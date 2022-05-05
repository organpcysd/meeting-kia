@extends('adminlte::page')
@php $pagename = 'เพิ่มใบเสนอราคา'; @endphp
@section('content')
    <div class="contrainer p-4">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i
                                class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการประเภทรถ</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $pagename }}</li>
                </ol>
            </nav>
        </div>

        <div class="card card-outline card-info">
            <div class="card-body">
                <h3>{{ $pagename }}</h3>
            </div>
        </div>

        <form action="{{ route('cartype.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-info">
                        <div class="card-header">
                            รายละเอียดใบเสนอราคา
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ลูกค้า</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="customer" name="customer"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ที่ปรึกษาการขาย</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="user" name="user" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ผู้มาติดต่อ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="contact" name="contact" required>
                                        </div>
                                    </div>
                                </div>
                                    <div class="vr"></div>

                                <div class="col-sm-7">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">รถยนต์</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="car" name="car" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">สถานที่จัดส่ง</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="place_send" name="place_send">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">ประมาณการส่งมอบ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="estimate_send"
                                                name="estimate_send">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card card-info">
                        <div class="card-header">
                            รายละเอียดการชำระเงิน
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">เงื่อนไข</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="condition" name="condition" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ราคารถยนต์</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price_car" name="price_car" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"><u>ส่วนลด</u> ราคารถยนต์</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="payment_discount" name="payment_discount">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">คำนวณยอดจัดซื้อ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="deposit_roll" name="deposit_roll"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">มัดจำป้ายแดง</label>
                                <div class="col-sm-10 border border-info rounded p-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ราคารถยนต์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car"
                                                name="price_car" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car"
                                                name="price_car">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"><u>ส่วนลด</u> เงินดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_discount"
                                                name="payment_discount">
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">รถยนต์ที่นำมาแลก</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car"
                                                name="price_car">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"><u>หัก</u> รถยนต์คันเก่า</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_discount"
                                                name="payment_discount">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ค่าใช้จ่ายวันออกรถ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car"
                                                name="price_car" disabled>
                                        </div>
                                    </div>

                                    <div class="form-check row">
                                        <label class="col-sm-4 col-form-label">ค่าใช้จ่ายวันออกรถ</label>
                                        <div class="col-sm-8">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                            Default checkbox
                                            </label>
                                        </div>

                                      </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="float-right">
                        <a class='btn btn-secondary' onclick='history.back();'><i
                                class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                        <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@section('plugins.Sweetalert2', true)
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'])

@push('js')
    <script type="text/javascript">
        function grayer(formId, yesNo) {
            var f = document.getElementById(formId),
                s, opacity;
            s = f.style;
            opacity = yesNo ? '40' : '100';
            s.opacity = s.MozOpacity = s.KhtmlOpacity = opacity / 100;
            s.filter = 'alpha(opacity=' + opacity + ')';
            for (var i = 0; i < f.length; i++) f[i].disabled = yesNo;
        }
        window.onload = function() {
            grayer('f_1', true);
        }; // disabled by default
    </script>
@endpush
@endsection
