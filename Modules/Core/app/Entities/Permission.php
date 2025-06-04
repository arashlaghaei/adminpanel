<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\Factories\PermissionFactory;
use Modules\Core\Libraries\Traits\Scopes;

class Permission extends Model
{
    use HasFactory , Scopes;
    
    protected $fillable = [
        'name',
        'label',
        'group',
        'mainGroup',
        'routeName',
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permission_m');
    }
    
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PermissionFactory::new();
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
