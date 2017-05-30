<div class="container-fluid" ng-app="HIS">
    {{--Main Box--}}
    <div class="box box-default box-solid margin" ng-controller="PrescriptionController">
        <div class="box-header">
            <h4 class="box-title">处方</h4>
        </div>

        {{--Main Box Body--}}
        <div class="box-body">

            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                    <i class="icon fa fa-info"></i> 打印处方
                </h4>
                <p>添加所需的药品和检查后，你可以尽快打印处方保存处方.</p>
            </div>

            <div class="alert alert-danger" ng-show="hasError" ng-cloak>
                <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                [[error]]
            </div>

            <div class="alert alert-success" ng-show="hasSuccess" ng-cloak>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <p>Prescription saved successfully. You can print the drugs to taken from a pharmacy by clicking the
                    button below.</p>

                <a href="{{url("/patients/patient/{$patient->id}/printPrescription")}}/[[printPrescriptionId]]"
                   class="btn btn-flat btn-default text-black" target="_blank">
                    <i class="fa fa-print" aria-hidden="true"></i> 打印处方
                </a>

            </div>

            <div class="form-horizontal margin">
                {{-- Initialize the angular variables in a hidden field --}}
                <input type="hidden"
                       ng-init="baseUrl='{{url("/")}}';id={{$patient->id}};token='{{csrf_token()}}';init()">

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">症状</label>
                    <div class="col-md-9 col-xs-12">
                        <textarea id="presentingComplaints" placeholder="Presenting Complaints" ng-model="complaints"
                                  class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">调查</label>
                    <div class="col-md-9 col-xs-12">
                <textarea id="prescriptionInvestigations" placeholder="Investigations" ng-model="investigations"
                          class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">
                        诊断
                        <i class="fa fa-question-circle-o fa-lg pull-right" data-toggle="tooltip"
                           data-placement="bottom" title=""
                           data-original-title="Start typing to get suggestions for the diagnosis"></i>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <input id="prescriptionDiagnosis" placeholder="Start typing to get suggestions ..."
                               ng-model="diagnosis" class="form-control" type="text" ng-change="predictDisease()"
                               list="diseaseList">
                        <datalist id="diseaseList">
                            <option ng-repeat="disease in diseasePredictions">[[disease.disease]]</option>
                        </datalist>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">其他备注</label>
                    <div class="col-md-9 col-xs-12">
                <textarea id="prescriptionRemarks" ng-model="remarks" placeholder="Remarks"
                          class="form-control"></textarea>
                    </div>
                </div>

                {{-- Area to add drugs --}}
                <div class="box box-success box-solid">
                    <div class="box-header">
                        <h4 class="box-title">药物</h4>
                    </div>

                    <div class="box-body">

                        <div class="alert alert-danger" ng-show="hasDrugError" ng-cloak>
                            <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                            [[error]]
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="col-md-8 col-xs-12">
                                <label class="col-sm-12 text-center">
                                    药物
                                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                                       data-placement="bottom" title=""
                                       data-original-title="Select the drug to be added to the prescription.
                                       Available stock is shown in front of each drug as a number.
                                       Only the drugs added under 'Drugs' in the system are shown here"></i>
                                </label>
                                <div class="col-sm-12">
                                    <select id="prescriptionDrug" class="form-control" size="6" ng-model="drug">
                                        <option value="">空</option>
                                        <option ng-repeat="drug in drugs" value="[[drug.id]]" ng-cloak>
                                            [[drug.name]] ([[drug.quantity | exactNumber]] Available)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-xs-12">
                                    找不到要找的药品？
                                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                                       data-placement="bottom" title=""
                                       data-original-title="Add a new drug, dosage, frequency and period which
                                           is not present in the lists."> </i>
                                </label>
                                <div class="col-xs-12">
                                    <button class="btn bg-gray btn-lg btn-flat" data-toggle="modal"
                                            data-target="#addDosageModal"> 添加
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12" style="margin-top: 10px">
                            <div class="col-md-4 col-xs-12">
                                <label class="col-sm-12 text-center">
                                    剂量
                                    <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                                       data-placement="bottom" title=""
                                       data-original-title="The quantity of the drug to be taken at a time."></i>
                                </label>
                                <div class="col-sm-12">
                                    <select id="prescriptionDose" class="form-control" size="6" ng-model="dosage">
                                        <option value="">空</option>
                                        <option ng-repeat="dose in dosages track by dose.id" value="[[dose.id]]"
                                                ng-cloak>
                                            [[dose.description]]
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <label class="col-sm-12 text-center">频次 (可选)</label>
                                <div class="col-sm-12">
                                    <select id="prescriptionFrequency" class="form-control" size="6"
                                            ng-model="frequency">
                                        <option value="">空</option>
                                        <option ng-repeat="f in frequencies track by f.id" value="[[f.id]]" ng-cloak>
                                            [[f.description]]
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <label class="col-sm-12 text-center">周期 (可选)</label>
                                <div class="col-sm-12">
                                    <select id="prescriptionPeriod" class="form-control" size="6" ng-model="period">
                                        <option value="">空</option>
                                        <option ng-repeat="p in periods track by p.id" value="[[p.id]]" ng-cloak>
                                            [[p.description]]
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn bg-gray btn-lg btn-flat pull-left" data-toggle="modal"
                                data-target="#addPharmacyDrugsModal"> 药房药品
                            <i class="fa fa-question-circle-o fa-lg" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="添加药房药品"></i>
                        </button>
                        <button class="btn btn-success btn-lg btn-flat pull-right" ng-click="add()">
                            添加
                        </button>
                    </div>
                </div>
                {{-- /Area to add drugs --}}

                {{-- Area to show drugs --}}
                <div class="box box-success box-solid">
                    <div class="box-header">
                        <h4 class="box-title">处方药品</h4>
                    </div>
                    <div class="box-body">
                        {{--table to show prescribed drugs--}}
                        <table class="table table-condensed table-bordered table-hover text-center"
                               ng-if="prescribedDrugs.length>0">
                            <thead>
                            <tr class="success">
                                <th>药品名称</th>
                                <th>用量</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="d in prescribedDrugs track by $index" class="success" ng-cloak>
                                <td>[[d.drug.name]]</td>
                                <td>
                                    [[d.dose.description]]<br>[[d.frequency.description]]<br>[[d.period.description]]
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" ng-click="removeDrug([[$index]])">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        {{--table to show pharmacy drugs--}}
                        <h4 ng-if="pharmacyDrugs.length>0">药房药品</h4>
                        <table class="table table-condensed table-bordered table-hover text-center"
                               ng-if="pharmacyDrugs.length>0">
                            <thead>
                            <tr class="success">
                                <th>药品名称</th>
                                <th>备注</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="d in pharmacyDrugs track by $index" class="success" ng-cloak>
                                <td>[[d.name]]</td>
                                <td>
                                    [[d.remarks]]
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" ng-click="removePharmacyDrug([[$index]])">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <div class="alert bg-success" ng-if="prescribedDrugs.length==0 && pharmacyDrugs.length==0"
                             ng-cloak>
                            没有药品！
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--/Main Box Body--}}

        {{-- Overlay to be shown when submitted --}}
        <div class="overlay" ng-show="submitted" ng-cloak>
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        {{-- /Overlay --}}

        <div class="box-footer">
            <button class="btn btn-primary btn-lg pull-right" ng-click="savePrescription()">
                保存处方
            </button>
            <button class="btn btn-danger btn-lg" ng-click="clearPrescription()">
                取消保存
            </button>
        </div>

        {{--Modal to add pharmacy Drugs--}}
        @include('patients.modals.addPharmacyDrugs')
        @include('patients.modals.addDosage')

    </div>
    {{--/Main Box--}}
</div>