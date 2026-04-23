<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps=false;

     protected $fillable=["name","phone"];


     public function purchases(){
         return $this->hasMany(Purchase::class);
     }
     public function payments(){
         return $this->hasMany(SupplierPayment::class);
     }
}
