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
                <div class="col-sm-5">
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
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ลูกค้า</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="customer" id="customer">
                                                    <option value="" selected disabled>- ค้นหาลูกค้า -</option>
                                                @foreach($customers as $item)
                                                    <option value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ที่ปรึกษาการขาย</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="user" id="user">
                                                <option value="" selected disabled>- ค้นหาที่ปรึกษาการขาย -</option>
                                                @foreach($users as $item)
                                                    <option value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ผู้มาติดต่อ</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="contact" id="contact">
                                                <option value="" selected disabled>- ค้นหาผู้มาติดต่อ -</option>
                                                @foreach($customers as $item)
                                                    <option value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">รถยนต์</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="car" id="car">
                                                <option value="" selected disabled>- ค้นหารถยนต์ -</option>
                                                @foreach($cars as $item)
                                                    <option value="{{$item->id}}">{{$item->car_model->model_name . ' ' . $item->car_level->level_name . ' ' . $item->car_color->color_name . ' ' . $item->years}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">สถานที่จัดส่ง</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="place_send" name="place_send">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ประมาณการส่งมอบ</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="estimate_send"
                                                name="estimate_send">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-7">
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
                                <label class="col-sm-3 col-form-label">เงื่อนไข</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="condition" id="condition">
                                        <option value="สด">สด</option>
                                        <option value="ผ่อน">ผ่อน</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ราคารถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price_car" name="price_car" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><u>ส่วนลด</u> ราคารถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_discount" name="payment_discount">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">คำนวณยอดจัดซื้อ</label>
                                <div class="col-sm-9 border border-info rounded p-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ราคารถยนต์ : สุทธิ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car_net" name="price_car_net" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_down" name="payment_down">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"><u>ส่วนลด</u> เงินดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_down_discount" name="payment_down_discount">
                                        </div>
                                    </div>

                                    <hr/>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ระยะเวลาผ่อนชำระ</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control" name="term_credit" id="term_credit">
                                                    <option value="" selected disabled>- เลือกจำนวนงวด -</option>
                                                    <option value="12">12</option>
                                                    <option value="24">24</option>
                                                    <option value="36">36</option>
                                                    <option value="48">48</option>
                                                    <option value="60">60</option>
                                                    <option value="72">72</option>
                                                    <option value="84">84</option>
                                                </select>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">เดือน</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">อัตราดอกเบี้ยต่อปี</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" id="interest" name="interest">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ยอดจัดเช่าซื้อ</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" id="hire_purchase" name="hire_purchase" disabled>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">บาท</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ค่างวดต่อเดือน (รวม VAT)</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" id="term_payment" name="term_payment" disabled>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">มัดจำป้ายแดง</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="deposit_roll" name="deposit_roll"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าอุปกรณ์แต่งรถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_decorate" name="payment_decorate"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าเบี้ยประกัน</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_insurance" name="payment_insurance"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าใช้จ่ายอื่นๆ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_other" name="payment_other"
                                        required>
                                </div>
                            </div>

                            <hr/>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">รถยนต์ที่นำมาแลก</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="car_change" id="car_change">
                                        <option value="มี" >มี</option>
                                        <option value="ไม่มี">ไม่มี</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><u>หัก</u> รถยนต์คันเก่า</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_car_turn" name="payment_car_turn">
                                </div>
                            </div>

                            <hr/>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าใช้จ่ายวันออกรถ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="subtotal" name="subtotal" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">อุปกรณ์แต่งที่แถม</label>
                                <div class="col-sm-9">
                                    <select class="sel2 form-control" name="accessories[]" id="accessories" multiple>
                                        @foreach($accessories as $item)
                                            <option value="{{$item->id}}">{{$item->gift_name}}</option>
                                        @endforeach
                                    </select>
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

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'])

@push('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('.sel2').select2();
        });

        $('#car').on('change',function(){
            let id = $('#car').val();

            $.ajax({
                type: "POST",
                url: "{{ route('quotation.car') }}",
                data: {_token:CSRF_TOKEN,id:id},
                dataType: "json",
                success: function (response) {
                    $('#price_car').val(response.price);
                    $('#price_car_net').val(response.price);
                }
            });
        });

    </script>
@endpush
@endsection
