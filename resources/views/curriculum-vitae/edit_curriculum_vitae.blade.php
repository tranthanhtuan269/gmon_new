@extends('layouts.layout_cv')

@section('content')
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sửa hồ sơ</div>
                <div class="panel-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::open(['url' => 'curriculumvitae/update/'. $cv_user->id, 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true, 'id' => 'update-curriculum-vitae']) !!}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <img src="http://test.gmon.com.vn/?image={{ $cv_user->avatar }}" id="avatar-image" class="img" style="height: 150px; width: 150px; background-color: #fff; border: 2px solid gray; border-radius: 5px;">
                                    <input type="file" name="avatar-img" id="avatar-img" style="display: none;">
                                    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}}">
                                {!! Form::label('birthday', 'Ngày sinh', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="birthday" id="birthday" value="{{ $cv_user->birthday }}" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                    </div>
                                    {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                                {!! Form::label('city', 'Tỉnh / Thành phố', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('city', $cities, $cv_user->city_id, ['placeholder' => '', 'class' => 'form-control']) !!}
                                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('salary_want') ? 'has-error' : ''}}">
                                {!! Form::label('salary_want', 'Mức lương', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('salary_want', $salaries, $cv_user->salary_want, ['placeholder' => '', 'class' => 'form-control']) !!}
                                    {!! $errors->first('salary_want', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div id="jobs_hold" class="form-group {{ $errors->has('jobs') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <?php 
                                        $listjobs = explode(";",$cv_user->jobs);
                                        ?>
                                    <input type="hidden" id="jobs" name="jobs" value="">
                                    <select class="form-control selectpicker" multiple title="Chọn công việc">
                                        @foreach($job_types as $key => $value)
                                            @if(in_array($value, $listjobs))
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('jobs', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                {!! Form::label('gender', 'Giới tính', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <label>{!! Form::radio('gender', '1', $cv_user->gender == 1); !!}Nam</label>
                                    <label>{!! Form::radio('gender', '0', $cv_user->gender == 0); !!}Nữ</label>
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
                                {!! Form::label('district', 'Quận / Huyện', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::select('district', $districts, $cv_user->district_id, ['placeholder' => '', 'class' => 'form-control', 'id' => 'district']) !!}
                                    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                {!! Form::label('address', 'Địa chỉ', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('address', $cv_user->address, ['class' => 'form-control', 'placeholder' => 'Số nhà và Đường']) !!}
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div id="time_can_work_hold" class="form-group {{ $errors->has('jobs') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <?php 
                                        $listTimes = explode(";",$cv_user->time_can_work);
                                        ?>
                                    <input type="hidden" id="time_can_work" name="time_can_work" value="">
                                    <select class="form-control selectpicker" multiple title="Chọn Thời gian làm việc">
                                        @foreach($time_can_works as $key => $value)
                                            @if(in_array($value, $listTimes))
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('time_can_work', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="qua_trinh_hoc_tap">
                        <div class="panel-heading">Quá trình học tập</div>
                        <div class="panel-body">
                            <input type="hidden" name="education" id="education" value="">
                            <?php 
                                $cv_user->education=ltrim($cv_user->education,";");
                                $educations = explode(";",$cv_user->education);
                                for($i = 0; $i < count($educations); $i++){
                                    $edu = json_decode($educations[$i]);
                            ?>
                            <div class="form-hoc-tap-group first-form" id="hoc_tap_{{ $i }}">
                                <input type="hidden" class="education_json" id="hoc_tap_{{ $i }}_json" value="{{ $educations[$i] }}">
                                <div id='hoc_tap_{{ $i }}_content' style="display: none">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-2"><input type="radio" class='bang_cap' name="bang_cap_{{ $i }}" value="0" @if($edu->bang_cap == 0) checked @endif> Chứng chỉ</label>
                                            <label class="col-md-5"><input type="radio" class='bang_cap' name="bang_cap_{{ $i }}" value="1" @if($edu->bang_cap == 1) checked @endif>Sau Đại học / Đại học / Cao đẳng / Trung cấp</label>
                                            <label class="col-md-5"><input type="radio" class='bang_cap' name="bang_cap_{{ $i }}" value="2" @if($edu->bang_cap == 2) checked @endif>Tiểu học / Trung học</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Học tại</label>
                                        <div class="col-md-4">
                                            <input type="text" name="school" class="form-control truong_hoc" id="truong_hoc_{{ $i }}" placeholder="Nhập tên trường, trung tâm học" value="{{ $edu->truong_hoc }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-sm-offset-2"><input type="radio" class="student_process" name="student_process_{{ $i }}" value="0" @if($edu->student_process == 0) checked @endif>Đang học</label>
                                            <label class="col-sm-offset-2"><input type="radio" class="student_process" name="student_process_{{ $i }}" value="1" @if($edu->student_process == 1) checked @endif>Đã tốt nghiệp</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Thời gian học</label>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Từ:</label>
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('thang_bat_dau', $months, $edu->thang_bat_dau, ['placeholder' => '', 'class' => 'form-control col-md-2 thang_bat_dau', 'id' => 'thang_bat_dau_' . $i]) !!}
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('nam_bat_dau', $years, $edu->nam_bat_dau, ['placeholder' => '', 'class' => 'form-control col-md-2 nam_bat_dau', 'id' => 'nam_bat_dau_' . $i]) !!}
                                        </div>
                                        <div class="col-md-1 learn-to-{{ $i }}" style="display: none;">
                                            <label for="birthday" class="col-md-2 control-label">Đến:</label>
                                        </div>
                                        <div class="col-md-2 learn-to-{{ $i }}" style="display: none;">
                                            {!! Form::select('thang_ket_thuc', $months, $edu->thang_ket_thuc, ['placeholder' => '', 'class' => 'form-control col-md-2 thang_ket_thuc', 'id' => 'thang_ket_thuc_' . $i]) !!}
                                        </div>
                                        <div class="col-md-2 learn-to-{{ $i }}" style="display: none;">
                                            {!! Form::select('nam_ket_thuc', $years, $edu->nam_ket_thuc, ['placeholder' => '', 'class' => 'form-control col-md-2 nam_ket_thuc', 'id' => 'nam_ket_thuc_' . $i]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="chuyen_nganh" class="col-md-2 control-label"><div id="chuyen_nganh_{{ $i }}_label">Chuyên ngành</div></label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" class="chuyen_nganh" id="chuyen_nganh_{{ $i }}" value="{{ $edu->chuyen_nganh }}">
                                        </div>
                                        <label for="loai_tot_nghiep_{{ $i }}" class="col-md-2 control-label"><span  id="loai_tot_nghiep_{{ $i }}_label" @if($edu->student_process == 0)style="display:none;" @endif>Tốt nghiệp loại</span></label>
                                        <div class="col-md-3">
                                            @if($edu->student_process == 1)
                                            {!! Form::select('loai_tot_nghiep', $loaitotnghieps, isset($edu->loai_tot_nghiep) ? $edu->loai_tot_nghiep : null, ['placeholder' => '', 'class' => 'form-control loai_tot_nghiep', 'id' => 'loai_tot_nghiep_' . $i, 'style' => '']) !!}
                                            @else
                                            {!! Form::select('loai_tot_nghiep', $loaitotnghieps, 0, ['placeholder' => '', 'class' => 'form-control loai_tot_nghiep', 'id' => 'loai_tot_nghiep_' . $i, 'style' => 'display:none']) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='col-md-8'>
                                        <p id='truong_hoc_{{ $i }}_txt' class='truong-hoc-hide'> - {{ $edu->truong_hoc }} ( {{ $edu->nam_bat_dau }} - @if($edu->nam_ket_thuc == 0) Nay @else {{ $edu->nam_ket_thuc }} @endif ) </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-danger pull-right hoc_tap_delete-btn" id="delete_{{ $i }}">Hủy bỏ</div>
                                        <div class='btn btn-primary pull-right hoc_tap_edit-btn' id='edit_{{ $i }}'>Chỉnh sửa</div>
                                        <div class="btn btn-primary pull-right hoc_tap_success-btn" id='success_{{ $i }}' style='display:none;'>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="text-center"><div class="btn btn-link" id="them_moi_hoc_tap"> + Thêm mới</div></div>
                    </div>


                    <div class="panel panel-default" id="kinh_nghiem_lam_viec">
                        <div class="panel-heading">Kinh nghiệm làm việc</div>
                        <div class="panel-body">
                                <input type="hidden" name="word_experience" id="word_experience" value="">
                            <?php 
                                if(strlen($cv_user->word_experience) > 1){
                                $cv_user->word_experience=ltrim($cv_user->word_experience,";");
                                if(substr($cv_user->word_experience, -1) == ';'){
                                    $cv_user->word_experience=rtrim($cv_user->word_experience,";");
                                }
                                $word_experiences = explode(";",$cv_user->word_experience);
                                for($i = 0; $i < count($word_experiences); $i++){
                                    $words = json_decode($word_experiences[$i]);
                            ?>
                            <div class="form-kinh-nghiem-group first-form" id="kinh_nghiem_lam_viec_{{ $i }}">
                                <input type="hidden" class="word_experience_json" id="kinh_nghiem_lam_viec_{{ $i }}_json" value="{{ $word_experiences[$i] }}">
                                <div id='kinh_nghiem_lam_viec_{{ $i }}_content' style="display:none;">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="ten_cong_ty" class="col-md-4 control-label">Tên công ty đã làm</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="ten_cong_ty_{{ $i }}" id="ten_cong_ty_{{ $i }}" value="{{ $words->ten_cong_ty }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vi_tri" class="col-md-4 control-label">Vị trí công việc</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="vi_tri" id="vi_tri_{{ $i }}" value="{{ $words->vi_tri }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Thời gian làm</label>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Từ:</label>
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('thang_bat_dau_lam_viec', $months, $words->thang_bat_dau_lam_viec, ['placeholder' => '', 'class' => 'form-control col-md-2 thang_bat_dau', 'id' => 'thang_bat_dau_lam_viec_' . $i]) !!}
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('nam_bat_dau_lam_viec', $years, $words->nam_bat_dau_lam_viec, ['placeholder' => '', 'class' => 'form-control col-md-2 nam_bat_dau', 'id' => 'nam_bat_dau_lam_viec_' . $i]) !!}
                                        </div>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Đến:</label>
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('thang_ket_thuc_lam_viec', $months, $words->thang_ket_thuc_lam_viec, ['placeholder' => '', 'class' => 'form-control col-md-2 thang_ket_thuc', 'id' => 'thang_ket_thuc_lam_viec_' . $i]) !!}
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::select('nam_ket_thuc_lam_viec', $years, $words->nam_ket_thuc_lam_viec, ['placeholder' => '', 'class' => 'form-control col-md-2 nam_ket_thuc', 'id' => 'nam_ket_thuc_lam_viec_' . $i]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Mô tả công việc</label>
                                        <div class="col-md-10">
                                            <textarea rows="4" cols="50" class="form-control mo_ta_{{ $i }}" id="mo_ta_{{ $i }}" placeholder="Mô tả ngắn về công việc"><?php echo $words->mo_ta; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='col-md-8'>
                                        <p id='kinh_nghiem_{{ $i }}_txt' class='kinh-nghiem-hide'> - {{ $words->vi_tri }} tại {{ $words->ten_cong_ty }} ( {{ $words->nam_bat_dau_lam_viec }} - {{ $words->nam_ket_thuc_lam_viec }} ) </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-danger pull-right kinh_nghiem_delete-btn" id="delete_kinh_nghiem_{{ $i }}">Hủy bỏ</div>
                                        <div class='btn btn-primary pull-right kinh_nghiem_edit-btn' id='edit_kinh_nghiem_{{ $i }}'>Chỉnh sửa</div>
                                        <div class="btn btn-primary pull-right kinh_nghiem_success-btn" id='success_kinh_nghiem_{{ $i }}' style='display:none;'>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            }else{
                            ?>
                            <div class="form-kinh-nghiem-group first-form" id="kinh_nghiem_lam_viec_0">
                                <input type="hidden" class="word_experience_json" id="kinh_nghiem_lam_viec_0_json" value="">
                                <div id='kinh_nghiem_lam_viec_0_content'>
                                    <input type="hidden" id="lam_viec_0_image" value="">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="ten_cong_ty" class="col-md-4 control-label">Tên công ty đã làm</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="ten_cong_ty_0" id="ten_cong_ty_0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vi_tri" class="col-md-4 control-label">Vị trí công việc</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="vi_tri" id="vi_tri_0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Thời gian làm</label>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Từ:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="thang_bat_dau" id="thang_bat_dau_lam_viec_0">
                                                <option value="0">--Chọn Tháng--</option>
                                                <option value="1">Tháng 1</option>
                                                <option value="2">Tháng 2</option>
                                                <option value="3">Tháng 3</option>
                                                <option value="4">Tháng 4</option>
                                                <option value="5">Tháng 5</option>
                                                <option value="6">Tháng 6</option>
                                                <option value="7">Tháng 7</option>
                                                <option value="8">Tháng 8</option>
                                                <option value="9">Tháng 9</option>
                                                <option value="10">Tháng 10</option>
                                                <option value="11">Tháng 11</option>
                                                <option value="12">Tháng 12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="nam_bat_dau" id="nam_bat_dau_lam_viec_0">
                                                <option value="0">--Chọn Năm--</option>
                                                <option value="2017">Năm 2017</option><option value="2016">Năm 2016</option><option value="2015">Năm 2015</option><option value="2014">Năm 2014</option><option value="2013">Năm 2013</option><option value="2012">Năm 2012</option><option value="2011">Năm 2011</option><option value="2010">Năm 2010</option><option value="2009">Năm 2009</option><option value="2008">Năm 2008</option><option value="2007">Năm 2007</option><option value="2006">Năm 2006</option><option value="2005">Năm 2005</option><option value="2004">Năm 2004</option><option value="2003">Năm 2003</option><option value="2002">Năm 2002</option><option value="2001">Năm 2001</option><option value="2000">Năm 2000</option><option value="1999">Năm 1999</option><option value="1998">Năm 1998</option><option value="1997">Năm 1997</option><option value="1996">Năm 1996</option><option value="1995">Năm 1995</option><option value="1994">Năm 1994</option><option value="1993">Năm 1993</option><option value="1992">Năm 1992</option><option value="1991">Năm 1991</option><option value="1990">Năm 1990</option><option value="1989">Năm 1989</option><option value="1988">Năm 1988</option><option value="1987">Năm 1987</option><option value="1986">Năm 1986</option><option value="1985">Năm 1985</option><option value="1984">Năm 1984</option><option value="1983">Năm 1983</option><option value="1982">Năm 1982</option><option value="1981">Năm 1981</option><option value="1980">Năm 1980</option><option value="1979">Năm 1979</option><option value="1978">Năm 1978</option><option value="1977">Năm 1977</option><option value="1976">Năm 1976</option><option value="1975">Năm 1975</option><option value="1974">Năm 1974</option><option value="1973">Năm 1973</option><option value="1972">Năm 1972</option><option value="1971">Năm 1971</option><option value="1970">Năm 1970</option><option value="1969">Năm 1969</option><option value="1968">Năm 1968</option><option value="1967">Năm 1967</option><option value="1966">Năm 1966</option><option value="1965">Năm 1965</option><option value="1964">Năm 1964</option><option value="1963">Năm 1963</option><option value="1962">Năm 1962</option><option value="1961">Năm 1961</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Đến:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="thang_ket_thuc" id="thang_ket_thuc_lam_viec_0">
                                                <option value="0">--Chọn Tháng--</option>
                                                <option value="1">Tháng 1</option>
                                                <option value="2">Tháng 2</option>
                                                <option value="3">Tháng 3</option>
                                                <option value="4">Tháng 4</option>
                                                <option value="5">Tháng 5</option>
                                                <option value="6">Tháng 6</option>
                                                <option value="7">Tháng 7</option>
                                                <option value="8">Tháng 8</option>
                                                <option value="9">Tháng 9</option>
                                                <option value="10">Tháng 10</option>
                                                <option value="11">Tháng 11</option>
                                                <option value="12">Tháng 12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="nam_ket_thuc" id="nam_ket_thuc_lam_viec_0">
                                                <option value="0">--Chọn Năm--</option>
                                                <option value="2017">Năm 2017</option><option value="2016">Năm 2016</option><option value="2015">Năm 2015</option><option value="2014">Năm 2014</option><option value="2013">Năm 2013</option><option value="2012">Năm 2012</option><option value="2011">Năm 2011</option><option value="2010">Năm 2010</option><option value="2009">Năm 2009</option><option value="2008">Năm 2008</option><option value="2007">Năm 2007</option><option value="2006">Năm 2006</option><option value="2005">Năm 2005</option><option value="2004">Năm 2004</option><option value="2003">Năm 2003</option><option value="2002">Năm 2002</option><option value="2001">Năm 2001</option><option value="2000">Năm 2000</option><option value="1999">Năm 1999</option><option value="1998">Năm 1998</option><option value="1997">Năm 1997</option><option value="1996">Năm 1996</option><option value="1995">Năm 1995</option><option value="1994">Năm 1994</option><option value="1993">Năm 1993</option><option value="1992">Năm 1992</option><option value="1991">Năm 1991</option><option value="1990">Năm 1990</option><option value="1989">Năm 1989</option><option value="1988">Năm 1988</option><option value="1987">Năm 1987</option><option value="1986">Năm 1986</option><option value="1985">Năm 1985</option><option value="1984">Năm 1984</option><option value="1983">Năm 1983</option><option value="1982">Năm 1982</option><option value="1981">Năm 1981</option><option value="1980">Năm 1980</option><option value="1979">Năm 1979</option><option value="1978">Năm 1978</option><option value="1977">Năm 1977</option><option value="1976">Năm 1976</option><option value="1975">Năm 1975</option><option value="1974">Năm 1974</option><option value="1973">Năm 1973</option><option value="1972">Năm 1972</option><option value="1971">Năm 1971</option><option value="1970">Năm 1970</option><option value="1969">Năm 1969</option><option value="1968">Năm 1968</option><option value="1967">Năm 1967</option><option value="1966">Năm 1966</option><option value="1965">Năm 1965</option><option value="1964">Năm 1964</option><option value="1963">Năm 1963</option><option value="1962">Năm 1962</option><option value="1961">Năm 1961</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="ten_cong_ty" class="col-md-2 control-label">Địa chỉ công ty</label>
                                            <div class="col-md-3">
                                                <select class="form-control thanh_pho" id="thanh_pho_0"><option value="0">--Chọn Tỉnh / Thành Phố--</option><option value="1">Hà Nội</option><option value="2">Hồ Chí Minh</option><option value="3">Đà Nẵng</option><option value="4">Hải Phòng</option><option value="5">Cần Thơ</option><option value="6">An Giang</option><option value="7">Bà Rịa Vũng Tàu</option><option value="8">Bạc Liêu</option><option value="9">Bắc Cạn</option><option value="10">Bắc Giang</option><option value="11">Hải Dương</option><option value="12">Bắc Ninh</option><option value="13">Bến Tre</option><option value="14">Bình Dương</option><option value="15">Bình Định</option><option value="16">Bình Phước</option><option value="17">Bình Thuận</option><option value="18">Cà Mau</option><option value="19">Cao Bằng</option><option value="20">Đắk Lắk</option><option value="21">Đăk Nông</option><option value="22">Điện Biên</option><option value="23">Đồng Nai</option><option value="24">Đồng Tháp</option><option value="25">Gia Lai</option><option value="26">Hà Giang</option><option value="27">Hà Nam</option><option value="28">Hà Tĩnh</option><option value="29">Hậu Giang</option><option value="30">Hòa Bình</option><option value="31">Hưng Yên</option><option value="32">Khánh Hòa</option><option value="33">Kiên Giang</option><option value="34">Kon Tum</option><option value="35">Lai Châu</option><option value="36">Lâm Đồng</option><option value="37">Lạng Sơn</option><option value="38">Lào Cai</option><option value="39">Long An</option><option value="40">Nam Định</option><option value="41">Nghệ An</option><option value="42">Ninh Bình</option><option value="43">Ninh Thuận</option><option value="44">Phú Thọ</option><option value="45">Phú Yên</option><option value="46">Quảng Bình</option><option value="47">Quảng Nam</option><option value="48">Quảng Ngãi</option><option value="49">Quảng Ninh</option><option value="50">Quảng Trị</option><option value="51">Sóc Trăng</option><option value="52">Sơn La</option><option value="53">Tây Ninh</option><option value="54">Thái Bình</option><option value="55">Thái Nguyên</option><option value="56">Thanh Hóa</option><option value="57">Huế</option><option value="58">Tiền Giang</option><option value="59">Trà Vinh</option><option value="60">Tuyên Quang</option><option value="61">Vĩnh Long</option><option value="62">Vĩnh Phúc</option><option value="63">Yên Bái</option></select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control quan_huyen" id="quan_huyen_0"><option value="0">--Chọn Quận / Huyện --</option></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-offset-1 image_company">
                                            <input type="file" class="company-img" id="company-img-0" style="display: none;">
                                        </div>
                                        <div class="col-md-8 col-sm-offset-1">
                                            <textarea rows="4" cols="50" class="form-control" class="mo_ta_0" id="mo_ta_0" placeholder="Mô tả ngắn về công việc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='col-md-8'>
                                        <p id='kinh_nghiem_0_txt' class='kinh-nghiem-hide'></p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='btn btn-primary pull-right kinh_nghiem_edit-btn' id='edit_kinh_nghiem_0' style='display:none;'>Chỉnh sửa</div>
                                        <div class="btn btn-primary pull-right kinh_nghiem_success-btn" id='success_kinh_nghiem_0'>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="text-center"><div class="btn btn-link" id="them_moi_kinh_nghiem"> + Thêm mới</div></div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Trình độ ngoại ngữ</div>
                        <div class="panel-body">
                            <input type="hidden" name="language" id="language" value="{{ $cv_user->language }}">
                            <div class="form-ngon-ngu-group">
                                <div class="form-group" id="ngoai_ngu_content">
                                <?php 
                                    if(strlen($cv_user->language) > 1){
                                    $cv_user->language=ltrim($cv_user->language,";");
                                    $languages = explode(";",$cv_user->language);
                                    for($i = 0; $i < count($languages); $i++){
                                        $langs = json_decode($languages[$i]);
                                        ?>
                                        <label for="ten_ngoai_ngu" data-json="{{ $languages[$i] }}" class="col-md-4 language-json" id="language-{{ $i }}"><div class="col-md-12"> - <span class="ngoai-ngu">{{ $langs->ten_ngoai_ngu }}</span> - Trình độ: <span class="trinh-do-ngoai-ngu">{{ $langs->trinh_do_ngoai_ngu }}</span><span class="language-delete" id="language-delete-{{ $i }}">&nbsp;x&nbsp;</span></div></label>
                                <?php
                                    }
                                }
                                ?>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="ten_ngoai_ngu" class="col-md-2 control-label">Tên ngoại ngữ</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" class="ten_ngoai_ngu" id="ten_ngoai_ngu">
                                    </div>
                                    <label for="trinh_do_ngoai_ngu" class="col-md-2 control-label">Trình độ</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" class="trinh_do_ngoai_ngu" id="trinh_do_ngoai_ngu">
                                    </div>
                                    <div class="btn btn-primary" id="add-language">Thêm mới</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Kỹ năng làm việc</div>
                        <div class="panel-body">
                            <input type="hidden" name="qualification" id="qualification" value="">
                            <div class="form-ngon-ngu-group">
                                <div class="form-group" id="qualification_content">
                                    <?php
                                        if(strlen($cv_user->qualification) > 0){
                                            $cv_user->qualification=ltrim($cv_user->qualification,";");
                                            $qualifications = explode(";",$cv_user->qualification);
                                            for($i = 0; $i < count($qualifications); $i++){
                                                $quals = json_decode($qualifications[$i]);
                                                ?>
                                                <label for="ten_ky_nang" data-json="{{ $qualifications[$i] }}" class="col-md-4 qualification-holder" id="qualification-{{ $i }}"><div class="col-md-12"> - <span class="ky-nang">{{ $quals->ten_ky_nang }}</span><span class="qualification-delete" id="qualification-delete-{{ $i }}">&nbsp;x&nbsp;</span></div></label>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        VD: Word, Excel, Powerpoint,...
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ten_ky_nang" class="col-md-2 control-label">Tên kỹ năng</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" class="ten_ky_nang" id="ten_ky_nang">
                                    </div>
                                    <div class="btn btn-primary" id="add-qualification">Thêm mới</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Sở thích - Tính cách</div>
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interests" class="col-md-12">Sở thích</label>
                                    <div class="col-md-12">
                                        {!! Form::text('interests', null, ['class' => 'form-control', 'id' => 'interests']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interests" class="col-md-12">Tính cách</label>
                                    <div class="col-md-12">
                                        {!! Form::text('references', null, ['class' => 'form-control', 'id' => 'references']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Mục tiêu nghề nghiệp</div>
                        <div class="panel-body">
                            <div class="form-career-objective-group">
                                {!! Form::text('career_objective', null, ['class' => 'form-control', 'id' => 'career_objective']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Hoạt động ngoại khóa</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    Mô tả một vài hoạt động mà bạn đã tham gia...
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::text('active', null, ['class' => 'form-control', 'id' => 'active']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Thêm ảnh ngoại khóa</div>
                        <div class="panel-body">
                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Thêm ảnh</label>
                                </div>
                                <div class="col-md-12">
                                    <div id="images-plus">
                                        <?php 
                                            $cv_user->images=rtrim($cv_user->images,";");
                                            $images = explode(";",$cv_user->images);
                                            for($i = 0; $i < count($images); $i++){
                                        ?>
                                            <img src="http://test.gmon.com.vn/?image={{ $images[$i] }}" class="img">
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <img src="http://test.gmon.com.vn/?image=icons8-Add-Image-50.png" id="images" class="img" style="height: 50px; width: 50px;">
                                    <input type="file" name="images-img[]" id="images-img" style="display: none;" multiple>
                                    {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <button class="btn btn-primary" id="submit-btn">Lưu lại</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/') }}/public/js/edit_curriculum_vitae.js"></script>
<script type="text/javascript">
    $(document).ready(function(){        
        CKEDITOR.instances['interests'].setData('<?php echo $cv_user->interests; ?>');
        CKEDITOR.instances['references'].setData('<?php echo $cv_user->references; ?>');
        CKEDITOR.instances['career_objective'].setData('<?php echo $cv_user->career_objective; ?>');
        CKEDITOR.instances['active'].setData('<?php echo $cv_user->active; ?>');
        
        $('.language-delete').click(function () {
            $(this).parent().parent().addClass('removed');
            $(this).parent().parent().hide();
        });
        
        $('.qualification-delete').click(function () {
            $(this).parent().parent().addClass('removed');
            $(this).parent().parent().hide();
        });
    });
</script>
@endsection


