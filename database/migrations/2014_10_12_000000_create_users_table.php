<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prefixes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('คำนำหน้า');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_prefix_id')->comment('คำนำหน้า');
            $table->string('f_name')->comment('ชื่อ');
            $table->string('l_name')->nullable()->comment('นามสกุล');
            $table->string('nickname')->nullable()->comment('ชื่อเล่น');
            $table->date('born')->nullable()->comment('วันเกิด');
            $table->string('line_id')->nullable()->comment('ไอดีไลน์');
            $table->text('phone')->nullable()->comment('เบอร์โทรศัพท์');
            $table->string('hobby')->nullable()->comment('งานอดิเรก');
            $table->string('status')->default(1)->comment('สถานะ (0 1)');
            $table->string('email')->unique()->comment('อีเมล');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_prefix_id')->references('id')->on('user_prefixes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_prefixes');
        Schema::dropIfExists('users');
    }
}
