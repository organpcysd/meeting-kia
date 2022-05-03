<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quotation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('customer_id')->comment('ที่ปรึกษาการขาย');
            $table->unsignedBigInteger('car_id')->comment('รถยนต์');
            $table->string('place_send')->comment('สถานที่จัดส่ง');
            $table->date('estimate_send')->comment('ประมาณการส่งมอบ');
            $table->string('allow_status')->comment('สถานะการอนุญาต');
            $table->string('quotation_status')->comment('สถานะใบเสนอราคา');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });

        Schema::create('quotation_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_id')->comment('ใบเสนอราคา');
            $table->string('condition')->comment('เงื่อนไข');
            $table->string('price_car')->comment('ราคารถยนต์');
            $table->string('payment_discount')->comment('ส่วนลดราคารถยนต์');
            $table->string('price_car_net')->comment('ราคารถยนต์สุทธิ');
            $table->string('term_credit')->comment('ระยะเวลาผ่อนชำระ');
            $table->string('interest')->comment('อัตราดอกเบี้ยต่อปี');
            $table->string('hire_purchase')->comment('ยอดจัดเช่าซื้อ');
            $table->string('term_payment')->comment('ค่างวดต่อเดือน');
            $table->string('payment_down')->comment('เงินดาวน์');
            $table->string('payment_down_discount')->comment('ส่วนลดเงินดาวน์');
            $table->string('deposit_roll')->comment('มัดจำป้ายแดง');
            $table->string('payment_decorate')->comment('ค่าอุปกรณ์แต่งรถยนต์');
            $table->string('payment_insurance')->comment('ค่าเบี้ยประกัน');
            $table->string('payment_other')->comment('ค่าใช้จ่ายอื่นๆ');
            $table->string('car_change')->comment('รถยนต์ที่นำมาแลก');
            $table->string('payment_car_turn')->comment('ราคาหักจากรถยนต์คันเก่า');
            $table->string('subtotal')->comment('ค่าใช้จ่ายวันออกรถ');
            $table->string('accessories')->comment('อุปกรณ์แต่งที่แถม');

            $table->foreign('quotation_id')->references('id')->on('quotation')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('quotation_has_accessories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_detail_id')->comment('รายละเอียดใบเสนอราคา');
            $table->unsignedBigInteger('accessories_id')->comment('อุปกรณ์แต่งที่แถม');

            $table->foreign('quotation_detail_id')->references('id')->on('quotation_detail')->onDelete('cascade');
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
        Schema::dropIfExists('quotation');
        Schema::dropIfExists('quotation_detail');
        Schema::dropIfExists('quotation_has_accessories');
    }
}
