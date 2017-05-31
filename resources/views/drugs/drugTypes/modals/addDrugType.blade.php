<div class="modal fade" id="addDrugTypeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加数量类型</h4>
            </div>

            <form class="form-horizontal" method="post" action="{{route('addDrugType')}}">

                <div class="box-body">

                    {{-- General error message --}}
                    @if ($errors->has('general'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    {{csrf_field()}}

                    <div class="alert alert-warning">
                        这些数量类型将在跟踪药物库存时使用。因此，使用可用于描述数量的有意义的类型名称。
                        <br>
                        <strong>例如：药片，片剂，瓶，升等...</strong>
                    </div>

                    <div class="form-group{{ $errors->has('drugType') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">数量类型</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="drugType"
                                   value="{{ old('drugType') }}" required
                                   placeholder="Ex: Pills/Tablets/Bottles">
                            @if ($errors->has('drugType'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('drugType') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary pull-right">添加</button>
                </div><!-- /.box-footer -->
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


@if($errors->any())
    <script>
        $(document).ready(function () {
            $('#addDrugTypeModal').modal('show');
        });
    </script>
@endif