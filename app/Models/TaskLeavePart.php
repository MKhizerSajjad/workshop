<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLeavePart extends Model
{
    use HasFactory;
    protected $guarded;

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_leave_parts', 'part_id');
    }
}
