@extends('adminlte::page')
@section('title', setting('title') . ' | รายงานผล')
@section('content')
    <div class="contrainer pt-4 pl-1 pr-1">
        <div class="row">
            <div class="col-sm-12 pb-2">
                <h3>รายงานผล</h3>
            </div>

            <div class="col-sm-12">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-right pb-2">
                                    <button class='btn btn-secondary' value="btndaily" onclick="getData(this)">รายวัน</button>
                                    <button class='btn btn-secondary' value="btnmonthly" onclick="getData(this)">รายเดือน</button>
                                    <button class='btn btn-secondary' value="btnyearly" onclick="getData(this)">รายปี</button>
                                    <button class='btn btn-secondary' value="btnall" onclick="getData(this)">ดูทั้งหมด</button>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3 id='stocks'>{{ count($stocks) }}</h3>
                                        <p>สต๊อกรถยนต์</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-archive" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="{{ route('car.index') }}"
                                        class="small-box-footer">รายการรถยนต์ <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id='customers'>{{ count($customers) }}</h3>
                                        <p>ลูกค้าติดต่อเข้ามา</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-users" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="{{ route('customer.index') }}"
                                        class="small-box-footer">รายการลูกค้าติดต่อเข้ามา <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id='traffics'>{{ count($traffic) }}</h3>
                                        <p>ลูกค้า Traffic</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-users-between-lines" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">รายการลูกค้า Traffic <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">

                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 id='quotations'>{{ count($quotations) }}</h3>
                                        <p>ออกใบเสนอราคา</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-file" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="{{ route('traffic.index') }}" class="small-box-footer">รายการใบเสนอราคา<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">

                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 id='reserved'>{{ count($reserved) }}</h3>
                                        <p>ลูกค้าที่จองรถยนต์</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-book" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="{{ route('reserved.index') }}" class="small-box-footer">รายการจองรถยนต์ <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">

                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 id='received'>{{ count($received) }}</h3>
                                        <p>ลูกค้าที่รับรถยนต์</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-car-side" style="color: black; opacity: 0.5;"></i>
                                    </div>
                                    <a href="#" class="small-box-footer link-light">รายการรับรถยนต์ <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    @push('js')
        <script>
            function getData(ele){
                let btn = ele.value;
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/getData') }}/" + btn,
                    success: function (response) {
                        $('#customers').text(response.customers);
                        $('#traffics').text(response.traffic);
                        $('#quotations').text(response.quotations);
                        $('#reserved').text(response.reserved);
                        $('#received').text(response.received);
                    }
                });
            }
        </script>
    @endpush
@endsection
