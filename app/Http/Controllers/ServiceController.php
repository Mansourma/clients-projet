<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\InvoiceHistory;
use App\Models\Facture;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\ServiceArchive;
use App\Mail\SubscriptionConfirmed;
use App\Mail\SubscriptionEnded;
use Illuminate\Support\Facades\Mail;


use Illuminate\Routing\Controller as BaseController;
class ServiceController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $is_subscription = $request->query('is_subscription');
        $search = $request->input('search');
        $status = $request->query('status');
        $year = $request->query('year', date('Y'));
        if ($status === 'archivé') {
            $servicesQuery = ServiceArchive::whereYear('created_at', $year);
        } else {
            $servicesQuery = Service::query();
        }

        if ($search) {
            $servicesQuery->where(function ($query) use ($search) {
                $query->where('service_code', 'LIKE', "%{$search}%")
                    ->orWhere('service_name', 'LIKE', "%{$search}%")
                    ->orWhereHas('client', function ($query) use ($search) {
                        $query->where('name_client', 'LIKE', "%{$search}%")
                            ->orWhere('enterprise_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($is_subscription !== null) {
            $servicesQuery->where('is_subscription', $is_subscription);
        }

        if ($status && $status !== 'archivé') {
            $servicesQuery->where('services_status', $status);
        }

        $perPage = 10;
        $services = $servicesQuery->paginate($perPage);

        $totalServices = $services->total();
        $totalPrice = $services->sum('price');

        $totalAfairNonAbonne = Service::where('services_status', 'to do')->where('is_subscription', '0')->count();
        $totalAfairAbonne = Service::where('services_status', 'to do')->where('is_subscription', '1')->count();
        $totalNonAbonne = Service::where('is_subscription', '0')->count();
        $totalAbonne = Service::where('is_subscription', '1')->count();

        $archivedServices = ServiceArchive::whereYear('created_at', $year)->count();

        return view('services.index', compact(
            'services',
            'totalServices',
            'totalPrice',
            'is_subscription',
            'status',
            'totalAfairNonAbonne',
            'totalAfairAbonne',
            'totalNonAbonne',
            'totalAbonne',
            'archivedServices',
            'year'
        ));
    }





    public function create(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        return view('services.create', compact('client'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'enterprise_name' => 'nullable|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
            'service_name' => 'required|string',
            'is_subscription' => 'required|in:0,1',
            'subscription_duration' => 'nullable|required_if:is_subscription,1|string|in:1,3,6,12,24',
            'mode_payment' => 'required|string',
            'service_description' => 'nullable|required_if:is_subscription,0|string',
            'total_price' => 'nullable|numeric|min:0',
            'payment_status' => 'required|string|in:payé,non payé',
        ]);

        $service = new Service();
        $service->client_id = $request->client_id;
        $service->service_name = $request->service_name;
        $service->is_subscription = $request->is_subscription;
        $service->mode_payment = $request->mode_payment;
        $service->payment_status = $request->payment_status;
        $service->price = $request->price;
        $service->total_price = $request->total_price;
        $service->service_description = $request->service_description;
        $service->service_start_date = now();

        if ($request->is_subscription == '1') {
            $service->subscription_duration = $request->subscription_duration;
            $service->remains_subscription = $request->subscription_duration;
            $service->due_date = now()->addMonths(1);
        } else {
            $service->price = $request->total_price;
            $service->service_description = $request->service_description;
            $service->due_date = null;
        }

        $currentYear = now()->year;

        $lastInvoice = Service::whereYear('created_at', $currentYear)->orderBy('invoice_number', 'desc')->first();
        $lastInvoiceNumber = $lastInvoice ? (int)$lastInvoice->invoice_number : 0;
        $newInvoiceNumber = str_pad($lastInvoiceNumber + 1, 8, '0', STR_PAD_LEFT);

        $service->invoice_number = $newInvoiceNumber;
        $service->services_status = 'waiting';
        $service->created_at = now();

        if ($request->payment_status === 'payé') {
            $service->validation_status = 'en cours';
            $service->dernier_paiement = now();
        } else if ($request->payment_status === 'non payé') {
            $service->validation_status = 'non-validé';
            $service->due_date = null;
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service ajouté avec succès.');
    }






    public function show($id)
    {
        $service = Service::findOrFail($id);
        $currentDate = Carbon::now()->format('d/m/Y');
        return view('services.show', compact('service', 'currentDate'));
    }



    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function editCustom($id)
    {

        $service = Service::findOrFail($id);
        $client = $service->client;
        return view('services.edit_service', compact('service', 'client'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'services_status' => 'required|string|in:waiting,in progress,to do,done',
            'payment_status' => 'required|string|in:payé,non payé,subscription end',
            'validation_status' => 'required|string|in:validé,non-validé',
        ]);

        $service = Service::findOrFail($id);
        $service->services_status = $validated['services_status'];
        $service->payment_status = $validated['payment_status'];
        $service->validation_status = $validated['validation_status'];

        $service->updated_at = now();
        $service->save();
        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function updateCustom(Request $request, Service $service)
    {
        $request->validate([
            'enterprise_name' => 'nullable|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
            'service_name' => 'required|string',
            'is_subscription' => 'required|in:0,1',
            'subscription_duration' => 'nullable|required_if:is_subscription,1|string|in:1,3,6,12,24',
            'mode_payment' => 'required|string',
            'service_description' => 'nullable|required_if:is_subscription,0|string',
            'total_price' => 'nullable|numeric|min:0',
            'payment_status' => 'required|string|in:payé,non payé',
            'services_status' => 'nullable|string',
        ]);

        // Update the service attributes
        if ($request->has('services_status')) {
            $service->services_status = $request->services_status;
        }
        $service->client_id = $request->client_id;
        $service->service_name = $request->service_name;
        $service->is_subscription = $request->is_subscription;
        $service->mode_payment = $request->mode_payment;
        $service->price = $request->price;
        $service->total_price = $request->total_price;
        $service->service_description = $request->service_description;

        if ($request->is_subscription == '1') {
            $service->subscription_duration = $request->subscription_duration;
            if ($service->remains_subscription !== $request->subscription_duration) {
                $service->remains_subscription = $request->subscription_duration;
                $service->due_date = now()->addMonths($request->subscription_duration);
            }
        } else {
            $service->price = $request->total_price;
            $service->service_description = $request->service_description;
            $service->due_date = null;
        }

        // Update the payment status only if it has changed
        if ($request->payment_status !== $service->payment_status) {
            $service->payment_status = $request->payment_status;

            // Update validation status based on new payment status
            if ($request->payment_status === 'payé') {
                $service->validation_status = 'en cours';
                $service->dernier_paiement = now();
            } else if ($request->payment_status === 'non payé') {
                $service->validation_status = 'non-validé';
                $service->due_date = null;
            }
        }

        $service->save();
        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }




    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }



    public function downloadOrder($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $client = $service->client;
        $pdf = Pdf::loadView('services.download', [
            'service' => $service,
            'client' => $client,
        ]);


        return $pdf->download('order.pdf');
    }





    private function generateNewServiceCode()
    {
        $lastService = Service::orderBy('id', 'desc')->first();
        $newCode = $lastService ? sprintf('%08d', $lastService->id + 1) : '00000001';
        return $newCode;
    }


    public function updatePaymentStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:payé,non payé',
        ]);

        $service = Service::findOrFail($id);
        $newStatus = $validatedData['status'];
        $service->payment_status = $newStatus;

        if ($newStatus === 'payé') {
            $currentYear = now()->year;
            $lastInvoice = Service::whereYear('created_at', $currentYear)->orderBy('invoice_number', 'desc')->first();
            $lastInvoiceNumber = $lastInvoice ? (int)$lastInvoice->invoice_number : 0;
            $newInvoiceNumber = str_pad($lastInvoiceNumber + 1, 8, '0', STR_PAD_LEFT);

            $service->invoice_number = $newInvoiceNumber;

            $service->validation_status = 'en cours';
            $service->dernier_paiement = now();
            $service->due_date = now()->addMonths(1);
            $service->remains_subscription = max(0, $service->remains_subscription - 1);

            if ($service->remains_subscription === 0) {
                $service->payment_status = 'subscription end';
                $service->validation_status = 'non-validé';
                $service->due_date = null;
                $service->subscription_end_date = now();


                $client = $service->client;
                if ($client && $client->email_client) {
                    try {
                        Mail::to($client->email_client)->send(new SubscriptionEnded(
                            $client->client_type === 'society' ? $client->enterprise_name : $client->name_client,
                            $service->service_name,
                            $client->client_type,
                            $client->enterprise_name
                        ));
                    } catch (\Exception $e) {
                        \Log::error('Failed to send subscription end email: ' . $e->getMessage());
                    }
                }
            }
        } else if ($newStatus === 'non payé') {
            $service->validation_status = 'non-validé';
            $service->due_date = null;
        }

        $service->save();

        return redirect()->back()->with('success', 'Statut de paiement mis à jour.');
    }





    public function downloadInvoice($id)
    {
        $service = Service::where('id', $id)
            ->where('payment_status', 'payé')
            ->where('validation_status', 'validé')
            ->firstOrFail();

        $pdf = PDF::loadView('invoices.service_facture', [
            'service' => $service,
        ]);

        return $pdf->download('invoice_'.$service->invoice_number.'.pdf');
    }



    public function clientArchives($clientId)
  {
    $client = Client::findOrFail($clientId);
    $archives = ServiceArchive::where('client_id', $clientId)->paginate(10);
    return view('services.archive', compact('client', 'archives'));
  }

public function ServiceArchiveShow($service_id, $client_id, $month_year)
{
    $archive = ServiceArchive::where('service_id', $service_id)
                                     ->where('client_id', $client_id)
                                     ->where('month_year', $month_year)
                                     ->firstOrFail();

    return view('services.archive_show', compact('archive'));
}




public function updateValidationStatus(Request $request, $id)
{
    $validatedData = $request->validate([
        'status' => 'required|in:validé,non-validé',
    ]);

    $service = Service::findOrFail($id);
    $newValidationStatus = $validatedData['status'];

    if ($newValidationStatus === 'non-validé') {
        $service->payment_status = 'non payé';
        $service->validation_status = 'non-validé';
    } else if ($newValidationStatus === 'validé') {
        if ($service->payment_status !== 'payé') {
            return redirect()->back()->with('error', 'Le paiement doit être validé avant de valider le service.');
        }

        $service->validation_status = 'validé';
        $pdf = PDF::loadView('invoices.service_facture', [
            'service' => $service,
        ]);
        $invoicePath = public_path('storage/invoices/invoice_' . $service->invoice_number . '.pdf');
        $pdf->save($invoicePath);

        $client = $service->client;

        if ($client) {
            try {
                if ($client->client_type === 'society' && $client->legal_representative_email_enterprise) {
                    Mail::to($client->legal_representative_email_enterprise)->send(new SubscriptionConfirmed(
                        $client->enterprise_name,
                        $service->service_name,
                        $invoicePath,
                        $service->invoice_number,
                        $client->client_type,
                        $client->enterprise_name
                    ));
                } elseif ($client->email_client) {
                    Mail::to($client->email_client)->send(new SubscriptionConfirmed(
                        $client->name_client,
                        $service->service_name,
                        $invoicePath,
                        $service->invoice_number,
                        $client->client_type,
                        null
                    ));
                } else {
                    \Log::warning('No valid email address for client ID: ' . $client->id);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send email: ' . $e->getMessage());
            }
        }
    } else {
        return redirect()->back()->with('error', 'Statut de validation invalide.');
    }

    $service->save();

    return redirect()->back()->with('success', 'Statut de validation mis à jour.');
}



public function generateInvoices()
    {
        $services = Service::where('subscription_start_date', '<=', now())
                           ->where('subscription_duration_months', '>', 0)
                           ->get();

        foreach ($services as $service) {
            if ($service->shouldGenerateInvoice()) {
                $service->createInvoice();
            }
        }

        return redirect()->route('services.index')->with('success', 'Factures générées avec succès.');
    }


public function updateServiceStatus(Request $request, $id)
{
    $service = Service::findOrFail($id);
    $service->services_status = $request->input('status');
    $service->save();

    return response()->json(['status' => 'success', 'is_subscription' => $service->is_subscription]);
}


}







