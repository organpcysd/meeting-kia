<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Traffic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_channel', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->timestamps();
        });

        Schema::create('traffic_source', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
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
        Schema::dropIfExists('traffic_channel');
        Schema::dropIfExists('traffic_source');
    }
}
