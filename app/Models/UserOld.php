<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Modules\Core\Libraries\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserOld extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Scopes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

}
