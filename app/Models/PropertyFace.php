<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFace extends Model
{
   // use HasFactory;
    protected $fillable=['direction'];
   
    public function product(){
      return $this->belongsTo('App\Models\Admin\Product', 'propertyface_id');
  }
   
   }
