<div class="modal fade" id="addDrugModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加药品</h4>
            </div>

            <form class="form-horizontal" method="post" action="{{route('addDrug')}}">

                <div class="box-body">


                    {{-- Warning when there's no quantity type pre entered --}}
                    @if(\App\Clinic::getCurrentClinic()->quantityTypes()->count()==0)
                        <div class="alert alert-warning alert-dismissable container-fluid">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> No Quantity Types Available !</h4>
                            In order to add drugs, quantity types are required. Quantity Types are used to manage
                            stocks. Go to <a href="{{route('drugTypes')}}"><strong> Quantity Types</strong> </a> to add
                            quantity types.
                        </div>
                    @endif

                    {{-- General error message --}}
                    @if ($errors->has('general'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    {{csrf_field()}}

                    <div class="form-group{{ $errors->has('drugName') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">
                            药品名称
                            <i class="fa fa-question-circle-o fa-lg pull-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="Commercial/Brand name of the drug.
                               Type at least 3 characters to get suggestions"></i>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="drugName" required list="drugList"
                                   ng-change="predictDrug()" ng-model="drugName"
                                   ng-init="drugName='{{ old('drugName') }}'">
                            <datalist id="drugList">
                                <option ng-repeat="drug in drugPredictions">[[drug.trade_name]]</option>
                            </datalist>
                            @if ($errors->has('drugName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('drugName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ingredient') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">
                            成分
                            <i class="fa fa-question-circle-o fa-lg pull-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="Scientific name or the generic name of the drug.
                               Type at least 3 characters to get suggestions"></i>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ingredient" required list="ingredientList"
                                   ng-change="predictIngredient()" ng-model="ingredient"
                                   ng-init="ingredient='{{ old('ingredient') }}'">
                            <datalist id="ingredientList">
                                <option ng-repeat="drug in ingredientPredictions">[[drug.ingredient]]</option>
                            </datalist>
                            @if ($errors->has('ingredient'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('ingredient') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantityType') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">
                            数量类型
                            <i class="fa fa-question-circle-o fa-lg pull-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="The measurement used to measure the available quantity of a drug.
                               ex: Number of 'Pills', number of 'Bottles', 'Litres'"></i>
                        </label>
                        <div class="col-md-9">
                            <select name="quantityType" class="form-control">
                                @foreach(\App\Clinic::getCurrentClinic()->quantityTypes as $quantityType)
                                    <option value="{{$quantityType->id}}"
                                            @if($quantityType->id === old('quantityType')) selected @endif>
                                        {{$quantityType->drug_type}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('quantityType'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('quantityType') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('manufacturer') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">厂商</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="manufacturer"
                                   ng-init="manufacturer='{{ old('manufacturer') }}'"
                                   required list="manufacturerList" ng-change="predictManufacturer()"
                                   ng-model="manufacturer">
                            <datalist id="manufacturerList">
                                <option ng-repeat="manufacturer in manufacturers">[[manufacturer.manufacturer]]</option>
                            </datalist>
                            @if ($errors->has('manufacturer'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('manufacturer') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- ================= Adding the initial Stock ================== --}}
                    @can('add','App\Stock')
                        <div class="box-header">
                            <h4 class="box-title">添加初始化库存 (可选)</h4>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">数量</label>
                                <div class="col-md-9">
                                    <input type="number" min="0" step="0.01" class="form-control" name="quantity"
                                           value="{{ old('quantity') }}">
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('manufacturedDate') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">生产日期</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control datepicker" name="manufacturedDate"
                                           value="{{ old('manufacturedDate') }}">
                                    @if ($errors->has('manufacturedDate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('manufacturedDate') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('receivedDate') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">购买日期</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control datepicker" name="receivedDate"
                                           value="{{ old('receivedDate') }}">
                                    @if ($errors->has('receivedDate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('receivedDate') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('expiryDate') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">有效期</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control datepicker" name="expiryDate"
                                           value="{{ old('expiryDate') }}">
                                    @if ($errors->has('expiryDate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('expiryDate') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">备注</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="remarks" rows="2">{{old('remarks')}}</textarea>
                                    @if ($errors->has('remarks'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endcan


                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary pull-right">保存</button>
                </div><!-- /.box-footer -->
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


@if(session('type') && session('type')==="drug" && $errors->any())
    <script>
        $(document).ready(function () {
            $('#addDrugModal').modal('show');
        });
    </script>
@endif