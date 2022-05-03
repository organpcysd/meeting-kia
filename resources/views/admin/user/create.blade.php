@extends('adminlte::page')
@php $pagename = 'เพิ่มผู้ใช้งาน'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('user.store') }}" method="post" id='formsubmit' name="formsubmit" onsubmit="return confirmpass()">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        ข้อมูลผู้ใช้งาน
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>สิทธิ์ผู้ใช้งาน</label>
                            <select class="role form-control" name="role[]" id="role">
                                @foreach($roles as $item_r)
                                    <option value="{{$item_r->id}}">{{$item_r->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ตำแหน่ง</label>
                            <select class="position form-control" id="position" name="position[]" multiple>
                                @foreach($positions as $item_p)
                                    <option value="{{$item_p->id}}">{{$item_p->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>คำนำหน้า</label>
                                <select class="js-example-basic-multiple form-control" name="user_prefix">
                                    @foreach($prefixes as $item_pr)
                                        <option value="{{$item_pr->id}}">{{$item_pr->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                              <label>ชิ่อจริง</label>
                              <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputPassword4">นามสกุล</label>
                              <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ชื่อเล่น</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" required>
                        </div>

                        <div class="form-group">
                            <label>วันเกิด</label>
                            <input type="date" class="form-control" id="birthdate" name="born" required>
                        </div>

                        <div class="form-group">
                            <label>งานอดิเรก</label>
                            <input type="text" class="form-control" id="hobby" name="hobby">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        ข้อมูลติดต่อ
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="0987654321" maxlength="10" required>
                        </div>

                        <div class="form-group">
                            <label>ไอดีไลน์</label>
                            <input type="text" class="form-control" id="lineid" name="lineid">
                        </div>
                    </div>
                </div>

                <div class="card card-info">
                    <div class="card-header">
                        อีเมลและรหัสผ่าน
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                            <div class="my-2">
                                <span class="text-danger my-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="6">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Password" minlength="6">
                        </div>
                    </div>
                </div>

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
        function formsubmit() {
            $('#formsubmit').submit();
        }

        $(document).ready(function() {
            $('.position').select2();
        });

        function confirmpass(){
            var pw1 = document.forms['formsubmit']['password'].value;
            var pw2 = document.forms['formsubmit']['confirmpassword'].value;

            console.log(pw1);

            if(pw1 != pw2){
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'รหัสผ่านไม่ตรงกัน',
                });
                return false;
            }else{
                return true;
            }
        }
    </script>
@endpush
@endsection