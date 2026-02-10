<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'prenom', 'age', 'date_of_birth', 'cin', 'email', 'password', 'image', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Role methods
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
