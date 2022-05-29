@extends('adminlte::page')
@section('title', setting('title'). ' | แก้ไขข้อมูลรถยนต์')
@php $pagename = 'แก้ไขข้อมูลรถยนต์'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการรถยนต์</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('car.update',['car' => $car->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        แก้ไขข้อมูลรถยนต์
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>โมเดล</label>
                            <select class="form-control" id="model" name="model">
                                <option> เลือกโมเดล </option>
                                @foreach($models as $item)
                                    <option @if(in_array($item->model_name,[$carmodel])) selected @endif value="{{$item->id}}">{{$item->model_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>รุ่น</label>
                            <select class="form-control" id="level" name="level">
                                <option> เลือกรุ่น </option>
                            </select>
                            <input type="hidden" value="{{ $carlevel }}" id="levelid">
                        </div>

                        <div class="form-group">
                            <label>ประเภท</label>
                            <select class="form-control" id="type" name="type">
                                <option> เลือกประเภท </option>
                                @foreach($types as $item)
                                    <option @if(in_array($item->type_name,[$cartype])) selected @endif value="{{$item->id}}">{{$item->type_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>สี</label>
                            <select class="form-control" id="color" name="color">
                                <option> เลือกสี </option>
                                @foreach($colors as $item)
                                    <option @if(in_array($item->color_name,[$carcolor])) selected @endif value="{{$item->id}}">{{$item->color_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>เกียร์</label>
                            <input type="text" class="form-control" id="gear" name="gear" value="{{ $car->gear }}">
                        </div>

                        <div class="form-group">
                            <label>เครื่องยนต์</label>
                            <input type="text" class="form-control" id="engine" name="engine" value="{{ $car->engine }}">
                        </div>

                        <div class="form-group">
                            <label>ราคา</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $car->price }}">
                        </div>

                        <div class="form-group">
                            <label>ปี</label>
                            <input type="hidden" value="{{ $car->years }}" id = "y">
                            <select class="form-control" id="years" name="years"></select>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>อื่นๆ</label>
                            <textarea type="text" class="form-control" id="other" name="other" value="{{ $car->other }}"></textarea>
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
        $(document).ready(function() {
            let CSRF = $('meta[name="csrf-token"]').attr('content'); //must have
            $('.car_colors').select2();

            let id = $('#model').val();
               $.ajax({
                   type: "post",
                   url: "{{ route('car.getmodel') }}",
                   data: { _token:CSRF,id:id },
                   dataType: "json",
                   success: function (response) {
                        let option = '';
                        option = ''; // first option
                        let levelid = parseInt(document.getElementById('levelid').value);
                        console.log(levelid);

                        response.forEach(level => {
                            let selected = (level.id === levelid ? ' selected' : '');
                            option += '<option value="' + level.id + '"' + selected + '>' + level.level_name + '</option>';
                        });

                        document.getElementById("level").innerHTML = option;
                   }
               });

            $('#model').on('change',function(){
                let id = $('#model').val();
               $.ajax({
                   type: "post",
                   url: "{{ route('car.getmodel') }}",
                   data: { _token:CSRF,id:id },
                   dataType: "json",
                   success: function (response) {
                        let option = '';
                        option = ''; // first option

                        response.forEach(level => {
                            option += '<option value="' + level.id + '">' + level.level_name + '</option>';
                        });

                        document.getElementById("level").innerHTML = option;
                   }
               });
            })
        });

        (function () {
            let year_start = (new Date).getFullYear()-10;
            let year_end = (new Date).getFullYear()+5; // current year
            let year_selected = parseInt(document.getElementById('y').value);

            console.log(year_selected);

            let option = '';
            option = ''; // first option

            for (let i = year_start; i <= year_end; i++) {
                let selected = (i === year_selected ? ' selected' : '');
                option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
            }

            document.getElementById("years").innerHTML = option;
        })();

    </script>
@endpush
@endsection
