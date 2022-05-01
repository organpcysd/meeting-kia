@extends('adminlte::page')
@php $pagename = 'แก้ไขบทบาท'; @endphp
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
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการบทบาท</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form action="{{ route('role.update',['role' => $role->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        บทบาท
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>ชื่อบทบาท</label>
                            <input type="text" class="form-control" id="role" name="role" value="{{ $role->name }}"required>
                            @error('role')
                            <div class="my-2">
                                <span class="text-danger my-2">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        สิทธิ์การเข้าถึง
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>สิทธิ์การเข้าถึง</label>
                            <select class="permission form-control" name="permission[]" id="permission" multiple>
                                @foreach($permissions as $item)
                                    <option @if(in_array($item->name,$role->getPermissionNames()->toArray())) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
@section('plugins.Select2', true)
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"])
@push('js')
    <script>
        $(document).ready(function(){
            $('.permission').select2();
        });
    </script>
@endpush
@endsection
