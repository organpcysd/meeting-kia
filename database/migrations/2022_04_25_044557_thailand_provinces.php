<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThailandProvinces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ภาค');
        });

        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment('โค๊ด');
            $table->string('name_th')->nullable()->comment('ชื่อภาษาไทย');
            $table->string('name_en')->nullable()->comment('ชื่อภาษาอังกฤษ');
            $table->unsignedBigInteger('geography_id')->comment('ภาค');

            $table->foreign('geography_id')->references('id')->on('geographies')->onDelete('cascade');
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment('โค๊ด');
            $table->string('name_th')->nullable()->comment('ชื่อภาษาไทย');
            $table->string('name_en')->nullable()->comment('ชื่อภาษาอังกฤษ');
            $table->unsignedBigInteger('province_id')->comment('จังหวัด');

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        });

        Schema::create('canton', function (Blueprint $table) {
            $table->id();
            $table->integer('zip_code')->nullable()->comment('รหัสไปรษณีย์');
            $table->string('name_th')->nullable()->comment('ชื่อภาษาไทย');
            $table->string('name_en')->nullable()->comment('ชื่อภาษาอังกฤษ');
            $table->unsignedBigInteger('district_id')->comment('อำเภอ');

            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geographies');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('canton');
    }
}
