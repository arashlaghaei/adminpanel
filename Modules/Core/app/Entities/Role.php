<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Libraries\Traits\Scopes;

class Role extends Model
{
    use Scopes;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'label',
    ];

    public function permissions()
    {
        return $this->belongsToMany(permission::class,'role_permission_m')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany(User::class,'role_user_m','role_id','user_id')->withTimestamps();
    }

    public function givePermissionTo(permission $permission)
    {
        return $this->permissions()->save($permission);
    }


    public function scopeSearch($query)
    {
        $this->scopeBasicSearch($query);

        $request = request();
        if ($request->has('query')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('id', 'like', "%{$request->input('query')}%");
                $query->orWhere('name', 'like', "%{$request->input('query')}%");
                $query->orWhere('label', 'like', "%{$request->input('query')}%");
            });
        }

        return $query;
    }
}
