<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $guarded;
    // protected $fillable = [
    //     'user_id', 'model_name', 'action', 'ip_address', 'user_agent', 'changes',
    // ];

    protected $casts = [
        // 'changes' => 'array',  // Automatically convert JSON into array
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
