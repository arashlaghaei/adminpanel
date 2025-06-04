<?php

namespace Modules\Core\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Modules\Core\Libraries\Traits\ACL;
use Modules\Core\Libraries\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Core\Database\Factories\UserFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Scopes, HasApiTokens , ACL;

    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'mobile',
        'phone',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'type',
        'is_admin',
        'api_token',
        'picture',
        'status',
        'email_verified_at',
        'password',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static $statusMap = [
        'active'   => 'فعال',
        'inactive' => 'غیرفعال',
        'pending'  => 'در انتظار تأیید',
        'banned'   => 'مسدود شده',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory()
    {
        return \Modules\Core\Database\Factories\UserFactory::new();
    }

    // Scopes

    public function scopeSearch($query)
    {
        $this->scopeBasicSearch($query);

        $request = request();
        if ($request->has('query')) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('id', 'like', "%{$request->input('query')}%");
                $query->orWhere('first_name', 'like', "%{$request->input('query')}%");
                $query->orWhere('last_name', 'like', "%{$request->input('query')}%");
            });
        }

        return $query;
    }

    public function getInitialsAttribute()
    {
        return strtoupper(
            mb_substr($this->first_name, 0, 1) .
            mb_substr($this->last_name, 0, 1)
        );
    }
    public function getTypeTranslateAttribute()
    {
        if ($this->type == 'admin') {
            return 'مدیر';
        }
        return 'کاربر';
    }


    public function getStatusTextAttribute()
    {
        return self::$statusMap[$this->status] ?? 'نامشخص';
    }
}
