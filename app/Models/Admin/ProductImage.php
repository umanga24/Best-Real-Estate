<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model{
    protected $fillable = [ 'product_id', 'images'];

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product', 'product_id', 'id');
    }
}
