@extends('layouts.layout_uv')

@section('content')
<?php //dd($jobsvip); ?>
<div class="wrapper-homepage profile-01 profile-05">
   <div class="container">
       <div class="row">
           <div class="left col-lg-3">
                <div class="avatar">
                    <img src="http://test.gmon.com.vn/?image={{ $myInfo->avatar }}" alt="Avatar">
                </div>
                <div class="name">
                    <h3>{{ \Auth::user()->name }}</h3>
                    <h4>{{ $myInfo->school }}</h4>
                </div>
                <div class="job">
                    <h3>Quản lý tài khoản</h3>
                    <ul>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Việc làm</a></li>
                        <li><a href="">Cập nhật hồ sơ</a></li>
                        <li><a href="">Việc đã ứng tuyển</a></li>
                        <li><a href="">Việc làm phù hợp</a></li>
                        <li><a href="">Nhà tuyển dụng đã theo dõi</a></li>
                        <li><a href="">Nhà tuyển dụng mới</a></li>
                    </ul>
                </div>
               <div class="hot-job">
                   <h3>Việc đang hot</h3>
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
                   <img src="http://test.gmon.com.vn/?image=job.jpg" alt="">
               </div>
           </div>
           <div class="col-lg-9 right">
                <div class="title">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span>Trang chính</span>
                </div>
                <div class="content">
                  @foreach($jobsvip as $job)
                    <div class="item-01">
                        <div class="thumbnail">
                            <img src="http://test.gmon.com.vn/?image={{ $job->banner }}" alt="{{ $job->jobName }}">
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
                                       <a href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}">{{ $job->jobName }} tại {{ $job->companyName }}</a>
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
       </div>
   </div>
</div>
@endsection