<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReminderBeforePaymentDue;


class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-payment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Calculate the date 3 days before today
        $reminderBeforeDate = $today->addDays(3);
        $servicesDueSoon = Service::where('is_subscription', 1)
            ->where('payment_status', 'payé')
            ->whereDate('due_date', $reminderBeforeDate)
            ->get();

        foreach ($servicesDueSoon as $service) {
            $client = $service->client;
            if ($client) {
                Mail::to($client->email_client)->send(new ReminderBeforePaymentDue(
                    $client->name_client,
                    $client->enterprise_name,
                    $service->service_name,
                    Carbon::parse($service->due_date)->format('Y-m-d')
                ));
            }
        }
}

}
