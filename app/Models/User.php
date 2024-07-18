<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'email',
        'oauth_provider',
        'oauth_uid',
        'oauth_token',
        'oauth_refresh_token',
    ];

    protected $hidden = [
        'password',
        'oauth_token',
        'oauth_refresh_token',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class, 'owner_user_id');
    }

    public function storeUsers()
    {
        return $this->hasMany(StoreUser::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
