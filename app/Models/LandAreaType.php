<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandAreaType extends Model
{
   // use HasFactory;
    protected $fillable=['title'];


    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'landareatype_id');
    }
}
