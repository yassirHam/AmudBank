<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class SuperAdmin extends Authenticatable
{
    protected $guard = 'super_admin';
    protected $table = 'super_admin';
    protected $fillable = ['email', 'password'];
    protected $hidden = ['password'];
}
