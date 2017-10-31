@extends('layouts.layout_uv')

@section('content')
<style type="text/css">
  .info span i{
    background: none;
  }
  .profile-05 .right .content{
    padding: 0 15px;
  }
</style>
<div class="col-lg-9 right">
    <div class="title">
        <i class="fa fa-address-book" aria-hidden="true"></i>
        <span>Việc làm phù hợp</span>
    </div>
    <div class="content" id="job-list">
      @foreach($jobsrelative as $job)
        <div class="item row">
          <div class="thumb col-lg-2">
              <img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt="avatar" />
          </div>
          <div class="text col-lg-10">
              <h3><a target="_blank" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}">{{ ucfirst($job->name) }} tại {{ ucfirst($job->companyname) }}</a></h3>
              <div class="info">
                  <span>
                      <i class="fa fa-map-marker" aria-hidden="true"></i>{{ $job->district }}, {{ $job->city }}
                  </span>
              </div>
              <div class="info">
                  <span>
                      <i class="fa fa-money" aria-hidden="true"></i> {{ $job->salary }}
                  </span>
                  <span>
                      <i class="fa fa-user" aria-hidden="true"></i> tuyển {{ $job->number }} người
                  </span>
              </div>
              <div class="info">
                  <span>
                      <i class="fa fa-briefcase" aria-hidden="true"></i> {{ $job->applied }} người đã ứng tuyển
                  </span>
                  <span>
                      <i class="fa fa-eye" aria-hidden="true"></i> {{ $job->views }} người đã xem
                  </span>
                  <span>
                      <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->expiration_date }}
                  </span>
              </div>
          </div>
        </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
  var site_url = $('base').attr('href');
  var $currentJob = 10;
  var $numberGet = 5;
  var $currentPossion = 0;
  var $newPossion = 0;
  $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();
      $newPossion = scroll;
      if($newPossion - $currentPossion > 2000){
          $currentPossion = $newPossion;
          $('.mass-content').show();
          $('.loader').show();
          var request = $.ajax({
              url: site_url + "/getJobRelative/?start=" + $currentJob  + "&number=" + $numberGet + "&salary_want={{ $salary_want }}&jobs_want={{ $jobs_want }}",
              method: "GET",
              dataType: "json"
          });

          request.done(function (msg) {
              $('.mass-content').hide();
              $('.loader').hide();
              if(msg['code'] == 200){
                  var $html = '';
                  var temp = '';
                  $(msg['jobs']).each(function( index ) {
                      $html += '<div class="item row">';
                        $html += '<div class="thumb col-lg-2">';
                            $html += '<img src="http://test.gmon.com.vn/?image='+ $(this)[0].logo +'" alt="avatar" />';
                        $html += '</div>';
                        $html += '<div class="text col-lg-10">';
                            $html += '<h3><a target="_blank" href="'+ site_url +'/job/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">'+ $(this)[0].name  +' tại '+ $(this)[0].companyname +'</a></h3>';
                            $html += '<div class="info">';
                                $html += '<span>';
                                    $html += '<i class="fa fa-map-marker" aria-hidden="true"></i>'+ $(this)[0].district +', '+ $(this)[0].city;
                                $html += '</span>';
                            $html += '</div>';
                            $html += '<div class="info">';
                                $html += '<span>';
                                    $html += '<i class="fa fa-money" aria-hidden="true"></i> '+ $(this)[0].salary;
                                $html += '</span>';
                                $html += '<span>';
                                    $html += '<i class="fa fa-user" aria-hidden="true"></i> tuyển '+ $(this)[0].number  +' người';
                                $html += '</span>';
                            $html += '</div>';
                            $html += '<div class="info">';
                                $html += '<span>';
                                    $html += '<i class="fa fa-briefcase" aria-hidden="true"></i> '+ $(this)[0].applied  +' người đã ứng tuyển';
                                $html += '</span>';
                                $html += '<span>';
                                    $html += '<i class="fa fa-eye" aria-hidden="true"></i> '+ $(this)[0].views +' người đã xem';
                                $html += '</span>';
                                $html += '<span>';
                                    $html += '<i class="fa fa-clock-o" aria-hidden="true"></i> '+ $(this)[0].expiration_date;
                                $html += '</span>';
                            $html += '</div>';
                        $html += '</div>';
                      $html += '</div>';
                  });
                  $currentJob += $numberGet;
                  $('#job-list').append($html);
              }
          });

          request.fail(function (jqXHR, textStatus) {
              alert("Request failed: " + textStatus);
          });
      }
  });
</script>
@endsection