<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Received extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->comment('หมายเลขใบส่งมอบรถยนต์');
            $table->unsignedBigInteger('user_id')->comment('ที่ปรึกษาการขาย');
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('reserved_id')->nullable()->comment('ใบจองรถยนต์');
            $table->unsignedBigInteger('car_id')->comment('รถยนต์');
            $table->unsignedBigInteger('stock_id')->nullable()->comment('เลขตัวถัง');
            $table->string('payment_by')->comment('วิธีการชำระเงิน');
            $table->date('received_date')->nullable()->comment('วันที่จอง');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('reserved_id')->references('id')->on('reserved')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('car_stock')->onDelete('cascade');
        });

        Schema::create('received_detail', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('received_id')->comment('ใบส่งมอบรถยนต์');
            $table->string('condition')->comment('เงื่อนไข');
            $table->string('payable')->comment('จำนวนเงินมัดจำ');
            $table->string('price_car')->nullable()->default(0)->comment('ราคารถยนต์');
            $table->string('payment_discount')->nullable()->default(0)->comment('ส่วนลดราคารถยนต์');
            $table->string('price_car_net')->nullable()->default(0)->comment('ราคารถยนต์สุทธิ');
            $table->string('term_credit')->nullable()->default(0)->comment('ระยะเวลาผ่อนชำระ');
            $table->string('interest')->nullable()->default(0)->comment('อัตราดอกเบี้ยต่อปี');
            $table->string('hire_purchase')->nullable()->default(0)->comment('ยอดจัดเช่าซื้อ');
            $table->string('term_payment')->nullable()->default(0)->comment('ค่างวดต่อเดือน');
            $table->string('payment_down')->nullable()->default(0)->comment('เงินดาวน์');
            $table->string('payment_down_discount')->nullable()->default(0)->comment('ส่วนลดเงินดาวน์');
            $table->string('deposit_roll')->nullable()->default(0)->comment('มัดจำป้ายแดง');
            $table->string('payment_decorate')->nullable()->default(0)->comment('ค่าอุปกรณ์แต่งรถยนต์');
            $table->string('payment_insurance')->nullable()->default(0)->comment('ค่าเบี้ยประกัน');
            $table->string('payment_other')->nullable()->default(0)->comment('ค่าใช้จ่ายอื่นๆ');
            $table->string('car_change')->nullable()->comment('รถยนต์ที่นำมาแลก');
            $table->string('payment_car_turn')->nullable()->default(0)->comment('ราคาหักจากรถยนต์คันเก่า');
            $table->string('subtotal')->nullable()->default(0)->comment('ค่าใช้จ่ายวันออกรถ');
            $table->string('accessories')->nullable()->comment('อุปกรณ์แต่งอื่นๆ');
            $table->timestamps();

            $table->foreign('received_id')->references('id')->on('received')->onDelete('cascade');
        });

        Schema::create('received_follow', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('received_id')->comment('ใบส่งมอบรถยนต์');
            $table->string('follow_up')->comment('ผลการติดตาม');
            $table->string('follow_up_customer')->nullable()->comment('การตอบสนองจากลูกค้า');
            $table->string('recomment_ceo')->nullable()->comment('คำแนะนำจาก ผจก.');
            $table->date('follow_date')->nullable()->comment('วันที่ติดตาม');
            $table->timestamps();

            $table->foreign('received_id')->references('id')->on('received')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('received');
        Schema::dropIfExists('received_detail');
        Schema::dropIfExists('received_follow');
    }
}
