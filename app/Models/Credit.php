<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'montant',
    'type',
    'duree',
    'motif_credit',
    'compte_bancaire',
    'revenu_mensuel',
    'Attestation_travail_contrat',
    'Bulletins_salaire',
    'paiement_mensuel',
];

    protected $casts = [
        'amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method to calculate remaining amount
    public function getRemainingAmountAttribute()
    {
        $paid = $this->payments()->where('status', 'completed')->sum('amount');
        return $this->amount - $paid;
    }
}
