<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';


    protected $fillable = [
        'title',
        'description',
        'price',
        'category',
        'featured',
        'main_photo',
        'additional_photo_1',
        'additional_photo_2',
        'additional_photo_3',
        'additional_photo_4',
        'users_id',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category', 'title');
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
