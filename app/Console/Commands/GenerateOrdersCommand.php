<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use PDF;

class GenerateOrdersCommand extends Command
{
    protected $signature = 'orders:generate';
    protected $description = 'Generate orders for clients with is_subscription = 0 and services_status = "to do"';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Generating orders...');

        $services = Service::where('is_subscription', 0)
                         ->where('services_status', 'to do')
                         ->get();

        foreach ($services as $service) {
            $client = $service->client;

            $pdf = PDF::loadView('services.download', compact('client', 'service'));
            $fileName = 'bon_de_commande_' . $client->id . '.pdf';
            $filePath = 'public/orders/' . $fileName;

            // Save PDF to storage
            Storage::disk('local')->put($filePath, $pdf->output());

            $this->info('Order generated for client ID: ' . $client->id);
        }

        $this->info('All orders generated successfully.');
    }
}
