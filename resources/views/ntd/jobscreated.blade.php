@extends('layouts.layout_ntd')

@section('content')
<div class="col-lg-9 right">
  <div class="title">
    <i class="fa fa-address-book" aria-hidden="true"></i>
    <span>Tin đã tạo</span>
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
                  <th>Công cụ</th>
              </tr>
          </thead>
          <tbody>
            <?php $count = 0; ?>
            @foreach($jobs as $job)
            <?php $count++; ?>
              <tr>
                  <td>{{ $count }}</td>
                  <td><a href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}"> {{ ucfirst($job->name) }}</a></td>
                  <td class="text-center showCV" data-job="{{ $job->id }}">{{ $job->applied }}</td>
                  <td>{{ date("d/m/Y", strtotime($job->created_at)) }}</td>
                  <td>{{ $job->expiration_date }}</td>
                  <td>
                    <span class="refresh-job" data-job="{{ $job->id }}">Làm mới</span>
                    <a target="_blank" href="{{ url('/') }}/job/{{ $job->id }}/editJob">Sửa</a>
                    <span class="remove-job" data-job="{{ $job->id }}">Xóa</span>
                  </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    @else
      <div class="info">Chưa có tuyển dụng nào được tạo!</div>
    @endif
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Danh sách ứng tuyển</h4>
      </div>
      <div class="modal-body">
        <table class="table" id="CV-list">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Tên ứng viên</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Ngày sinh</th>
              <th scope="col">Giới tính</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var site_url = $('base').attr('href');
  $(document).ready(function(){
    $('.refresh-job').click(function(){
      var job_id = $(this).attr('data-job');
      var _self = $(this);
      $('.mass-content').show();
      $('.loader').show();

      var request = $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/') }}/refreshJob",
          method: "POST",
          data: {
              'job_id': job_id
          },
          dataType: "json"
      });

      request.done(function (msg) {
          $('.mass-content').hide();
          $('.loader').hide();
          if (msg.code == 200) {
            swal("Thông báo", "Làm mới thành công!", "success");
          }
      });

      request.fail(function (jqXHR, textStatus) {
        $('.mass-content').hide();
        $('.loader').hide();
        swal("Thông báo", "Làm mới không thành công!", "error");
      });
    });

    $('.remove-job').click(function(){
      var job_id = $(this).attr('data-job');
      var _self = $(this);
      $('.mass-content').show();
      $('.loader').show();

      var request = $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/') }}/removeJob",
          method: "POST",
          data: {
              'job_id': job_id
          },
          dataType: "json"
      });

      request.done(function (msg) {
          $('.mass-content').hide();
          $('.loader').hide();
          if (msg.code == 200) {
            swal("Thông báo", "Xóa thành công!", "success");
            _self.parent().parent().hide();
          }
      });

      request.fail(function (jqXHR, textStatus) {
        $('.mass-content').hide();
        $('.loader').hide();
        swal("Thông báo", "Xóa không thành công!", "error");
      });
    });

    $('.showCV').click(function(){
      var job_id = $(this).attr('data-job');
      var _self = $(this);
      $('.mass-content').show();
      $('.loader').show();

      var request = $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/') }}/getCVAppliedOfJob",
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
            $('#CV-list tbody').html($html);
            addEvent();
          }
      });

      request.fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
      });

      $('#myModal').modal('show');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').hide();
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
</script>
@endsection