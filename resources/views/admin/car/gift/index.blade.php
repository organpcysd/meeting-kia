@extends('adminlte::page')
@section('title', setting('title'). ' | รายการของแถม')
@php $pagename = 'รายการของแถม'; @endphp
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
        <div class="col-lg-4 col-md-5 col-sm-4">
            <form action="{{ route('cargift.store') }}" method="post">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        รายการของแถม
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อของแถม</label>
                            <input type="text" class="form-control" id="cargift" name="cargift" required>
                            @error('cargift')
                            <div class="my-2">
                                <span class="text-danger my-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="float-right">
                            <button type="reset" class='btn btn-danger'><i class="fas fa-trash mr-2"></i>ล้างข้อมูล</button>
                            <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('cargift.multidel') }}" id="form_multidel">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 p-2">
                                <a class="btn btn-danger float-right" onclick='form_multidel()'><i class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                            </div>
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <td>##</td>
                                        <td><input type="checkbox" id="selectall"/></td>
                                        <td>ชื่อของแถม</td>
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

    {{-- Model Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายการของแถม</h5>
                </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>ชื่อของแถม</label>
                            <input type="hidden" id="cargift_id" value="">
                            <input type="text" class="form-control" id="cargift_edit" name="cargift_edit" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <input type="submit" onclick="updatecargift()" class="btn btn-success savebtn" value="บันทึก">
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
                    ajax: "{{route('cargift.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'select', orderable: false},
                        {data: 'gift_name'},
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

            function modaledit(id) {
                console.log(id);

                $.ajax({
                    type: "get",
                    url: '{{ url('admin/cargift')}}/' + id,
                    success: function (response) {
                        console.log(response);
                        $('#cargift_id').val(response.id);
                        $('#cargift_edit').val(response.gift_name);

                        $('#edit').modal('show');
                    }
                });
            }

            function updatecargift(){
                id = document.getElementById('cargift_id').value;
                cargift = document.getElementById('cargift_edit').value;

                // console.log(CSRF_TOKEN);
                var data = {
                    _token : CSRF_TOKEN,
                    cargift_edit : cargift,
                }

                console.log(data)

                $.ajax({
                    type: "PUT",
                    url: '{{ url('admin/cargift')}}/' + id,
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
                                url: "{{url('admin/cargift')}}/" + id,
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
