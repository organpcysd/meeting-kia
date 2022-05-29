@extends('adminlte::page')
@section('title', setting('title'). ' | ติดตามลูกค้า')
@php $pagename = 'ติดตามลูกค้า'; @endphp
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
            <h3>{{ $pagename }} : {{ $customer->f_name }} {{ $customer->l_name }} ( <a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a> ) </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-info text-center">
                <div class="card-header">
                    บันทึกการติดตาม
                </div>
                <div class="card-body">
                    <button class="btn @if($customer->status === 'traffic') btn-primary @else btn-outline-primary @endif" data-id="traffic" type="button" id="changestatus">Traffic</button>
                    <button class="btn @if($customer->status === 'quotation') btn-primary @else btn-outline-primary @endif" data-id="quotation" type="button" id="changestatus">Quotation</button>
                    <button class="btn @if($customer->status === 'booked') btn-primary @else btn-outline-primary @endif" data-id="booked" type="button" id="changestatus">Booked</button>
                    <button class="btn @if($customer->status === 'success') btn-primary @else btn-outline-primary @endif" data-id="success" type="button" id="changestatus">Success</button>
                    <button class="btn @if($customer->status === 'canceled') btn-primary @else btn-outline-primary @endif" data-id="canceled" type="button" id="changestatus">Canceled</button>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a href="{{ route('customer.create') }}" class="btn btn-success"><i class="fa fa-plus-circle px-2"></i>เพิ่มการติดตาม</a> --}}
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addcustomerfollow">
                        <i class="fa fa-plus-circle px-2"></i> เพิ่มการติดตาม
                    </button>
                    <div class="mt-4">
                        <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td>##</td>
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
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <form action="{{ route('follow.store') }}" method="post">
        @csrf
        <div class="modal fade" id="addcustomerfollow" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มการติดตาม</h5>
                </div>
                <div class="modal-body">

                        <input type="hidden" id = "customer_id" name = "customer_id" value="{{ $customer->id }}">
                        <div class="form-group">
                        <label for="message-text" class="col-form-label">ผลการติดตาม:</label>
                        <textarea class="form-control" id="follow_up" name="follow_up"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">ผลการตอบสนองจากลูกค้า:</label>
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

                        <input type="hidden" id = "customer_follow_id_edit" name = "customer_follow_id" value="">
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
                        <input type="submit" onclick="updatecustomerfollow()" class="btn btn-success savebtn" value="บันทึก">
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
                    ajax: "{{route('follow.getData',['customer' => $customer->id])}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'follow_up'},
                        {data: 'follow_up_customer'},
                        {data: 'recomment_ceo'},
                        {data: 'follow_date'},
                        {data: 'btn'},
                    ],
                });
            });

            $(document).on('click','#changestatus',function(){
                id = $('#customer_id').val();
                cus_status = $(this).attr('data-id');

                Swal.fire({
                    icon: 'question',
                    title: 'ยืนยันการเปลี่ยนสถานะ',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                    showLoaderOnConfirm: true,
                    preConfirm: (status) => {
                        return new Promise((resolve) => {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('follow.changestatus') }}",
                                data: { _token:CSRF_TOKEN,id:id,cus_status:cus_status },
                                dataType: "json",
                                success: function (results) {
                                    if (results.status === true) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: results.message,
                                            timer: 1500,
                                        });
                                        location.reload();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: results.message,
                                        })
                                    }
                                }
                            });
                        })
                    }
                })

            })

            function modaledit(id){
                console.log(id)
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/customer/follow') }}/" + id,
                    success: function (response) {
                        $("#customer_follow_id_edit").val(response.id);
                        $("#follow_up_edit").val(response.follow_up);
                        $("#follow_up_customer_edit").val(response.follow_up_customer);
                        $("#recomment_ceo_edit").val(response.recomment_ceo);
                        $("#follow_date_edit").val(response.follow_date);

                        $('#edit').modal('show');
                    }
                });
            }

            function updatecustomerfollow(){
                id = $('#customer_follow_id_edit').val();
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

                console.log(data)

                $.ajax({
                    type: "PUT",
                    url: "{{url('admin/customer/follow')}}/" + id,
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
                                url: "{{url('admin/customer/follow')}}/" + id,
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
