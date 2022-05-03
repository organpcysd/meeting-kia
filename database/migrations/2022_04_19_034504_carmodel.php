<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carmodel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('car_type', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->comment('ประเภทรถ');
            $table->timestamps();
        });

        Schema::create('car_model', function (Blueprint $table) {
            $table->id();
            $table->string('model_name')->comment('รุ่นหลัก');
            $table->timestamps();
        });

        Schema::create('car_level', function (Blueprint $table) {
            $table->id();
            $table->string('level_name')->comment('รุ่น');
            $table->unsignedBigInteger('model_id');
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('car_model')->onDelete('cascade');
        });

        Schema::create('car_color', function (Blueprint $table) {
            $table->id();
            $table->string('color_name')->comment('สีรถ');
            $table->string('color_code')->nullable()->comment('โค๊ดสี');
            $table->timestamps();
        });

        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('model_id');
            $table->string('engine')->nullable()->comment('เครื่อง');
            $table->string('gear')->nullable()->comment('เกียร์');
            $table->float('price', 10, 2)->nullable()->comment('ราคา');
            $table->year('years')->nullable()->comment('ปี');
            $table->string('other')->nullable()->comment('อื่นๆ');
            $table->float('total_qty', 10, 2)->nullable()->comment('ราคาสุทธิ');
            $table->float('sold_qty', 10, 2)->nullable()->comment('');
            $table->float('book_qty', 10, 2)->nullable()->comment('');
            $table->float('defect_qty', 10, 2)->nullable()->comment('');
            $table->boolean('available')->nullable()->comment('คงเหลือ');
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('car_color')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('car_type')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('car_level')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('car_model')->onDelete('cascade');

        });

        Schema::create('car_gift', function (Blueprint $table) {
            $table->id();
            $table->string('gift_name');
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
        Schema::dropIfExists('car_type');
        Schema::dropIfExists('car_level');
        Schema::dropIfExists('car_model');
        Schema::dropIfExists('car_color');
        schema::dropIfExists('car');
    }
}
