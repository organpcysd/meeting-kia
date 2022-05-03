@extends('adminlte::page')
@section('title', setting('title'). ' | จัดการตำแหน่ง')
@php $pagename = 'จัดการตำแหน่ง'; @endphp
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
                    <a href="{{ route('position.create') }}" class="btn btn-success"><i class="fa fa-plus-circle px-2"></i>เพิ่มข้อมูล</a>
                    <div class="mt-4">
                        <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                            <thead>
                            <tr>
                                <td>##</td>
                                <td>ตำแหน่ง</td>
                                <td>การมองเห็น</td>
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
                    ajax: "{{route('position.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'name'},
                        {data: 'publish'},
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
                    animation: false,
                    preConfirm: (e) => {
                        return new Promise(function (resolve) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                type: 'DELETE',
                                url: "{{url('admin/position')}}/" + id,
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

            function publish(ele){
                var data = ele.value;
                var frmdata = {
                    'data': ele.value
                };

                if(data == 1){
                    ele.value = 0;
                }else{
                    ele.value = 1;
                }

                $.ajax({
                    type: 'get',
                    url: '{{url('admin/position/publish')}}/'+ele.id,
                    data: frmdata,
                    success: function (response){
                        if (response.status === true) {
                            Swal.fire({
                                position: 'top-right',
                                icon: 'success',
                                title: response.message,
                                toast: true,
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        } else {
                            Swal.fire({
                                position: 'top-right',
                                icon: 'error',
                                title: response.message,
                                toast: true,
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        }
                    }
                })
            }
        </script>
@endpush
@endsection
