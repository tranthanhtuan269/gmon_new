@extends('layouts.layout_admin_uv')

@section('content')
<div class="wrapper-homepage profile-01 profile-05">
   <div class="container">
       <div class="row">
           <div class="left col-lg-3">
                <div class="avatar">
                    @if(isset($myInfo->avatar) && strlen($myInfo->avatar) > 3)
                      @if (strpos($myInfo->avatar, 'https') !== false)
                          <img src="{{ $myInfo->avatar }}" alt="Avatar">
                      @else
                      <img src="http://test.gmon.com.vn/?image={{ $myInfo->avatar }}" alt="Avatar">
                      @endif
                    @else
                      <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar">
                    @endif
                </div>
                <div class="name">
                    <h3>{{ \Auth::user()->name }}</h3>
                    <h4>{{ $myInfo->school }}</h4>
                </div>
                <div class="job">
                    <h3>Việc làm</h3>
                    <ul>
                        <li><a href=""><i class="fa fa-address-book" aria-hidden="true"></i> Tin đã đăng</a></li>
                        <li><a href=""><i class="fa fa-heart" aria-hidden="true"></i> Hồ sơ ứng tuyển mới</a></li>
                        <li><a href=""><i class="fa fa-briefcase" aria-hidden="true"></i> Hồ sơ ứng tuyển</a></li>
                        <li><a href=""><i class="fa fa-tag" aria-hidden="true"></i> Hồ sơ phỏng vấn</a></a></li>
                        <li><a href=""><i class="fa fa-star" aria-hidden="true"></i> Hồ sơ đã lưu</a></a></li>
                        <li><a href=""><i class="fa fa-circle-o" aria-hidden="true"></i> Thay đổi giao diện</a></li>
                        <li><a href=""><i class="fa fa-lock" aria-hidden="true"></i> Tài khoản</a></li>
                        <li><a href=""><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>
                    </ul>
                </div>
               <div class="hot-job">
                   <h3>việc đang hot</h3>
                   <ul>
                      @foreach($companies as $company)
                       <li>
                           <div class="image">
                               <img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="{{ url('/') }}/company/{{ $company->id }}/{{ $company->slug }}">{{ $company->name }}</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                      @endforeach
                   </ul>
               </div>
               <div class="image-adv">
                   <img src="{{ url('/') }}/public/assets/images/job.jpg" alt="">
               </div>
           </div>
           <div class="col-lg-9 right">
                <div class="title">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span>Trang chính</span>
                </div>
                <div class="content">
                    @foreach($jobsvip as $jobvip)
                    <div class="item-01">
                        <div class="thumbnail">
                            <img src="http://test.gmon.com.vn/?image={{ $jobvip->banner }}" alt="">
                            @if(strlen($jobvip->sologan) > 0)
                            <div class="caption">
                                <p>
                                    {{ $jobvip->sologan }}
                                </p>
                            </div>
                            @endif
                        </div>
                        <div class="info">
                           <div class="container-fluid">
                               <div class="row">
                                   <div class="col-md-8 name">
                                       <a href="{{ url('/') }}/job/{{ $jobvip->id }}/{{ $jobvip->slug }}">{{ $jobvip->jobName }} tại {{ $jobvip->companyName }}</a>
                                   </div>
                                   <div class="col-md-4 tool">
                                        <span class="tool-work">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            <span class="red">{{ $jobvip->applied }}</span>
                                            Applied
                                        </span>
                                        <span class="tool-work">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span class="red">{{ $jobvip->views }}</span>
                                            Lượt xem
                                        </span>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                    @endforeach
                </div>
           </div>
       </div>
   </div>
</div>

<script type="text/javascript">
  var site_url = $('base').attr('href');
  var $currentJob = 10;
  var $numberGet = 10;
  var $currentPossion = 0;
  var $newPossion = 0;
  $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();
      $newPossion = scroll;
      if($newPossion - $currentPossion > 680){
          $currentPossion = $newPossion;
          $('.mass-content').show();
          $('.loader').show();
          var request = $.ajax({
              url: "{{ URL::to('/') }}/getJob/?start=" + $currentJob  + "&number=" + $numberGet + "&<?php echo parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY); ?>",
              method: "GET",
              dataType: "json"
          });

          request.done(function (msg) {
              $('.mass-content').hide();
              $('.loader').hide();
              if(msg['code'] == 200){
                  var $html = '';
                  $(msg['jobs']).each(function( index ) {
                      $html += '<li class="list-item">';
                          $html += '<div class="img-item">';
                              $html += '<a href="' + site_url + '/job/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">';
                                  $html += '<span class="wp-avatar">';
                                          $html += '<img src="http://test.gmon.com.vn/?image='+ $(this)[0].logo +'" alt="">';
                                  $html += '</span>';
                             $html += '</a>';
                          $html += '</div>';

                          $html += '<div class="content-item">';
                              $html += '<a href="' + site_url + '/job/'+ $(this)[0].id +'/'+ $(this)[0].slug +'"><h4>'+ $(this)[0].name +'</h4></a>';
                              $html += '<p>';
                                  $html += '<span>Mức lương: </span><span class="grey-color">'+ $(this)[0].salary +'</span>';
                              $html += '</p>';
                              $html += '<p>';
                                  $html += '</p><div class="title-list">';
                                      $html += '<span>Số lượng: </span><span class="grey-color">'+ $(this)[0].number +'</span>';
                                  $html += '</div>';
                                  $html += '<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="grey-color">'+ $(this)[0].district +', '+ $(this)[0].city +'</span></a>';
                              $html += '<p></p>';
                              $html += '<p>';
                                  $html += '</p><div class="title-list">';
                                      $html += '<span>Nhận hồ sơ đến hết:</span>';
                                  $html += '</div>';
                                  $html += '<a href="#"><i class="fa fa-clock-o"></i><span class="grey-color">'+ $(this)[0].expiration_date +'</span></a>';
                              $html += '<p></p>';
                          $html += '</div>';
                          $html += '<div class="last-item">';
                              $html += '<span class="profile_num grey1-color">Lượt xem: <i class="fa fa-eye"></i><span class="grey-color">'+ $(this)[0].views +'</span></span>';
                              $html += '<span class="grey1-color">Hồ sơ ứng tuyển: <span class="grey-color">'+ $(this)[0].applied +'</span></span>';
                          $html += '</div>';
                          $html += '<div class="new-bg">';
                                  $html += 'Mới';
                          $html += '</div>';
                      $html += '</li>';
                  });
                  $currentJob += $numberGet;
                  $('.ul-content').append($html);
              }
          });

          request.fail(function (jqXHR, textStatus) {
              alert("Request failed: " + textStatus);
          });
      }
  });
</script>
@endsection