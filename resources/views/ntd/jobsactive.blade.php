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
                  <td class="text-center">{{ $job->number }}</td>
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
      <div class="info">Không có tuyển dụng nào đang chạy!</div>
    @endif
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
  });
</script>
@endsection