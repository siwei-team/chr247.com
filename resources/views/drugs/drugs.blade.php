@extends('layouts.master')


@section('page_header')
    药品库
@endsection


@section('content')
    <div ng-app="HIS" ng-controller="DrugController">
        {{-- Initialize the angular variables in a hidden field --}}
        <input type="hidden"
               ng-init="baseUrl='{{url("/")}}';token='{{csrf_token()}}';">

        <div class="box box-primary">
            <!--    Box Header  -->
            <div class="box-header with-border">

                @can('add','App\Drug')
                    <button class="btn btn-primary margin"
                            data-toggle="modal" data-target="#addDrugModal">
                        添加药品
                        <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                           data-placement="bottom" title=""
                           data-original-title="Add a new drug to the inventory. Added drugs will be available to
                           be prescribed as soon as you add them"></i>
                    </button>
                @endcan

                <a class="btn btn-primary margin pull-right" href="{{route('drugTypes')}}">
                    数量类型
                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="The measurements used to measure the available quantity(stock) of a drug.
                               ex: Number of 'Pills', number of 'Bottles', 'Litres'"></i>
                </a>

                <a class="btn btn-primary margin pull-right" href="{{route('dosages')}}">
                    剂量类型
                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="A pool of dosages which is to be used when prescribing medicine to patients."></i>
                </a>

            </div>


            <!--    Box Body  -->
            <div class="box-body container-fluid table-responsive">

                {{--Success Message--}}
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> 成功!</h4>
                        {{session('success')}}
                    </div>
                @endif

                {{--Error Message--}}
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> 错误!</h4>
                        {{session('error')}}
                    </div>
                @endif

                <style>
                    .tableRow {
                        cursor: pointer;
                    }

                    .tableRow:hover {
                        text-decoration: underline !important;
                    }
                </style>

                <table class="table table-condensed table-hover text-center" id="drugsTable">
                    <thead>
                    <tr>
                        <th>药品名称</th>
                        <th>成分</th>
                        <th>数量类型</th>
                        <th>厂商</th>
                        <th>数量</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($drugs as $drug)
                        <tr class="tableRow">
                            <td onclick="window.location='{{route("drug",['id'=>$drug->id])}}'">
                                {{$drug->name}}
                            </td>
                            <td onclick="window.location='{{route("drug",['id'=>$drug->id])}}'">
                                {{$drug->ingredient? : "N/A"}}
                            </td>
                            <td onclick="window.location='{{route("drug",['id'=>$drug->id])}}'">
                                {{$drug->quantityType->drug_type}}
                            </td>
                            <td onclick="window.location='{{route("drug",['id'=>$drug->id])}}'">
                                {{$drug->manufacturer}}
                            </td>
                            <td onclick="window.location='{{route("drug",['id'=>$drug->id])}}'">
                                {{Utils::getFormattedNumber($drug->quantity)}}
                            </td>
                            <td>
                                @can('delete',$drug)
                                    {{--
                                    A modal is used to confirm the delete action.
                                    One the modal popup, the url in the form changes according to the drug's id
                                    --}}
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#confirmDeleteDrugModal"
                                            onclick="showConfirmDelete({{$drug->id}},'{{$drug->name}}')">
                                        <i class="fa fa-recycle fa-lg"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        @include('drugs.modals.addDrug')

        @include('drugs.modals.confirmDelete')

        <script>
            /**
             * Method to show delete drug modal.
             * Updates the modal title and the form's action
             * @param drugId
             */
            function showConfirmDelete(drugId, name) {
                $('#confirmDeleteDrugModal .modal-title').html(name);
                $('#confirmDeleteDrugModal form').prop("action", "{{url('drugs/deleteDrug')}}/" + drugId);
            }
        </script>


        {{--Data Tables Scripts--}}
        <script>
            $(document).ready(function () {
                var tableFixed = $('#drugsTable').dataTable({
                    'pageLength': 10
                });
            });
        </script>
        {{--//Data Tables--}}
    </div>

    {{--AngularJs Scripts--}}
    <script src="{{asset('plugins/angularjs/angular.min.js')}}"></script>
    <script src="{{asset('js/services.js')}}"></script>
    <script src="{{asset('js/DrugController.js')}}"></script>
@endsection
