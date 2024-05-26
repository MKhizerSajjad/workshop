<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'manufacturer',
        'model',
        'year',
        'color',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
