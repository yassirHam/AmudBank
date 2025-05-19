<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_compte',
        'solde',
        'statut',
        'numero_compte',
        'numero_carte',
        'type_carte',
        'date_expiration',
        'code_securite',
        'plafond_journalier',
        'rip',
        'Code_guichet',
    ];
    public static function generateRib()
    {
        $rib = '288';
        for ($i = 0; $i < 21; $i++) {
            $rib .= mt_rand(0, 9);
        }
        return $rib;
    }
    public static function CodeGuichet(){
        $codeGuichet = '';
        for ($i = 0; $i < 4; $i++) {
            $codeGuichet .= mt_rand(0, 9); 
        }
        return $codeGuichet;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
