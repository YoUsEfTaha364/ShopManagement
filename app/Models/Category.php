<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      public $timestamps = false;
     protected $fillable=["name"];

     public function product(){
        return $this->hasMany(product::class);
     }
}
