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
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('location_id')->nullable();
            $table->integer('way_id')->nullable();
            $table->text('note')->nullable();
            $table->text('info')->nullable();
            $table->string('slug')->nullable();
            $table->integer('hot')->default(0);
            $table->integer('price')->default(0);
            $table->integer('price_old')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function(Blueprint $table) {
            $table->dropColumn(['location_id','way_id', 'note', 'info', 'hot', 'slug', 'price', 'price_old']);
        });
    }
};
