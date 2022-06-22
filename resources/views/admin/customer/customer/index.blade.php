@extends('adminlte::page')
@section('title', setting('title') . ' | ลูกค้าติดต่อเข้ามา')
@php $pagename = 'รายชื่อลูกค้า'; @endphp
@section('content')
    <div class="contrainer p-4">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                                aria-hidden="true"></i> หน้าแรก</a></li>
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
                        <form method="post" action="{{ route('customer.multidel') }}" id="form_multidel">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 p-2">
                                    <a href="{{ route('customer.create') }}" class="btn btn-success"><i
                                            class="fa fa-plus-circle px-2"></i>เพิ่มข้อมูล</a>
                                    <a class="btn btn-danger float-right" onclick='form_multidel()'><i
                                            class="fa fa-trash px-2"></i>ลบที่เลือก</a>
                                </div>
                                <div class="col-sm-12">
                                    <table id="table"
                                        class="table table-striped dataTable no-footer dtr-inline text-center nowrap table-hover"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <td>##</td>
                                                <td><input type="checkbox" id="selectall" /></td>
                                                <td>ชื่อ</td>
                                                <td>ชื่อเล่น</td>
                                                <td>เบอร์โทร</td>
                                                <td>สถานะ</td>
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

        <!-- Modal -->
        <div class="modal fade" id="showdata" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">ข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ชื่อ</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="fullname"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ชื่อเล่น</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="nickname"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>วันเกิด</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="birthdate"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ตำแหน่ง</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="vocation"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>อีเมลล์</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="email"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>เบอร์โทร</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="phone"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>LineID</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="lineid"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <hr/>
                                <h6>ที่อยู่</h6>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>หมู่บ้าน</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="village"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>บ้านเลขที่</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="house_number"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>หมู่</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="group"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ซอย</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="alley"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ถนน</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="road"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>ตำบล</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="canton"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>อำเภอ</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="district"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>จังหวัด</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="province"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>รหัสไปรษณีย์</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="zipcode"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        var table;
        $(document).ready(function() {
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
                ajax: "{{ route('customer.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'select',
                        orderable: false
                    },
                    {   data: 'name' },
                    {   data: 'nickname'},
                    {   data: 'phone'},
                    {   data: 'status'},
                    {   data: 'staff_name'},
                    {   data: 'btn'},
                ],
            });

            //selectall
            $('#selectall').on('click', function() {
                if (this.checked) {
                    $('.select').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.select').each(function() {
                        this.checked = false;
                    })
                }
            });
        });

        function modalshow(id) {
            $.ajax({
                type: "get",
                url: "{{ url('admin/customer') }}/" + id,
                success: function(response) {
                    console.log(response);
                    $('#fullname').text(response.customer.f_name + ' ' + response.customer.l_name);
                    $('#nickname').text(response.customer.nickname == null ? "-" : response.customer.nickname);
                    $('#birthdate').text(response.customer.born == null ? "-" : response.customer.born);
                    $('#vocation').text(response.customer.vocation == null ? "-" : response.customer.vocation);
                    $('#email').text(response.customer.email == null ? "-" : response.customer.email);
                    $('#phone').text(response.customer.phone == null ? "-" : response.customer.phone);
                    $('#lineid').text(response.customer.lineid == null ? "-" : response.customer.lineid);

                    $('#village').text(response.customer.customer_address.village == null ? "-" : response.customer.customer_address.village);
                    $('#house_number').text(response.customer.customer_address.house_number == null ? "-" : response.customer.customer_address.house_number);
                    $('#group').text(response.customer.customer_address.group == null ? "-" : response.customer.customer_address.group);
                    $('#alley').text(response.customer.customer_address.alley == null ? "-" : response.customer.customer_address.alley);
                    $('#road').text(response.customer.customer_address.road == null ? "-" : response.customer.customer_address.road);
                    $('#canton').text(response.customer.customer_address.canton.name_th == null ? "-" : response.customer.customer_address.canton.name_th);
                    $('#district').text(response.customer.customer_address.districts.name_th == null ? "-" : response.customer.customer_address.districts.name_th);
                    $('#province').text(response.customer.customer_address.provinces.name_th == null ? "-" : response.customer.customer_address.provinces.name_th);
                    $('#zipcode').text(response.customer.customer_address.zipcode == null ? "-" : response.customer.customer_address.zipcode);

                    $('#showdata').modal('show');
                }
            });
        }

        function form_multidel() {
            let sel = $('input.select:checkbox:checked').length;

            // console.log(sel);
            if (sel === 0) {
                Swal.fire({
                    title: 'โปรดเลือกข้อมูลก่อนกดลบ',
                    icon: 'error',
                    confirmButtonColor: '#17a2b8',
                    confirmButtonText: 'ตกลง',
                })
            } else {
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
                    return new Promise(function(resolve) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('admin/customer') }}/" + id,
                            data: {
                                _token: CSRF_TOKEN
                            },
                            dataType: 'JSON',
                            success: function(results) {
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
