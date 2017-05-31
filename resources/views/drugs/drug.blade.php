@extends('layouts.master')


@section('page_header')
    {{$drug->name}}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('drugs')}}">Drugs</a></li>
        <li class="active" href="#">{{$drug->name}}</li>
    </ol>
@endsection


@section('content')


    <div class="box box-primary">
        <!--    Box Header  -->
        <div class="box-header with-border">
            {{--Check whether the user has permissions to access these tasks--}}
            @can('edit',$drug)
                <button class="btn btn-primary margin-left" data-toggle="modal" data-target="#editDrugModal">
                    <i class="fa fa-edit fa-lg"></i> 编辑信息
                </button>
            @endcan

            @can('add','App\Stock')
                <button class="btn btn-primary margin-left" data-toggle="modal" data-target="#addStockModal">
                    <i class="fa fa-plus fa-lg"></i> 添加库存
                </button>
            @endcan


        </div>
        <!--    Box Body  -->
        <div class="box-body">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> 成功!</h4>
                    {{session('success')}}
                </div>
            @endif

            <div class="container-fluid">
                <div class="row margin">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-4">药品名称</label>
                            <div class="col-md-8">{{$drug->name}}</div>
                        </div>
                        <div class="row">
                            <label class="col-md-4">成分</label>
                            <div class="col-md-8">{{$drug->ingredient? : "N/A"}}</div>
                        </div>
                        <div class="row">
                            <label class="col-md-4">厂商</label>
                            <div class="col-md-8">{{$drug->manufacturer}}</div>
                        </div>
                        <div class="row">
                            <label class="col-md-4">数量</label>
                            <div class="col-md-8">{{Utils::getFormattedNumber($drug->quantity)}} {{$drug->quantityType->drug_type}}</div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-4">创建者</label>
                            <div class="col-md-8">{{$drug->creator->name}}</div>
                        </div>
                        <div class="row">
                            <label class="col-md-4">创建时间</label>
                            <div class="col-md-8">{{Utils::getTimestamp($drug->created_at)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Recent Stocks --}}
    <div class="box box-success box-solid">
        <!--    Box Header  -->
        <div class="box-header with-border">
            <h4 class="box-title">历史库存</h4>
        </div>

        <div class="box-body">
            <table class="table table-responsive table-hover table-bordered text-center" id="recentStocksTable">
                <thead>
                <tr>
                    <th>数量</th>
                    <th>有效期</th>
                    <th>购买日期</th>
                    <th>生产日期</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drug->getStocks(10) as $stock)
                    <tr>
                        <td>{{Utils::getFormattedNumber($stock->quantity)}}</td>
                        <td>{{Utils::getFormattedDate($stock->expiry_date)}}</td>
                        <td>{{Utils::getFormattedDate($stock->received_date)}}</td>
                        <td>{{Utils::getFormattedDate($stock->manufactured_date)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('drugs.modals.editDrug')
    @include('drugs.stocks.modals.addStock')

@endsection
