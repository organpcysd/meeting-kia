<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_color')->insert([
            [
                'color_name' => 'สีดำ',
                'color_code' => 'ABP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีขาว',
                'color_code' => 'SWP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีเทา',
                'color_code' => 'P2M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีบรอนส์',
                'color_code' => '4SS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีฟ้า',
                'color_code' => 'D2U',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีแดง',
                'color_code' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีเงิน',
                'color_code' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีดำ',
                'color_code' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'color_name' => 'สีขาว',
                'color_code' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('car_type')->insert([
            [
                'type_name' => 'รถตู้ 11 ที่นั่ง',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type_name' => 'รถSUV แบบ 7 ที่นั่ง',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('car_model')->insert([
            [
                'model_name' => 'KIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'model_name' => 'DFSK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('car_level')->insert([
            [
                'model_id' => 1,
                'level_name' => 'Carnival sxl',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'model_id' => 1,
                'level_name' => 'Carnival ex',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'model_id' => 2,
                'level_name' => 'Glory 580 i-Auto',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'model_id' => 2,
                'level_name' => 'Glory 560',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('car_gift')->insert([
            [
                'gift_name' => 'ประกันภัยชั้น 1/พรบ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'ค่าจดทะเบียน',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'ฟิล์มกรองแสงรอบคัน',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'บันไดข้าง',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'กรอบป้ายทะเบียน',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'น้ำมัน 1,500 บาท',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'ชุดกล่องพรีเมี่ยม 1 ชุด',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'พรมกระดุมเข้ารูป',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'กล้องบันทึกหน้ารถ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'เคลือบสี',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'ถาดท้าย',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'ตาข่ายท้ายรถ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'gift_name' => 'เคลือบแก้ว',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('car')->insert([
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 1,
                'color_id' => 1,
                'price' => 2495000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 1,
                'color_id' => 2,
                'price' => 2495000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 1,
                'color_id' => 3,
                'price' => 2495000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 1,
                'color_id' => 5,
                'price' => 2495000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 2,
                'color_id' => 1,
                'price' => 2144000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 2,
                'color_id' => 2,
                'price' => 2144000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 1,
                'model_id' => 1,
                'level_id' => 2,
                'color_id' => 3,
                'price' => 2144000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 3,
                'color_id' => 6,
                'price' => 919000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 3,
                'color_id' => 7,
                'price' => 919000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 3,
                'color_id' => 8,
                'price' => 919000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 3,
                'color_id' => 9,
                'price' => 919000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 4,
                'color_id' => 7,
                'price' => 789000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 4,
                'color_id' => 6,
                'price' => 789000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 4,
                'color_id' => 8,
                'price' => 789000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
            [
                'type_id' => 2,
                'model_id' => 2,
                'level_id' => 4,
                'color_id' => 9,
                'price' => 789000,
                'years' => '2022',
                'total_qty' => 0,
                'available' => 0,
            ],
        ]);

        DB::table('traffic_channel')->insert([
            [
                'channel_name' => 'facebook',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'youtube',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'line@',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'หนังสือพิมพ์ท้องถิ่น',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'โทรทัศน์',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'ลูกค้าแนะนำ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'channel_name' => 'billboard',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('traffic_source')->insert([
            [
                'source_name' => 'walk in',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source_name' => 'road show',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'source_name' => 'call in',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
