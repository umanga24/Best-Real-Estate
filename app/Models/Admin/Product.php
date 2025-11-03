<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $fillable = [
        'title',
        'summary',
        'highlight',
        'description',
        'slug',
        'image',
        'images',
        'cat_id',
        'price',
        'prices',
        'discount',
        'brand',
        'model',
        'added_by',
        'path',
        'status',
        'sale',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_keyphrase',
        'view',
        'is_featured',
        'search',
        'is_other',
        'product_description','area_id','city_id','landareatype_id', 'propertyface_id','municipality_id','ward_id','year_id', 'land_area','segment_id',
        'bedroom','hall','kitchen','restroom','floor','attachedrestroom','username','number1','number2'.'product_id'

    ];
    public function category_info(){
        return $this->hasOne(  'App\Models\Admin\Category',   'id',   'cat_id');
    }
    public function subcat_info(){
        return $this->hasOne( 'App\Models\Admin\Category', 'id', 'child_cat_id');
    }
    
    public function ListAllProducts(){
        return $this->with( ['category_info', 'subcat_info'])->get();
    }

    public function other_image(){
    	return $this->hasMany('App\Models\Admin\ProductImage', 'product_id', 'id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Admin\Category', 'cat_id');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');

    }

    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    public function landareatype(){
        return $this->belongsTo('App\Models\landAreatype', 'landareatype_id', 'id');
    }

    public function propertyface(){
        return $this->belongsTo('App\Models\PropertyFace', 'propertyface_id', 'id');
    }

    public function municipality(){
        return $this->belongsTo('App\Models\Municipality', 'municipality_id', 'id');

    }

    public function ward(){
        return $this->belongsTo('App\Models\Ward', 'ward_id','id');
    }

    public function year(){
        return $this->belongsTo('App\Models\Year', 'year_id', 'id');
    }

    public function segment(){
        return $this->belongsTo('App\Models\Admin\Segment', 'segment_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Admin\ProductImage', 'product_id', 'id');
    }

}
