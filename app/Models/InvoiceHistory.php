<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use pdf;

class InvoiceHistory extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'service_id', 'invoice_number', 'issued_at', 'amount', 'status', 'generated_at','invoice_number'];

    protected $dates = ['invoice_date'];


    // Optionally, define relationships if necessary
 

// App\Models\InvoiceHistory.php

// App\Models\InvoiceHistory.php

public function services()
{
    return $this->belongsToMany(Service::class, 'invoice_service', 'invoice_id', 'service_id');
}

    

    public function showInvoices()
    {
        $histories = InvoiceHistory::all(); // Adjust the query to fetch the necessary data
        return view('invoices.index', compact('histories'));
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    // Pour générer un nouveau numéro de facture
    public static function generateNewInvoiceNumber()
    {
        $lastInvoice = self::orderBy('invoice_number', 'desc')->first();
        $lastNumber = $lastInvoice ? (int) $lastInvoice->invoice_number : 0;
        return str_pad($lastNumber + 1, 8, '0', STR_PAD_LEFT);
    }
    // Dans App\Models\InvoiceHistory
public function getFormattedNumberAttribute()
{
    return str_pad($this->invoice_number, 8, '0', STR_PAD_LEFT);
}


}

