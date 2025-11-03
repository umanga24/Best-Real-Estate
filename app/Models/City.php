<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   //use HasFactory;
    protected $fillable=['name']; 

    public function area(){
        return $this->hasMany('App/Model/Area', 'city_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'city_id');
    }

}
