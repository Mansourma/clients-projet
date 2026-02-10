<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'client_id',
        'service_name',
        'is_subscription',
        'price',
        'total_price',
        'mode_payment',
        'service_description',
        'due_date',
        'dernier_paiement',
        'subscription_duration',
        'services_status',
        'payment_status',
        'validation_status',
        'service_start_date',
        'invoice_number',
        'remains_subscription',
    ];


    protected $dates = [
        'service_date',
        'due_date',
        'service_start_date',
        'service_end_date',
        'payment_status_updated_at',
        'validation_status_updated_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $lastService = Service::orderBy('id', 'desc')->first();
            $lastId = $lastService ? $lastService->id : 0;
            $service->service_code = str_pad($lastId + 1, 8, '0', STR_PAD_LEFT);
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class); // Ensure the Client model is imported
    }

    public function isExpired()
    {
        return $this->service_end_date && Carbon::parse($this->service_end_date)->isPast();
    }

    public function timeRemaining()
    {
        $now = Carbon::now();
        $endDate = Carbon::parse($this->service_end_date);

        if ($now->gt($endDate)) {
            return 'Expired';
        }

        $diff = $now->diff($endDate);

        if ($now->diffInMinutes($endDate) <= 2) {
            return 'Expires in less than 2 minutes';
        }

        return $diff->format('%d jours %h heures %i minutes');
    }

    public function isPaid()
    {
        return !is_null($this->payment_status) && $this->payment_status === 'payé';
    }

    public function countdown()
    {
        if (!$this->isPaid()) {
            return null;
        }

        $now = Carbon::now();
        $paidAt = Carbon::parse($this->payment_status_updated_at);
        $endCountdown = $paidAt->copy()->addMinutes(2);

        if ($now->gt($endCountdown)) {
            return 'Expired';
        }

        $diff = $now->diff($endCountdown);
        return $diff->format('%i minutes %s secondes');
    }

    public function archiveIfExpired()
    {
        $currentTime = now();
        if ($this->service_end_date && Carbon::parse($this->service_end_date)->lte($currentTime)) {
            $this->update([
                'services_status' => 'archivé',
                'archived_at' => $currentTime,
            ]);
        }
    }

    public function needsRevert($field)
    {
        $updatedAt = $this->{$field.'_updated_at'};
        return $updatedAt && $updatedAt->diffInMinutes(now()) >= 2;
    }

    public function invoices()
    {
        return $this->hasMany(InvoiceHistory::class);
    }

    public function invoice()
    {
        return $this->hasOne(InvoiceHistory::class); // Adjust the relationship type and class as needed
    }

    public function shouldGenerateInvoice()
    {
        if (!$this->service_start_date || !$this->subscription_duration) {
            return false;
        }

        $subscriptionEndDate = Carbon::parse($this->service_start_date)
                                     ->addMonths($this->subscription_duration);

        return $subscriptionEndDate->lessThanOrEqualTo(now()) &&
               !$this->invoices()->whereMonth('issue_date', now()->month)->exists();
    }

    public function createInvoice()
    {
        return $this->invoices()->create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'amount' => $this->price,
            'issue_date' => now(),
        ]);
    }

    private function generateInvoiceNumber()
    {
        return 'INV-' . strtoupper(uniqid());
    }

    public function factures()
    {
        return $this->hasMany(InvoiceHistory::class);
    }

    public function Clients()
    {
        return $this->belongs(Client::class);
    }

    public function archives()
    {
        return $this->hasMany(ServiceArchive::class, 'service_id');
    }
}
