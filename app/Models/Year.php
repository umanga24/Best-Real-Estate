<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $fillable=['years'];


    public function product(){
        return $this->belongsTo('App\Models\Admin\Product', 'year_id');
    }
}
