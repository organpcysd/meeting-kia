@extends('adminlte::page')
@php $pagename = 'แก้ไขข้อมูลส่งมอบรถยนต์'; @endphp
@section('content')
    <div class="contrainer p-4">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i
                                class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">ลูกค้าจองรถยนต์</a>
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

        <form action="{{ route('received.edit',['received' => $received->id]) }}" method="post" id="formsubmit">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-5">
                    <div class="card card-info">
                        <div class="card-header">
                            เกี่ยวกับรถยนต์
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
                                        <label class="col-sm-4 col-form-label">หมายเลขใบจอง</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="reserved" id="reserved">
                                                <option value="" selected disabled>- ค้นหาหมายเลขใบจอง -</option>
                                                @foreach($reserved as $item)
                                                    <option @if ($received->reserved_id === $item->id) selected @endif value="{{$item->id}}">{{$item->serial_number . ' : ' . $item->customer->customer_prefix->title . ' ' . $item->customer->f_name . ' ' . $item->customer->l_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <hr/>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ที่ปรึกษาการขาย</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="user" id="user">
                                                <option value="" selected disabled>- ค้นหาที่ปรึกษาการขาย -</option>
                                                @foreach($users as $item)
                                                    <option @if ($received->user_id === $item->id) selected @endif value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ลูกค้า</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="customer" id="customer">
                                                <option value="" selected disabled>- ค้นหาลูกค้า -</option>
                                                @foreach($customers as $item)
                                                    <option @if ($received->customer_id === $item->id) selected @endif value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
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
                                                    <option @if ($received->car_id === $item->id) selected @endif value="{{$item->id}}">{{$item->car_model->model_name . ' ' . $item->car_level->level_name . ' ' . $item->car_color->color_name . ' ' . $item->years}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">เลขตัวถัง</label>
                                        <div class="col-sm-8">
                                            <select class="sel2 form-control" name="chassis" id="chassis">
                                                <option value="" selected disabled>- เลือกเลขตัวถังรถยนต์ -</option>
                                                @foreach($carstocks as $item)
                                                    <option @if ($received->stock_id === $item->id) selected @endif value="{{$item->id}}">{{ $item->number_chassis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">เลขตัวเครื่อง</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="engine" name="engine" value="{{ $received->car_stock->number_engine }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">วันที่รับรถยนต์</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="received_date"
                                                name="received_date" value="{{ $received->received_date }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            การวางเงินมัดจำ
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">จำนวนเงิน</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="payable" name="payable" value="{{ $received->received_detail->payable }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">วิธีการชำระเงิน</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="payment_by" id="payment_by">
                                        <option value="" selected disabled>- เลือกวิธีการชำระเงิน -</option>
                                        <option @if($received->payment_by === 'cash') selected @endif value="cash">เงินสด</option>
                                        <option @if($received->payment_by === 'credit') selected @endif value="credit">บัตรเครดิต</option>
                                        <option @if($received->payment_by === 'cheque') selected @endif value="cheque">เช็ค</option>
                                        <option @if($received->payment_by === 'tranfer') selected @endif value="tranfer">โอนผ่าน Banking</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 col-sm-7" id="payment_detail">
                    <div class="card card-info">
                        <div class="card-header">
                            รายละเอียดการชำระเงิน
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เงื่อนไข</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="condition" id="condition">
                                        <option selected disabled>- เลือกเงื่อนไข -</option>
                                        <option @if($received->received_detail->condition === 'cash') selected @endif value="cash">สด</option>
                                        <option @if($received->received_detail->condition === 'credit') selected @endif value="credit">ผ่อน</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ราคารถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price_car" name="price_car" value="{{ $received->received_detail->price_car }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><u>ส่วนลด</u> ราคารถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_discount" name="payment_discount" value="{{ $received->received_detail->payment_discount }}">
                                </div>
                            </div>

                            <div class="form-group row" id="cal">
                                <label class="col-sm-3 col-form-label">คำนวณยอดจัดซื้อ</label>
                                <div class="col-sm-9 border border-info rounded p-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ราคารถยนต์ : สุทธิ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="price_car_net" name="price_car_net" value="{{ $received->received_detail->price_car_net }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_down" name="payment_down" value="{{ $received->received_detail->payment_down }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"><u>ส่วนลด</u> เงินดาวน์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" id="payment_down_discount" name="payment_down_discount" value="{{ $received->received_detail->payment_down_discount }}">
                                        </div>
                                    </div>

                                    <hr/>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ระยะเวลาผ่อนชำระ</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control" name="term_credit" id="term_credit">
                                                    <option value="1" selected>- เลือกจำนวนงวด -</option>
                                                    <option @if($received->received_detail->term_credit === "12") selected @endif value="12">12</option>
                                                    <option @if($received->received_detail->term_credit === "24") selected @endif value="24">24</option>
                                                    <option @if($received->received_detail->term_credit === "36") selected @endif value="36">36</option>
                                                    <option @if($received->received_detail->term_credit === "48") selected @endif value="48">48</option>
                                                    <option @if($received->received_detail->term_credit === "60") selected @endif value="60">60</option>
                                                    <option @if($received->received_detail->term_credit === "72") selected @endif value="72">72</option>
                                                    <option @if($received->received_detail->term_credit === "84") selected @endif value="84">84</option>
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
                                                <input type="text" class="form-control form-control-sm" id="interest" name="interest" value="{{ $received->received_detail->interest }}">
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
                                                <input type="text" class="form-control form-control-sm" id="hire_purchase" name="hire_purchase" value="{{ $received->received_detail->hire_purchase }}" readonly>
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
                                                <input type="text" class="form-control form-control-sm" id="term_payment" name="term_payment" value="{{ $received->received_detail->term_payment }}" readonly>
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
                                    <input type="text" class="form-control" id="deposit_roll" name="deposit_roll" value="{{ $received->received_detail->deposit_roll }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าอุปกรณ์แต่งรถยนต์</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_decorate" name="payment_decorate" value="{{ $received->received_detail->payment_decorate }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าเบี้ยประกัน</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_insurance" name="payment_insurance" value="{{ $received->received_detail->payment_insurance }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าใช้จ่ายอื่นๆ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_other" name="payment_other" value="{{ $received->received_detail->payment_other }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หักค่ามัดจำ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payable_show" name="payable_show" value="{{ $received->received_detail->payable }}" readonly>
                                </div>
                            </div>

                            <hr/>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">รถยนต์ที่นำมาแลก</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="car_change" id="car_change">
                                        <option @if($received->received_detail->car_change === "yes") selected @endif value="yes">มี</option>
                                        <option @if($received->received_detail->car_change === "no") selected @endif value="no">ไม่มี</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="carturn">
                                <label class="col-sm-3 col-form-label"><u>หัก</u> รถยนต์คันเก่า</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_car_turn" name="payment_car_turn" value="{{ $received->received_detail->payment_car_turn }}">
                                </div>
                            </div>

                            <hr/>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ค่าใช้จ่ายวันออกรถ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="subtotal" name="subtotal" value="{{ $received->received_detail->subtotal }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">อุปกรณ์แต่งที่แถม เพิ่มเติม</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="accessories" name="accessories">{{ $received->received_detail->accessories }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="float-right">
                        <button class='btn btn-secondary' id="backbtn" onclick='history.back(); return false'><i class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</button>
                        <a class='btn btn-info' id="savebtn" onclick='formsubmit()'><i class="fas fa-save mr-2"></i>บันทึก</a>
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

        function formsubmit() {
            Swal.fire({
                title: 'ยืนยัน',
                text: "ยืนยันการเพิ่มข้อมูล?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#formsubmit').submit();
                }
            })
        }

        $(document).ready(function() {
            $('.sel2').select2();

            //hide div id : cal
            let ele = document.getElementById("cal");
            ele.style.display = "none";

            select_car = $("#car").val();
            if(select_car === null) {
                disable_payment_detail();
            }

            let val = $("#condition").val();
            if (val == "cash") {
                let ele = document.getElementById("cal");
                ele.style.display = "none";
                cal()
            }else{
                let ele = document.getElementById("cal");
                ele.style.display = "";
                cal()
            }

            let car_change = $("#car_change").val();
            if(car_change == "no") {
                let ele = document.getElementById("carturn");
                ele.style.display = "none";
                $("#payment_car_turn").val('');
                cal()
            }

            $('#car').change(function(){
                var id = $('#car').val();
                getCarStock(id);
            });

            $('#chassis').change(function(){
                var id = $('#chassis').val();
                getEngine(id);
            });


        });

        function disable_payment_detail(){
            $('#payment_detail').fadeTo(0, 0.4);

            document.getElementById("condition").disabled = true;
            document.getElementById("payment_discount").disabled = true;
            document.getElementById("deposit_roll").disabled = true;
            document.getElementById("payment_decorate").disabled = true;
            document.getElementById("payment_insurance").disabled = true;
            document.getElementById("payment_other").disabled = true;
            document.getElementById("car_change").disabled = true;
            document.getElementById("payment_car_turn").disabled = true;
            document.getElementById("accessories").disabled = true;
            document.getElementById("backbtn").disabled = true;
            $('#savebtn').attr('onclick','return false');
        }

        function enable_payment_detail(){
            $('#payment_detail').fadeTo(0, 1);

            document.getElementById("condition").disabled = false;
            document.getElementById("payment_discount").disabled = false;
            document.getElementById("deposit_roll").disabled = false;
            document.getElementById("payment_decorate").disabled = false;
            document.getElementById("payment_insurance").disabled = false;
            document.getElementById("payment_other").disabled = false;
            document.getElementById("car_change").disabled = false;
            document.getElementById("payment_car_turn").disabled = false;
            document.getElementById("accessories").disabled = false;
            document.getElementById("backbtn").disabled = false;
            $('#savebtn').attr('onclick','formsubmit()');
        }

        //ดึง car stock
        function getCarStock(id){
            $.ajax({
                type: "get",
                url: "{{ url('admin/received/getcarstock') }}/" + id,
                success: function (response) {
                    var chassis = '';
                    if(response.carstock.length === 0){
                        chassis = '<option selected disabled>- ไม่มีรถยนต์ -</option>';
                    }else{
                        chassis = '<option selected disabled>- เลือกเลขตัวถังรถยนต์ -</option>';
                        response.carstock.forEach(carstock =>{
                            chassis += '<option value="' + carstock.id + '">' + carstock.number_chassis + '</option>';
                        });
                    }
                    $('#chassis').html(chassis);
                }
            });
        }

        //ดึง engine number
        function getEngine(id){
            $.ajax({
                type: "get",
                url: "{{ url('admin/received/getengine') }}/" + id,
                success: function (response) {
                    $('#engine').val(response.carstock.number_engine);
                }
            });
        }


        //ดึงข้อมูลตอนเลือกใบเสนอราคา
        $('#reserved').on('change',function(){
            let id = $('#reserved').val();

            $.ajax({
                type: "get",
                url: "{{ url('admin/received/reserved') }}/" + id,
                success: function (response) {

                    console.log(response);

                    let customer_option = '<option selected disabled>- ค้นหาลูกค้า -</option>';
                    let user_option = '<option selected disabled>- ค้นหาที่ปรึกษาการขาย -</option>';
                    let contact_option = '<option selected disabled>- ค้นหาผู้มาติดต่อ -</option>';
                    let car_option = '<option selected disabled>- ค้นหารถยนต์ -</option>';
                    let accessories_option = '';

                    response.customers.forEach(customers =>{
                        let selected = (customers.id === response.reserved.customer_id ? ' selected' : '');
                        customer_option += '<option value="' + customers.id + '"' + selected +'>' + customers.f_name + ' ' + customers.l_name + ' (' + customers.phone + ')' + '</option>';
                    });

                    response.users.forEach(users =>{
                        let selected = (users.id === response.reserved.user_id ? ' selected' : '');
                        user_option += '<option value="' + users.id + '"' + selected +'>' + users.f_name + ' ' + users.l_name + ' (' + users.phone + ')' + '</option>';
                    });

                    response.customers.forEach(contacts =>{
                        let selected = (contacts.id === response.reserved.contact_id ? ' selected' : '');
                        contact_option += '<option value="' + contacts.id + '"' + selected +'>' + contacts.f_name + ' ' + contacts.l_name + ' (' + contacts.phone + ')' + '</option>';
                    });

                    response.cars.forEach(cars =>{
                        let selected = (cars.id === response.reserved.car_id ? ' selected' : '');
                        car_option += '<option value="' + cars.id + '"' + selected +'>' + cars.car_model.model_name + ' ' + cars.car_level.level_name + ' ' + cars.car_color.color_name + ' ' + cars.price + ' ' + cars.years + '</option>';
                    });

                    $('#user').html(user_option);
                    $('#customer').html(customer_option);
                    $('#contact').html(contact_option);
                    $('#car').html(car_option);


                    $('#payment_by').val(response.reserved.payment_by);
                    $('#payable').val(response.reserved_detail.payable);

                    $('#condition').val(response.reserved_detail.condition);
                    if ($('#condition').val() == "cash") {
                        let ele = document.getElementById("cal");
                        ele.style.display = "none";
                    }else{
                        let ele = document.getElementById("cal");
                        ele.style.display = "";
                    }

                    $('#price_car').val(response.reserved_detail.price_car);
                    $('#payment_discount').val(response.reserved_detail.payment_discount);
                    $('#price_car_net').val(response.reserved_detail.price_car_net);
                    $('#payment_down').val(response.reserved_detail.payment_down);
                    $('#payment_down_discount').val(response.reserved_detail.payment_down_discount);
                    $('#term_credit').val(response.reserved_detail.term_credit);
                    $('#interest').val(response.reserved_detail.interest);
                    $('#deposit_roll').val(response.reserved_detail.deposit_roll);
                    $('#payment_decorate').val(response.reserved_detail.payment_decorate);
                    $('#payment_insurance').val(response.reserved_detail.payment_insurance);
                    $('#payment_other').val(response.reserved_detail.payment_other);
                    $('#car_change').val(response.reserved_detail.car_change);
                        if($("#car_change").val() == "no") {
                            let ele = document.getElementById("carturn");
                            ele.style.display = "none";
                            $("#payment_car_turn").val('');
                        }
                    $('#payment_car_turn').val(response.reserved_detail.payment_car_turn);
                    $('#hire_purchase').val(response.reserved_detail.hire_purchase);
                    $('#term_payment').val(response.reserved_detail.term_payment);
                    $('#subtotal').val(response.reserved_detail.subtotal);
                    $('#accessories').val(response.reserved_detail.accessories);

                    cal();
                    getCarStock(response.reserved.car_id);

                }
            });

            enable_payment_detail();
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

            select_car = $("#car").val();
            if(select_car != null) {
                enable_payment_detail();
            }

        });

        $('#condition').on('change',function(){
            let val = $("#condition").val();

            if (val == "cash") {
                let ele = document.getElementById("cal");
                ele.style.display = "none";

                cal()
            }else{
                let ele = document.getElementById("cal");
                ele.style.display = "";

                cal()
            }
        });

        $('#car_change').on('change',function(){
            let car_change = $("#car_change").val();

            if(car_change == "no") {
                let ele = document.getElementById("carturn");
                ele.style.display = "none";
                $("#payment_car_turn").val('');
                cal()
            }else{
                let ele = document.getElementById("carturn");
                ele.style.display = "";
            }
        })

        $('#payment_discount').on('keyup',function() {
            var price_car = parseInt($("#price_car").val());
            var payment_discount = parseInt($("#payment_discount").val());

            if(isNaN(payment_discount)) {
                payment_discount = 0;
            }

            net = price_car - payment_discount
            $('#price_car_net').val(net);

            cal()
        });

        $('#payable').on('keyup',function(){
            var payable = parseInt($("#payable").val());
            $('#payable_show').val(payable);
            cal()
        });
        //----- credit -----//

        $('#payment_down').on('keyup',function() {
            cal()
        });

        $('#payment_down_discount').on('keyup',function() {
            cal()
        });

        $('#term_credit').on('change',function() {
            cal()
        });

        $('#interest').on('keyup',function() {
            cal()
        });

        //----------------//

        $('#deposit_roll').on('keyup',function() {
            cal()
        });

        $('#payment_decorate').on('keyup',function() {
            cal()
        });

        $('#payment_insurance').on('keyup',function() {
            cal()
        });

        $('#payment_other').on('keyup',function() {
            cal()
        });

        $('#payment_car_turn').on('keyup',function() {
            cal()
        });

        function cal() {
            var payable = parseInt($('#payable').val()); //จำนวนเงินมัดจำ
            var price_car = parseInt($("#price_car").val()); //ราคารถยนต์
            var payment_discount = parseInt($("#payment_discount").val()); //ส่วนลดราคารถยนต์

            var price_car_net = parseInt($("#price_car_net").val()); //ราคารถยนต์สุทธิ
            var payment_down = parseInt($("#payment_down").val()); //ดาวน์
            var payment_down_discount = parseInt($("#payment_down_discount").val()); //ส่วนลดเงินดาวน์
            var term_credit = parseInt($("#term_credit").val()); //ระยะเวลาผ่อนชำระ (เดือน) default = 1
            var interest = parseFloat($("#interest").val()); //อัตราดอกเบี้ยต่อปี

            var deposit_roll = parseInt($("#deposit_roll").val()); //มัดจำป้ายแดง
            var payment_decorate = parseInt($("#payment_decorate").val()); //ค่าอุปกรณ์แต่งรถยนต์
            var payment_insurance = parseInt($("#payment_insurance").val()); //ค่าเบี้ยประกัน
            var payment_other = parseInt($("#payment_other").val()); //ค่าใช้จ่ายอื่นๆ
            var payment_car_turn = parseInt($("#payment_car_turn").val()); //หักรถยนต์คันเก่า

            if(isNaN(payment_discount)) {
                payment_discount = 0;
            }

            if(isNaN(payable)) {
                payable = 0;
            }

            //----- credit -----//

            if(isNaN(payment_down)) {
                payment_down = 0;
            }

            if(isNaN(payment_down_discount)) {
                payment_down_discount = 0;
            }

            if(isNaN(interest)) {
                interest = 0;
            }

            //----------------//

            if(isNaN(deposit_roll)) {
                deposit_roll = 0;
            }

            if(isNaN(payment_decorate)) {
                payment_decorate = 0;
            }

            if(isNaN(payment_insurance)) {
                payment_insurance = 0;
            }

            if(isNaN(payment_other)) {
                payment_other = 0;
            }

            if(isNaN(payment_car_turn)) {
                payment_car_turn = 0;
            }

            condition = $("#condition").val();
            if (condition === "cash") {
                let subtotal = ( price_car - payment_discount ) + ( deposit_roll + payment_decorate + payment_insurance + payment_other ) - payment_car_turn - payable
                $("#subtotal").val(subtotal);
            } else if ( condition === "credit") {
                hire = (price_car - payment_discount) - payment_down;
                term_payment = hire/term_credit;
                net_interest = (((hire*interest)/100)/12);
                net_payment = Math.ceil(term_payment) + Math.ceil(net_interest);

                $("#hire_purchase").val(hire); //ยอดจัดเช่าซื้อ
                $("#term_payment").val(net_payment); //ค่างวดต่อเดือน

                let subtotal = (payment_down - payment_down_discount) + ( deposit_roll + payment_decorate + payment_insurance + payment_other ) - payment_car_turn - payable
                $("#subtotal").val(subtotal);
            }

        }

    </script>
@endpush
@endsection
