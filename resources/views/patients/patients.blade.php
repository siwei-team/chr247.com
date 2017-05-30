@extends('layouts.master')


@section('page_header')
    病人记录
@endsection


@section('content')

    <div class="box box-primary">
        <!--    Box Header  -->
        <div class="box-header with-border">
            <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addPatientModal">
                <span data-toggle="tooltip"
                      data-placement="bottom" title="" style="margin-left: 10px"
                      data-original-title="填充一个病人的基本信息并添加到系统">添加病人</span>
            </button>
        </div>

        <!--    Box Body  -->
        <div class="box-body container-fluid table-responsive">

            {{--Success Message--}}
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> 成功!</h4>
                    <p>
                        {{session('success')}}
                    </p>
                </div>
            @endif

            {{--Error Message--}}
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 成功!</h4>
                    {{session('error')}}
                </div>
            @endif

            <style>
                .tableRow {
                    cursor: pointer;
                }

                .tableRow:hover {
                    text-decoration: underline !important;
                }
            </style>

            <table class="table table-condensed table-hover text-center" id="patientsTable">
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>联系电话</th>
                    <th>地址</th>
                    <th>年龄</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($patients as $patient)
                    <tr class="tableRow">
                        <td onclick="window.location='{{route("patient",['id'=>$patient->id])}}'">
                            {{$patient->first_name}} {{$patient->last_name?:''}}
                        </td>
                        <td onclick="window.location='{{route("patient",['id'=>$patient->id])}}'">
                            {{$patient->phone}}
                        </td>
                        <td onclick="window.location='{{route("patient",['id'=>$patient->id])}}'">
                            {{$patient->address}}
                        </td>
                        <td onclick="window.location='{{route("patient",['id'=>$patient->id])}}'">
                            {{Utils::getAge($patient->dob)}}
                        </td>
                        <td>
                            @can('delete',$patient)
                                {{--
                                A modal is used to confirm the delete action.
                                One the modal popup, the url in the form changes according to the patient's id
                                --}}
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#confirmDeletePatientModal"
                                        onclick="showConfirmDelete({{$patient->id}},'{{$patient->first_name}} {{$patient->last_name?:''}}')">
                                    <i class="fa fa-recycle fa-lg" data-toggle="tooltip"
                                       data-placement="bottom" title=""
                                       data-original-title="确定删除病人信息?
                                      如果系统中有这个病人的任何信息，将无法删除"></i>
                                </button>
                            @endcan
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>

    </div>

    @include('patients.modals.addPatient')

    @include('patients.modals.confirmDelete')
    <script>
        /**
         * Method to show delete patient modal.
         * Updates the modal title and the form's action
         * @param patientId
         */
        function showConfirmDelete(patientId, name) {
            $('#confirmDeletePatientModal .modal-title').html(name);
            $('#confirmDeletePatientModal form').prop("action", "{{url('patients/deletePatient')}}/" + patientId);
        }
    </script>

    {{--Data Tables Scripts--}}
    <script>

        $(document).ready(function () {
            var tableFixed = $('#patientsTable').dataTable({
                'pageLength': 10
            });
        });
    </script>
    {{--//Data Tables--}}

@endsection
