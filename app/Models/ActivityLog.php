<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['mini_admin_id', 'action', 'description'];
    public function miniAdmin()
    {
        return $this->belongsTo(\App\Models\MiniAdmin::class);
    }
}