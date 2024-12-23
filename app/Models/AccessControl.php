<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;
    protected $guarded;

    protected $casts = [
        'working_days' => 'array', // Store working days as an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
