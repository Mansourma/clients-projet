<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceArchive;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArchiveServices extends Command
{
    protected $signature = 'services:archive';
    protected $description = 'Archive service data monthly';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDate = Carbon::now();
        $currentMonthYear = $currentDate->format('m-Y');

        if ($currentDate->day == 28) {
            $this->archiveAllServices($currentMonthYear);
        }

        $this->archiveAndDeleteSpecialServices($currentMonthYear);

        $this->info('Archiving process completed successfully.');
    }

    private function archiveAllServices($currentMonthYear)
    {
        $services = Service::all();

        foreach ($services as $service) {
            $existingArchive = ServiceArchive::where('id', $service->id)
                ->where('month_year', $currentMonthYear)
                ->first();

            if (!$existingArchive) {
                ServiceArchive::create([
                    'id' => $service->id,
                    'client_id' => $service->client_id,
                    'service_name' => $service->service_name,
                    'service_code' => $service->service_code,
                    'price' => $service->price,
                    'tva' => $service->tva,
                    'total_price' => $service->total_price,
                    'is_subscription' => $service->is_subscription,
                    'services_status' => $service->services_status,
                    'mode_payment' => $service->mode_payment,
                    'service_description' => $service->service_description,
                    'due_date' => $service->due_date,
                    'dernier_paiement' => $service->dernier_paiement,
                    'subscription_duration' => $service->subscription_duration,
                    'payment_status' => $service->payment_status,
                    'validation_status' => $service->validation_status,
                    'service_start_date' => $service->service_start_date,
                    'invoice_number' => $service->invoice_number,
                    'month_year' => $currentMonthYear,
                    'remains_subscription' => $service->remains_subscription,
                ]);
            }
        }
    }

    private function archiveAndDeleteSpecialServices($currentMonthYear)
    {
        $services = Service::where(function ($query) {
            $query->where('is_subscription', 0)
                  ->where('services_status', 'fini');
        })->orWhere(function ($query) {
            $query->where('is_subscription', 1)
                  ->where('remains_subscription', 0)
                  ->where('services_status', 'fini');
        })->get();

        foreach ($services as $service) {
            DB::beginTransaction();

            try {
                // Check if the service has already been archived for the current month
                $existingArchive = ServiceArchive::where('id', $service->id)
                    ->where('month_year', $currentMonthYear)
                    ->first();

                if (!$existingArchive) {
                    // Archive the service
                    ServiceArchive::create([
                        'id' => $service->id,
                        'client_id' => $service->client_id,
                        'service_name' => $service->service_name,
                        'service_code' => $service->service_code,
                        'price' => $service->price,
                        'tva' => $service->tva,
                        'total_price' => $service->total_price,
                        'mode_payment' => $service->mode_payment,
                        'is_subscription' => $service->is_subscription,
                        'services_status' => $service->services_status,
                        'service_description' => $service->service_description,
                        'due_date' => $service->due_date,
                        'dernier_paiement' => $service->dernier_paiement,
                        'subscription_duration' => $service->subscription_duration,
                        'payment_status' => $service->payment_status,
                        'validation_status' => $service->validation_status,
                        'service_start_date' => $service->service_start_date,
                        'invoice_number' => $service->invoice_number,
                        'month_year' => $currentMonthYear,
                        'remains_subscription' => $service->remains_subscription,
                    ]);

                    // Delete the service from the Service table
                    $service->delete();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                // Log the exception or handle it as needed
                $this->error('Failed to archive service ID ' . $service->id . ': ' . $e->getMessage());
            }
        }

        $this->info('Service data archived and deleted successfully.');
    }


}
