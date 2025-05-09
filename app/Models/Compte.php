<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_compte',
        'solde',
        'statut',
        'numero_compte',
        'date_ouverture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}