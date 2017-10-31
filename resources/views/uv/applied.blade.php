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
        <span>Việc đã ứng tuyển</span>
    </div>
    <div class="content" id="job-list">
      @foreach($jobsvip as $job)
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
</script>
@endsection