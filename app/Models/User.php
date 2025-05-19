<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Add this line
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable // Extend the Authenticatable class
{
    use Notifiable; // Include the Notifiable trait for notifications

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Nom', 
        'Prenom',
        'Cin',
        'Role',
        'email',
        'telephone',
        'password',
        'rip',
        'cin_image',
        'email_verified_at',
        'birthday',
        'adresse',
        'status',
    ];
    protected $casts = [
    'status' => 'string',
    ];
    public static function generateRib()
    {
        $rib = '288';
        for ($i = 0; $i < 21; $i++) {
            $rib .= mt_rand(0, 9);
        }
        return $rib;
    }
    public function comptes()
{
    return $this->hasMany(Compte::class);
}
}
