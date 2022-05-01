@extends('adminlte::page')
@php $pagename = 'แก้ไขข้อมูลลูกค้า'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">รายชื่อลูกค้า</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('customer.update',['customer' => $customer->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        รายละเอียดส่วนตัว
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="staff_id" name="staff_id" value={{ Auth::user()->id }}>

                        <div class="form-group">
                            <label>เลขประจำตัวผู้เสียภาษี</label>
                            <input type="text" class="form-control" id="itax_id" name="itax_id" value="{{ $customer->itax_id }}">
                        </div>

                        <div class="form-group">
                            <label>เลขประจำตัวประชาชน</label>
                            <input type="text" class="form-control" id="citizen_id" name="citizen_id" value="{{ $customer->citizen_id }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>คำนำหน้า</label>
                                <select class="js-example-basic-multiple form-control" name="customer_prefix">
                                    @foreach($prefixes as $item_pr)
                                        <option @if($customer->prefix_id == $item_pr->id ) selected @endif value="{{$item_pr->id}}">{{$item_pr->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                              <label>ชิ่อจริง</label>
                              <input type="text" class="form-control" id="fname" name="fname" value={{ $customer->f_name }}>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputPassword4">นามสกุล</label>
                              <input type="text" class="form-control" id="lname" name="lname" value="{{ $customer->l_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ชื่อเล่น</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $customer->nickname }}">
                        </div>

                        <div class="form-group">
                            <label>วันเกิด</label>
                            <input type="date" class="form-control" id="born" name="born" value="{{ $customer->born }}">
                        </div>

                        <div class="form-group">
                            <label>อาชีพ</label>
                            <input type="text" class="form-control" id="vocation" name="vocation" value="{{ $customer->vocation }}">
                        </div>

                        <div class="form-group">
                            <label>งานอดิเรก</label>
                            <input type="text" class="form-control" id="hobby" name="hobby" value="{{ $customer->hobby }}">
                        </div>

                        <div class="form-group">
                            <label>อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
                        </div>

                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="phone" name="phone" maxlength="10" value="{{ $customer->phone }}">
                        </div>

                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" class="form-control" id="fax" name="fax" value="{{ $customer->fax }}">
                        </div>

                        <div class="form-group">
                            <label>ไอดีไลน์</label>
                            <input type="text" class="form-control" id="lineid" name="lineid" value="{{ $customer->line_id }}">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        รายละเอียดที่อยู่
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name = "address_id" value="{{ $address->id }}">
                        <div class="form-group">
                            <label>บ้านเลขที่</label>
                            <input type="text" class="form-control" id="house_number" name="house_number" value={{ $address->house_number }}>
                        </div>

                        <div class="form-group">
                            <label>ถนน</label>
                            <input type="text" class="form-control" id="road" name="road" value="{{ $address->road }}">
                        </div>

                        <div class="form-group">
                            <label>ตรอก / ซอย</label>
                            <input type="text" class="form-control" id="alley" name="alley" value="{{ $address->alley }}">
                        </div>

                        <div class="form-group">
                            <label>อาคาร / แขวง / หมู่ที่</label>
                            <input type="text" class="form-control" id="group" name="group" value="{{ $address->group }}">
                        </div>

                        <div class="form-group">
                            <label>หมู่บ้าน</label>
                            <input type="text" class="form-control" id="village" name="village" value="{{ $address->village }}">
                        </div>

                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="js-example-basic-multiple form-control" name="provinces" id="provinces">
                                <option selected disabled>-กรุณาเลือกจังหวัด-</option>
                                @foreach($provinces as $item)
                                    <option @if(in_array($item->id,[$address->province_id])) selected @endif value="{{$item->id}}">{{$item->name_th}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="js-example-basic-multiple form-control" name="districts" id="districts">
                                <option selected disabled>-กรุณาเลือกอำเภอ-</option>
                            </select>
                            <input type="hidden" value="{{ $address->district_id }}" id="district_id">
                        </div>

                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="js-example-basic-multiple form-control" name="canton" id="canton">
                                <option selected disabled>-กรุณาเลือกตำบล-</option>
                            </select>
                            <input type="hidden" value="{{ $address->canton_id }}" id="canton_id">
                        </div>

                        <div class="form-group">
                            <label>รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $address->zipcode }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <a class='btn btn-secondary' onclick='history.back();'><i class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                    <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"])
@push('js')
    <script>
        // alert('organ == ไม่ผ่านสหกิจ!!!!!!');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            let id = $('#provinces').val();
                $.ajax({
                    type: "post",
                    url: "{{ route('customer.getprovinces') }}",
                    data: {_token:CSRF_TOKEN,id:id},
                    dataType: "json",
                    success: function (response) {
                        let option = '<option selected disabled>-กรุณาเลือกอำเภอ-</option>';
                        let district_id = parseInt(document.getElementById('district_id').value);

                        response.forEach(districts => {
                            let selected = (districts.id === district_id ? ' selected' : '');
                            option += '<option value="' + districts.id + '"' + selected +'>' + districts.name_th + '</option>';
                        });

                        $('#districts').html(option);

                    }
                });

            let id2 = $('#district_id').val();
            $.ajax({
                type: "post",
                url: "{{ route('customer.getdistricts') }}",
                data: {_token:CSRF_TOKEN,id:id2},
                dataType: "json",
                success: function (response) {
                    let option = '<option selected disabled>-กรุณาเลือกตำบล-</option>';
                    let canton_id = parseInt(document.getElementById('canton_id').value);

                    response.forEach(canton => {
                        let selected = (canton.id === canton_id ? ' selected' : '');
                        option += '<option value="' + canton.id + '"' + selected +'>' + canton.name_th + '</option>';
                    });

                    $('#canton').html(option);

                }
            });

            $('#provinces').on('change',function(){
                let id = $('#provinces').val();
                $.ajax({
                    type: "post",
                    url: "{{ route('customer.getprovinces') }}",
                    data: {_token:CSRF_TOKEN,id:id},
                    dataType: "json",
                    success: function (response) {
                        let option = ''
                        option = '<option selected disabled>-กรุณาเลือกอำเภอ-</option>';

                        response.forEach(districts => {
                            option += '<option value="' + districts.id + '">' + districts.name_th + '</option>';
                        });

                        $('#districts').html(option);
                        $('#canton').html('<option selected disabled>-กรุณาเลือกตำบล-</option>');
                        $('#zipcode').val('');

                    }
                });
            })

            $('#districts').on('change',function(){
                let id = $('#districts').val();
                $.ajax({
                    type: "post",
                    url: "{{ route('customer.getdistricts') }}",
                    data: {_token:CSRF_TOKEN,id:id},
                    dataType: "json",
                    success: function (response) {
                        let option = '<option selected disabled>-กรุณาเลือกตำบล-</option>';
                        let option2 = '';

                        response.forEach(canton => {
                            option += '<option value="' + canton.id + '">' + canton.name_th + '</option>';
                        });

                        $('#canton').html(option);

                    }
                });
            })

            $('#canton').on('change',function(){
                let id = $('#canton').val();
                console.log(id)
                $.ajax({
                    type: "post",
                    url: "{{ route('customer.getzipcode') }}",
                    data: {_token:CSRF_TOKEN,id:id},
                    dataType: "json",
                    success: function (response) {
                        let option = '';
                        response.forEach(zipcode => {
                            option = zipcode.zip_code;
                        });

                        $('#zipcode').val(option);

                    }
                });
            })


        });

    </script>
@endpush
@endsection
