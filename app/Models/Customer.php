<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Notifiable;
    use HasFactory;
    protected $guarded;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
