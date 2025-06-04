<?php

namespace Modules\Core\Libraries\Traits;

use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Role;

trait ACL
{

    public function allRoles()
    {
        $haveNotRole = Role::whereHas('permissions', function ($query) {
            $query->whereNotIn('permissions.id', $this->getPermissions()->pluck('id'));
        })->select('roles.id')->get()->pluck('id');
        return role::whereNotIn('id', $haveNotRole);
    }

    public function getPermissions()
    {
        if ($this->id == 1) {
            return Permission::all();
        }
        return auth()->user()->role()->with('permissions')->get()->pluck('permissions', 'id')->unique('id')->flatten();
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return role::contains('name', $role);
        }

        return !!$role->intersect($this->role)->count();
    }

    public function role()
    {
        return $this->belongsToMany(role::class, 'role_user');
    }
}