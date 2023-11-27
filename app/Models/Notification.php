<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'title',
        'message',
        'data',
        'status',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
