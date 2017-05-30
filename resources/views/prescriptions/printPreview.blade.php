<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>cmp247.com | 处方卡</title>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" media="print">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<style>
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<body>
{{--The ID to be printed--}}
<div class="container-fluid">
    @if($prescription->prescriptionDrugs()->count()>0 || $prescription->prescriptionPharmacyDrugs()->count()>0)
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="row container-fluid">

                <h3 class="center-block text-center">
                    {{$patient->clinic->name}}<br>

                </h3>
                <small style="text-align: right">
                    {{$patient->clinic->address}}<br>
                    {{$patient->clinic->phone}}<br>
                    {{$patient->clinic->email}}
                </small>
                <h4 style="border-bottom: 2px solid black">
                    <strong>患者 :</strong> {{$patient->first_name}} {{$patient->last_name}}
                    <small>{{$patient->dob ? Utils::getAge($patient->dob) : ""}}</small>
                    <span class="pull-right">{{Utils::getFormattedDate($prescription->created_at)}}</span>
                </h4>

                <div class="row" style="border-bottom: 2px solid black">
                    <div class="col-xs-1">
                        <span style="font-size: 40px">&#8478;</span>
                    </div>
                    <div class="col-xs-11">
                        <ol class="col-xs-12">
                            @foreach($prescription->prescriptionDrugs as $drug)
                                <li>
                                    <strong>{{$drug->drug->name}}</strong>
                                    ({{$drug->dosage ? $drug->dosage->description:""}}
                                    {{$drug->frequency ? ", ".$drug->frequency->description:""}}
                                    {{$drug->period ? ", ".$drug->period->description:""}})
                                </li>
                            @endforeach
                        </ol>

                        @if($prescription->prescriptionPharmacyDrugs()->count()>0)
                            <h4>以下从药店选配药品</h4>
                            <ol class="col-xs-12">
                                @foreach($prescription->prescriptionPharmacyDrugs as $index=>$pharmacyDrug)
                                    <li>
                                        <strong>{{$pharmacyDrug->drug}}</strong>
                                        {{$pharmacyDrug->remarks ? "(Remarks : ".$pharmacyDrug->remarks.")" : ""}}
                                    </li>
                                @endforeach
                            </ol>
                        @endif

                    </div>
                </div>

                <h5 class="col-xs-6 col-xs-offset-6"
                    style="margin-top: 100px;border-top: 3px dotted black;padding-top: 5px">
                </h5>
            </div>
        </div>
    @else
        {{-- Info message if there are no prescriptions to be issued --}}
        <div class="col-xs-6 col-xs-offset-3">
            <div class="alert alert-info" ng-if="prescriptions.length==0" ng-cloak>
                <h4><i class="icon fa fa-info"></i> 抱歉!</h4>
                There's no drugs in this prescription to be printed.
            </div>
        </div>
    @endif
</div>

<div class="row margin-top container-fluid no-print">
    <div class="col-xs-6 col-xs-offset-3" style="display: none">
        <div class="alert alert-info" ng-if="prescriptions.length==0" ng-cloak>
            <h4><i class="icon fa fa-info"></i> 重要!</h4>
            印刷处方时,避免打印页眉和页脚打印预览更改打印设置。
        </div>
    </div>

    <div class="col-md-2 col-md-offset-3">
        <button class="btn btn-primary pull-left" onclick="window.close()">
            <i class="fa fa-close" aria-hidden="true"></i> 关闭
        </button>
    </div>
    {{--@if($prescription->prescriptionPharmacyDrugs()->count()>0)--}}
    <div class="col-md-2 col-md-offset-2">
        <button class="btn btn-primary pull-right" onclick="window.print()">
            <i class="fa fa-print" aria-hidden="true"></i> 打印
        </button>
    </div>
    {{--@endif--}}
</div>

</body>
</html>