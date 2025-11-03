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
            $table->unsignedBigInteger('segment_id')->nullable()->after('slug');
            $table->integer('land_area')->nullable()->after('year_id');

            $table->foreign('segment_id')->references('id')->on('segments')->onDelete('cascade'); 




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

            $table->dropForeign(['segment_id']);

            $table->dropColumn('segment_id');
            $table->dropColumn('land_area');
        });
    }
};
