<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'category_id',
        'product_code',
        'product_name',
        'brand',
        'purchase_price',
        'selling_price',
        'discount',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
