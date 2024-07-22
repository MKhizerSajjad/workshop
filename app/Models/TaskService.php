<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskService extends Model
{
    use HasFactory;
    protected $guarded;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_services');
    }
}
