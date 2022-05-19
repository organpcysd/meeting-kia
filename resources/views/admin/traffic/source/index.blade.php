@extends('adminlte::page')
@section('title', setting('title'). ' | จัดการแหล่งข้อมูลลูกค้า')
@php $pagename = 'จัดการแหล่งข้อมูลลูกค้า'; @endphp
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
            <form action="{{ route('source.store') }}" method="post">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        เพิ่มแหล่งข้อมูลลูกค้า
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อแหล่งข้อมูล</label>
                            <input type="text" class="form-control" id="source" name="source" required>
                            @error('source')
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
                    <div class="mt-4">
                        <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                            <thead>
                            <tr>
                                <td>##</td>
                                <td>ชื่อแหล่งข้อมูล</td>
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

    {{-- Model Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขแหล่งข้อมูลลูกค้า</h5>
                </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>ชื่อแหล่งข้อมูลลูกค้า</label>
                            <input type="hidden" id="source_id" value="">
                            <input type="text" class="form-control" id="source_edit" name="source_edit" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <input type="submit" onclick="updatesource()" class="btn btn-success savebtn" value="บันทึก">
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
                    ajax: "{{route('source.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'source_name'},
                        {data: 'btn'},
                    ],
                });
            });

            function modaledit(id) {
                console.log(id);

                $.ajax({
                    type: "get",
                    url: "{{ url('admin/traffic/source')}}/" + id,
                    success: function (response) {
                        console.log(response);
                        $('#source_id').val(response.id);
                        $('#source_edit').val(response.source_name);

                        $('#edit').modal('show');
                    }
                });
            }

            function updatesource(){
                id = document.getElementById('source_id').value;
                source = document.getElementById('source_edit').value;

                // console.log(CSRF_TOKEN);
                var data = {
                    _token : CSRF_TOKEN,
                    source_edit : source,
                }

                console.log(data)

                $.ajax({
                    type: "PUT",
                    url: "{{ url('admin/traffic/source')}}/" + id,
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
                                url: "{{url('admin/traffic/source')}}/" + id,
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
