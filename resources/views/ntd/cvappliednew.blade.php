@extends('layouts.layout_ntd')

@section('content')
<div class="col-lg-9 right">
  <div class="title">
    <i class="fa fa-address-book" aria-hidden="true"></i>
    <span>Hồ sơ mới ứng tuyển</span>
  </div>
  <div class="content">
    <div class="table-responsive">
      <table class="table sm-table">
          <thead>
              <tr>
                  <th></th>
                  <th>Vị trí</th>
              </tr>
          </thead>
          <tbody>
            <?php $count = 0; ?>
            @foreach($jobs as $job)
            <?php $count++; ?>
              <tr>
                  <td>{{ $count }}</td>
                  @if($count == 1)
                    <td><div class="jobshow jobactive" data-job="{{ $job->id }}">{{ $job->name }}</div></td>
                  @else
                    <td><div class="jobshow" data-job="{{ $job->id }}">{{ $job->name }}</div></td>
                  @endif
              </tr>
            @endforeach
          </tbody>
      </table>
      <table class="table lg-table">
          <thead>
              <tr>
                  <th></th>
                  <th>Tên ứng viên</th>
                  <th>Địa chỉ</th>
                  <th>Ngày sinh</th>
                  <th>Giới tính</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            @if(count($cvs) > 0)
            <?php $count = 0; ?>
            @foreach($cvs as $cv)
            <?php $count++; ?>
              <tr>
                  <td>{{ $count }}</td>
                  <td><div class="changeCVStatus" data-user="{{ $cv->user_id }}" data-job="{{ $cv->job_id }}" data-cv="{{ $cv->id }}">{{ $cv->username }}</div></td>
                  <td>{{ $cv->district }}, {{ $cv->city }}</td>
                  <td>{{ $cv->birthday }}</td>
                  <td>{{ ($cv->gender == 1) ? "Nam" : "Nữ" }}</td>
                  <td><div class="btn btn-sm btn-danger remove-btn" data-user="{{ $cv->user_id }}" data-job="{{ $cv->job_id }}">Xóa</div></td>
              </tr>
            @endforeach
            @else
              <tr>
                <td colspan="6">Chưa có ứng viên nào ứng tuyển!</td>
              </tr>
            @endif
          </tbody>
      </table>
    </div>
    
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

  $(document).ready(function(){
    $('.jobshow').click(function(){
      var job_id = $(this).attr('data-job');
      var _self = $(this);
      $('.mass-content').show();
      $('.loader').show();

      var request = $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/') }}/getCVAppliedNewOfJob",
          method: "GET",
          data: {
              'job_id': job_id
          },
          dataType: "json"
      });

      request.done(function (msg) {
          $('.mass-content').hide();
          $('.loader').hide();
          var $i = 0;
          if (msg.code == 200) {
            $('.jobshow').removeClass('jobactive');
            _self.addClass('jobactive');
            var $html = '';
            $(msg['cvs']).each(function( index ) {
              $i++;
              $html += '<tr>';
                  $html += '<td>' + $i + '</td>';
                  $html += '<td><div class="changeCVStatus" data-user="' + $(this)[0].user_id + '" data-job="' + $(this)[0].job_id + '" data-cv="' + $(this)[0].id + '">' + $(this)[0].username + '</div></td>';
                  $html += '<td>' + $(this)[0].district + ', ' + $(this)[0].city + '</td>';
                  $html += '<td>' + $(this)[0].birthday + '</td>';
                  $html += '<td>';
                  ($(this)[0].gender == 1) ? $html += 'Nam' : $html += 'Nữ';
                  $html += '</td>';
                  $html += '<td><div class="btn btn-sm btn-danger remove-btn" data-user="' + $(this)[0].user_id + '" data-job="' + $(this)[0].job_id + '">Xóa</div></td>';
              $html += '</tr>';
            });
            $('.lg-table tbody').html($html);
            addEvent();
          }
      });

      request.fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
      });
    });

    function addEvent(){
      $('.remove-btn').off('click');
      $('.remove-btn').click(function(){
        var user_id = $(this).attr('data-user');
        var job_id = $(this).attr('data-job');
        var _self = $(this);
        $('.mass-content').show();
        $('.loader').show();

        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/') }}/removeApplied",
            method: "POST",
            data: {
                'user_id': user_id,
                'job_id': job_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            $('.mass-content').hide();
            $('.loader').hide();
            if (msg.code == 200) {
                _self.parent().parent().hide();
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
      });

      $('.changeCVStatus').off('click');
      $('.changeCVStatus').click(function(){
        var user_id = $(this).attr('data-user');
        var job_id = $(this).attr('data-job');
        var cv_id = $(this).attr('data-cv');
        var _self = $(this);
        $('.mass-content').show();
        $('.loader').show();

        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/') }}/changeToViewed",
            method: "POST",
            data: {
                'user_id': user_id,
                'job_id': job_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            $('.mass-content').hide();
            $('.loader').hide();
            if (msg.code == 200) {
                window.location.href = site_url + "/curriculumvitae/view/" + cv_id;
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
      });
    }

    addEvent();
  });
</script>
@endsection