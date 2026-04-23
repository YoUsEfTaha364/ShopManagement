<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
     public $timestamps=false;

     protected $fillable=["supplier_id","total_amount","paid_amount","remaining_amount","date"];


     public function supplier(){
         return $this->belongsTo(Supplier::class);
     }
     public function items(){
         return $this->hasMany(PurchaseItem::class);
     }
    
}
