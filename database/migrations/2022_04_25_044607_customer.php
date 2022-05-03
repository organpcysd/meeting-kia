<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prefix_id')->comment('คำนำหน้า');
            $table->text('citizen_id')->comment('เลขประจำตัวประชาชน');
            $table->text('itax_id')->comment('เลขประจำตัวผู้เสียภาษี');
            $table->string('f_name')->comment('ชื่อจริง');
            $table->string('l_name')->comment('นามสกุล');
            $table->string('nickname')->comment('ชื่อเล่น');
            $table->date('born')->comment('วันเกิด');
            $table->string('vocation')->comment('อาชีพ');
            $table->text('phone')->comment('เบอร์โทรศัพท์');
            $table->text('fax')->comment('เบอร์แฟกซ์');
            $table->string('email')->comment('อีเมล');
            $table->string('line_id')->comment('ไอดีไลนฺ์');
            $table->string('hobby')->comment('งานอดิเรก');
            $table->string('customer_type')->comment('');
            $table->string('status')->comment('สถานะ');
            $table->string('staff_id')->comment('');
            $table->timestamps();

            $table->foreign('prefix_id')->references('id')->on('user_prefixes')->onDelete('cascade');

        });

        Schema::create('customer_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('canton_id')->comment('ตำบล');
            $table->unsignedBigInteger('district_id')->comment('อำเภอ');
            $table->unsignedBigInteger('province_id')->comment('จังหวัด');
            $table->string('house_number')->comment('บ้านเลขที่');
            $table->string('group')->comment('หมู่');
            $table->string('village')->comment('หมู่บ้าน');
            $table->string('alley')->comment('ตรอก/ซอย');
            $table->string('road')->comment('ถนน');
            $table->string('zipcode')->comment('รหัสไปรษณีย์');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('canton_id')->references('id')->on('canton')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        });

        Schema::create('customer_follow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('follow_up')->comment('ผลการติดตาม');
            $table->string('follow_up_customer')->comment('การตอบสนองจากลูกค้า');
            $table->string('recomment_ceo')->comment('คำแนะนำจาก ผจก.');
            $table->date('follow_date')->comment('วันที่ติดตาม');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_prefix');
        Schema::dropIfExists('customer');
        Schema::dropIfExists('customer_address');
        Schema::dropIfExists('customer_follow');
    }
}