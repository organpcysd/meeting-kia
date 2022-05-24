@extends('adminlte::page')
@php $pagename = 'แก้ไขผู้ใช้งาน'; @endphp
@push('css')
<style type="text/css">
    body {
        font-family: kanit !important;
    }
</style>
@endpush

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

    <form action="{{ route('user.update',['user' => $user->id]) }}" method="post" id='formsubmit' name="formsubmit" onsubmit="return confirmpass()" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-3">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="rounded-circle" id="showimg" src="@if($user->getFirstMediaUrl('user')) {{asset($user->getFirstMediaUrl('user'))}} @else {{asset('image/no-image.jpg')}} @endif" alt="User profile picture" width="150" height="150">
                        </div>

                        <div class="input-group mt-3">
                            <input name="imgs" type="file" class="custom-file-input" id="imgInp">
                            <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-9">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-cyan active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">ข้อมูลผู้ใช้งาน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-cyan" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">ข้อมูลติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-cyan" id="emailpassword-tab" data-toggle="tab" href="#emailpassword" role="tab" aria-controls="emailpassword" aria-selected="false">อีเมลและรหัสผ่าน</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="form-group">
                                    <label>สิทธิ์ผู้ใช้งาน</label>
                                    <select class="role form-control" name="role[]" id="role">
                                        @foreach($roles as $item_r)
                                            <option @if(in_array($item_r->name,[$user_has_role]) ) selected @endif value="{{$item_r->id}}">{{$item_r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>ตำแหน่ง</label>
                                    <select class="position form-control" id="position" name="position[]" multiple>
                                        @foreach($positions as $item_p)
                                            <option @if (in_array($item_p->name,$user->user_position()->pluck('name')->toArray())) selected @endif value="{{$item_p->id}}">{{$item_p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-2 col-md-4 col-sm-2">
                                        <label>คำนำหน้า</label>
                                        <select class="js-example-basic-multiple form-control" name="user_prefix">
                                            @foreach($prefix as $item_pr)
                                                <option @if($user->user_prefix_id == $item_pr->id ) selected @endif value="{{$item_pr->id}}">{{$item_pr->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-5 col-md-4 col-sm-5">
                                      <label>ชิ่อจริง</label>
                                      <input type="text" class="form-control" id="fname" name="fname" value = "{{ $user->f_name }}"required>
                                    </div>
                                    <div class="form-group col-lg-5 col-md-4 col-sm-5">
                                      <label for="inputPassword4">นามสกุล</label>
                                      <input type="text" class="form-control" id="lname" name="lname" value = "{{ $user->l_name }}"required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>ชื่อเล่น</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" value = "{{ $user->nickname }}" required>
                                </div>

                                <div class="form-group">
                                    <label>วันเกิด</label>
                                    <input type="date" class="form-control" id="born" name="born" value = "{{ $user->born }}">
                                </div>

                                <div class="form-group">
                                    <label>งานอดิเรก</label>
                                    <input type="text" class="form-control" id="hobby" name="hobby" value = "{{ $user->hobby }}">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="form-group">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" maxlength="10" value = "{{ $user->phone }}" required>
                                </div>

                                <div class="form-group">
                                    <label>ไอดีไลน์</label>
                                    <input type="text" class="form-control" id="lineid" name="lineid" value="{{ $user->line_id }}">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="emailpassword" role="tabpanel" aria-labelledby="emailpassword-tab">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">อีเมล</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                    @error('email')
                                    <div class="my-2">
                                        <span class="text-danger my-2">{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">รหัสผ่าน</label>
                                    <input type="password" class="form-control" id="password" name="password" minlength="6" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" minlength="6" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right">
                    <a class='btn btn-secondary' onclick='history.back();'><i class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                    <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                </div>
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
        imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    showimg.src = URL.createObjectURL(file)
                }
        }

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
