<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // App\Models\Client.php
    use HasFactory;

    protected $fillable = [
        'code_client',
        'client_type',
        'society_type',
        'name_client',
        'prenom_client',
        'email_client',
        'telephone_client',
        'secondary_telephone_client',
        'address_client',
        'address_client2',
        'cin_client',
        'genre_client',
        'sector_of_work_client',
        'date_of_birth_client',
        'registration_datetime_client',
        'enterprise_name',
        'ice_enterprise',
        'telephone_enterprise',
        'address_enterprise',
        'address_enterprise2',
        'secondary_telephone_enterprise',
        'legal_representative_name_enterprise',
        'legal_representative_prenom_enterprise',
        'legal_representative_cin_enterprise',
        'legal_representative_nationality_enterprise',
        'legal_representative_email_enterprise',
        'registration_datetime_enterprise',
    ];


    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function invoices()
    {
        return $this->hasMany(InvoiceHistory::class); // Relation avec le modèle Invoice
    }
    public function lastInvoice()
    {
        return $this->invoices()->latest('issued_at')->first(); // Dernière facture
    }

    public function factures()
    {
        return $this->hasMany(InvoiceHistory::class);
    }



    /*class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'telephone',
        'cin',
        'genre',
        'address',
        'sector_of_work',
        'date_of_birth',
        'registration_datetime',
        'type_of_organization',
        'organization_name',
        'organization_identification',
        'activity_sector',
        'legal_representative_name',
        'legal_representative_prenom',
        'legal_representative_cin',
        'legal_representative_nationality',
        'secondary_address',
        'secondary_telephone',
        'has_branches',
    ];
}*/

    // Other model methods and properties
}
