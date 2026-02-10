<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArchive extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'services_archive';
    protected $fillable = [
        'service_id',
        'client_id',
        'service_name',
        'is_subscription',
        'service_code',
        'price',
        'tva',
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
        'month_year',
        'remains_subscription',
    ];
    public function service()
    {

        return $this->belongsTo(Service::class, 'service_id');
    }
}
