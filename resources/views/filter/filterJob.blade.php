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
      top: 28px;
      left: -6px;
    }

    #select-city{
      position: absolute;
      top: 28px;
      left: -6px;
    }

    #select-district{
      position: absolute;
      top: 28px;
      left: -6px;
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

</style>

<?php
  $job_types = \DB::table('job_types')
                  ->select('id', 'name')
                  ->get();
  $cities = \DB::table('cities')
                  ->where('active', '=', 1)
                  ->select('id', 'name')
                  ->get();
  // dd($jobs);
?>
<div class="container product-list">
  <div class="row filter-box-show">
      <input type="text" class="form-control col-12" placeholder="Tìm kiếm...">
  </div>
  <div class="row filter-box-hide">
    <div class="form-search">
      <form class="form-inline">
          <div class="form-group">
              <div class="dropdown">
                  <button id="select-job-type-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" data-id="0">Chọn ngành nghề<span class="caret"></span></button>

                  <ul id="select-job-type" class="dropdown-menu job-type-select">
                      <li value="0">Chọn ngành nghề</li>
                      @foreach($job_types as $job_type)
                      <li value="{{ $job_type->id }}">{{ $job_type->name }}</li>
                      @endforeach
                  </ul>
              </div>
          </div>
          <div class="form-group">
              <div class="dropdown">
                  <div class="dropdown">
                      <button id="select-city-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                          Thành phố
                      </button>

                      <ul id="select-city" class="dropdown-menu city-select">
                          <li value="0">Thành phố</li>
                          @foreach($cities as $city)
                          <li value="{{ $city->id }}">{{ $city->name }}</li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="dropdown">
                  <button id="select-district-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                      Quận/Huyện
                  </button>

                  <ul id="select-district" class="dropdown-menu district-select">
                      <li value="0">Quận/Huyện</li>
                  </ul>
              </div>
          </div>
          <div class="form-group submit">
              <button type="submit" id="search-cv-btn" class="btn btn-primary btn-search">Tìm người</button>
              <button type="submit" id="search-job-btn" class="btn btn-primary btn-search">Tìm việc</button>
          </div>
      </form>
  </div>
  </div>
  @foreach($jobs as $job)
  <div class="row product-item">
    <div class="col-12 holder-detail"><div class="show-time">{{ $job->expiration_date }}</div><a class="btn btn-sm btn-primary show-detail" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}">Chi tiết</a></div>
    <div class="col-4 col-md-2"><img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt="Smiley face" height="100%" width="100%" class="logo-image"></div>
    <div class="col-8 col-md-10 show-info">
      <div class="row">
        <div class="col-12"><a href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}"><b style="color: #3a78e7; text-transform: capitalize;">{{ $job->name }}</b></a></div>
        <div class="col-12"><a href="{{ url('/') }}/company/{{ $job->id }}/info"><span style="color:#0c7f44; text-transform: capitalize;">{{ $job->companyname }}</span></a></div>
        <div class="col-12">Số lượng: {{ $job->number }}</div>
        <div class="col-12">Kinh nghiệm: <span class="show-more">Xem thêm</span><span class="hide-more">Thu nhỏ</span></div>
      </div>
    </div>
    <div class="col-12 show-more-holder">
      <div class="row">
        <div class="col-12"><?php echo $job->benefit; ?></div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<style type="text/css">
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

  .filter-box-show{
    padding-left: 25px;
    padding-right: 25px;
  }

  .filter-box-hide{
    padding-left: 25px;
    padding-right: 25px;
    display: none;
  }

  .logo-image{
    border-radius: 50%;
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