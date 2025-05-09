<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    protected $fillable = [
        'compte_id',
        'numero_compte',
        'numero_carte',
        'type_carte',
        'date_expiration',
        'code_securite',
        'etat',
        'date_creation',
        // 'plafond_journalier',
        'code_pin'
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }
}