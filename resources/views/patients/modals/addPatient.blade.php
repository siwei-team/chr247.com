<div class="modal fade" id="addPatientModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加病人</h4>
            </div>

            <form class="form-horizontal" method="post" action="{{route('addPatient')}}">

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

                    <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">姓氏</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstName" value="{{ old('firstName') }}"
                                   required>
                            @if ($errors->has('firstName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">名字</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
                            @if ($errors->has('lastName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">出生日期</label>
                        <div class="col-md-9">
                            <input class="form-control birthdaypicker" type="text" id="dob" name="dob"
                                   value="{{old('dob')}}">
                            @if ($errors->has('dob'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">性别</label>
                        <div class="col-md-9 radio">
                            <label>
                                <input type="radio" name="gender" value="Male" checked="checked">
                                男
                            </label>
                            <br>
                            <label>
                                <input type="radio" name="gender" value="FeMale">
                                女
                            </label>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">地址</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nic') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">NIC</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nic" value="{{ old('nic') }}"
                                   pattern="[0-9]{9}[vV]">
                            @if ($errors->has('nic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">手机号</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <?php $bloodGroups = ["N/A", "A +", "A-", "B +", "B -", "AB +", "AB -", "O +", "O -"]; ?>
                    <div class="form-group{{ $errors->has('bloodGroup') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">血型</label>
                        <div class="col-md-9">
                            <select name="bloodGroup" class="form-control">
                                @foreach($bloodGroups as $bloodGroup)
                                    <option value="{{$bloodGroup}}"
                                            @if(strcmp($bloodGroup,old('bloodGroup'))==0) selected @endif>
                                        {{$bloodGroup}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('bloodGroup'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('bloodGroup') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('allergies') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">过敏史</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="allergies" rows="2">{{old('allergies')}}</textarea>
                            @if ($errors->has('allergies'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('allergies') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('familyHistory') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">家族病史</label>
                        <div class="col-md-9">
                            <textarea class="form-control" placeholder="Notable medical conditions run in the family"
                                      name="familyHistory" rows="2">{{old('familyHistory')}}</textarea>
                            @if ($errors->has('familyHistory'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('familyHistory') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('medicalHistory') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">病史</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="2"
                                      name="medicalHistory">{{old('medicalHistory')}}</textarea>
                            @if ($errors->has('medicalHistory'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('medicalHistory') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('postSurgicalHistory') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">柱外科历史</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="2"
                                      name="postSurgicalHistory">{{old('postSurgicalHistory')}}</textarea>
                            @if ($errors->has('postSurgicalHistory'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('postSurgicalHistory') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">备注</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="2" name="remarks">{{old('remarks')}}</textarea>
                            @if ($errors->has('remarks'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary pull-right">保存</button>
                </div><!-- /.box-footer -->
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


@if(session('type') && session('type')==="patient" && $errors->any())
    <script>
        $(document).ready(function () {
            $('#addPatientModal').modal('show');
        });
    </script>
@endif