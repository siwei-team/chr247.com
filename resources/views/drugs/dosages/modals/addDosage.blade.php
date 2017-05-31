<div class="modal fade" id="addDosageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加剂量</h4>
            </div>

            <form class="form-horizontal" method="post" action="{{route('addDosage')}}">

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

                    <div class="form-group{{ $errors->has('dosageDescription') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">剂量描述</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="dosageDescription" value="{{ old('dosageDescription') }}"
                                   required>
                            @if ($errors->has('dosageDescription'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('dosageDescription') }}</strong>
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


@if(session('type') && session('type')==="dosage" && $errors->any())
    <script>
        $(document).ready(function () {
            $('#addDosageModal').modal('show');
        });
    </script>
@endif