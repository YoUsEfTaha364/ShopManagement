<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
       protected $table = 'purchaseitems';
     public $timestamps=false;

     protected $fillable=["product_id","purchase_id","price","quantity","subtotal"];


     public function purchase(){
         return $this->belongsTo(Purchase::class);
     }
     public function product(){
         return $this->belongsTo(Product::class);
     }
}
