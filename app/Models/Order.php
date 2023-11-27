<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'status'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
