@extends('adminlte::page')
@php $pagename = 'สต๊อครถยนต์'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการรถ</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-4">
            <div class="card card-info text-center">
                <div class="card-header">
                    ข้อมูลรถยนต์
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">ชื่อรุ่น</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="carmodel" name="carmodel">{{ $car->car_model->model_name }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">ชื่อรุ่นย่อย</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="carlevel" name="carlevel">{{ $car->car_level->level_name }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">สี</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="carcolor" name="carcolor">{{ $car->car_color->color_name . ' ' .  $car->car_color->color_code}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">เกียร์</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="gear" name="gear">{{ $car->gear }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">เครื่องยนต์</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="engine" name="engine">{{ $car->engine }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">ปี</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="year" name="year">{{ $car->years }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message-text" class="col-sm-4 col-form-label">ราคา</label>
                        <div class="col-sm-8">
                            <label class="form-control" id="price" name="price">{{ $car->price }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('stock.multidel') }}" id="form_multidel">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 p-2">
                                <button type="button" class="btn btn-success float-left" data-toggle="modal" data-target="#addcarstock">
                                    <i class="fa fa-plus-circle px-2"></i> เพิ่มรถยนต์
                                </button>
                                <a class="btn btn-danger float-right" onclick='form_multidel()'><i class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                            </div>
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <td>##</td>
                                        <td><input type="checkbox" id="selectall"/></td>
                                        <td>หมายเลข chassis รถยนต์</td>
                                        <td>หมายเลขเครื่อง</td>
                                        <td>สถานะ</td>
                                        <td>การจัดการ</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <form action="{{ route('stock.store') }}" method="post">
        @csrf
        <div class="modal fade" id="addcarstock" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มรถยนต์</h5>
                </div>
                <div class="modal-body">

                        <input type="hidden" id = "car_id" name = "car_id" value="{{ $car->id }}">
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">หมายเลข chassis รถยนต์</label>
                            <input type="text" class="col-sm-8 form-control" id="number_chassis" name="number_chassis">
                        </div>

                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">หมายเลขเครื่อง</label>
                            <input type="text" class="col-sm-8 form-control" id="number_engine" name="number_engine">
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-left mr-2"></i>ยกเลิก</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save mr-2"></i>บันทึก</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </form>

    {{-- Model Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขการติดตาม</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" id = "car_stock_id_edit" name = "car_stock_id_edit">
                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">หมายเลข chassis รถยนต์</label>
                            <input type="text" class="col-sm-8 form-control" id="number_chassis_edit" name="number_chassis_edit">
                        </div>

                        <div class="form-group row">
                            <label for="message-text" class="col-sm-4 col-form-label">หมายเลขเครื่อง</label>
                            <input type="text" class="col-sm-8 form-control" id="number_engine_edit" name="number_engine_edit">
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-info" onclick="updatecarstock()"><i class="fas fa-save mr-2"></i>บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var table;
            $(document).ready( function () {
                table = $('#table').DataTable({
                    responsive: true,
                    processing: true,
                    scrollX: true,
                    scrollCollapse: true,
                    language: {
                        'loadingRecords': '&nbsp;',
                        'processing': '<div class="spinner-border text-primary" role="status"><span class="sr-only">กำลังโหลด...</span></div>'
                    },
                    serverSide: true,
                    ajax: "{{ route('stock.getData',['car' => $car->id]) }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'select', orderable: false},
                        {data: 'number_chassis'},
                        {data: 'number_engine'},
                        {data: 'status'},
                        {data: 'btn'},
                    ],
                });

                //selectall
                $('#selectall').on('click',function(){
                    if (this.checked) {
                        $('.select').each(function(){
                            this.checked = true;
                        })
                    }else{
                        $('.select').each(function(){
                            this.checked = false;
                        })
                    }
                });
            });

            function form_multidel() {
                let sel = $('input.select:checkbox:checked').length;

                // console.log(sel);
                if(sel === 0) {
                    Swal.fire({
                        title: 'โปรดเลือกข้อมูลก่อนกดลบ',
                        icon: 'error',
                        confirmButtonColor: '#17a2b8',
                        confirmButtonText: 'ตกลง',
                    })
                }else{
                    Swal.fire({
                        title: 'ยืนยัน',
                        text: "ยืนยันการลบข้อมูล?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#17a2b8',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $('#form_multidel').submit();
                        }
                    })
                }
            }

            function modaledit(id){
                // console.log(id)
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/car/stock') }}/" + id,
                    success: function (response) {
                        $("#car_stock_id_edit").val(response.id);
                        $("#number_chassis_edit").val(response.number_chassis);
                        $("#number_engine_edit").val(response.number_engine);

                        $('#edit').modal('show');
                    }
                });
            }

            function updatecarstock(){
                id = $('#car_stock_id_edit').val();
                number_chassis = $('#number_chassis_edit').val();
                number_engine = $('#number_engine_edit').val();

                var data = {
                    _token : CSRF_TOKEN,
                    number_chassis_edit : number_chassis,
                    number_engine_edit : number_engine,
                }

                $.ajax({
                    type: "PUT",
                    url: "{{url('admin/car/stock')}}/" + id,
                    data: data,
                    success: function (results) {
                        if (results.status === true) {
                            Swal.fire({
                                icon: 'success',
                                title: results.message,
                                timer: 1500,
                            })
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: results.message,
                            });
                        }
                    }
                });

                $('#edit').modal('hide');

            }
            function deleteConfirmation(id) {
                Swal.fire({
                    icon: 'info',
                    title: 'ท่านต้องการลบข้อมูลใช่หรือไม่',
                    text: 'หากลบข้อมูลแล้วจะไม่สามารถกู้คืนกลับมาได้',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                    showLoaderOnConfirm: true,
                    preConfirm: (e) => {
                        return new Promise(function (resolve) {
                            $.ajax({
                                type: 'DELETE',
                                url: "{{url('admin/car/stock')}}/" + id,
                                data: {_token: CSRF_TOKEN},
                                dataType: 'JSON',
                                success: function (results) {
                                    if (results.status === true) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: results.message,
                                        })
                                        table.ajax.reload();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: results.message,
                                        })
                                    }

                                }
                            });
                        })
                    },
                })
            }

    </script>
@endpush
@endsection
