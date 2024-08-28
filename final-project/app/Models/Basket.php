<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $table = 'basket';


    protected $fillable = [
        'users_id',
        'products_id',
        'status',
        'basket_item',
        'quantity',
        'price',

    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
