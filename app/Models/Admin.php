<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'sku',
        'email_verified_at',
        'status',
        'confirmation_code',
        'confirmed',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
}
