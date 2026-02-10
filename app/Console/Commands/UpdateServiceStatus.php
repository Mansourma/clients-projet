<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Service;


class UpdateServiceStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-service-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $services = Service::where('payment_status', 'payé')
            ->where('due_date', '<=', $now)
            ->get();

        foreach ($services as $service) {
            if ($service->due_date && $now->greaterThanOrEqualTo($service->due_date)) {
                $service->payment_status = 'non payé';
                $service->validation_status = 'non-validé';
                $service->save();
                
            }
        }

        $this->info('Service statuses updated successfully.');
    }
}
