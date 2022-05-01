@extends('adminlte::page')
@section('title', setting('title'). ' | ตั้งค่าเว็บไซต์')
@php $pagename = 'จัดการเว็บไซต์'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        ตั้งค่าเว็บไซต์
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อเว็บไซต์</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{setting('title')}}" required>
                        </div>

                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{setting('phone')}}">
                        </div>

                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{setting('facebook')}}">
                        </div>

                        <div class="form-group">
                            <label>Line</label>
                            <input type="text" class="form-control" id="line" name="line" value="{{setting('line')}}">
                        </div>

                        <div class="form-group">
                            <label>แผนที่</label>
                            <textarea type="text" class="form-control" id="googlemap" name="googlemap" value="{{setting('googlemap')}}"></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        ตั้งค่ารูปภาพ
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Favicon</label>
                            <div class="row row-cols-2 align-items-center">
                                <div class="col-4 text-center">
                                    <img src="@if(setting('favicon')) {{ asset(setting('favicon')) }} @else {{ asset('image/no-image.jpg') }} @endif" height="100px" width="100px" id="showimg1">
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input name="favicon" type="file" class="custom-file-input" id="imgInp1">
                                        <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo Login</label>
                            <div class="row row-cols-2 align-items-center">
                                <div class="col-4 text-center">
                                    <img src="@if(setting('logologin')) {{ asset(setting('logologin')) }} @else {{ asset('image/no-image.jpg') }} @endif" height="100px" width="100px" id="showimg2"> {{-- {{asset('image/no-image.jpg')}} --}}
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input name="logologin" type="file" class="custom-file-input" id="imgInp2">
                                        <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo Navbar</label>
                            <div class="row row-cols-2 align-items-center">
                                <div class="col-4 text-center">
                                    <img src="@if(setting('logonav')) {{ asset(setting('logonav')) }} @else {{ asset('image/no-image.jpg') }} @endif" height="100px" width="100px" id="showimg3">
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input name="logonav" type="file" class="custom-file-input" id="imgInp3">
                                        <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                    </div>
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
    </form>
</div>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        imgInp1.onchange = evt => {
            const [file] = imgInp1.files
            if (file) {
                showimg1.src = URL.createObjectURL(file)
            }
        }

        imgInp2.onchange = evt => {
            const [file] = imgInp2.files
            if (file) {
                showimg2.src = URL.createObjectURL(file)
            }
        }

        imgInp3.onchange = evt => {
            const [file] = imgInp3.files
            if (file) {
                showimg3.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
@endsection
