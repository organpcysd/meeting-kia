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
            font-size: 19px;
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

    <table style="border:1px solid black;">
        <tr>
            <td style="width: 50%; padding-left: 10px;">บุคคลธรรมดา {{ $reserved->customer->f_name . ' ' . $reserved->customer->l_name }}</td>
            <td style="width: 50%; padding-left: 10px;">เลขประจำตัวประชาชน @if($reserved->customer->citizen_id ) {{ $reserved->customer->citizen_id }} @else _______________________________ @endif</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 50%; padding-left: 10px;">นิติบุคคล __________________________________________</td>
            <td style="width: 50%; padding-left: 10px;">เลขประจำตัวผู้เสียภาษี @if($reserved->customer->itax_id ) {{ $reserved->customer->itax_id }} @else _______________________________ @endif</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 50%; padding-left: 10px;">ที่อยู่ </td>
            <td style="width: 50%; padding-left: 10px;">โทรศัพท์ {{ substr($reserved->user->phone, 0, 3) . '-' . substr($reserved->user->phone, 3, 3) . '-' . substr($reserved->user->phone, 6, 4) }}</td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 50%; padding-left: 10px; padding-bottom: 15px;">ที่ทำงาน __________________________________________</td>
            <td style="width: 50%; padding-left: 10px; padding-bottom: 15px;">โทรศัพท์ __________________________________________</td>
        </tr>
    </table>

    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="3" style="font-weight: bold; padding-left: 10px;"> &nbsp; &nbsp; &nbsp; &nbsp;2. รายละเอียดรถยนต์ / ราคา / อุปกรณ์สั่งซื้อเพิ่มเติม / ของแถมหรือสิทธิประโยชน์ / อื่นๆ</td>
        </tr>
    </table>
    <table style="width:100%; border:1px solid black;" cellspacing="0" cellpadding="0">
        <tr style="line-height: 0.9;">
            <td style="width: 70%; padding-left: 10px;">
                <div>รถยนต์ยี่ห้อ {{ $reserved->car->car_model->model_name }} รุ่น {{ $reserved->car->car_level->level_name }} ปีที่ผลิต {{ $reserved->car->years }}</div>
                <div>ขนาดกำลังเครื่องยนต์ @if ($reserved->car->engine) {{ $reserved->car_engine }} @else _______________________ @endif ซีซี. สี {{ $reserved->car->car_color->color_name }} @if ($reserved->car->car_color->color_code) [{{ $reserved->car->car_color->color_code }}]@endif &nbsp; &nbsp; ราคา</div>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;">{{ number_format($reserved->reserved_detail->price_car,2) }}</td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>
        <tr style="line-height: 0.9;">
            <td style="width: 70%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.9;">
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
        <tr style="line-height: 0.9;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:90%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.9;">
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
        <tr style="line-height: 0.9;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.9;">
                        <td style="width: 30%;">อื่นๆ</td>
                        <td style="width: 70%;">__________________________________________________</td>
                    </tr>
                    <tr style="line-height: 0.9;">
                        <td style="width: 30%;">รวมราคาเป็นเงินทั้งสิ้น</td>
                        <td style="width: 70%;">(_________________________________________________)</td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding-left: 10px; border:1px solid black;">{{ number_format($reserved->reserved_detail->subtotal,2) }}</td>
            <td style="width: 10%; padding-left: 10px; border:1px solid black;"></td>
        </tr>

        <tr style="line-height: 0.9;">
            <td style="width: 60%; padding-left: 10px;">
                <table style="width:100%;" cellspacing="0" cellpadding="0">
                    <tr style="line-height: 0.9;">
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
</body>
</html>
