<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //use HasFactory;
    protected $fillable=['name', 'city_id'];

    public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'area_id');
    }
}
