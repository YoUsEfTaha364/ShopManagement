<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
      public $table="sale_payments";
      protected $guarded=["id"];

      public function sale(){
        return $this->belongsTo(Sale::class);
      }
}
