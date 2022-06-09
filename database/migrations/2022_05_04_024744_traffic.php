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
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('user_id')->comment('ที่ปรึกษาการขาย');
            $table->string('dicision')->nullable()->comment('ผู้ตัดสินใจ');
            $table->unsignedBigInteger('source_id')->comment('แหล่งข้อมูลลูกค้า');
            $table->string('location')->nullable()->comment('ตำแหน่งที่มาของลูกค้า');
            $table->string('target')->comment('กลุ่มของลูกค้า');
            $table->text('contact_result')->nullable()->comment('ผลการติดต่อ');
            $table->unsignedBigInteger('channel_id')->comment('ช่องทางการรับรู้');
            $table->string('tenor')->comment('แนวโน้ม');

            $table->string('testdrive')->comment('ทดลองขับ');
            $table->unsignedBigInteger('staff_pick')->comment('ผู้เบิกรถยนต์');

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('staff_pick')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('traffic_source')->onDelete('cascade');
            $table->foreign('channel_id')->references('id')->on('traffic_channel')->onDelete('cascade');
        });

        Schema::create('traffic_car_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('traffic_id')->comment('ลูกค้า Traffic');
            $table->json('model_id')->comment('โมเดลรถยนต์');
            $table->json('level_id')->nullable()->comment('รุ่นรถยนต์');
            $table->json('color_id')->nullable()->comment('สีรถยนต์');

            $table->timestamps();

            $table->foreign('traffic_id')->references('id')->on('traffic')->onDelete('cascade');
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
        Schema::dropIfExists('traffic_car_itemy');
    }
}
