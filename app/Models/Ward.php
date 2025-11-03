<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
   // use HasFactory;
    protected $fillable=['wardnumber'];


    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'ward_id');
    }
}
