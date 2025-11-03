<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = [
        'title'

    ];

    public function category()
    {
        return $this->hasMany('App\Models\Admin\Category');
    }

    public function product(){
        return $this->hasMany('App\Models\Admin\Product');
    }

}
