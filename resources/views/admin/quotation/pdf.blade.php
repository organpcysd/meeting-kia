<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ปริ้นท์ใบเสนอราคา</title>

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
        .right {
            float: right;
        }
        .left {
            float: left;
        }
    </style>
</head>

<body>
    {{-- <label class="left">ใบเสนอราคา</label>
    <label class="right">THEPNAKORN AUTO SERVICE CO.,LTD</label> --}}
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
            <td style="font-size: 30px; font-weight: bold; vertical-align:top; padding-left: 0px; text-align: left;">
                ใบเสนอราคา / Quotations
            </td>
            <td colspan="2" style="font-size: 18px; vertical-align:middle; text-align: right;">
                THEPNAKORN AUTO SERVICE CO.,LTD
            </td>
        </tr>
        <tr>
            <td width="40%";>
                <div style="font-weight: bold;">บริษัท เทพนครออโตเซอร์วิส จำกัด (สำนักงานใหญ่)</div>
                <div style="margin-top: -10px;">248 หมู่ 5 ตำบลจอหอ</div>
                <div style="margin-top: -10px;">อำเภอเมือง จังหวัดนครราชสีมา 30310</div>
                <div style="margin-top: -10px;">เลขประจำตัวผู้เสียภาษี 0305538002567</div>
                <div style="margin-top: -10px;">โทร 044-296 999 044-296 305-12</div>
            </td>
            <td style="text-align: left; padding-left:0;">
                <img src="{{ public_path('image/kia-motors.png') }}" style="width: 100px;">
            </td>
            <td style="float: right; vertical-align:top;">
                <div style="margin-left: 3px;"><b>เลขที่ / NO</b> {{ $quotations->serial_number }}</div>
                <div style="margin-top: -10px; margin-left: 3px;"><b>วันที่ / DATE</b>
                    {{ \Carbon\Carbon::parse($quotations->created_at)->format('d/m/Y') }}</div>
                <div style="margin-left: 3px;"><b>ผู้ติดต่อ / contact</b> </div>
                <div style="margin-top: -10px; margin-left: 3px;">
                    {{ $quotations->user->f_name . ' ' . $quotations->user->l_name }}</div>
                <div style="margin-top: -10px; margin-left: 3px;"><b>โทร / Tel</b>
                    {{ substr($quotations->user->phone, 0, 3) . '-' . substr($quotations->user->phone, 3, 3) . '-' . substr($quotations->user->phone, 6, 4) }}
                </div>
            </td>
        </tr>
        <tr style="border: 1px solid rgb(217, 217, 217); line-height: 0.8; vertical-align:top; ">
            <td style="border: 1px solid rgb(217, 217, 217); padding: 5px;" colspan="2">
                <div>ลูกค้า /
                    {{ $quotations->customer->customer_prefix->title . $quotations->customer->f_name . ' ' . $quotations->customer->l_name }}
                </div>
                <div>
                    {{ $quotations->place_send }}
                </div>
                <div>เลขประจำตัวผู้เสียภาษี : {{ $quotations->customer->itax_id }}</div>
                <div>ชื่อผู้ติดต่อ :
                    {{ $quotations->contact->customer_prefix->title . $quotations->contact->f_name . ' ' . $quotations->contact->l_name . '  เบอร์โทร: ' . substr($quotations->contact->phone, 0, 3) . '-' . substr($quotations->contact->phone, 3, 3) . '-' . substr($quotations->contact->phone, 6, 4) }}
                </div>
            </td>
            <td style="padding: 5px;">
                <div>สถานที่จัดส่ง {{ $quotations->place_send }}</div>
                <div>&nbsp;</div>
                <div>กำหนดการส่งมอบรถ {{ \Carbon\Carbon::parse($quotations->estimate_send)->format('d/m/Y') }}</div>
            </td>
        </tr>
    </table>
    <br style="line-height: 0.2;" />
    <table style="border-collapse: collapse; width: 100%;">
        <tr style="line-height: 0.7;">
            <th style="border: 1px solid rgb(217, 217, 217);"> ลำดับ <br /> ITEM </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> รุ่น <br /> Model </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> รายละเอียดสินค้า <br /> DESCRIPTION </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> หน่วย <br /> UNIT </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> จำนวน <br /> OTV </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> ราคา / หน่วย <br /> UNIT PRICE </th>
            <th style="border: 1px solid rgb(217, 217, 217);"> จำนวนเงินรวม (บาท) <br /> AMOUNT (BAHT) </th>
        </tr>
        <tr>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:center;">1</td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:left; padding-left:10px;">
                {{ $quotations->car->car_model->model_name . ' ' . $quotations->car->car_level->level_name . ' ' . $quotations->car->car_color->color_code . ' ' . $quotations->car->car_color->color_name }}
            </td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:left; padding-left:10px;">
                {{ $quotations->car->car_type->type_name }}</td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:center;">คัน</td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:center;">1</td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:right;">
                {{ number_format($quotations->quotation_detail->price_car, 2) }}</td>
            <td style="border: 1px solid rgb(217, 217, 217); text-align:right;">
                {{ number_format($quotations->quotation_detail->price_car, 2) }}</td>
        </tr>
    </table>

    <table style="width:100%;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 75%;">
                <table style="width:100%;">
                    <tr>
                        <td colspan="3" style="font-size: 23px;">หมายเหตุ: รายการของแถม</td>
                    </tr>
                    <tr style="font-size: 16px; line-height: 0.6;">
                        @php
                        $i = 0;
                            foreach ($quotations->quotation_detail->car_gift as $gift) {
                                if ($i%3 === 0) {
                                    echo '</tr><tr style="line-height: 0.6;">';
                                }
                                echo "<td>" . ++$i . '. ' . $gift->gift_name . "</td>";
                            }
                        @endphp
                    </tr>
                </table>
            </td>
            <td>
                @if ($quotations->quotation_detail->condition === "cash")
                    <table style="width:100%; margin-top: -30px;">
                        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td style="text-align: left;">
                                <b>ราคารถ:</b>
                            </td>
                            <td style="text-align: right;">
                                <label>{{ number_format($quotations->quotation_detail->price_car, 2) }}</label>
                            </td>
                        </tr>
                        <tr style="line-height: 0.8;">
                            <td style="text-align: left;">
                                <div><b>ส่วนลด</b></div>
                            </td>
                            <td style="text-align: right;">
                                <div>{{ number_format($quotations->quotation_detail->payment_discount , 2) }}</div>
                            </td>
                        </tr>
                    </table>
                @else
                    <table style="width:100%;">
                        <tr style="border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td colspan="2" style="font-size: 23px;">กรณีจัดเช่าซื้อ</td>
                        </tr>
                        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td style="text-align: left;">
                                <b>ราคารถ:</b>
                            </td>
                            <td style="text-align: right;">
                                <label>{{ number_format($quotations->quotation_detail->price_car, 2) }}</label>
                            </td>
                        </tr>
                        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td style="text-align: left;">
                                <div><b>ส่วนลด</b></div>
                            </td>
                            <td style="text-align: right;">
                                <div>{{ number_format($quotations->quotation_detail->payment_discount , 2) }}</div>
                            </td>
                        </tr>
                        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td style="text-align: left;">
                                <div><b>ดาวน์</b></div>
                            </td>
                            <td style="text-align: right;">
                                <div>{{ number_format($quotations->quotation_detail->payment_down , 2) }}</div>
                            </td>
                        </tr>
                        <tr style="line-height: 0.8; border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                            <td style="text-align: left;">
                                <div><b>ยอดจัด</b></div>
                            </td>
                            <td style="text-align: right;">
                                <div>{{ number_format($quotations->quotation_detail->hire_purchase , 2) }}</div>
                            </td>
                        </tr>
                        <tr style="line-height: 0.8;">
                            <td colspan="2">
                                ค่างวด ({{ $quotations->quotation_detail->term_credit}} งวด) ด/บ {{ number_format($quotations->quotation_detail->interest , 2) }}% = {{ number_format($quotations->quotation_detail->term_payment) }}
                            </td>
                        </tr>
                    </table>
                @endif
            </td>
        </tr>
    </table>

    <br/>

    <table style="width:100%; border:1px solid rgb(0, 0, 0, .2);" cellspacing="0" cellpadding="5">
        <tr style="text-align: center;">
            <td>
                <div style="margin-top: -10px;">( {{ $price_string }} )</div>
            </td>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="0" style="width:100%;">
        <tr>
            <td colspan="2">
                <div>วันรับรถชำระ ( กรุณาจ่ายดร๊าฟในนาม บริษัท เทพนครออโตเซอร์วิส จำกัด )</div>
            </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td style="width: 15px;">
                <b>1.</b>
            </td>
            <td colspan="2">
                @if ($quotations->quotation_detail->condition === "cash")
                    <div>ราคารถยนต์ {{ number_format($quotations->quotation_detail->price_car) }} บาท</div>
                @else
                    <div>เงินดาวน์ {{ number_format($quotations->quotation_detail->payment_down) }} บาท</div>
                @endif
            </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td>
                <b>2.</b>
            </td>
            <td>
                <div>ค่ามัดจำป้ายแดง {{ number_format($quotations->quotation_detail->deposit_roll) }} บาท &nbsp; &nbsp; ค่าอุปกรณ์แต่งรถยนต์ {{ number_format($quotations->quotation_detail->payment_decorate) }} บาท</div>
            </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td>
            </td>
            <td>
                <div>ค่าเบี้ยประกัน {{ number_format($quotations->quotation_detail->payment_insurance) }} บาท &nbsp; &nbsp; ค่าใช้จ่ายอื่นๆ {{ number_format($quotations->quotation_detail->payment_other) }} บาท</div>
            </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td>
                <b>3.</b>
            </td>
            <td colspan="2">
                <div><b><u>หัก</u></b> รถยนต์คันเก่า {{ number_format($quotations->quotation_detail->payment_car_turn) }} บาท</div>
            </td>
        </tr>
        <tr style="line-height: 0.8;">
            <td></td>
            <td colspan="2">
                <b><u>รวมเป็นเงิน {{ number_format($quotations->quotation_detail->subtotal) }} บาท</u></b>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr style="text-align:center;">
            <td style="width: 40%;">
            </td>
            <td style="width: 40%;">

            </td>
            <td style="border-bottom: 1pt solid rgb(0, 0, 0, .1);">
                <b>{{ $quotations->customer->f_name . ' ' . $quotations->customer->l_name }}</b>
            </td>
        </tr>
        <tr style="line-height: 0.8; text-align:center;">
            <td></td>
            <td></td>
            <td>ผู้เสนอราคา</td>
        </tr>
        <tr style="line-height: 0.8; text-align:center;">
            <td></td>
            <td></td>
            <td>วันที่ {{ \Carbon\Carbon::parse($quotations->created_at)->format('d/m/Y') }}</td>
        </tr>
    </table>
</body>
</html>
