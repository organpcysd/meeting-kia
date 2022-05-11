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
            $table->string('channel_name')->comment('ช่องทางการรับรู้');
            $table->timestamps();
        });

        Schema::create('traffic_source', function (Blueprint $table) {
            $table->id();
            $table->string('source_name')->comment('แหล่งข้อมูลลูกค้า');
            $table->timestamps();
        });

        Schema::create('traffic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('user_id')->comment('ที่ปรึกษาการขาย');
            $table->string('dicision')->comment('ผู้ตัดสินใจ');
            $table->unsignedBigInteger('source_id')->comment('แหล่งข้อมูลลูกค้า');
            $table->string('location')->comment('ตำแหน่งที่มาของลูกค้า');
            $table->string('target')->comment('กลุ่มของลูกค้า');
            $table->text('contact_result')->comment('ผลการติดต่อ');
            $table->unsignedBigInteger('channel_id')->comment('ช่องทางการรับรู้');
            $table->string('tenor')->comment('แนวโน้ม');

            $table->timestamps();
        });

        Schema::create('traffic_car_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('traffic_id')->comment('ลูกค้า Traffic');
            $table->unsignedBigInteger('car_item')->comment('');

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
