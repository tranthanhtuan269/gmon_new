@extends('layouts.layout_uv')

@section('content')
<div class="col-lg-9 right">
    <div class="title">
        <i class="fa fa-address-book" aria-hidden="true"></i>
        <span>Trang chính</span>
    </div>
    <div class="content" id="job-list">
      @foreach($jobsvip as $job)
        <div class="item-01">
            <div class="thumbnail">
              <a target="_blank" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}">
                <img src="http://test.gmon.com.vn/?image={{ $job->banner }}" alt="{{ $job->jobName }}">
              </a>
                @if(strlen($job->sologan) > 0)
                <div class="caption">
                    <p>
                        {{ $job->sologan }}
                    </p>
                </div>
                @endif
            </div>
            <div class="info">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-8 name">
                           <a target="_blank" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}">{{ $job->jobName }} tại {{ $job->companyName }}</a>
                       </div>
                       <div class="col-md-4 tool">
                            <span class="tool-work">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="red">{{ $job->views }}</span>
                                đã xem
                            </span>
                            <span class="tool-work">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="red">{{ $job->applied }}</span>
                                đã ứng tuyển
                            </span>
                       </div>
                   </div>
               </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
  var site_url = $('base').attr('href');
  var $currentJob = 5;
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
              url: "{{ URL::to('/') }}/getJobWithBanner/?start=" + $currentJob  + "&number=" + $numberGet + "&<?php echo parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY); ?>",
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
                      $html += '<div class="item-01">';
                        $html += '<div class="thumbnail">';
                          $html += '<a target="_blank" href="{{ url('/') }}/job/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">'
                            $html += '<img src="http://test.gmon.com.vn/?image='+ $(this)[0].banner +'" alt="'+ $(this)[0].jobName +'">';
                          $html += '</a>';
                            var $temp = $(this)[0].sologan + "";
                            if($temp.length > 0 && $temp != "null"){
                              $html += '<div class="caption">';
                                  $html += '<p>';
                                    $html += $temp;
                                  $html += '</p>';
                              $html += '</div>';
                            }

                        $html += '</div>';
                        $html += '<div class="info">';
                           $html += '<div class="container-fluid">';
                               $html += '<div class="row">';
                                   $html += '<div class="col-md-8 name">';
                                       $html += '<a target="_blank" href="{{ url('/') }}/job/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">'+ $(this)[0].jobName +' tại '+ $(this)[0].companyName +'</a>';
                                   $html += '</div>';
                                   $html += '<div class="col-md-4 tool">';
                                        $html += '<span class="tool-work">';
                                            $html += '<i class="fa fa-eye" aria-hidden="true"></i>';
                                            $html += '<span class="red">'+ $(this)[0].views +'</span>';
                                            $html += ' đã xem';
                                        $html += '</span>';
                                        $html += '<span class="tool-work">';
                                            $html += '<i class="fa fa-briefcase" aria-hidden="true"></i>';
                                            $html += '<span class="red">'+ $(this)[0].applied +'</span>';
                                            $html += ' đã ứng tuyển';
                                        $html += '</span>';
                                   $html += '</div>';
                               $html += '</div>';
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