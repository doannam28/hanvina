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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('name');
            $table->string('address');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('site_title');
            $table->string('logo');
            $table->string('logo_footer');
            $table->string('favicon');
            $table->string('zalo');
            $table->string('phone');
            $table->string('tiktok');
            $table->text('meta_description');
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
