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
            $table->string('serial_number')->comment('หมายเลขใบเสนอราคา');
            $table->unsignedBigInteger('customer_id')->comment('ลูกค้า');
            $table->unsignedBigInteger('user_id')->comment('ที่ปรึกษาการขาย');
            $table->unsignedBigInteger('contact_id')->nullable()->comment('ผู้มาติดต่อ');
            $table->unsignedBigInteger('car_id')->comment('รถยนต์');
            $table->string('place_send')->nullable()->comment('สถานที่จัดส่ง');
            $table->date('estimate_send')->nullable()->comment('ประมาณการส่งมอบ');
            $table->string('allow_status')->comment('สถานะการอนุญาต');
            $table->string('quotation_status')->comment('สถานะใบเสนอราคา');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });

        Schema::create('quotation_detail', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('quotation_id')->comment('ใบเสนอราคา');
            $table->string('condition')->comment('เงื่อนไข');
            $table->string('price_car')->nullable()->default(0)->comment('ราคารถยนต์');
            $table->string('payment_discount')->nullable()->default(0)->comment('ส่วนลดราคารถยนต์');
            $table->string('price_car_net')->nullable()->default(0)->comment('ราคารถยนต์สุทธิ');
            $table->string('term_credit')->nullable()->default(1)->comment('ระยะเวลาผ่อนชำระ');
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
