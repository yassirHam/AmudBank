<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'compte_id',
        'numero_compte',
        'compte_source',
        'montant',
        'status',
        'transaction_type',
        'description',
        'nom_complete',
        'numero_compte_destination',
        'source_account',
    ];

    // Définir la relation avec le modèle User (si tu as une table users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function compte()
{
    return $this->belongsTo(Compte::class);
}
}