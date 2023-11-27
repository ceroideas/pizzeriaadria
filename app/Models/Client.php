<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Order;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'image',
        'status',
    ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
