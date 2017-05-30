<div class="container-fluid margin" ng-controller="RecordController">

    {{-- Initialize the angular variables in a hidden field --}}
    <input type="hidden"
           ng-init="baseUrl='{{url("/")}}';id={{$patient->id}};token='{{csrf_token()}}';loadMedicalRecords()">

    <div class="alert alert-success" ng-show="hasSuccess" ng-cloak>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        [[successMessage]]
    </div>

    <div class="row margin">
        <label class="control-label col-md-4 col-md-offset-4 text-left">搜索 (通过 诊断,日期等...)</label>
        <div class="col-md-4">
            <input type="text" ng-model="searchText" class="form-control">
        </div>
    </div>

    {{-- Info message if there are no prescriptions to be issued --}}
    <div class="alert alert-info" ng-if="prescriptions.length==0" ng-cloak>
        <h4><i class="icon fa fa-info"></i> 抱歉!</h4>
        有这个病人的医疗记录显示。
    </div>

    {{--Prescription--}}
    <div class="box box-primary box-solid"
         ng-repeat="prescription in prescriptions | filter:searchText">
        <div class="box-header">
            <h4 class="box-title">
                [[prescription.created_at | dateToISO | date:"EEEE, d/M/yy h:mm a"]]
            </h4>
        </div>

        <div class="box-body">

            <div class="alert alert-danger alert-dismissable" ng-show="prescription.hasError" ng-cloak>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                [[error]]
            </div>

            <div class="row">
                <label class="col-md-4">症状</label>
                <div class="col-md-8">[[prescription.complaints]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">调查</label>
                <div class="col-md-8">[[prescription.investigations]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">诊断结果</label>
                <div class="col-md-8">[[prescription.diagnosis]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">备注</label>
                <div class="col-md-8">[[prescription.remarks]]</div>
            </div>

            <br>

            <table class="table table-hover table-condensed table-bordered table-striped text-center">
                <thead>
                <tr class="success">
                    <th class="col-sm-4">药品</th>
                    <th class="col-sm-5">剂量</th>
                    <th class="col-sm-3">数量</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="prescribedDrug in prescription.prescription_drugs" class="success">
                    <td>[[prescribedDrug.drug.name]] ([[prescribedDrug.drug.quantity_type.drug_type]])</td>
                    <td>
                        [[prescribedDrug.dosage.description]]<br>
                        [[prescribedDrug.frequency.description]]<br>
                        [[prescribedDrug.period.description]]
                    </td>
                    <td>
                        [[prescribedDrug.quantity | exactNumber]]
                    </td>
                </tr>
                </tbody>
            </table>

            {{--table to show pharmacy drugs--}}
            <h4 ng-if="prescription.prescription_pharmacy_drugs.length>0">药店药品</h4>
            <table class="table table-condensed table-bordered table-hover text-center"
                   ng-if="prescription.prescription_pharmacy_drugs.length>0">
                <thead>
                <tr class="success">
                    <th>药品名称</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="drug in prescription.prescription_pharmacy_drugs track by $index" class="success"
                    ng-cloak>
                    <td>[[drug.drug]]</td>
                    <td>
                        [[drug.remarks]]
                    </td>
                </tr>
                </tbody>
            </table>

            <br>

            <div class="row">
                <label class="col-md-4">金额</label>
                <div class="col-md-8">[[prescription.payment.amount]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">支付备注</label>
                <div class="col-md-8">[[prescription.payment.remarks]]</div>
            </div>

        </div>
    </div>


</div>