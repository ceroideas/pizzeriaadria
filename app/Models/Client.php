<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\User;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'image',
        'phone',
        'status'
    ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function favorites() {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
