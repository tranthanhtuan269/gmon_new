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
<div class="container show-curriculum-vitae-page" style="margin-top: 20px;">
  <div class="row">
      <div class="col-md-8">            
          <div class="row curriculumvitae">
              <div class="col-md-12">
                  <div class="row main-top">
                      <div class="col-md-5">
                          <?php 
                              if($curriculumvitae->avatarCV == null){
                                  $avatar = $curriculumvitae->avatarU;
                              }else{
                                  $avatar = $curriculumvitae->avatarCV;
                              }
                          ?>
                          @if(strlen($avatar) > 3)
                          @if (strpos($avatar, 'https') !== false)
                              <img src="{{ $avatar }}" width="200" height="200" class="img-circle">
                          @else
                          <img src="http://test.gmon.com.vn/?image={{ $avatar }}" width="200" height="200" class="img-circle
                          ">
                          @endif
                          @else
                          <img src="http://test.gmon.com.vn/?image=avatar.png" width="200" height="200" class="img-circle
                          ">
                          @endif
                      </div>
                      <div class="col-md-7">
                          <div class="row">
                              <div class="col-md-12">
                                  <h2 class="text-upper">{{ $curriculumvitae->name }}</h2>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  Ngày sinh: {{ $curriculumvitae->birthday }}
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  Giới tính: @if($curriculumvitae->gender == 0) Nữ @else Nam @endif
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  Tỉnh / Thành phố: {{ $curriculumvitae->city }}
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  Quận / Huyện: {{ $curriculumvitae->district }}
                              </div>
                          </div>
                      </div>
                  </div>
                  @if(strlen($curriculumvitae->education) > 3)
                  <div class="row">
                      <div class="col-md-12">
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
                                      <div class="col-md-4">Trường học </div>
                                      <div class="col-md-4">{{ $edu->truong_hoc }}</div>
                                      <div class="col-md-4">@if( $edu->student_process == 0) Đang học @else Đã tốt nghiệp @endif</div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-4">Thời gian học </div>
                                      <div class="col-md-4">Từ {{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau < 10) ? '0' . $edu->thang_bat_dau . '/' : '' }}{{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau > 9) ? '' . $edu->thang_bat_dau . '/' : '' }}{{ $edu->nam_bat_dau }} </div>
                                      <div class="col-md-4">@if( $edu->student_process == 0) Đến nay @else Đến {{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc < 10) ? '0' . $edu->thang_ket_thuc . '/' : '' }}{{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc > 9) ? '' . $edu->thang_ket_thuc . '/' : '' }}{{ $edu->nam_ket_thuc }} @endif </div>
                                  </div>
                                  @if( $edu->bang_cap != 2 && $edu->chuyen_nganh != "")
                                  <div class="row">
                                      <div class="col-md-4">Chuyên ngành </div>
                                      <div class="col-md-8">{{ $edu->chuyen_nganh }} </div>
                                  </div>
                                  @endif
                                  @if(isset($edu->loai_tot_nghiep) && $edu->loai_tot_nghiep != "--Chọn Loại tốt nghiệp--" && $edu->loai_tot_nghiep != "Chọn Loại tốt nghiệp")
                                  <div class="row">
                                      <div class="col-md-4">Thành tích học tập </div>
                                      <div class="col-md-8">{{ $edu->loai_tot_nghiep }}</div>
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
                      <div class="col-md-12">
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
                                      <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-5">Vị trí công việc</div>
                                              <div class="col-md-7">{{ $exp->vi_tri }}</div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-5">Tên đơn vị đã làm</div>
                                              <div class="col-md-7">{{ $exp->ten_cong_ty }}</div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-5">Thời gian làm</div>
                                              <div class="col-md-7">Từ {{ $exp->thang_bat_dau_lam_viec }}/{{ $exp->nam_bat_dau_lam_viec }} Đến {{ $exp->thang_ket_thuc_lam_viec }}/{{ $exp->nam_ket_thuc_lam_viec }}</div>
                                          </div>
                                          @if(strlen($exp->mo_ta) > 0)
                                          <div class="row">
                                              <div class="col-md-5">Mô tả công việc</div>
                                              <div class="col-md-7">{{ $exp->mo_ta }}</div>
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
                      <div class="col-md-12">
                          <div class="panel">
                              <div class="panel-heading">Kỹ năng</div>
                              <div class="panel-body">
                                  <div class="row">
                                  <?php 
                                      $curriculumvitae->qualification = ltrim($curriculumvitae->qualification, ';');
                                      $qualifications = explode(";",$curriculumvitae->qualification);
                                  ?>
                                      <div class="col-md-12">
                                          @if(count($qualifications) > 1)
                                          @for ($i = 0; $i < count($qualifications); $i++)
                                              <?php
                                                  if($qualifications[$i] != 'undefined'){
                                                      $qual = json_decode($qualifications[$i]);
                                                      echo ' - ' . $qual->ten_ky_nang . '<br />';
                                                  }
                                              ?>
                                          @endfor
                                          @else
                                              <?php 
                                              $qual = json_decode($qualifications[0]);
                                              echo $qual->ten_ky_nang;
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
                      <div class="col-md-12">
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
                                      <div class="col-md-6">{{ $lang->ten_ngoai_ngu }}</div>
                                      <div class="col-md-6">{{ $lang->trinh_do_ngoai_ngu }}</div>
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
                  <div class="row">
                      <div class="col-md-12">
                          <div class="panel">
                              <div class="panel-heading">Sở thích</div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-12"><?php echo $curriculumvitae->interests; ?></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="panel">
                              <div class="panel-heading">Tính cách</div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-12"><?php echo $curriculumvitae->references; ?></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @if(strlen($curriculumvitae->career_objective) > 1)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="panel">
                              <div class="panel-heading">Mục đích làm việc?</div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-12">
                                      <?php 
                                          echo $curriculumvitae->career_objective;
                                      ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endif
                  <div class="row">
                      <div class="col-md-12">
                          <div class="panel">
                              <div class="panel-heading">Hoạt động ngoại khóa</div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-md-12"><?php echo $curriculumvitae->active; ?></div>
                                  </div>
                                  <div class="row">
                                      <?php 
                                          if(strlen($curriculumvitae->images) > 0){
                                              $curriculumvitae->images = rtrim($curriculumvitae->images,";");
                                              $images = explode(";",$curriculumvitae->images);
                                              $i = 0;
                                              foreach ($images as $image) {
                                                  $i++;
                                                  if($i%4 == 0) break;
                                      ?>
                                      <div class="col-md-4"><img id="image-{{ $i }}" class="image-cv" data-id="{{ $i }}" src="http://test.gmon.com.vn/?image={{ $image }}" width="100%" height="102"></div>
                                      <?php 
                                      }
                                      }
                                      ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<style type="text/css">
  .image-company{
    position: relative;
    padding: 0;
  }

  .banner-img{
    padding: 11px;
  }

  .logo-img{
    position: absolute;
    bottom: 20px;
    left: 20px;
    border: 1px solid #eee;
    border-radius: 50%;
  }

  .company-info{
    padding: 11px;
  }

  .name-scholl{
    font-size: 20px;
    color: #3a78e5;
  }

  .address-scholl{
    font-size: 14px;
    color: #0b7e43;
  }

  .product-list{
    background-color: #fff;
    padding: 10px;
    z-index: -1;
  }
  .product-item{
    margin:10px;
    border:1px solid #dcdcdc;
    border-radius: 8px;
    background-color: #f6f6f6;
    padding-bottom: 10px;
  }
  .holder-detail,
  .holder-time{
    position: relative;
  }
  .show-detail{
    border-top-right-radius: 6px;
    position: absolute;
    right: 0px;
    top: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }
  .show-time{
    position: relative;
    right: 62px;
    text-align: right;
    line-height: 32px;
    color: #666;
    font-size: 13px;
  }

  .show-more{
    color: #3b77e5;
    cursor: pointer;
  }

  .hide-more{
    color: #3b77e5;
    cursor: pointer;
    display: none;
  }

  .show-info{
    font-size: 13px;
    padding: 0;
  }

  .show-more-holder{
    font-size: 13px;
    border-top: 1px solid #ccc;
    margin-top: 10px;
    padding-top: 10px;
    display: none;
  }

  .logo-image{
    border-radius: 50%;
  }

  .number-student,
  .link-web{
    font-size: 14px;
  }

  .product-panel{

  }

  .title-panel{
    padding: 10px;
    text-transform: uppercase;
    font-weight: bold;
    border: 1px solid #dcdcdc;
    background-color: #f6f6f6;
    margin: 10px 10px 0 10px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .content-panel{
    padding: 10px;
    margin: 0 10px;
    border-left: 1px solid #dcdcdc;
    border-right: 1px solid #dcdcdc;
    border-bottom: 1px solid #dcdcdc;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }

  .content-jobs{
    padding: 1px 0 0 0;
    margin: 0 10px;
    border-left: 1px solid #dcdcdc;
    border-right: 1px solid #dcdcdc;
    border-bottom: 1px solid #dcdcdc;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }

</style>

<script type="text/javascript">
  $(document).ready(function(){
    $flag_show = false;
    $('.show-more').click(function(){
      $('.show-more-holder').show();
      $('.show-more').hide();
      $('.hide-more').show();
    });
    $('.hide-more').click(function(){
      $('.show-more-holder').hide();
      $('.hide-more').hide();
      $('.show-more').show();
    });

    $('.filter-box-show').click(function(){
      if(!$flag_show){
        $('.filter-box-hide').show();
      }else{
        $('.filter-box-hide').hide();
      }
      $flag_show = !$flag_show;
    });

    $('#select-job-type li').click(function(){
      $('#select-job-type-btn').text($(this).text());
      $('#select-job-type-btn').attr('data-id', $(this).val());
    });

    $('#select-city li').click(function(){
      $('#select-city-btn').html('<span class="fa fa-map-marker"></span>' + $(this).text());
      $('#select-city-btn').attr('data-id', $(this).val());

      var citId = $(this).val();
      var request = $.ajax({
          url: "{{ url('') }}/getDistrictli/" + citId,
          method: "GET",
          dataType: "html"
      });
      request.done(function (msg) {
          $("#select-district").html(msg);
          $('#select-district li').off('click');
          $('#select-district li').click(function(){
              $('#select-district-btn').html('<span class="fa fa-map-marker"></span>' + $(this).text());
              $('#select-district-btn').attr('data-id', $(this).val());
          });
      });
      request.fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
      });
    });

    $('.form-search .btn-search').click(function(){
      var new_link = '{{ url("/") }}/showmore?';
      var search_type = $(this).attr('id') == 'search-cv-btn' ? 1 : 0;
      var job_selected = $('#select-job-type-btn').attr('data-id');
      var city_selected = $('#select-city-btn').attr('data-id');
      var district_selected = $('#select-district-btn').attr('data-id');

      if(job_selected > 0){
          new_link = new_link + 'job_type=' + job_selected + '&search_type=' + search_type;
          if(district_selected > 0){
              new_link += '&district=' + district_selected;
          }else{
              if(city_selected > 0){
                  new_link += '&city=' + city_selected;
              }
          }
      }else{
          if(district_selected > 0){
              new_link += 'district=' + district_selected + '&search_type=' + search_type;
          }else{
              if(city_selected > 0){
                  new_link += 'city=' + city_selected + '&search_type=' + search_type;
              }
          }
      }
      window.location.replace(new_link);
      return false;
    });
  });
</script>

@endsection
