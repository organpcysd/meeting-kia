<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reserved extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->comment('หมายเลขใบจองรถยนต์');
            $table->unsignedBigInteger('user_id')->comment('ที่ปรึกษาการขาย');
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('quotation_id')->nullable()->comment('ใบเสนอราคา');
            $table->unsignedBigInteger('car_id')->comment('รถยนต์');
            $table->unsignedBigInteger('contact_id')->nullable()->comment('ผู้มาติดต่อ');
            $table->string('place_send')->nullable()->comment('สถานที่จัดส่ง');
            $table->date('estimate_send')->nullable()->comment('ประมาณการส่งมอบ');
            $table->string('status_reserved')->comment('สถานะการจองรถยนต์');
            $table->string('payment_by')->nullable()->comment('วิธีการชำระเงิน');
            $table->string('payment_bank')->nullable()->comment('ธนาคาร');
            $table->string('payment_no')->nullable()->comment('เลขที่');
            $table->date('reserved_date')->nullable()->comment('วันที่จอง');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('quotation_id')->references('id')->on('quotation')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });

        Schema::create('reserved_detail', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('reserved_id')->comment('จองรถยนต์');
            $table->string('condition')->comment('เงื่อนไข');
            $table->string('payable')->nullable()->comment('จำนวนเงินมัดจำ');
            $table->string('price_car')->nullable()->default(0)->comment('ราคารถยนต์');
            $table->string('payment_discount')->nullable()->default(0)->comment('ส่วนลดราคารถยนต์');
            $table->string('price_car_net')->nullable()->default(0)->comment('ราคารถยนต์สุทธิ');
            $table->string('term_credit')->nullable()->default(0)->comment('ระยะเวลาผ่อนชำระ');
            $table->string('interest')->nullable()->default(0)->comment('อัตราดอกเบี้ยต่อปี');
            $table->string('payment_regis')->nullable()->default(0)->comment('ค่าจดทะเบียน');
            $table->string('hire_purchase')->nullable()->default(0)->comment('ยอดจัดเช่าซื้อ');
            $table->string('first_purchase')->nullable()->default(0)->comment('จ่ายงวดแรก');
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
            $table->string('accessories_buy')->nullable()->comment('อุปกรณ์แต่งที่ซื้อ');

            $table->foreign('reserved_id')->references('id')->on('reserved')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('reserved_has_accessories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserved_detail_id')->comment('รายละเอียดการจองรถยนต์');
            $table->unsignedBigInteger('accessories_id')->comment('อุปกรณ์แต่งที่แถม');

            $table->foreign('reserved_detail_id')->references('id')->on('reserved_detail')->onDelete('cascade');
            $table->foreign('accessories_id')->references('id')->on('car_gift')->onDelete('cascade');

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
        Schema::dropIfExists('reserved');
        Schema::dropIfExists('reserved_detail');
        Schema::dropIfExists('reserved_has_accessories');
    }
}
