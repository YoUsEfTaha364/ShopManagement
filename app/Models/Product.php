<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable=["name","category_id","bought_price","sold_price","quantity"];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function saleitems(){
        return $this->hasMany(SaleItem::class);
    }
    public function purchaseitems(){
        return $this->hasMany(PurchaseItem::class);
    }
}


