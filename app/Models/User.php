<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Compte;
use App\Models\Delete_request;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable // Extend the Authenticatable class
{
    use Notifiable;
    use SoftDeletes;

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
        'status', 
    ];
    
    public function comptes()
{
    return $this->hasMany(Compte::class);
}
public function transactions()
{
    return $this->hasManyThrough(Transaction::class, Compte::class);
}
public function deleteRequest()
{
    return $this->hasOne(Delete_request::class);
}
}