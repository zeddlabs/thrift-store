<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    public $fillable = [
        'name',
        'email',
        'password',
        'whatsapp',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
