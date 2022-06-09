@extends('adminlte::page')
@php $pagename = 'บันทึกการติดตาม'; @endphp
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">ติดตามหลังการขาย</a></li>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('receivedfollow.multidel') }}" id="form_multidel">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 p-2">
                                <button type="button" class="btn btn-success float-left" data-toggle="modal" data-target="#addcustomerfollow">
                                    <i class="fa fa-plus-circle px-2"></i> เพิ่มการติดตาม
                                </button>
                                <a class="btn btn-danger float-right" onclick='form_multidel()'><i class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                            </div>
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <td>##</td>
                                        <td><input type="checkbox" id="selectall"/></td>
                                        <td>ผลการติดตาม</td>
                                        <td>การตอบสนองต่อลูกค้า</td>
                                        <td>คำแนะนำจาก ผจก.</td>
                                        <td>วันที่ติดตาม</td>
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
    <form action="{{ route('receivedfollow.store') }}" method="post">
        @csrf
        <div class="modal fade" id="addcustomerfollow" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มการติดตาม</h5>
                </div>
                <div class="modal-body">

                        <input type="hidden" id = "received_id" name = "received_id" value="{{ $receivedfollow->id }}">
                        <div class="form-group">
                        <label for="message-text" class="col-form-label">ผลการติดตาม:</label>
                        <textarea class="form-control" id="follow_up" name="follow_up"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">การตอบสนองจากลูกค้า:</label>
                            <textarea class="form-control" id="follow_up_customer" name="follow_up_customer"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">คำแนะนำจาก ผจก:</label>
                            <textarea class="form-control" id="recomment_ceo" name="recomment_ceo"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">วันที่ติดตาม</label>
                            <input type="date" class="form-control" id="follow_date" name="follow_date">
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

                        <input type="hidden" id = "receivedfollow_id_edit" name = "receivedfollow_id_edit" value="">
                        <div class="form-group">
                        <label for="message-text" class="col-form-label">ผลการติดตาม:</label>
                        <textarea class="form-control" id="follow_up_edit" name="follow_up"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">ผลการตอบสนองจากลูกค้า:</label>
                            <textarea class="form-control" id="follow_up_customer_edit" name="follow_up_customer"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">คำแนะนำจาก ผจก:</label>
                            <textarea class="form-control" id="recomment_ceo_edit" name="recomment_ceo"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">วันที่ติดตาม</label>
                            <input type="date" class="form-control" id="follow_date_edit" name="follow_date">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <input type="submit" onclick="updatereceivedfollow()" class="btn btn-success savebtn" value="บันทึก">
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
                    ajax: "{{route('receivedfollow.show',['receivedfollow' => $receivedfollow->id])}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'select', orderable: false},
                        {data: 'follow_up'},
                        {data: 'follow_up_customer'},
                        {data: 'recomment_ceo'},
                        {data: 'follow_date'},
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
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/receivedfollow/getreceivedfollow') }}/" + id,
                    success: function (response) {

                        $("#receivedfollow_id_edit").val(response.receivedfollow.id);
                        $("#follow_up_edit").val(response.receivedfollow.follow_up);
                        $("#follow_up_customer_edit").val(response.receivedfollow.follow_up_customer);
                        $("#recomment_ceo_edit").val(response.receivedfollow.recomment_ceo);
                        $("#follow_date_edit").val(response.receivedfollow.follow_date);

                        $('#edit').modal('show');
                    }
                });
            }

            function updatereceivedfollow(){
                id = $('#receivedfollow_id_edit').val();
                follow_up = $('#follow_up_edit').val();
                follow_up_customer = $('#follow_up_customer_edit').val();
                recomment_ceo = $('#recomment_ceo_edit').val();
                follow_date = $('#follow_date_edit').val();
                console.log(recomment_ceo)

                var data = {
                    _token : CSRF_TOKEN,
                    follow_up_edit : follow_up,
                    follow_up_customer_edit : follow_up_customer,
                    recomment_eco_edit : recomment_ceo,
                    follow_date_edit : follow_date,
                }

                // console.log(data)

                $.ajax({
                    type: "PUT",
                    url: "{{url('admin/receivedfollow')}}/" + id,
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
                                url: "{{url('admin/receivedfollow')}}/" + id,
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
