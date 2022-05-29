@extends('adminlte::page')
@section('title', setting('title'). ' | รายงานผล')
@section('content')
<div class="contrainer p-4">
    <h3>รายงานผล</h3>
    <div class="row">
        <div class="col-sm-2">
            <div class="card text-white bg-info mb-3" style="width: 25rem; height: 10rem;">
                <div class="card-body">
                <h1>0</h1>
                <p class="card-text">ลูกค้าที่ติดต่อเข้ามา</p>
                </div>
                <div class="card-footer">เทส</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <canvas id="myChart" style="width: 1%"></canvas>
        </div>
    </div>
</div>

@section('plugins.Chartjs', true)
@push('js')
<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Red', 'Blue', 'Yellow'],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 10
        }]
    },
});
</script>

@endpush
@endsection
