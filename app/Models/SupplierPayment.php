<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    public $timestamps=false;
    protected $table="supplierpayments";
     protected $fillable=["purchase_id","supplier_id","paid","date"];

     public  function supplier(){
        return $this->belongsTo(Supplier::class);
     }
     public  function purchase(){
        return $this->belongsTo(Purchase::class);
     }
    
}
