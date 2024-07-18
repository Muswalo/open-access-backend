<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'logins';

    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
        'ip_address',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
