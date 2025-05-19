<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Compte;
use App\Models\Transaction;

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
        'cin_image',
        'email_verified_at',
        'birthday',
        'adresse',
    ];
    
    public function comptes()
{
    return $this->hasMany(Compte::class);
}
public function transactions()
{
    return $this->hasManyThrough(Transaction::class, Compte::class);
}
}