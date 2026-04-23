<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
   
     protected $fillable=["customer_name","customer_phone","total_price","paid_price","remaining_price"];

     public  function items(){
        return $this->hasMany(SaleItem::class);
     }
}
