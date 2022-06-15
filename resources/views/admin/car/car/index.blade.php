@extends('adminlte::page')
@section('title', setting('title'). ' | จัดการรถยนต์')
@php $pagename = 'รายชื่อรถยนต์ที่มีจำหน่าย'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
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
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('car.multidel') }}" id="form_multidel">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 p-2">
                                <a href="{{ route('car.create') }}" class="btn btn-success float-left"><i class="fa fa-plus-circle px-2"></i>เพิ่มข้อมูล</a>
                                <a class="btn btn-danger float-right" onclick='form_multidel()'><i class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                            </div>

                            <div class="col-sm-12">
                                <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <td>##</td>
                                        <td><input type="checkbox" id="selectall"/></td>
                                        <td>โมเดล</td>
                                        <td>รุ่น</td>
                                        <td>ประเภท</td>
                                        <td>สี</td>
                                        <td>ปี</td>
                                        <td>In stock</td>
                                        <td>ราคา</td>
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
</div>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
    <script>
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
                    ajax: "{{route('car.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'select', orderable: false},
                        {data: 'model'},
                        {data: 'level'},
                        {data: 'type'},
                        {data: 'color'},
                        {data: 'years'},
                        {data: 'stock'},
                        {data: 'price'},
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


            function deleteConfirmation(id) {
                Swal.fire({
                    icon: 'info',
                    title: 'ท่านต้องการลบข้อมูลใช่หรือไม่',
                    text: 'หากลบข้อมูลแล้วจะไม่สามารถกู้คืนกลับมาได้',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                    showLoaderOnConfirm: true,
                    animation: false,
                    preConfirm: (e) => {
                        return new Promise(function (resolve) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                type: 'DELETE',
                                url: "{{url('admin/car')}}/" + id,
                                data: {_token: CSRF_TOKEN},
                                dataType: 'JSON',
                                success: function (results) {
                                    if (results.status === true) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: results.message,
                                            animation: false,
                                        })
                                        table.ajax.reload();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: results.message,
                                            animation: false,
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
