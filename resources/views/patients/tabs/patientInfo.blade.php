<div class="container-fluid">
    <div class="row margin">

        <div class="col-md-6">
            <div class="row">
                <label class="col-md-4">姓名</label>
                <div class="col-md-8">{{$patient->first_name}} {{$patient->last_name}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">年龄</label>
                <div class="col-md-8">{{Utils::getAge($patient->dob)}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">地址</label>
                <div class="col-md-8">{{$patient->address}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">性别</label>
                <div class="col-md-8">{{$patient->gender}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">NIC</label>
                <div class="col-md-8">{{$patient->nic}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">联系方式</label>
                <div class="col-md-8">{{$patient->phone}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">注册时间</label>
                <div class="col-md-8">{{Utils::getTimestamp($patient->created_at)}}</div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="row">
                <label class="col-md-4">血型</label>
                <div class="col-md-8">{{$patient->blood_group}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">备注</label>
                <div class="col-md-8">{{$patient->remarks?:'-'}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">过敏史</label>
                <div class="col-md-8">{{$patient->allergies?:'-'}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">家族病史</label>
                <div class="col-md-8">{{$patient->family_history?:'-'}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">病史</label>
                <div class="col-md-8">{{$patient->medical_history?:'-'}}</div>
            </div>
            <div class="row">
                <label class="col-md-4">手术史</label>
                <div class="col-md-8">{{$patient->post_surgical_history?:'-'}}</div>
            </div>
        </div>

    </div>
</div>