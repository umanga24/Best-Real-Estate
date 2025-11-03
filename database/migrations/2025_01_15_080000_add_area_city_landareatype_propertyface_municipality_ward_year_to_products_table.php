<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable()->after('image');
            $table->unsignedBigInteger('city_id')->nullable()->after('area_id');
            $table->unsignedBigInteger('landareatype_id')->nullable()->after('city_id');
            $table->unsignedBigInteger('propertyface_id')->nullable()->after('landareatype_id');
            $table->unsignedBigInteger('municipality_id')->nullable()->after('propertyface_id');
            $table->unsignedBigInteger('ward_id')->nullable()->after('municipality_id');
            $table->unsignedBigInteger('year_id')->nullable()->after('ward_id');

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade'); 
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');    
            $table->foreign('landareatype_id')->references('id')->on('land_area_types')->onDelete('cascade');    
            $table->foreign('propertyface_id')->references('id')->on('property_faces')->onDelete('cascade');    
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');    
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');    
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['landareatype_id']);
            $table->dropForeign(['propertyface_id']);
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['ward_id']);
            $table->dropForeign(['year_id']);
            
            $table->dropColumn('area_id');
            $table->dropColumn('city_id');
            $table->dropColumn('landareatype_id');
            $table->dropColumn('propertyface_id');
            $table->dropColumn('municipality_id');
            $table->dropColumn('ward_id');
            $table->dropColumn('year_id');
        });
    }
};
