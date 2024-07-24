<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProduct extends Model
{
    use HasFactory;
    protected $guarded;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_products');
    }

    public function taskChildProducts()
    {
        return $this->hasMany(TaskProduct::class, 'task_products_id');
    }
}
