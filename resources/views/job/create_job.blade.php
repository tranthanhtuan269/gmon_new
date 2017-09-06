@extends('layouts.layout')

@section('content')
<script type="text/javascript" src="{{ url('/') }}/public//bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public//bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/public//bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Đăng tin tuyển dụng</div>
                <div class="panel-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/job/store', 'class' => 'form-horizontal', 'files' => true, 'id' => 'create-job']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên công việc']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'Số lượng']) !!}
                                    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" id="select-branch">
                            <input type="hidden" id="branches" name="branches" value="">
                            <select class="form-control selectpicker" multiple title="Chọn chi nhánh tuyển dụng">
                                <?php 
                                    foreach($branches as $branch){
                                        echo '<option id="'.$branch->id.'">'. $branch->name . '( ' . $branch->address . ', ' . $branch->district . ', ' . $branch->city . ' )' .'</option>';
                                    }
                                ?>
                            </select>
                            {!! $errors->first('branches', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Mô tả công việc</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('requirement') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Yêu cầu công việc</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('requirement', null, ['class' => 'form-control', 'id' => 'requirement']) !!}
                                    {!! $errors->first('requirement', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('public') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <select class="form-control" id="public" name="public"><option value="0">Hiển thị với ứng viên</option><option value="1">Không hiển thị</option></select>
                                    {!! $errors->first('public', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label"></label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" id="position" name="position">
                                        <option value="0">--Chức vụ--</option>
                                        <option value="1">Nhân viên thời vụ</option>
                                        <option value="2">Nhân viên</option>
                                        <option value="3">Trưởng nhóm</option>
                                        <option value="4">Trưởng phòng</option>
                                        <option value="5">Phó giám đốc</option>
                                        <option value="6">Giám đốc</option>
                                    </select>
                                    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('job_type') ? 'has-error' : ''}}">
                                <div class="col-md-12" id="select-job">
                                    <input type="hidden" id="job_type" name="job_type" value="">
                                    <select class="form-control selectpicker" multiple title="Chọn ngành nghề">
                                        <option>Làm bán thời gian</option>
                                        <option>Bán hàng</option>
                                        <option>Marketing-PR</option>
                                        <option>Bảo vệ</option>
                                        <option>Du lịch</option>
                                        <option>Tạp vụ</option>
                                        <option>Order</option>
                                        <option>Nhân viên kỹ thuật</option>
                                        <option>Sale/Marketing online</option>
                                        <option>Promotion Girl(PG)</option>
                                        <option>Thực tập</option>
                                        <option>Phụ bếp</option>
                                        <option>Người giúp việc</option>
                                        <option>Bếp chính</option>
                                        <option>Nhân viên spa</option>
                                        <option>Pha chế</option>
                                        <option>Bell man</option>
                                        <option>Chăm sóc khách hàng</option>
                                        <option>Giao nhận, ship</option>
                                        <option>Kinh doanh</option>
                                        <option>Hành chính nhân sự</option>
                                        <option>Phiên dịch</option>
                                        <option>Gia sư</option>
                                        <option>Hướng dẫn viên</option>
                                        <option>Giám sát, quản lý</option>
                                        <option>Phục vụ, bồi bàn</option>
                                        <option>Telesale</option>
                                        <option>Cộng tác viên</option>
                                        <option>Phụ bếp</option>
                                        <option>Lễ tân</option>
                                        <option>Thu ngân</option>
                                        <option>Marketing online</option>
                                        <option>Phát tờ rơi</option>
                                        <option>Buồng phòng</option>
                                        <option>Pha chế</option>
                                        <option>Shipper</option>
                                        <option>Kế toán</option>
                                        <option>Bác sĩ</option>
                                        <option>Giáo viên</option>
                                        <option>Phi công</option>
                                        <option>Lái xe</option>
                                        <option>Thiết kế</option>
                                        <option>Nhân viên IT</option>
                                        <option>Biên tập viên</option>
                                    </select>
                                    {!! $errors->first('job_type', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('education') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="education" name="education" value="0">
                                    <select class="form-control" title="Yêu cầu bằng cấp" id="education_select" name="education_select">
                                        <option value="0">Không yêu cầu bằng cấp</option>
                                        <option value="6">Chứng chỉ nghề</option>
                                        <option value="1">Cử nhân</option>
                                        <option value="2">Kỹ sư</option>
                                        <option value="3">MBA</option>
                                        <option value="4">Thạc sĩ</option>
                                        <option value="5">Tiến sĩ</option>
                                    </select>
                                    {!! $errors->first('education', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('experience') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="experience" name="experience" value="0">
                                    <select class="form-control" title="Kinh nghiệm" id="experience_select" name="experience_select">
                                        <option value="0">Không yêu cầu kinh nghiệm</option>
                                        <option value="1">1 năm</option>
                                        <option value="2">2 năm</option>
                                        <option value="3">3 năm</option>
                                        <option value="4">4 năm</option>
                                        <option value="5">5 năm</option>
                                        <option value="6">Trên 5 năm</option>
                                    </select>
                                    {!! $errors->first('education', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('salary') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::select('salary', $salaries, null, ['class' => 'form-control', 'id' => 'salary']) !!}
                                    {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('work_type') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="work_type" name="work_type" value="0">
                                    <select class="form-control" title="Hình thức làm việc" id="work_type_select" name="work_type_select">
                                        <option value="0">Bán thời gian</option>
                                        <option value="1">Toàn thời gian</option>
                                    </select>
                                    {!! $errors->first('work_type', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="age" name="age" value="0">
                                    <select class="form-control" title="Độ tuổi" id="age_select" name="age_select">
                                        <option value="0">Không yêu cầu độ tuổi</option>
                                        <option value="1">18 - 24 tuổi</option>
                                        <option value="2">Trên 24 tuổi</option>
                                    </select>
                                    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="gender" name="gender" value="0">
                                    <select class="form-control" title="Hình thức làm việc" id="gender_select" name="gender_select">
                                        <option value="0">Không yêu cầu giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('benefit') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Quyền lợi</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('benefit', null, ['class' => 'form-control', 'id' => 'benefit']) !!}
                                    {!! $errors->first('benefit', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="expiration_date" id="expiration_date" placeholder="Ngày hết hạn" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                    </div>
                                    {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 pull-right">
                                    <button class="btn btn-primary" id="submit-btn">Tạo mới</button>
                                    <a target="_self" href="{{ url('/home') }}" class="btn btn-primary">Trở về trang chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    CKEDITOR.replace('description');
    CKEDITOR.replace('requirement');
    CKEDITOR.replace('benefit');

    $('#time_start').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#expiration_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $("#city").change(function () {
        var citId = $("#city").val();
        var request = $.ajax({
            url: "{{ URL::to('/') }}/getDistrict/" + citId,
            method: "GET",
            dataType: "html"
        });

        request.done(function (msg) {
            $("#district").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $("#job_type_select").change(function () {
        $("#job_type").val($(this).val());
    });

    $("#education_select").change(function () {
        $("#education").val($(this).val());
    });

    $("#experience_select").change(function () {
        $("#experience").val($(this).val());
    });

    $("#salary_select").change(function () {
        $("#salary").val($(this).val());
    });

    $("#work_type_select").change(function () {
        $("#work_type").val($(this).val());
    });

    $("#age_select").change(function () {
        $("#age").val($(this).val());
    });

    $("#gender_select").change(function () {
        $("#gender").val($(this).val());
    });

    $("#submit-btn").click(function () {
        var listJobs = '';
        $('#select-job .dropdown-menu.inner li.selected').each(function (index) {
            listJobs += ';' + $(this).text();
        });

        var listBranches = '';
        $listBranch = $('#select-branch select option');
        $('#select-branch .dropdown-menu.inner li').each(function (index) {
            if($(this).hasClass('selected')){
                listBranches += ';' + $(this).text();
            }
        });

        $('#branches').val(listBranches);
        $('#description').val(CKEDITOR.instances["description"].getData());
        $('#requirement').val(CKEDITOR.instances["requirement"].getData());
        $('#benefit').val(CKEDITOR.instances["benefit"].getData());
        $('#job_type').val(listJobs);
        $("#create-job").submit();
    });
});
</script>
@endsection