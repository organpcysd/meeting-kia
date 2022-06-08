@extends('adminlte::page')
@section('title', setting('title'). ' | รายงานผล')
@section('content')
<div class="contrainer pt-4 pl-1 pr-1">
    <div class="row">
        <div class="col-sm-12 pb-2">
            <h3>รายงานผล</h3>
        </div>
        <div class="col-sm-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs pull-right" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-cyan active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">ภาพรวม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-cyan" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false">รายวัน</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body text-center">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="row">

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('car.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #BE8C63;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-archive fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($stocks) }}</h1>
                                                            <h5 class="pt-2">สต๊อกรถยนต์</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('customer.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($customers) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าติดต่อเข้ามา</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('traffic.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users-between-lines fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($traffic) }}</h1>
                                                            <h5 class="pt-2">ลูกค้า Traffic</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('quotation.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #EB5353;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-file fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($quotations) }}</h1>
                                                            <h5 class="pt-2">ออกใบเสนอราคา</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('reserved.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #FFD24C;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-book fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($reserved) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าที่จองรถยนต์</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('received.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #34BE82;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-car-side fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($received) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าที่รับรถยนต์</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card card-info card-outline">
                                        <div class="card-header text-left"><b>Traffic</b></div>
                                        <div class="card-body">
                                            <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                <canvas id="myChart" width="400" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card card-info card-outline">
                                        <div class="card-header text-left"><b>กราฟเปรียบเทียบแต่ละเดือน</b></div>
                                        <div class="card-body">
                                            <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                .
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Tab 2 --}}
                        <div class="tab-pane fade" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('customer.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($daily_customers) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าติดต่อเข้ามา</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('traffic.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users-between-lines fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($daily_traffic) }}</h1>
                                                            <h5 class="pt-2">ลูกค้า Traffic</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('quotation.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #EB5353;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-file fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($daily_quotations) }}</h1>
                                                            <h5 class="pt-2">ออกใบเสนอราคา</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('reserved.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #FFD24C;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-book fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($daily_reserved) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าที่จองรถยนต์</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('received.index') }}" class="text-white">
                                        <div class="card" style="height: 150px">
                                            <div class="card-body" style="background-color: #34BE82;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:55px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-car-side fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1 class="pt-2">{{ count($daily_received) }}</h1>
                                                            <h5 class="pt-2">ลูกค้าที่รับรถยนต์</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('plugins.Chartjs', true)
@push('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var source = "";
        $(document).ready( function () {

            $.ajax({
                type: "get",
                url: "{{ url('admin/getData') }}",
                success: function (response) {
                    traffic_chart(response.traffic_source);
                }
            });
        });

        function traffic_chart(source){
            // console.log(source)
            // source.forEach(source =>{
            //     console.log(source.id);
            // });

            // for (x in source){
            //     console.log(source[x])
            // }
            const ctx = document.getElementById('myChart');
            const months = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                           {
                            label: 'walk in',
                            data: [12, 10, 10],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.8)',
                            ],
                            },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            max: 20,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        }
    </script>
@endpush
@endsection
