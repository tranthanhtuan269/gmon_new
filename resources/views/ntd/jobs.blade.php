@extends('layouts.layout_ntd')

@section('content')
<div class="col-lg-9 right">
  <div class="title">
    <i class="fa fa-address-book" aria-hidden="true"></i>
    <span>Tin đã đăng</span>
  </div>
  <div class="content">
    @if(count($jobs) > 0)
    <div class="table-responsive">
      <table class="table">
          <thead>
              <tr>
                  <th></th>
                  <th>Vị trí tuyển dụng</th>
                  <th>Ứng tuyển</th>
                  <th>Ngày đăng</th>
                  <th>Hạn nộp</th>
                  <th>Xét duyệt</th>
                  <th>Công cụ</th>
              </tr>
          </thead>
          <tbody>
            <?php $count = 0; ?>
            @foreach($jobs as $job)
            <?php $count++; ?>
              <tr>
                  <td>{{ $count }}</td>
                  <td>{{ ucfirst($job->name) }}</td>
                  <td class="text-center">{{ $job->number }}</td>
                  <td>{{ date("d/m/Y", strtotime($job->created_at)) }}</td>
                  <td>{{ $job->expiration_date }}</td>
                  <td>Đã duyệt</td>
                  <td><a target="_blank" href="{{ url('/') }}/job/{{ $job->id }}/editJob">Chỉnh sửa</a></td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    @else
      <div class="info">Chưa có tuyển dụng nào được đăng!</div>
    @endif
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