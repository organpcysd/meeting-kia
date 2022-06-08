@extends('adminlte::page')
@section('title', setting('title'). ' | จัดการบทบาท')
@php $pagename = 'จัดการบทบาท'; @endphp
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
            <form action="{{ route('role.store') }}" method="post">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        บทบาท
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อบทบาท</label>
                            <input type="text" class="form-control" id="role" name="role" required>
                            @error('role')
                            <div class="my-2">
                                <span class="text-danger my-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>สิทธิ์การเข้าถึง</label>
                            <select class="sel2 form-control" name="permission[]" id="permission" multiple>
                                @foreach($permissions as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                                <thead>
                                <tr>
                                    <td>##</td>
                                    <td>บทบาท</td>
                                    <td>สิทธิ์การเข้าถึง</td>
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

    {{-- Model Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขบทบาท</h5>
                </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>ชื่อบทบาท</label>
                            <input type="hidden" id="role_id" value="">
                            <input type="text" class="form-control" id="role_edit" name="role_edit" required>
                        </div>

                        <div class="form-group row">
                            <label class="col col-form-label">สิทธิ์การเข้าถึง</label>
                            <div class="col-sm-12">
                                <select class="sel2 form-control" id="permission_edit" multiple>
                                    @foreach($permissions as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <input type="submit" onclick="updaterole()" class="btn btn-success savebtn" value="บันทึก">
                    </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
<script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var table;
            $(document).ready( function () {
                $('.sel2').select2();

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
                    ajax: "{{route('role.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'name'},
                        {data: 'permission'},
                        {data: 'btn'},
                    ],
                });
            });

            function modaledit(id) {

            $.ajax({
                type: "get",
                url: "{{ url('admin/role')}}/" + id,
                success: function (response) {
                    console.log(response);
                    $('#role_id').val(response.role.id);
                    $('#role_edit').val(response.role.name);

                    let permission_option;

                    response.permissions.map((permissions,key) =>{
                        let organ = 0;
                        for(let i=0;i<response.perm.length;i++){
                            if(permissions.name === response.perm[i]){
                                organ = 1;
                                permission_option += '<option value="' + permissions.id + '" selected>' + permissions.name + '</option>';
                            }
                        }
                            if(organ != 1){
                                permission_option += '<option value="' + permissions.id + '">' + permissions.name + '</option>';
                            }
                    });

                    $('#permission_edit').html(permission_option);
                    $('#edit').modal('show');
                }
            });
            }

            function updaterole(){
                id = $("#role_id").val();
                role_edit = $("#role_edit").val();
                permission_edit = $("#permission_edit").val();

                var data = {
                    _token : CSRF_TOKEN,
                    role_edit : role_edit,
                    perm_edit : permission_edit,
                }

                $.ajax({
                    type: "PUT",
                    url: "{{ url('admin/role')}}/" + id,
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
                    animation: false,
                    preConfirm: (e) => {
                        return new Promise(function (resolve) {
                            $.ajax({
                                type: 'DELETE',
                                url: "{{url('admin/role')}}/" + id,
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
