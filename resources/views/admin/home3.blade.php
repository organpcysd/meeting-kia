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
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary">ทั้งหมด</button>
                            <button class="btn btn-primary">รายวัน</button>
                            <button class="btn btn-primary">รายเดือน</button>
                            <button class="btn btn-primary">รายปี</button>
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
