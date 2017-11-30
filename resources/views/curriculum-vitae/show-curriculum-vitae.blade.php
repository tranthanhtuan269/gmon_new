@extends('layouts.layout_master')

@section('content')
<script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=212812479241763";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .header-homepage{
        background: none;
        background-size: cover;
        height: 595px;
        position: relative;
        font-family: Roboto, sans-serif;
    }

    .obj-name:first-letter {
        text-transform: uppercase;
    }

    .single p:first-letter {
        text-transform: uppercase;
    }

    #select-job-type{
      position: absolute;
      top: 36px;
      left: 0;
    }

    #select-city{
      position: absolute;
      top: 36px;
      left: 0;
    }

    #select-district{
      position: absolute;
      top: 36px;
      left: 0;
    }

    .fa-map-marker{
      margin-right: 10px;
    }

    .form-search{
      border: 1px solid #eee;
      padding: 5px 5px 0 5px;
      border-radius: 5px;
    }

    .form-group {
      margin-bottom: 5px;
      margin-right: 5px;
    }

    .form-search .form-group .btn{
      font-size: 12px;
      padding: 0;
      background-color: #fff;
    }

    .form-search .form-group #search-cv-btn{
      background-color: #f07007;
      border-color: #f07007;
      padding: .25rem .5rem;
    }

    .form-search .form-group #search-job-btn{
      background-color: #0275d8;
      border-color: #0275d8;
      padding: .25rem .5rem;
    }

    #select-city,
    #select-district,
    #select-job-type{
      z-index: 9000;
    }

    #select-city li,
    #select-district li,
    #select-job-type li{
      margin: 0 10px;
    }

    .filter-box-show{
      padding-left: 25px;
      padding-right: 25px;
      margin-top: 10px;
    }

    .filter-box-hide{
      padding-left: 25px;
      padding-right: 25px;
      display: none;
    }

</style>

<?php
  $job_types = \DB::table('job_types')
                  ->select('id', 'name')
                  ->where('teacher_show', '=', 1)
                  ->get();
  $cities = \DB::table('cities')
                  ->where('active', '=', 1)
                  ->select('id', 'name')
                  ->get();
  // dd($cvs);
?>
    <div class="container show-curriculum-vitae-page">
        <div class="row">
            <div class="col-12">            
                <div class="row curriculumvitae">
                    <div class="col-12">
                        <div class="row main-top">
                            <div class="col-5">
                                <?php 
                                    if($curriculumvitae->avatarCV == null){
                                        $avatar = $curriculumvitae->avatarU;
                                    }else{
                                        $avatar = $curriculumvitae->avatarCV;
                                    }
                                ?>
                                @if(strlen($avatar) > 3)
                                @if (strpos($avatar, 'https') !== false)
                                    <img src="{{ $avatar }}" width="100%" class="img-circle">
                                @else
                                <img src="http://test.gmon.com.vn/?image={{ $avatar }}" width="100%" class="img-circle
                                ">
                                @endif
                                @else
                                <img src="http://test.gmon.com.vn/?image=avatar.png" width="100%" class="img-circle
                                ">
                                @endif
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12">
                                        <b class="text-upper">{{ $curriculumvitae->name }}</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        Ngày sinh: {{ $curriculumvitae->birthday }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        Giới tính: @if($curriculumvitae->gender == 0) Nữ @else Nam @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        Tỉnh / Thành phố: {{ $curriculumvitae->city }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        Quận / Huyện: {{ $curriculumvitae->district }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(strlen($curriculumvitae->education) > 3)
                        <div class="row">
                            <div class="col-12">
                                <div class="panel">
                                    <div class="panel-heading">Quá trình học tập</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->education = ltrim($curriculumvitae->education, ';');
                                            $educations = explode(";",$curriculumvitae->education);
                                            foreach ($educations as $education) {
                                                if(strlen($education) <= 3) continue;
                                                $edu = json_decode($education);
                                        ?>
                                        <div class="row">
                                            <div class="col-12">Trường: <b style="text-transform: capitalize;">{{ $edu->truong_hoc }}</b></div>
                                        </div>
                                        @if( $edu->bang_cap != 2 && $edu->chuyen_nganh != "")
                                        <div class="row">
                                            <div class="col-12">Ngành: <b style="text-transform: capitalize;">{{ $edu->chuyen_nganh }}</b> </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-12">Từ <b>{{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau < 10) ? '0' . $edu->thang_bat_dau . '/' : '' }}{{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau > 9) ? '' . $edu->thang_bat_dau . '/' : '' }}{{ $edu->nam_bat_dau }}@if( $edu->student_process == 0)</b> đến <b>Nay</b> @else đến <b>{{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc < 10) ? '0' . $edu->thang_ket_thuc . '/' : '' }}{{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc > 9) ? '' . $edu->thang_ket_thuc . '/' : '' }}{{ $edu->nam_ket_thuc }} @endif </b></div>
                                        </div>
                                        @if(isset($edu->loai_tot_nghiep) && $edu->loai_tot_nghiep != "--Chọn Loại tốt nghiệp--" && $edu->loai_tot_nghiep != "Chọn Loại tốt nghiệp")
                                        <div class="row">
                                            <div class="col-12">Thành tích học tập: {{ $edu->loai_tot_nghiep }}</div>
                                        </div>
                                        @endif
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->word_experience) > 3)
                        <div class="row">
                            <div class="col-12">
                                <div class="panel">
                                    <div class="panel-heading">Kinh nghiệm làm việc</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->word_experience = ltrim($curriculumvitae->word_experience, ';');
                                            if(substr($curriculumvitae->word_experience, -1) == ';'){
                                                $curriculumvitae->word_experience=rtrim($curriculumvitae->word_experience,";");
                                            }
                                            $word_experiences = explode(";",$curriculumvitae->word_experience);
                                            foreach ($word_experiences as $word_experience) {
                                            $exp = json_decode($word_experience);
                                        ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">Vị trí: <b>{{ $exp->vi_tri }}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">Tại: <b>{{ $exp->ten_cong_ty }}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">Từ <b>{{ $exp->thang_bat_dau_lam_viec }}/{{ $exp->nam_bat_dau_lam_viec }}</b> đến <b>{{ $exp->thang_ket_thuc_lam_viec }}/{{ $exp->nam_ket_thuc_lam_viec }}</b></div>
                                                </div>
                                                @if(strlen($exp->mo_ta) > 0)
                                                <div class="row">
                                                    <div class="col-12">{{ $exp->mo_ta }}</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->qualification) > 3)
                        <div class="row">
                            <div class="col-12">
                                <div class="panel">
                                    <div class="panel-heading">Kỹ năng</div>
                                    <div class="panel-body">
                                        <div class="row">
                                        <?php 
                                            $curriculumvitae->qualification = ltrim($curriculumvitae->qualification, ';');
                                            $qualifications = explode(";",$curriculumvitae->qualification);
                                        ?>
                                            <div class="col-12">
                                                @if(count($qualifications) > 1)
                                                @for ($i = 0; $i < count($qualifications); $i++)
                                                    <?php
                                                        if($qualifications[$i] != 'undefined'){
                                                            $qual = json_decode($qualifications[$i]);
                                                            echo ' - <b style="text-transform: capitalize;">' . $qual->ten_ky_nang . '</b><br />';
                                                        }
                                                    ?>
                                                @endfor
                                                @else
                                                    <?php 
                                                    $qual = json_decode($qualifications[0]);
                                                    echo '<b style="text-transform: capitalize;">' . $qual->ten_ky_nang . '</b>';
                                                    ?>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->language) > 3)
                        <div class="row">
                            <div class="col-12">
                                <div class="panel">
                                    <div class="panel-heading">Ngoại ngữ</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->language = ltrim($curriculumvitae->language, ';');
                                            $languages = explode(";",$curriculumvitae->language);
                                            foreach ($languages as $language) {
                                            $lang = json_decode($language);
                                        ?>
                                        <div class="row">
                                            <div class="col-6">{{ $lang->ten_ngoai_ngu }}</div>
                                            <div class="col-6">{{ $lang->trinh_do_ngoai_ngu }}</div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection