@extends('layouts.master')


@section('page_header')
    {{$patient->first_name}} {{$patient->last_name?:''}} (年龄 : {{Utils::getAge($patient->dob)}})
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{route('root')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li><a href="{{route('patients')}}">病人记录</a></li>
        <li class="active" href="#">{{$patient->first_name}}</li>
    </ol>
@endsection


@section('content')
    {{--AngularJs Scripts--}}
    <script src="{{asset('plugins/angularjs/angular.min.js')}}"></script>
    <script src="{{asset('js/services.js')}}"></script>
    <script src="{{asset('js/filters.js')}}"></script>
    <script src="{{asset('js/PrescriptionController.js')}}"></script>
    <script src="{{asset('js/IssueMedicineController.js')}}"></script>
    <script src="{{asset('js/RecordController.js')}}"></script>

    <div class="box box-primary">
        <!--    Box Header  -->
        <div class="box-header with-border">
            {{--Check whether the user has permissions to access these tasks--}}
            @can('edit',$patient)
                <button class="btn btn-primary margin-left" data-toggle="modal" data-target="#editPatientModal">
                    <i class="fa fa-edit fa-lg"></i> 编辑信息
                </button>
            @endcan

            @can('issueMedical',$patient)
                <button class="btn btn-primary margin-left" data-toggle="modal" data-target="#addPatientModal">
                    <i class="fa fa-stethoscope fa-lg"></i> 医疗问题
                </button>
            @endcan

            @can('issueID',$patient)
                <a class="btn btn-primary margin-left" href="{{route('IDPreview',['id'=>$patient->id])}}">
                    <i class="fa fa-tag fa-lg"></i> 病例卡
                </a>
            @endcan

            @can('addToQueue',$patient)
                <a class="btn btn-primary margin-left" href="{{route('addToQueue',['patientId'=>$patient->id])}}">
                    <i class="fa fa-plus fa-lg"></i> 添加到队列
                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="Add this patient to the queue. You should start a queue before
                       adding patients to the queue."></i>
                </a>
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

            {{--Error Message--}}
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 错误!</h4>
                    {{session('error')}}
                </div>
            @endif


            {{--    Nav tabs    --}}
            <div class="nav-tabs-custom" ng-app="HIS">
                <ul class="nav nav-tabs" role="tablist">

                    @can('view',$patient)
                        <li role="presentation" @if(Gate::denies('prescribeMedicine',$patient)) class="active" @endif>
                            <a href="#info" aria-controls="info" role="tab" data-toggle="tab">信息</a>
                        </li>
                    @endcan

                    @can('prescribeMedicine',$patient)
                        <li role="presentation" class="active">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">处方药物</a>
                        </li>
                    @endcan

                    @can('issueMedicine',$patient)
                        <li role="presentation">
                            <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">待处理问题</a>
                        </li>
                    @endcan

                    @can('viewMedicalRecords',$patient)
                        <li role="presentation">
                            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">就医记录</a>
                        </li>
                    @endcan

                </ul>

                <div class="tab-content">
                    @can('view',$patient)
                        <div role="tabpanel" id="info"
                             class="tab-pane fade @if(Gate::denies('prescribeMedicine',$patient)) in active @endif">
                            @include('patients.tabs.patientInfo')
                        </div>
                    @endcan

                    @can('prescribeMedicine',$patient)
                        <div role="tabpanel" class="tab-pane fade in active" id="profile">
                            @include('patients.tabs.prescribeMedicine')
                        </div>
                    @endcan

                    @can('issueMedicine',$patient)
                        <div role="tabpanel" class="tab-pane fade" id="messages">
                            @include('patients.tabs.issueMedicine')
                        </div>
                    @endcan

                    @can('viewMedicalRecords',$patient)
                        <div role="tabpanel" class="tab-pane fade" id="settings">
                            @include('patients.tabs.medicalRecords')
                        </div>
                    @endcan
                </div>
            </div>

        </div>
    </div>

    @can('edit',$patient)
        @include('patients.modals.editPatient')
    @endcan
@endsection
