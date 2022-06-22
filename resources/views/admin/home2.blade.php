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
                                    <a href="{{ route('car.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #BE8C63;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-archive fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($stocks) }}</h1>
                                                            <h6>สต๊อกรถยนต์</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('customer.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($customers) }}</h1>
                                                            <h6>ลูกค้าติดต่อเข้ามา</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('traffic.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users-between-lines fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($traffic) }}</h1>
                                                            <h6>ลูกค้า Traffic</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('quotation.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #EB5353;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-file fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($quotations) }}</h1>
                                                            <h6>ออกใบเสนอราคา</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('reserved.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #FFD24C;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-book fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($reserved) }}</h1>
                                                            <h6>ลูกค้าที่จองรถยนต์</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('received.index') }}" class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #34BE82;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-car-side fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($received) }}</h1>
                                                            <h6>ลูกค้าที่รับรถยนต์</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                <div class="col-lg-6 col-md-12 col-sm-12">

                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card card-info card-outline">
                                        <div class="card-header text-left"><b>Traffic รายเดือน</b></div>
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
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="{{ route('customer.index') }}" class="text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($daily_customers) }}</h1>
                                                            <h6>ลูกค้าติดต่อเข้ามา</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="{{ route('traffic.index') }}" class="text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #40DFEF;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-users-between-lines fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($daily_traffic) }}</h1>
                                                            <h6>ลูกค้า Traffic</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="{{ route('quotation.index') }}" class="text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #EB5353;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-file fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($daily_quotations) }}</h1>
                                                            <h6>ออกใบเสนอราคา</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="{{ route('reserved.index') }}" class="text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #FFD24C;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-book fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($daily_reserved) }}</h1>
                                                            <h6>ลูกค้าที่จองรถยนต์</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <a href="{{ route('received.index') }}" class="text-white">
                                        <div class="card" style="height: 125px; width: 300px;">
                                            <div class="card-body" style="background-color: #34BE82;">
                                                <div class="row rows-col-lg-2 rows-col-md-2 rows-col-sm-1">
                                                    <div class="col text-left">
                                                        <h1 class="fa-stack fa-2xt" style="font-size:45px; opacity: 0.5;">
                                                            <i class="fa-solid fa-circle fa-stack-2x"></i>
                                                            <i class="fa-solid fa-car-side fa-stack-1x fa-inverse" style="color: black;"></i>
                                                        </h1>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-right">
                                                            <h1>{{ count($daily_received) }}</h1>
                                                            <h6>ลูกค้าที่รับรถยนต์</h6>
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
                    console.log(response);
                    traffic_chart(response.traffic_source);
                    response.traffic_source.forEach(source => {
                        console.log(source.source_name);
                    });

                }
            });
        });

        function traffic_chart(source){
            // source.forEach(source =>{
            //     console.log(source.id);
            // });

            var datasets=[];

            for (x in source){
                datasets.push({
                    label: source[x].source_name,
                    data: [10,20,30],
                });
            }

            const months = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];

            var barChartData = {
                "labels": months,
                "datasets": datasets
            }

            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
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

            // console.log(myChart.data);

            // for (x in source){
                // myChart.data.labels.push(source[x].source_name);

                // console.log(myChart.data.datasets.length);

                // myChart.data.datasets.forEach(dataset => {
                //     console.log('test');
                //     dataset.data.push([10,20,30]);
                // });
                // myChart.data.push([10,20,30]);

            //     myChart.data.datasets.push({
            //         label: source[x].source_name,
            //         data: [12,15,20],
            //         backgroundColor: [
            //             'rgba(255, 99, 132, 0.8)',
            //         ],
            //     })
            // }
        //     myChart.update();
        }
    </script>
@endpush
@endsection
