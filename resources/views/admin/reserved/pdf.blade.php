<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <title>ปริ้นท์ใบจองซื้อรถยนต์</title>

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
            font-size: 18px;
        }
        table{
            border-collapse: collapse;
        }

        /* td,th{
            border: 1px solid;
        } */

        /* table, th, td {
            border:1px solid black;
        } */

        .my-checkbox {
            transform: scale(2);
            margin-right: 11px;
        }
        .right {
            float: right;
        }
        .left {
            float: left;
        }

        .fa {
            display: inline;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 1;
            font-family: FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr style="line-height: 0.8;">
            <td colspan="2" style="text-align: center;"><h2>ใบจองซื้อรถยนต์</h2></td>
        </tr>

        <tr style="line-height: 0.8;">
            <td style="width: 50%; padding-left: 10px;">โชว์รูม เทพนครออโตเซอร์วิส</td>
            <td style="width: 50%; padding-left: 10px;">เลขที่ {{ $reserved->serial_number }}</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="padding-left: 10px;">เลขที่ ______________________________________________</td>
            <td style="padding-left: 10px;">พนักงานขาย {{ $reserved->user->f_name . ' ' . $reserved->user->l_name }}</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="padding-left: 10px;">โทรศัพท์ 0911788359 แฟกซ์ @if($reserved->customer->fax) {{ $reserved->customer->fax }} @else __________________ @endif</td>
            <td style="padding-left: 10px;">{{ \Carbon\Carbon::parse($reserved->created_at)->thaidate('วันที่ j เดือน M พ.ศ. Y') }}</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td colspan="2" style="padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;ข้าพเจ้ามีความประสงค์จองซื้อรถยนต์กับ บริษัท ยนตรกิจ ออโตเซ็นเตอร์ จำกัด (ซึ่งต่อไปในใบจองซื้อนี้จะเรียกว่า บริษัทฯ) และขอให้ ดำเนินการสั่งซื้ออุปกรณ์ติดตั้งเพิ่มเติม ซึ่งผู้จองซื้อตกลงซื้อและบริษัทฯ ตกลงขายรถยนต์ โดยมีเงื่อนไขและข้อตกลง ดังต่อไปนี้ </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2" style="font-weight: bold; padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;1. รายละเอียดของผู้จัดของซื้อ</td>
        </tr>
    </table>

    <table style="width:100%; border:1px solid black;" cellspacing="0" cellpadding="0">
        <tr style="line-height: 0.8;">
            <td style="line-height: 0.8; width: 50%; padding-left: 10px;"> บุคคลธรรมดา {{ $reserved->customer->f_name . ' ' . $reserved->customer->l_name }} </td>
            <td style="line-height: 0.8;"><div>พนักงานขาย</div> </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="line-height: 0.8; width: 50%; padding-left: 10px;">นิติบุคคล __________________________________________</td>
            <td style="line-height: 0.8;">เลขประจำตัวผู้เสียภาษี @if($reserved->customer->itax_id ) {{ $reserved->customer->itax_id }} @else _______________________________ @endif</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="line-height: 0.8; width: 50%; padding-left: 10px;">
                ที่อยู่
                @if($reserved->customer->customer_address->village) {{ $reserved->customer->customer_address->village }} @endif
                @if($reserved->customer->customer_address->house_number) {{ $reserved->customer->customer_address->house_number }} @endif
                @if($reserved->customer->customer_address->alley) {{ "ตรอก/ซอย " . $reserved->customer->customer_address->alley }} @endif
                @if($reserved->customer->customer_address->group) {{ "หมู่ " . $reserved->customer->customer_address->group }} @endif
                @if($reserved->customer->customer_address->road) {{ "ถ." .$reserved->customer->customer_address->road }} @endif
                @if($reserved->customer->customer_address->canton->name_th ) {{ "ต." . $reserved->customer->customer_address->canton->name_th }} @endif
                @if($reserved->customer->customer_address->districts->name_th) {{ "อ." . $reserved->customer->customer_address->districts->name_th }} @endif
                @if($reserved->customer->customer_address->provinces->name_th) {{ "จ." . $reserved->customer->customer_address->provinces->name_th }} @endif
            </td>
            <td style="line-height: 0.8;">โทรศัพท์ {{ substr($reserved->user->phone, 0, 3) . '-' . substr($reserved->user->phone, 3, 3) . '-' . substr($reserved->user->phone, 6, 4) }}</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="line-height: 0.8; width: 50%; padding-left: 10px; padding-bottom: 10px;">ที่ทำงาน ___________________________________________</td>
            <td style="line-height: 0.8; padding-bottom: 10px;">โทรศัพท์ __________________________________________</td>
        </tr>
    </table>

    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="line-height: 0.8;" colspan="3" style="font-weight: bold; padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;2. รายละเอียดรถยนต์ / ราคา / อุปกรณ์สั่งซื้อเพิ่มเติม / ของแถมหรือสิทธิประโยชน์ / อื่นๆ</td>
        </tr>
    </table>
    <table style="width:100%; border:1px solid black;" cellspacing="0" cellpadding="0">
        <tr style="line-height: 0.8;">
            <td style="width: 70%; padding-left: 10px;">
                <div>รถยนต์ยี่ห้อ {{ $reserved->car->car_model->model_name }} รุ่น {{ $reserved->car->car_level->level_name }} ปีที่ผลิต {{ $reserved->car->years }}</div>
                <div>ขนาดกำลังเครื่องยนต์ @if ($reserved->car->engine) {{ $reserved->car_engine }} @else _______________________ @endif ซีซี. สี {{ $reserved->car->car_color->color_name }} @if ($reserved->car->car_color->color_code) [{{ $reserved->car->car_color->color_code }}]@endif &nbsp; &nbsp; ราคา</div>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;">{{ number_format($reserved->reserved_detail->price_car,2) }}</td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 70%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.8;">
                        <td style="width: 20%; vertical-align:top;">อุปกรณ์สั่งซื้อติดตั้งเพิ่มเติม</td>
                        <td style="width: 80%; padding-left: 10px;">
                            <div>ค่าดาวน์ {{ number_format($reserved->reserved_detail->price_car, 2) }}</div>
                            <div>ค่าจดทะเบียน {{ number_format($reserved->reserved_detail->payment_regis, 2) }}</div>
                            <div>ค่ามัดจำป้ายแดง {{ number_format($reserved->reserved_detail->deposit_roll ,2) }}</div>
                            <div>ค่าอุปกรณ์ตกแต่ง {{ number_format($reserved->reserved_detail->payment_decorate,2) }}</div>
                            <div>ค่าเบี้ยประกันภัย {{ number_format($reserved->reserved_detail->payment_insurance,2) }}</div>
                            <div>ค่าใช้จ่ายอื่นๆ {{ number_format($reserved->reserved_detail->payment_other,2) }}</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;"></td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:90%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.8;">
                        <td style="width: 20%; vertical-align:top;" colspan="3">ของแถมหรือสิทธิประโยชน์</td>
                    </tr>
                    <tr style="line-height: 0.8;">
                        @php
                        $i = 0;
                            foreach ($reserved->reserved_detail->car_gift as $gift) {
                                if ($i%3 === 0) {
                                    echo '</tr><tr style="line-height: 0.8;">';
                                }
                                echo "<td>" . ++$i . '. ' . $gift->gift_name . "</td>";
                            }
                        @endphp
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;"></td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.8;">
                        <td style="width: 30%;">อื่นๆ</td>
                        <td style="width: 70%;">__________________________________________________</td>
                    </tr>
                    <tr style="line-height: 0.8;">
                        <td style="width: 30%;">รวมราคาเป็นเงินทั้งสิ้น</td>
                        <td style="width: 70%;">(_________________________________________________)</td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;">{{ number_format($reserved->reserved_detail->subtotal,2) }}</td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>

        <tr style="line-height: 0.8;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.8;">
                        <td style="width: 10%;">
                            <label for="name1">มัดจำ</label>
                        </td>
                        <td style="width: 90%;">
                            <span class="fa @if ($reserved->payment_by === 'cash') fa-check-square @else fa fa-square-o @endif"></span> เงินสด
                            <span class="fa @if ($reserved->payment_by === 'credit') fa-check-square @else fa fa-square-o @endif"></span> บัตรเครดิต
                            ____________ เลขที่ ____________ ลว ____________
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <span class="fa @if ($reserved->payment_by === 'tranfer') fa-check-square @else fa fa-square-o @endif"></span> โอนเงินเข้าบัญชีบริษัทฯ
                            __________ เลขที่ ____________ ลว ____________
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;"></td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
        <tr>
            <td style="padding-left: 10px;">
                ส่วนราคาที่เหลือจะชำระในวันส่งมอบรถยนต์ด้วย <span class="fa fa-square-o"></span> แคชเชียร์เช็ค <span class="fa fa-square-o"></span> สัญญาเช่าซื้อ เป็นเงิน
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;"></td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
    </table>
    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="3" style="font-weight: bold; padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;3. บริษัทฯ คาดว่าจะส่งมอบรถยนต์ให้แก่ผู้จองซื้อได้ภายใน วันที่ _______ เดือน _____________________ พ.ศ. ________</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td colspan="3" style="padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;<b>4. เงื่อนไขและข้อตกลงการจองซื้อ</b> (โปรดพลิกด้านหลัง) ถือเป็นส่วนหนึ่งของใบจองซื้อฉบับนี้</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td colspan="3" style="font-weight: bold;">ข้าพเจ้าได้อ่านและเข้าใจข้อความในใบจองซื้อรถยนต์พร้อมเงื่อนไขและข้อตกลงการจองซื้อรถยนต์(ด้านหลัง)โดยตลอดแล้วเห็นว่าถูกต้อง จึงได้ลงลายมือชื่อไว้เป็นสำคัญ</td>
        </tr>
    </table>
    <br style="line-height: 0.5;"/>
    <table style="width:100%; text-align:center;" cellspacing="0" cellpadding="5">
        <tr style="border:1px solid black; line-height: 0.8;">
            <td style="border:1px solid black;">
                <div>_________________________________</div>
                <div>(________________________________)</div>
                <div style="font-weight: bold;">ผู้จองซื้อ</div>
            </td>
            <td style="border:1px solid black;">
                <div>_________________________________</div>
                <div>(________________________________)</div>
                <div style="font-weight: bold;">พนักงานขาย</div>
            </td>
            <td style="border:1px solid black;">
                <div>_________________________________</div>
                <div>(________________________________)</div>
                <div style="font-weight: bold;">ผู้รับมอบอำนาจบริษัทฯ</div>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <div style="line-height: 0.8;"><b><u>เงื่อนไขและข้อตกลงการจองซื้อรถยนต์</u></b></div>
    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="word-break: break-all; font-size:17 px;">
            <p style="line-height: 0.8;">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1. ค่าธรรมเนียมการขอจดทะเบียนรถยนต์, ค่าอากรแสตมป์, ค่าภาษีรถยนต์ประจำปี ผู้จองซื้อตกลงเป็นผู้ชำระเองทั้งสิ้น <br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. ใบจองซื้อฉบับนี้จะมีผลสมบูรณ์ก็ต่อเมื่อผู้รับมอบอำนาจบริษัทฯ ลงลายมือชื่อ การแก้ไขเพิ่มเติมข้อความในใบจองซื้อ จะทำไม่ได้ หากไม่ได้รับความ ยินยอมจากผู้จองซื้อและผู้รับมอบอำนาจบริษัทฯ โดยทั้งคู่ต้องลงลายมือชื่อกำกับการแก้ไขนั้นๆ ไว้ด้วย<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. ค่ามัดจำสามารถชำระด้วยเงินสด บัตรเครดิต หรือสิ่งของ โดยผู้จองซื้อต้องเรียก<b>หลักฐานการรับเงิน (มัดจำ)</b> ของบริษัทจากพนักงานขาย <b>หลักฐาน การรับเงิน(มัดจำ) ต้องมีลายมือชื่อผู้รับมอบอำนาจบริษัทฯ และเจ้าหน้าที่การเงิน ลงชื่อร่วมกันจึงจะสมบูรณ์</b> ส่วนการชำระราคารถยนต์หรือการชำระเงิน ดาวน์ต้องชำระด้วย <b>แคชเชียร์เช็ค หรือการโอนเงินเข้าบัญชีธนาคารที่ บริษัท ยนตรกิจออโต้เซ็นเตอร์ จำกัด เป็นเจ้าของบัญชีเท่านั้น พนักงานขายไม่มี หน้าที่รับเงินสด และออกเอกสารการรับเงิน.</b><br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4. ผู้จองซื้อมีสิทธิ์บอกเลิกการจองซื้อนี้ได้ หากบริษัทฯ กระทำการอย่างหนึ่งอย่างใดฝ่ายเดียว ดังต่อไปนี้<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.1 ปรับเปลี่ยนราคารถยนต์ให้สูงขึ้น<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.2 ไม่ส่งมอบรถยนต์ภายในระยะเวลาที่กำหนด<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.3 ไม่ส่งมอบรถยนต์ที่มียี่ห้อ รุ่น ปีที่ผลิต สี ขนาดกำลังเครื่องยนต์ ตรงตามที่กำหนดไว้ในใบจองซื้อนี้<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.4 ไม่ส่งมอบรถยนต์ที่มีรายการอุปกรณ์ติดตั้งเพิ่มเติมและของแถมหรือสิทธิประโยชน์ต่างๆตามที่กำหนดไว้ในใบจองซื้อนี้<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ทั้งนี้ บริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่ได้รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วันนับแต่วันที่ผู้จองซื้อใช้สิทธิบอกเลิกการของซื้อ<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;5. ผู้จองซื้อ มีสิทธิบอกเลิกการจองซื้อนี้ได้ หากปรากฏว่า ผู้จองซื้อต้องขอสินเชื่อเพื่อการซื้อรถยนต์ และผู้จองซื้อไม่ได้ รับอนุมัติสินเชื่อภายในกำหนด เวลาการส่งมอบรถยนต์ โดยบริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วัน<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>6. บริษัทฯ มีสิทธิบอกเลิกการจองซื้อนี้ได้ หากปรากฏว่า ผู้จองซื้อต้องขอสินเชื่อเพื่อการซื้อรถยนต์ และผู้จองซื้อไม่ได้รับ อนุมัติสินเชื่อภายใน กำหนดเวลา การส่งมอบรถยนต์ โดยบริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วัน</b><br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>7.	กรณีผู้จองซื้อไม่ยอมรับมอบรถยนต์เมื่อครบกำหนดเวลาการส่งมอบ หรือบอกเลิกการจองซื้อโดยมิใช่ความผิดของบริษัทฯ ผู้จองซื้อยินยอม ให้บริษัทฯ บอกเลิกสัญญาและริบมัดจำ</b><br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;8. การติดตั้งเพิ่มเติม แก้ไข ปรับเปลี่ยน ซึ่งอุปกรณ์หรือชิ้นส่วนของรถยนต์ หรือดัดแปลงสภาพรถ ให้ผิดไปจากมาตรฐานของผู้ผลิตรถยนต์เกียจะทำให้ การรับประกันคุณภาพสิ้นสุดลงเฉพาะส่วนที่ผู้จองซื้อได้กระทำการนั้น แต่ถ้าการติดตั้งเพิ่มเติม แก้ไข ปรับเปลี่ยน ซึ่งอุปกรณ์หรือชิ้นส่วนของรถยนต์ หรือ ดัดแปลงสภาพนั้น เกี่ยวข้องกับ <b>มาตรฐานความปลอดภัยในการใช้รถยนต์</b> จะทำให้รถยนต์ทั้งคันสิ้นสุดการรับประกันคุณภาพโดยสิ้นเชิง<br/>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;9. บริษัทฯ รับผิดชอบเฉพาะธุรกรรมที่ระบุไว้ในใบจองซื้อรถยนต์ฉบับนี้เท่านั้น <b>ธุรกรรมอื่นใดที่ผู้จองซื้อเข้าทำกับพนักงานขายโดยตรงเฉพาะตัว เช่น สั่งซื้อ/สั่งจองเลขทะเบียนสวย, สั่งซื้อ/สั่งจ้างให้ดำเนินการปรับเปลี่ยนหรือติดตั้งอุปกรณ์เพิ่มเติม, ดัดแปลงสภาพรถ, ทำ/ต่อประกันภัยรถยนต์ ฯลฯ ถือ เป็นการกระทำเฉพาะตัวของพนักงานขายซึ่งอยู่นอกเหนือสภาพการจ้าง บริษัทฯ สงวนสิทธิ์ไม่รับผิดชอบทั้งสิ้น</b><br/>
            </p>
            </td>
        </tr>
    </table>
    {{-- <div style="line-height: 0.8; word-break: break-all;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1. ค่าธรรมเนียมการขอจดทะเบียนรถยนต์, ค่าอากรแสตมป์, ค่าภาษีรถยนต์ประจำปี ผู้จองซื้อตกลงเป็นผู้ชำระเองทั้งสิ้น</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. ใบจองซื้อฉบับนี้จะมีผลสมบูรณ์ก็ต่อเมื่อผู้รับมอบอำนาจบริษัทฯ ลงลายมือชื่อ การแก้ไขเพิ่มเติมข้อความในใบจองซื้อ จะทำไม่ได้ หากไม่ได้รับความยินยอมจากผู้จองซื้อและผู้รับมอบอำนาจบริษัทฯ โดยทั้งคู่ต้องลงลายมือชื่อกำกับการแก้ไขนั้นๆ ไว้ด้วย</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. ค่ามัดจำสามารถชำระด้วยเงินสด บัตรเครดิต หรือสิ่งของ โดยผู้จองซื้อต้องเรียก<b>หลักฐานการรับเงิน (มัดจำ)</b> ของบริษัทจากพนักงานขาย <b>หลักฐานการรับเงิน(มัดจำ) ต้องมีลายมือชื่อผู้รับมอบอำนาจบริษัทฯ และเจ้าหน้าที่การเงิน ลงชื่อร่วมกันจึงจะสมบูรณ์</b> ส่วนการชำระราคารถยนต์หรือการชำระเงินดาวน์ต้องชำระด้วย <b>แคชเชียร์เช็ค หรือการโอนเงินเข้าบัญชีธนาคารที่ บริษัท ยนตรกิจออโต้เซ็นเตอร์ จำกัด เป็นเจ้าของบัญชีเท่านั้น พนักงานขายไม่มีหน้าที่รับเงินสด และออกเอกสารการรับเงิน.</b></div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4. ผู้จองซื้อมีสิทธิ์บอกเลิกการจองซื้อนี้ได้ หากบริษัทฯ กระทำการอย่างหนึ่งอย่างใดฝ่ายเดียว ดังต่อไปนี้</b></div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.1 ปรับเปลี่ยนราคารถยนต์ให้สูงขึ้น</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.2 ไม่ส่งมอบรถยนต์ภายในระยะเวลาที่กำหนด</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.3 ไม่ส่งมอบรถยนต์ที่มียี่ห้อ รุ่น ปีที่ผลิต สี ขนาดกำลังเครื่องยนต์ ตรงตามที่กำหนดไว้ในใบจองซื้อนี้</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4.4 ไม่ส่งมอบรถยนต์ที่มีรายการอุปกรณ์ติดตั้งเพิ่มเติมและของแถมหรือสิทธิประโยชน์ต่างๆตามที่กำหนดไว้ในใบจองซื้อนี้</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ทั้งนี้ บริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่ได้รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วันนับแต่วันที่ผู้จองซื้อใช้สิทธิบอกเลิกการจองซื้อ</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;5. ผู้จองซื้อ มีสิทธิบอกเลิกการจองซื้อนี้ได้ หากปรากฏว่า ผู้จองซื้อต้องขอสินเชื่อเพื่อการซื้อรถยนต์ และผู้จองซื้อไม่ได้รับอนุมัติสินเชื่อภายในกำหนดเวลาการส่งมอบรถยนต์ โดยบริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วัน</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;6. บริษัทฯ มีสิทธิบอกเลิกการจองซื้อนี้ได้ หากปรากฏว่า ผู้จองซื้อต้องขอสินเชื่อเพื่อการซื้อรถยนต์ และผู้จองซื้อไม่ได้รับอนุมัติสินเชื่อภายในกำหนดเวลาการส่งมอบรถยนต์ โดยบริษัทฯ ต้องคืนเงินมัดจำหรือสิ่งของอื่นที่รับไว้เป็นมัดจำทั้งหมดให้แก่ผู้จองซื้อภายใน 15 วัน</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>7. กรณีผู้จองซื้อไม่ยอมรับมอบรถยนต์เมื่อครบกำหนดเวลาการส่งมอบ หรือบอกเลิกการจองซื้อโดยมิใช่ความผิดของบริษัทฯ ผู้จองซื้อยินยอมให้บริษัทฯ บอกเลิกสัญญาและริบมัดจำ</b></div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;8. การติดตั้งเพิ่มเติม แก้ไข ปรับเปลี่ยน ซึ่งอุปกรณ์หรือชิ้นส่วนของรถยนต์ หรือดัดแปลงสภาพรถ ให้ผิดไปจากมาตรฐานของผู้ผลิตรถยนต์เกีย จะทำให้การรับประกันคุณภาพสิ้นสุดลงเฉพาะส่วนที่ผู้จองซื้อได้กระทำการนั้น แต่ถ้าการติดตั้งเพิ่มเติม แก้ไข ปรับเปลี่ยน ซึ่งอุปกรณ์หรือชิ้นส่วนของรถยนต์หรือดัดแปลงสภาพนั้น เกี่ยวข้องกับ มาตรฐานความปลอดภัยในการใช้รถยนต์ จะทำให้รถยนต์ทั้งคันสิ้นสุดการรับประกันคุณภาพโดยสิ้นเชิง</div>
                <div style="line-height: 0.8;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;9. บริษัทฯ รับผิดชอบเฉพาะธุรกรรมที่ระบุไว้ในใบจองซื้อรถยนต์ฉบับนี้เท่านั้น ธุรกรรมอื่นใดที่ผู้จองซื้อเข้าทำกับพนักงานขายโดยตรงเฉพาะตัว เช่น สั่งซื้อ/สั่งจองเลขทะเบียนสวย, สั่งซื้อ/สั่งจ้างให้ดำเนินการปรับเปลี่ยนหรือติดตั้งอุปกรณ์เพิ่มเติม, ดัดแปลงสภาพรถ, ทำ/ต่อประกันภัยรถยนต์ ฯลฯ ถือเป็นการกระทำเฉพาะตัวของพนักงานขายซึ่งอยู่นอกเหนือสภาพการจ้าง บริษัทฯ สงวนสิทธิ์ไม่รับผิดชอบทั้งสิ้น</div> --}}
</body>
</html>
