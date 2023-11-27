<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

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
}
