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
            $table->date('born')->nullable()->comment('วันเกิด');
            $table->string('vocation')->nullable()->comment('อาชีพ');
            $table->text('phone')->nullable()->comment('เบอร์โทรศัพท์');
            $table->text('fax')->nullable()->comment('เบอร์แฟกซ์');
            $table->string('email')->nullable()->comment('อีเมล');
            $table->string('line_id')->nullable()->comment('ไอดีไลนฺ์');
            $table->string('hobby')->nullable()->comment('งานอดิเรก');
            $table->string('customer_type')->comment('');
            $table->string('status')->comment('สถานะ');
            $table->string('staff_id')->comment('พนักงานขาย');
            $table->timestamps();

            $table->foreign('prefix_id')->references('id')->on('user_prefixes')->onDelete('cascade');

        });

        Schema::create('customer_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');;
            $table->unsignedBigInteger('canton_id')->comment('ตำบล');
            $table->unsignedBigInteger('district_id')->comment('อำเภอ');
            $table->unsignedBigInteger('province_id')->comment('จังหวัด');
            $table->string('house_number')->nullable()->comment('บ้านเลขที่');
            $table->string('group')->nullable()->comment('หมู่');
            $table->string('village')->nullable()->comment('หมู่บ้าน');
            $table->string('alley')->nullable()->comment('ตรอก/ซอย');
            $table->string('road')->nullable()->comment('ถนน');
            $table->string('zipcode')->nullable()->comment('รหัสไปรษณีย์');
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
            $table->string('follow_up_customer')->nullable()->comment('การตอบสนองจากลูกค้า');
            $table->string('recomment_ceo')->nullable()->comment('คำแนะนำจาก ผจก.');
            $table->date('follow_date')->nullable()->comment('วันที่ติดตาม');
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
