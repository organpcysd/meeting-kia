@extends('adminlte::page')
@section('title', setting('title'). ' | รายการใบเสนอราคา')
@php $pagename = 'ลูกค้าจองรถยนต์'; @endphp
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
                    <a href="{{ route('reserved.create') }}" class="btn btn-success"><i class="fa fa-plus-circle px-2"></i>เพิ่มข้อมูล</a>
                    <div class="mt-4">
                        <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                            <thead>
                            <tr>
                                <td>##</td>
                                <td>หมายเลขการจอง</td>
                                <td>ชื่อลูกค้า</td>
                                <td>ชื่อเล่น</td>
                                <td>รุ่นรถยนต์</td>
                                <td>จำนวนเงิน</td>
                                <td>พนักงานขาย</td>
                                <td>การจัดการ</td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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
                    ajax: "{{route('reserved.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'serial_number'},
                        {data: 'customer_name'},
                        {data: 'nickname'},
                        {data: 'car'},
                        {data: 'payable'},
                        {data: 'user_name'},
                        {data: 'btn'},
                    ],
                });
            });

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
                            url: "{{url('admin/reserved')}}/" + id,
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
