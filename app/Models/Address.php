<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'postal_code',
        'city',
        'lat',
        'lng',
        'client_id',
        'default'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
