<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\ActivityLog;

class MiniAdmin extends  Authenticatable
{
    protected $guard = 'mini_admins';
    protected $table = 'mini_admins';
    protected $fillable = ['email', 'password'];
    protected $hidden = ['password'];
    protected $casts = [
        'permissions' => 'array',
    ];
    protected static function booted()
{
    static::creating(function ($miniAdmin) {
        $miniAdmin->permissions = $miniAdmin->permissions ?? [];
    });
}
    public function hasPermission(string $permission): bool
{
    return in_array($permission, $this->permissions ?? []);
}

public function grantPermission(string $permission): void
{
    $permissions = $this->permissions ?? [];
    if (!in_array($permission, $permissions)) {
        $permissions[] = $permission;
        $this->update(['permissions' => $permissions]);
    }
}

public function revokePermission(string $permission): void
{
    $permissions = array_filter($this->permissions ?? [], fn($p) => $p !== $permission);
    $this->update(['permissions' => array_values($permissions)]);
}
public function logAction(string $action, string $description): void
{
    ActivityLog::create([
        'mini_admin_id' => $this->id,
        'action' => $action,
        'description' => $description,
    ]);
}
}
