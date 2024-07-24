<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id')->where('user_type', 3);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function media()
    {
        return $this->hasMany(TaskMedia::class);
    }

    public function taskServices()
    {
        return $this->hasMany(TaskService::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'task_services');
    }

    public function taskLeaveParts()
    {
        return $this->hasMany(TaskLeavePart::class);
    }

    public function leaveParts()
    {
        return $this->belongsToMany(TaskLeavePart::class, 'task_leave_parts', 'task_id', 'part_id');
    }

    public function taskProducts()
    {
        return $this->hasMany(TaskProduct::class)->where('task_products_id', null);
    }

    public function products()
    {
        return $this->belongsToMany(TaskProduct::class, 'task_products', 'task_id', 'product_id');
    }

}
