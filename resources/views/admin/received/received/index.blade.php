@extends('adminlte::page')
@section('title', setting('title'). ' | รายการส่งมอบรถยนต์')
@php $pagename = 'รายการส่งมอบรถยนต์'; @endphp
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
                    <form method="post" action="{{ route('received.multidel') }}" id="form_multidel">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 p-2">
                                <a href="{{ route('received.create') }}" class="btn btn-success float-left"><i class="fa fa-plus-circle px-2"></i>เพิ่มข้อมูล</a>
                                <a class="btn btn-danger float-right" onclick='form_multidel()'><i class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                            </div>
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <td>##</td>
                                        <td><input type="checkbox" id="selectall"/></td>
                                        <td>หมายเลขการส่งมอบรถยนต์</td>
                                        <td>ชื่อลูกค้า</td>
                                        <td>ชื่อเล่น</td>
                                        <td>รุ่นรถยนต์</td>
                                        <td>พนักงานขาย</td>
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

    @include('admin.received.received.partials.modalshow')
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
                    ajax: "{{route('received.index')}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'select', orderable: false},
                        {data: 'serial_number'},
                        {data: 'customer_name'},
                        {data: 'nickname'},
                        {data: 'car'},
                        {data: 'user_name'},
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

            function modalshow(id) {
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/received') }}/" + id,
                    success: function(response) {

                        $('#cus_name').text(response.received.customer.f_name + ' ' + response.received.customer.l_name);
                        $('#nickname').text(response.received.customer.nickname == null ? "-" : response.received.customer.nickname);
                        $('#email').text(response.received.customer.email == null ? "-" : response.received.customer.email );
                        $('#phone').text(response.received.customer.phone == null ? "-" : response.received.customer.phone);
                        $('#lineid').text(response.received.customer.lineid == null ? "-" : response.received.customer.lineid);

                        $('#user_name').text(response.received.user.f_name + ' ' + response.received.user.l_name);
                        $('#user_phone').text(response.received.user.phone == null ? "-" : response.received.user.phone);

                        $('#car').text(response.received.car.car_model.model_name + ' ' + response.received.car.car_level.level_name + ' ' + response.received.car.car_color.color_name + (response.received.car.car_color.color_code == null ? ' ' : ' (' + response.received.car.car_color.color_code + ') '));
                        $('#condition').text(response.received.received_detail.condition == 'credit' ? "ผ่อน" : "เงินสด");
                        $('#car_price').text((new Intl.NumberFormat().format(response.received.received_detail.price_car)));
                        $('#payment_discount').text((new Intl.NumberFormat().format(response.received.received_detail.payment_discount)));
                        $('#deposit_roll').text((new Intl.NumberFormat().format(response.received.received_detail.deposit_roll)));
                        $('#payment_decorate').text((new Intl.NumberFormat().format(response.received.received_detail.payment_decorate)));
                        $('#payment_insurance').text((new Intl.NumberFormat().format(response.received.received_detail.payment_insurance)));
                        $('#payment_other').text((new Intl.NumberFormat().format(response.received.received_detail.payment_other)));
                        $('#payment_car_turn').text((new Intl.NumberFormat().format(response.received.received_detail.payment_car_turn)));
                        $('#subtotal').text((new Intl.NumberFormat().format(response.received.received_detail.subtotal)));
                        $('#accessories').text(response.received.received_detail.accessories);

                        $('#received_date').text(response.received.received_date);
                        $('#payable').text((new Intl.NumberFormat().format(response.received.received_detail.payable)));

                        if(response.received.received_detail.condition == 'credit'){
                            let ele = document.getElementById("car_credit");
                            ele.style.display = "";

                            $('#price_car_net').text((new Intl.NumberFormat().format(response.received.received_detail.price_car_net)));
                            $('#payment_down').text((new Intl.NumberFormat().format(response.received.received_detail.payment_down)));
                            $('#payment_down_discount').text((new Intl.NumberFormat().format(response.received.received_detail.payment_down_discount)));
                            $('#term_credit').text (response.received.received_detail.term_credit);
                            $('#interest').text (response.received.received_detail.interest + '%');
                            $('#hire_purchase').text ((new Intl.NumberFormat().format(response.received.received_detail.hire_purchase)));
                            $('#term_payment').text ((new Intl.NumberFormat().format(response.received.received_detail.term_payment)));

                        }else {
                            let ele = document.getElementById("car_credit");
                            ele.style.display = "none";
                        }
                        $('#showdata').modal('show');
                    }
                });
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
                            url: "{{url('admin/received')}}/" + id,
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
