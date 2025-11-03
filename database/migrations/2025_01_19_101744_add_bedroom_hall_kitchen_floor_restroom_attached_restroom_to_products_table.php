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
            $table->integer('bedroom')->nullable()->after('land_area');
            $table->integer('kitchen')->nullable()->after('bedroom');
            $table->integer('hall')->nullable()->after('kitchen');
            $table->integer('restroom')->nullable()->after('hall');
            $table->integer('attachedrestroom')->nullable()->after('restroom');
            $table->integer('floor')->nullable()->after('attachedrestroom');

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
            $table->dropColumn('bedroom');
            $table->dropColumn('kitchen');
            $table->dropColumn('hall');
            $table->dropColumn('restroom');
            $table->dropColumn('attachedrestroom');
            $table->dropColumn('floor');
        });
    }
};
