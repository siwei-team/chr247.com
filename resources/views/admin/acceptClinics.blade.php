@extends('layouts.app')


@section('title',"Admin | HIS")

@section('content')
    <div class="container-fluid table-responsive">
        <div class="container-fluid">
            <a href="{{route('adminLogout')}}" class="btn btn-primary">退出登录</a>
        </div>

        <br>
        <h4>待审核诊所</h4>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> 成功!</h4>
                {{session('success')}}
            </div>
        @endif

        {{--Success Message--}}
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                </button>
                <h4><i class="icon fa fa-ban"></i> 错误!</h4>
                {{session('error')}}
            </div>
        @endif

        <table class="table table-hover table-condensed table-bordered text-center">
            <tr>
                <th class="col-md-2">名称</th>
                <th class="col-md-1">邮箱</th>
                <th class="col-md-2">地址</th>
                <th class="col-md-1">手机</th>
                <th class="col-md-1">国家</th>
                <th class="col-md-1">货币</th>
                <th class="col-md-1">时区</th>
                <th class="col-md-1">申请时间 (UTC)</th>
                <th class="col-md-2"></th>
            </tr>

            <tbody>
            @foreach($clinics as $clinic)
                <tr>
                    <td>{{$clinic->name}}</td>
                    <td>{{$clinic->email}}</td>
                    <td>{{$clinic->address}}</td>
                    <td>{{$clinic->phone}}</td>
                    <td>{{$clinic->country}}</td>
                    <td>{{$clinic->currency}}</td>
                    <td>{{$clinic->timezone}}</td>
                    <td>{{$clinic->created_at}}</td>
                    <td>
                        <a href="{{route('acceptClinic',['id'=>$clinic->id])}}" class="btn btn-sm btn-success">
                            通过
                        </a>
                        <a href="{{route('deleteClinic',['id'=>$clinic->id])}}" class="btn btn-sm btn-danger">
                            删除
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="container-fluid table-responsive">
        <h4>已通过审核的诊所</h4>

        <table class="table table-hover table-condensed table-bordered text-center">
            <tr>
                <th class="col-md-2">名称</th>
                <th class="col-md-1">邮箱</th>
                <th class="col-md-2">地址</th>
                <th class="col-md-1">手机</th>
                <th class="col-md-1">国家</th>
                <th class="col-md-1">货币</th>
                <th class="col-md-1">时区</th>
                <th class="col-md-1">申请时间 (UTC)</th>
                <th class="col-md-2">患者数量</th>
            </tr>

            <tbody>
            @foreach($acceptedClinics as $clinic)
                <tr>
                    <td>{{$clinic->name}}</td>
                    <td>{{$clinic->email}}</td>
                    <td>{{$clinic->address}}</td>
                    <td>{{$clinic->phone}}</td>
                    <td>{{$clinic->country}}</td>
                    <td>{{$clinic->currency}}</td>
                    <td>{{$clinic->timezone}}</td>
                    <td>{{$clinic->created_at}}</td>
                    <td>{{$clinic->patients()->count()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
