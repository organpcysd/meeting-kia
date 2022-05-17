@extends('adminlte::page')
@php $pagename = 'เพิ่มลูกค้าที่ติดต่อเข้ามา'; @endphp
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

    <form action="{{ route('traffic.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-7">
                <div class="card card-info">
                    <div class="card-header">
                        รายละเอียด
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
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

                        <hr/>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ผู้มีอำนาจในการตัดสินใจซื้อ</label>
                            <div class="col-sm-8">
                                <select class="sel2 form-control" name="dicision" id="dicision">
                                    <option value="" selected disabled>- ค้นหาผู้มีอำนาจในการตัดสินใจซื้อ -</option>
                                    <option value="ตัวลูกค้าเอง">ตัวลูกค้าเอง</option>
                                    <option value="พ่อ">พ่อ</option>
                                    <option value="แม่">แม่</option>
                                    <option value="พ่อ-แม่">พ่อ-แม่</option>
                                    <option value="สามี">สามี</option>
                                    <option value="ภรรยา">ภรรยา</option>
                                    <option value="ครอบครัว">ครอบครัว</option>
                                    <option value="other">อื่นๆ</option>
                                </select>
                                <div id="dicision_detail" class="mt-2">
                                    <small class="text-cyan">หากไม่มีตัวเลือกที่ต้องการกรุณาเลือก "อื่นๆ" เพื่อกรอกข้อมูล</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">แหล่งข้อมูลลูกค้า</label>
                            <div class="col-sm-8">
                                <select class="sel2 form-control" name="traffic_source" id="traffic_source">
                                    <option value="" selected disabled>- ค้นหาแหล่งข้อมูลลูกค้า -</option>
                                        @foreach($sources as $item)
                                            <option value="{{$item->id}}">{{$item->source_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">สถานที่</label>
                            <div class="col-sm-8">
                                <select class="sel2 form-control" name="location" id="locations">
                                    <option value="" selected disabled>- ค้นหาแหล่งข้อมูลลูกค้า -</option>
                                    <option value="โชว์รูม">โชว์รูม</option>
                                    <option value="เดอะมอลล์โคราช">บูธเดอะมอลล์โคราช</option>
                                    <option value="เซ็นทรัลโคราช">เซ็นทรัลโคราช</option>
                                    <option value="other">อื่นๆ</option>
                                </select>
                                <div id="location_detail" class="mt-2">
                                    <small class="text-cyan">หากไม่มีตัวเลือกที่ต้องการกรุณาเลือก "อื่นๆ" เพื่อกรอกข้อมูล</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ผลการติดต่อ</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="contact_result" name="contact_result"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ช่องทางการรับรู้</label>
                            <div class="col-sm-8">
                                <select class="sel2 form-control" name="traffic_channel" id="traffic_channel">
                                    <option value="" selected disabled>- ค้นหาช่องทางการรับรู้ -</option>
                                    @foreach($channels as $item)
                                        <option value="{{$item->id}}">{{$item->channel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">แนวโน้ม</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="dicision" id="dicision">
                                    <option value="" selected disabled>- เลือกแนวโน้ม -</option>
                                    <option value="high">สูง</option>
                                    <option value="medium">ปานกลาง</option>
                                    <option value="low">ต่ำ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="card card-info">
                    <div class="card-header">
                        รถยนต์
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-sm-4 col-form-label">รุ่นรถยนต์</label>
                            <div class="col-lg-10 col-sm-8">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach($carmodels as $item)
                                        <label class="btn btn-outline-info p-1 mt-1"> <input type="checkbox" name="carmodel[]" id="carmodel" value="{{ $item->id }}" onclick="Carmodel()"> {{ $item->model_name }} </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="divlevel">
                            <label class="col-lg-2 col-sm-4 col-form-label">รุ่นย่อย</label>
                            <div class="col-lg-10 col-sm-8">
                                <div class="btn-group-toggle" data-toggle="buttons" id="carlevels">
                                    {{-- @foreach($carlevels as $item)
                                        <label class="btn btn-outline-info p-1"> <input type="checkbox" name="carlevel[]" id="carlevel" value="{{ $item->id }}"> {{ $item->level_name }} </label>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="divcolor">
                            <label class="col-lg-2 col-sm-4 col-form-label">สีรถยนต์</label>
                            <div class="col-lg-10 col-sm-8">
                                <div class="btn-group-toggle" data-toggle="buttons" id="carcolors">
                                    {{-- @foreach($carcolors as $item)
                                        <label class="btn btn-outline-info p-1"> <input type="checkbox" name="carcolor[]" id="carcolor" value="{{ $item->id }}"> {{ $item->color_name }} </label>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-info">
                    <div class="card-header">
                        Test Drive
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ชื่อผู้เบิกรถยนต์</label>
                            <div class="col-sm-9">
                                <select class="sel2 form-control" name="staff_pick" id="staff_pick">
                                    <option value="" selected disabled>- ค้นหาชื่อผู้เบิกรถยนต์ -</option>
                                    @foreach($users as $item)
                                        <option value="{{$item->id}}">{{$item->f_name . ' ' . $item->l_name . ' (' . $item->phone . ' )'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <div class="col-sm-2">
                                <label class="col-form-label">รูปภาพ</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row row-cols-2 align-items-center">
                                    <div class="col-sm-4 text-center">
                                        <img src="{{ asset('image/no-image.jpg') }}" height="100px" width="100px" id="showimg">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input name="favicon" type="file" class="custom-file-input" id="imgInp">
                                            <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('.sel2').select2();

            let ele_level = document.getElementById("divlevel");
                ele_level.style.display = "none";

            let ele_color = document.getElementById("divcolor");
                ele_color.style.display = "none";
            // option = '<label class="btn btn-outline-info p-1"> <input type="checkbox" name="carmodel[]" id="carmodel"> adwdw </label>'
            // $('#carmodels').html(option);
            // console.log(option);

        });

        $('#dicision').on('change',function(){
            dicision = $('#dicision').val();
            if(dicision === "other"){
                dicision_input = "<input type='text' class='form-control' name='dicision_input' placeholder='ตัวอย่าง: อาม่า'>"
                $('#dicision_detail').html(dicision_input);
            }else{
                dicision_input = "<small class='text-cyan'>หากไม่มีตัวเลือกที่ต้องการกรุณาเลือก "+'อื่นๆ'+" เพื่อกรอกข้อมูล</small>"
                $('#dicision_detail').html(dicision_input);
            }
        });

        $('#locations').on('change',function(){
            locations = $('#locations').val();
            if(locations === "other"){
                location_input = "<input type='text' class='form-control' name='location_input' placeholder='ตัวอย่าง: มือถือส่วนตัว'>"
                $('#location_detail').html(location_input);
            }else{
                location_input = "<small class='text-cyan'>หากไม่มีตัวเลือกที่ต้องการกรุณาเลือก "+'อื่นๆ'+" เพื่อกรอกข้อมูล</small>"
                $('#location_detail').html(location_input);
            }
        });

        function Carmodel(){
            var model_array = [];
            $("input:checkbox[id=carmodel]:checked").each(function() {
                model_array.push($(this).val());
            });
            console.log(model_array);
            if (model_array.length != 0) {
                $.ajax({
                type: "POST",
                url: "{{ route('traffic.getcarlevel') }}",
                data: { _token:CSRF_TOKEN,model_id:model_array},
                dataType: "json",
                success: function (response) {
                    // console.log(response)
                    let levels = '';
                    response.forEach(carlevels => {
                        levels += '<label class="btn btn-outline-info p-1 mt-1"> <input type="checkbox" onclick="Carlevel()" name="carlevel[]" id="carlevel" data-id="'+ carlevels.id +'" value="'+ carlevels.id +'">' + carlevels.level_name + '</label> ';
                    });
                    // console.log(levels);
                    let ele = document.getElementById("divlevel");
                    ele.style.display = "";
                    $('#carlevels').html(levels);
                    Carlevel();
                }
            });

            }else{
                let ele = document.getElementById("divlevel");
                ele.style.display = "none";

                let levels = '';
                $('#carlevels').html(levels);
                Carlevel();
            }

            // var checkboxes = document.getElementsByName('carmodel[]');
            // var result = "";

            // for (var i = 0; i < checkboxes.length; i++) {
            //     if (checkboxes[i].checked) {
            //         result += checkboxes[i].value + ",";
            //         model_id = result.slice(0,-1);
            //         console.log(model_id);
            //     }
            // }

        }

        function Carlevel(){
            var level_array = [];
            $("input:checkbox[id=carlevel]:checked").each(function() {
                level_array.push($(this).val());
            });
            console.log(level_array);
            if (level_array.length != 0) {
                $.ajax({
                type: "POST",
                url: "{{ route('traffic.getcarcolor') }}",
                data: { _token:CSRF_TOKEN,level_id:level_array},
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    let colors = '';
                    response.forEach(carcolors => {
                        // console.log(carcolors);
                        if(carcolors.color_code === null) {
                            colorname = carcolors.color_name;
                        }else{
                            colorname = carcolors.color_name + ' ' + carcolors.color_code;
                        }
                        colors += '<label class="btn btn-outline-info p-1 mt-1"> <input type="checkbox" name="carcolor[]" id="carcolor" data-id="'+ carcolors.id +'" value="'+ carcolors.id +'">' + colorname + '</label> ';
                    });
                    // console.log(levels);
                    let ele_color = document.getElementById("divcolor");
                    ele_color.style.display = "";
                    $('#carcolors').html(colors);
                }
                });
            }else{
                let ele_color = document.getElementById("divcolor");
                    ele_color.style.display = "none";

                let colors = '';
                $('#carcolors').html(colors);
            }

        }

    </script>
@endpush
@endsection
