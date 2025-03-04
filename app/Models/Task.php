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

    public function taskAddonsPriority()
    {
        return $this->hasOne(TaskAddons::class)->where('type', 1);
    }

    public function taskAddonsInspection()
    {
        return $this->hasOne(TaskAddons::class)->where('type', 2);
    }

    public function taskPayments()
    {
        return $this->hasMany(TaskPayment::class);
    }


    public function taskComments()
    {
        return $this->hasMany(TaskComment::class);
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
        return $this->hasMany(TaskProduct::class);
    }
    public function taskItemProducts()
    {
        return $this->hasMany(TaskItemProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(TaskProduct::class, 'task_products', 'task_id', 'product_id');
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }

}
