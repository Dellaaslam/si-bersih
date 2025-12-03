<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    protected $fillable = [
        'user_id',
        'location',
        'description',
        'photo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
