<script src="{{asset("js/DrugController.js")}}?{{Utils::getCachePreventPostfix()}}"></script>

<div class="modal fade" id="addDosageModal" ng-controller="DrugController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加新的药物到处方</h4>
            </div>

            <div class="modal-body">

                <div class="form-horizontal container-fluid">
                    <div class="form-group"
                         ng-class="{'has-error':error.drug.has||error.quantityType.has}">
                        <label class="col-md-3 col-xs-12 control-label text-center">药品</label>

                        <div class="col-md-9 col-xs-12">
                            <div class="row">
                                <span class="help-block" ng-if="error.drug.has">
                                    [[error.drug.msg]]
                                </span>
                                <select class="form-control" size="4" ng-model="drug">
                                    <option value="">空</option>
                                    <option ng-repeat="drug in drugs" value="[[drug.id]]" ng-cloak>
                                        [[drug.name]]
                                    </option>
                                </select>
                            </div>

                            <div class="row text-center">
                                <label class="control-label text-center">或者 添加信息的药品</label>
                            </div>

                            <div class="row">
                                <input type="text" class="form-control" required list="drugPredictionList"
                                       ng-change="predictDrug()" ng-model="drugName" placeholder="New drug to be added">
                                <datalist id="drugPredictionList">
                                    <option ng-repeat="drug in drugPredictions">[[drug.trade_name]]</option>
                                </datalist>
                            </div>

                            <div class="row">
                                <span class="help-block" ng-if="error.quantityType.has">
                                    [[error.quantityType.msg]]
                                </span>
                                <input type="text" class="form-control" required list="quantityTypesList"
                                       ng-model="quantityType" placeholder="药品库存类型">
                                <datalist id="quantityTypesList" ng-init="getQuantityTypes()">
                                    <option ng-repeat="q in quantityTypes">[[q.drug_type]]</option>
                                </datalist>
                            </div>

                        </div>
                    </div>

                    <div class="form-group" ng-class="{'has-error':error.dosage.has}">
                        <label class="col-md-3 col-sm-12 control-label">剂量</label>
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <span class="help-block" ng-if="error.dosage.has">
                                    [[error.dosage.msg]]
                                </span>
                                <select class="form-control" size="4" ng-model="dosage">
                                    <option value="">空</option>
                                    <option ng-repeat="dose in dosages track by dose.id" value="[[dose.id]]"
                                            ng-cloak>
                                        [[dose.description]]
                                    </option>
                                </select>
                            </div>
                            <div class="row text-center">
                                <label class="control-label text-center">或者 添加一个新的剂量类型</label>
                            </div>
                            <div class="row">
                                <input type="text" class="form-control" required ng-model="dosageText"
                                       placeholder="New dosage to be added">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" ng-class="{'has-error':error.frequency.has}">
                        <label class="col-md-3 col-sm-12 control-label">剂量频率</label>
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <span class="help-block" ng-if="error.frequency.has">
                                    [[error.frequency.msg]]
                                </span>
                                <select class="form-control" size="4" ng-model="frequency">
                                    <option value="">空</option>
                                    <option ng-repeat="f in frequencies track by f.id" value="[[f.id]]" ng-cloak>
                                        [[f.description]]
                                    </option>
                                </select>
                            </div>
                            <div class="row text-center">
                                <label class="control-label text-center">或者 添加新的频率</label>
                            </div>
                            <div class="row">
                                <input type="text" class="form-control" required ng-model="frequencyText"
                                       placeholder="New frequency to be added">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" ng-class="{'has-error':error.period.has}">
                        <label class="col-md-3 col-sm-12 control-label">剂量期</label>
                        <div class="col-md-9 col-sm-12">
                            <div class="row">
                                <span class="help-block" ng-if="error.period.has">
                                    [[error.period.msg]]
                                </span>
                                <select class="form-control" size="4" ng-model="period">
                                    <option value="">空</option>
                                    <option ng-repeat="p in periods track by p.id" value="[[p.id]]" ng-cloak>
                                        [[p.description]]
                                    </option>
                                </select>
                            </div>
                            <div class="row text-center">
                                <label class="control-label text-center">或者 添加新的剂量期</label>
                            </div>
                            <div class="row">
                                <input type="text" class="form-control" required ng-model="periodText"
                                       placeholder="New period to be added">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="alert alert-danger" ng-show="error.hasError" ng-cloak>
                                    <h4><i class="icon fa fa-ban"></i> 抱歉 !</h4>
                                    [[error.msg]]
                                </div>
                                <div class="alert alert-success" ng-show="success.hasSuccess" ng-cloak>
                                    <h4><i class="icon fa fa-check"></i> 成功 !</h4>
                                    [[success.msg]]
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-success pull-right" ng-click="save()">
                                    添加到处方
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="box-footer">
                <button class="btn btn-default" data-dismiss="modal" ng-click="pharmacyDrugs=[];">取消</button>
                <button class="btn btn-primary pull-right" data-dismiss="modal">完成</button>
            </div><!-- /.box-footer -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>