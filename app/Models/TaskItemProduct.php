<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItemProduct extends Model
{
    use HasFactory;
    protected $guarded;

    public function taskItemProducts()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
