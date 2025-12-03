<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'amount',
        'month',
        'year',
        'proof',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
