@extends('adminlte::page')
@php $pagename = 'แก้ไขตำแหน่ง'; @endphp
@push('css')
<style type="text/css">
    body {
        font-family: kanit !important;
    }
</style>
@endpush
@section('content')
<div class="contrainer p-4">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการตำแหน่ง</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('position.update',['position' => $position->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        แก้ไขตำแหน่ง
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อตำแหน่ง</label>
                            <input type="text" class="form-control" id="position" name="position" value="{{ $position->name }}" required>
                            @error('position')
                            <div class="my-2">
                                <span class="text-danger my-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="float-right">
                    <a class='btn btn-secondary' onclick='history.back();'><i class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                    <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                </div>
            </div>
        </div>
    </form>

@section('plugins.Sweetalert2', true)
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"])
@endsection
