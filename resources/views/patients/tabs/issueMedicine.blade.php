<div class="container-fluid margin" ng-controller="IssueMedicineController">

    {{-- Initialize the angular variables in a hidden field --}}
    <input type="hidden"
           ng-init="baseUrl='{{url("/")}}';id={{$patient->id}};token='{{csrf_token()}}';loadPrescriptions()">

    {{--Success Mesage--}}
    <div class="alert alert-success" ng-show="hasSuccess" ng-cloak>
        <h4><i class="icon fa fa-check"></i> 成功!</h4>
        [[successMessage]]
    </div>


    {{-- Info message if there are no prescriptions to be issued --}}
    <div class="alert alert-info" ng-if="prescriptions.length==0" ng-cloak>
        <h4><i class="icon fa fa-info"></i> 抱歉!</h4>
        没有这个病人的待处理处方。
    </div>

    {{--Prescription--}}
    <div class="box box-primary box-solid" ng-repeat="prescription in prescriptions track by $index">
        <div class="box-header">
            <h4 class="box-title">
                [[prescription.created_at | dateToISO | date:"EEEE, d/M/yy h:mm a"]]
            </h4>

            <button class="btn btn-sm btn-flat btn-danger pull-right" ng-click="deletePrescription([[$index]])">
                删除处方
            </button>

            <a href="{{url("/patients/patient/{$patient->id}/printPrescription")}}/[[prescription.id]]"
               class="btn btn-flat btn-default btn-sm pull-right" style="margin-right: 10px;" target="_blank"
               ng-if="prescription.prescription_pharmacy_drugs.length>0 || prescription.prescription_drugs.length>0">
                打印处方
                <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                   data-placement="bottom" title=""
                   data-original-title="Opens a new tab in the browser to print the prescription where the prescription
                   can be printed"></i>
            </a>
        </div>

        <div class="box-body">
            <div class="alert alert-danger alert-dismissable" ng-show="prescription.hasError" ng-cloak>
                <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                [[error]]
            </div>

            <table class="table table-hover table-condensed table-bordered text-center"
                   ng-if="prescription.prescription_drugs.length>0">
                <thead>
                <tr class="success">
                    <th class="col-sm-4">药品
                        <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                           data-placement="bottom" title=""
                           data-original-title="The name of the drug to be issued.
                           (The quantity type used to measure the drug's quantity is in the brackets)"></i>
                    </th>
                    <th class="col-sm-5">剂量</th>
                    <th class="col-sm-3">数量
                        <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                           data-placement="bottom" title=""
                           data-original-title="The actual quantity of the drug issued.
                           Type '0' in the field to neglect the quantity"></i>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="success" ng-class="{'danger':prescribedDrug.outOfStocks}"
                    ng-repeat="prescribedDrug in prescription.prescription_drugs">
                    <td>[[prescribedDrug.drug.name]] ([[prescribedDrug.drug.quantity_type.drug_type]])</td>
                    <td>
                        [[prescribedDrug.dosage.description]]<br>
                        [[prescribedDrug.frequency.description]]<br>
                        [[prescribedDrug.period.description]]
                    </td>
                    <td>
                        <div ng-class="{'has-error':prescribedDrug.outOfStocks}">
                            <span class="help-block" ng-show="prescribedDrug.outOfStocks">
                                <strong>
                                你只有 [[prescribedDrug.drug.quantity | exactNumber]] 单位库存可用.
                                请补充库存。
                                </strong>
                            </span>
                            <input class="form-control" type="number" step="0.01"
                                   ng-model="prescribedDrug.issuedQuantity" min="0"
                                   ng-change="checkStockAvailability([$parent.$index])">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            {{--table to show pharmacy drugs--}}
            <h4 ng-if="prescription.prescription_pharmacy_drugs.length>0">Pharmacy Drugs</h4>
            <table class="table table-condensed table-bordered table-hover text-center"
                   ng-if="prescription.prescription_pharmacy_drugs.length>0">
                <thead>
                <tr class="success">
                    <th class="col-sm-4">药品名称</th>
                    <th class="col-sm-8">备注</th>
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

            {{--Input to add payment information--}}
            <div class="container-fluid col-sm-12 margin">
                <label class="col-sm-3 control-label text-right">金额</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" min="0" ng-model="prescription.payment"
                           step="0.01">
                </div>
            </div>
            <div class="container-fluid col-sm-12 margin">
                <label class="col-sm-3 control-label text-right">备注</label>
                <div class="col-sm-9">
                    <textarea class="form-control" ng-model="prescription.paymentRemarks"></textarea>
                </div>
            </div>


        </div>

        <div class="box-footer">
            <button class="btn btn-lg btn-success btn-flat pull-right" ng-click="issuePrescription([[$index]])">
                标记为已解决
                <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                   data-placement="bottom" title=""
                   data-original-title="Mark the prescription as 'Issued'. Once a prescription is issued,
                   it cannot be reversed."></i>
            </button>
        </div>
    </div>


</div>