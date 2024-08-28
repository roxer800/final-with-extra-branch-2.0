<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;


    protected $table = 'orders';


    protected $fillable = [
        'phone_number',
        'address',
        'status',
        'users_id',
        'basket_id',
        'items',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }
}
