<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delete_request extends Model
{
    protected $fillable = [
        'user_id',
        'motif',
        'type_compte',
        'reponse',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}