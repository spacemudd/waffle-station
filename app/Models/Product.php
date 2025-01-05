<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name is 'products' by default)
    protected $table = 'products';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'product_name', 
        'price', 
        'preparation_time', 
        'serve', 
        'description', 
        'image'
    ];
}
