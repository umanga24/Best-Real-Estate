<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
   // use HasFactory;
    protected $fillable=['name'];

    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'municipality_id');
    }
}
