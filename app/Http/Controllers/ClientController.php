<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\Admin;
use App\Models\InvoiceHistory;
use App\Models\History;
use App\Http\Middleware;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\ServiceArchive;
use Illuminate\Support\Facades\Mail;
use App\Mail\addClient;



use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ClientCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ClientController extends BaseController

{
    // Display a listing of the clients

    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    public function index(Request $request)
{
    $searchCode = $request->query('search_code');
    $type = $request->query('type');

    $clientsQuery = Client::query();

    if ($searchCode) {
        $clientsQuery->where('code_client', 'like', '%' . $searchCode . '%');
    }

    if ($type && in_array($type, ['individual', 'society'])) {
        $clientsQuery->where('client_type', $type);
    }

    $clients = $clientsQuery->paginate(10)->appends($request->query());

    $totalClients = Client::count();
    $totalIndividualClients = Client::where('client_type', 'individual')->count();
    $totalEnterpriseClients = Client::where('client_type', 'society')->count();

    $individualClients = $type == 'individual' ? $clients : collect();
    $enterpriseClients = $type == 'society' ? $clients : collect();

    if (!$type) {
        $individualClients = $clients->filter(function ($client) {
            return $client->client_type == 'individual';
        });

        $enterpriseClients = $clients->filter(function ($client) {
            return $client->client_type == 'society';
        });
    }

    return view(
        'clients.index',
        compact(
            'individualClients',
            'enterpriseClients',
            'searchCode',
            'type',
            'totalClients',
            'totalIndividualClients',
            'totalEnterpriseClients',
            'clients'
        )
    );
}


    public function search(Request $request)
    {
        $searchCode = $request->input('search_code');
        $clients = Client::where('code_client', 'like', '%' . $searchCode . '%')->get();

        $individualClients = $clients->where('client_type', 'individual');
        $enterpriseClients = $clients->where('client_type', 'society');

        return view('clients.index', compact('individualClients', 'enterpriseClients'));
    }


    public function create()
    {
        $codeClient = $this->generateUniqueCodeClient();

        return view('clients.create', compact('codeClient'));
    }

    private function generateUniqueCodeClient()
    {
        do {
            $codeClient = sprintf('%08d', rand(0, 99999999));
        } while (Client::where('code_client', $codeClient)->exists());

        return $codeClient;
    }

    public function store(Request $request)
    {
        $rules = [
            'client_type' => 'required|in:individual,society',
            'code_client' => 'required|string',
        ];

        if ($request->input('client_type') === 'individual') {
            $rules = array_merge($rules, [
                'name_client' => 'required|string',
                'prenom_client' => 'required|string',
                'email_client' => 'required|email|unique:clients,email_client',
                'cin_client' => 'required|string|unique:clients,cin_client',
                'genre_client' => 'required|string',
                'sector_of_work_client' => 'required|string',
                'date_of_birth_client' => 'required|date',
                'telephone_client' => 'nullable|string',
                'address_client' => 'nullable|string',
                'secondary_telephone_client' => 'nullable|string',
                'registration_datetime_client' => 'nullable|date',
            ]);
        } elseif ($request->input('client_type') === 'society') {
            $rules = array_merge($rules, [
               'society_type' => 'required|in:company,enterprise,foundation,association,cooperative,gov foundation',
                'enterprise_name' => 'required|string',
                'ice_enterprise' => 'required|string',
                'telephone_enterprise' => 'required|string',
                'address_enterprise' => 'required|string',
                'secondary_telephone_enterprise' => 'nullable|string',
                'legal_representative_name_enterprise' => 'required|string',
                'legal_representative_prenom_enterprise' => 'required|string',
                'legal_representative_cin_enterprise' => 'required|string',
                'legal_representative_nationality_enterprise' => 'required|string',
                'legal_representative_email_enterprise' => 'required|email',
                'legal_representative_position_enterprise' => 'required|string',
                'tax_identification_number_enterprise' => 'required',
                'enterprise_sector' => 'required|string',
            ]);
        }

        $validatedData = $request->validate($rules);
        $client = new Client();
        $client->client_type = $validatedData['client_type'];
        $client->code_client = $validatedData['code_client'];

        if (isset($validatedData['registration_datetime_client'])) {
            $client->registration_datetime = $validatedData['registration_datetime_client'];
        }

        if ($validatedData['client_type'] === 'individual') {
            $client->name_client = $validatedData['name_client'];
            $client->prenom_client = $validatedData['prenom_client'];
            $client->email_client = $validatedData['email_client'];
            $client->cin_client = $validatedData['cin_client'];
            $client->genre_client = $validatedData['genre_client'];
            $client->sector_of_work_client = $validatedData['sector_of_work_client'];
            $client->date_of_birth_client = $validatedData['date_of_birth_client'];
            $client->telephone_client = $validatedData['telephone_client'];
            $client->registration_datetime_client = $validatedData['registration_datetime_client'];
            $client->address_client = $validatedData['address_client'];
            $client->address_client2 = $request->input('address_client2');
            $client->secondary_telephone_client = $validatedData['secondary_telephone_client'];
            Mail::to($client->email_client)->send(new addClient($client->name_client, $client->client_type));

        } elseif ($validatedData['client_type'] === 'society') {
            $client->society_type = $validatedData['society_type'];
            $client->enterprise_name = $validatedData['enterprise_name'];
            $client->ice_enterprise = $validatedData['ice_enterprise'];
            $client->telephone_enterprise = $validatedData['telephone_enterprise'];
            $client->secondary_telephone_enterprise = $validatedData['secondary_telephone_enterprise'];
            $client->address_enterprise = $validatedData['address_enterprise'];
            $client->address_enterprise2 = $request->input('address_enterprise2');
            $client->legal_representative_name_enterprise = $validatedData['legal_representative_name_enterprise'];
            $client->legal_representative_prenom_enterprise = $validatedData['legal_representative_prenom_enterprise'];
            $client->legal_representative_cin_enterprise = $validatedData['legal_representative_cin_enterprise'];
            $client->legal_representative_email_enterprise = $validatedData['legal_representative_email_enterprise'];
            $client->legal_representative_position_enterprise = $validatedData['legal_representative_position_enterprise'];
            $client->legal_representative_nationality_enterprise = $validatedData['legal_representative_nationality_enterprise'];
            $client->tax_identification_number_enterprise = $validatedData['tax_identification_number_enterprise'];
            $client->enterprise_sector = $validatedData['enterprise_sector'];
            Mail::to($client->legal_representative_email_enterprise)
            ->send(new AddClient($client->enterprise_name, $client->client_type, $client->legal_representative_name_enterprise));
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès!');
    }



    public function show($id)
    {
        $client = Client::findOrFail($id);
        $archives = ServiceArchive::where('client_id', $id)->paginate(10);

        return view('clients.show', compact('client', 'archives'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $rules = [
            'client_type' => 'required|in:individual,society',
            'code_client' => 'required|string',
        ];

        if ($request->input('client_type') === 'individual') {
            $rules = array_merge($rules, [
                'name_client' => 'required|string',
                'prenom_client' => 'required|string',
                'email_client' => 'required|email|unique:clients,email_client,' . $client->id,
                'cin_client' => 'required|string|unique:clients,cin_client,' . $client->id,
                'genre_client' => 'required|string',
                'sector_of_work_client' => 'required|string',
                'date_of_birth_client' => 'required|date',
                'telephone_client' => 'nullable|string',
                'address_client' => 'nullable|string',
                'secondary_telephone_client' => 'nullable|string',
                'registration_datetime_client' => 'nullable|date',
            ]);
        } elseif ($request->input('client_type') === 'society') {
            $rules = array_merge($rules, [
                'society_type' => 'required|in:company,enterprise,foundation,association,cooperative,gov foundation',
                'enterprise_name' => 'required|string',
                'ice_enterprise' => 'required|string',
                'telephone_enterprise' => 'required|string',
                'address_enterprise' => 'required|string',
                'secondary_telephone_enterprise' => 'nullable|string',
                'legal_representative_name_enterprise' => 'required|string',
                'legal_representative_prenom_enterprise' => 'required|string',
                'legal_representative_cin_enterprise' => 'required|string',
                'legal_representative_nationality_enterprise' => 'required|string',
                'legal_representative_email_enterprise' => 'required|email',
                'legal_representative_position_enterprise' => 'required|string',
                'tax_identification_number_enterprise' => 'required',
                'enterprise_sector' => 'required|string',

            ]);
        }

        $validatedData = $request->validate($rules);

        $client->client_type = $validatedData['client_type'];
        $client->code_client = $validatedData['code_client'];

        if (isset($validatedData['registration_datetime_client'])) {
            $client->registration_datetime = $validatedData['registration_datetime_client'];
        }

        if ($validatedData['client_type'] === 'individual') {
            $client->name_client = $validatedData['name_client'];
            $client->prenom_client = $validatedData['prenom_client'];
            $client->email_client = $validatedData['email_client'];
            $client->cin_client = $validatedData['cin_client'];
            $client->genre_client = $validatedData['genre_client'];
            $client->sector_of_work_client = $validatedData['sector_of_work_client'];
            $client->date_of_birth_client = $validatedData['date_of_birth_client'];
            $client->telephone_client = $validatedData['telephone_client'];
            $client->address_client = $validatedData['address_client'];
            $client->address_client2 = $request->input('address_client2');
            $client->secondary_telephone_client = $validatedData['secondary_telephone_client'];
        } elseif ($validatedData['client_type'] === 'society') {
            $client->society_type = $validatedData['society_type'];
            $client->enterprise_name = $validatedData['enterprise_name'];
            $client->ice_enterprise = $validatedData['ice_enterprise'];
            $client->telephone_enterprise = $validatedData['telephone_enterprise'];
            $client->address_enterprise = $validatedData['address_enterprise'];
            $client->secondary_telephone_enterprise = $validatedData['secondary_telephone_enterprise'];
            $client->legal_representative_name_enterprise = $validatedData['legal_representative_name_enterprise'];
            $client->legal_representative_prenom_enterprise = $validatedData['legal_representative_prenom_enterprise'];
            $client->legal_representative_cin_enterprise = $validatedData['legal_representative_cin_enterprise'];
            $client->legal_representative_nationality_enterprise = $validatedData['legal_representative_nationality_enterprise'];
            $client->legal_representative_email_enterprise = $validatedData['legal_representative_email_enterprise'];
            $client->legal_representative_position_enterprise = $validatedData['legal_representative_position_enterprise'];
            $client->tax_identification_number_enterprise = $validatedData['tax_identification_number_enterprise'];
            $client->enterprise_sector = $validatedData['enterprise_sector'];
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès!');
    }


    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function downloadOrder($clientId, $serviceId)
    {
        $client = Client::findOrFail($clientId);
        $service = $client->services()->where('id', $serviceId)->firstOrFail();

        $pdf = PDF::loadView('services.download', compact('client', 'service'));
        return $pdf->download('bon_de_commande_' . $service->invoice_number . '.pdf');
    }




}
