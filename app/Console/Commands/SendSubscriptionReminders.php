<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReminderBeforeSubscriptionEnd;
use App\Mail\ReminderAfterSubscriptionEnd;

class SendSubscriptionReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-subscription';

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
        $today = Carbon::today();

        $reminderBeforeDate = $today->addDays(3);
        $reminderAfterDate = $today->subDays(3);

        // Reminder 3 days before subscription end
        $servicesDueSoon = Service::where('is_subscription', 1)
            ->whereNull('subscription_end_date')
            ->get()
            ->filter(function ($service) use ($reminderBeforeDate) {
                $subscriptionEndDate = Carbon::parse($service->service_start_date)
                    ->addMonths($service->subscription_duration);

                return $subscriptionEndDate->eq($reminderBeforeDate);
            });
        foreach ($servicesDueSoon as $service) {
            $client = $service->client;
            if ($client) {
                Mail::to($client->email_client)->send(new ReminderBeforeSubscriptionEnd(
                    $client->name_client,
                    $client->enterprise_name,
                    $service->service_name,
                    $subscriptionEndDate->format('Y-m-d')
                ));
            }
        }
        

         // Send reminder 3 days after subscription end
         $reminderAfterDate = Carbon::today()->subDays(3);
         $servicesEndedRecently = Service::whereDate('subscription_end_date', $reminderAfterDate)
             ->where('payment_status', 'subscription end')
             ->get();

         foreach ($servicesEndedRecently as $service) {
             $client = $service->client;
             if ($client) {
                 Mail::to($client->email_client)->send(new ReminderAfterSubscriptionEnd(
                     $client->name_client,
                     $client->enterprise_name,
                     $service->service_name
                 ));
             }
         }
     }
}
