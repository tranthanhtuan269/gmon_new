@extends('layouts.layout')

@section('content')
    <header class="header-spa">
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-md-3">
                        <a target="_self" href="" class="logo row"><img src="http://test.gmon.com.vn/?image=home.png" alt=""></a>
                    </div>
                    <div class="col-md-9 search-form">
                        <div class="">
                            <div class="col-md-9">
                                <form class="search">
                                    <select class="col-md-4" id="job-select">
                                        <option value="0">Chọn ngành nghề</option>
                                        <option value="1">Làm bán thời gian</option>
                                        <option value="2">Bán hàng</option>
                                        <option value="3">Marketing-PR</option>
                                        <option value="4">Bảo vệ</option>
                                        <option value="5">Du lịch</option>
                                        <option value="6">Sale/Marketing online</option>
                                        <option value="7">Promotion Girl(PG)</option>
                                        <option value="8">Thực tập</option>
                                        <option value="9">Phụ bếp</option>
                                        <option value="10">Người giúp việc</option>
                                        <option value="11">Bếp chính</option>
                                        <option value="12">Nhân viên spa</option>
                                        <option value="13">Pha chế</option>
                                        <option value="14">Bell man</option>
                                        <option value="15">Chăm sóc khách hàng</option>
                                        <option value="16">Giao nhận, ship</option>
                                        <option value="17">Kinh doanh</option>
                                        <option value="18">Hành chính nhân sự</option>
                                        <option value="19">Phiên dịch</option>
                                        <option value="20">Gia sư</option>
                                        <option value="21">Hướng dẫn viên</option>
                                        <option value="22">Giám sát, quản lý</option>
                                        <option value="23">Phục vụ, bồi bàn</option>
                                        <option value="24">Telesale</option>
                                        <option value="25">Cộng tác viên</option>
                                        <option value="26">Phụ bếp</option>
                                        <option value="27">Lễ tân</option>
                                        <option value="28">Thu ngân</option>
                                        <option value="29">Marketing online</option>
                                        <option value="30">Phát tờ rơi</option>
                                        <option value="31">Buồng phòng</option>
                                        <option value="32">Pha chế</option>
                                        <option value="33">Shipper</option>
                                        <option value="34">Kế toán</option>
                                    </select>
                                    <select id="tinh-select" class="col-md-3">
                                        <option value="0">Thành phố</option>
                                        <option value="1">Hà Nội</option>
                                        <option value="2">Hồ Chí Minh</option>
                                        <option value="3">Đà Nẵng</option>
                                        <option value="4">Hải Phòng</option>
                                    </select>
                                    <select id="quanhuyen-select" class="col-md-3">
                                        <option value="0">Quận/Huyện</option>
                                    </select>
                                    <button class="submit hidden-xs search-btn"><i></i></button>
                                    <button class="submit visible-xs search-btn" style="width: auto;border:1px solid #EBEAEA;padding:5px 7px;height: auto;margin:auto;margin-top: 10px;background-color: #F5F5F5;color:#A8A8A8;border-radius: 4px">Tìm kiếm</button>
                                </form>
                                <div class="city">
                                    <a target="_self" href="{{ url('/') }}/home?city=1">Hà Nội</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=2">TP HCM</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=3">Đà Nẵng</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=4">Hải Phòng</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=14">Bình Dương</a>
                                </div>
                            </div>
                            <div class="col-md-3 clearfix">
                                <div class="contact row">
                                    <p><i></i>0977898312</p>
                                    <p><i></i>vieclamhn@gmon.vn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bot">
            <div class="container clearfix">
                <div class="row">
                    <div class="menu-left">
                        <a target="_self" href="http://spa.gmon.com.vn"><i></i>Spa</a>
                        <a target="_self" href="http://gmon.com.vn/home?field=1"><i></i>Khách sạn</a>
                        <a target="_self" href="http://gmon.com.vn/home?field=2"><i></i>Nhà hàng</a>
                        <a target="_self" href="http://gmon.com.vn/home?field=4"><i></i>Doanh nghiệp</a>
                        <a target="_self" href="http://gmon.com.vn/home?field=5"><i></i>Nhân sự tài năng</a>
                    </div>
                    <div class="menu-right">
                        @if (Auth::guest())
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Tạo hồ sơ</a>
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Trang tuyển dụng</a>
                        @else
                            @if(Auth::user()->hasRole('user'))
                            <a target="_self" href="{{ url('/') }}/curriculumvitae/create"><i></i>Tạo hồ sơ</a>
                            @endif
                            @if(Auth::user()->hasRole('poster'))
                            @if($company_id == -1)
                            <a target="_self" href="{{ url('/') }}/company/create"><i></i>Trang tuyển dụng</a>
                            @else
                            <a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info"><i></i>Trang tuyển dụng</a>
                            <a target="_self" href="{{ url('/') }}/job/create"><i></i>Đăng tuyển dụng</a>
                            @endif
                            @endif
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </header>

    <div class="container list-info">
        @if(count($cvs) > 0)
        <div class="vip-candidates row">
            <div class="title clearfix"><span>Ứng viên VIP <i class="hot"></i></span></div>
            <div class="clearfix wrapper" id="wrapper-candidates">
                @foreach($cvs as $cv)
                <div class="item-u" >
                    <a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv->id }}" onmouseenter="onFocusCandidates(event)" onmouseleave ="onDisFocusCandidates(event)">
                        @if(strlen($cv->avatar) > 0)
                        <div class="img"><img src="http://test.gmon.com.vn/?image={{ $cv->avatar }}" alt=""></div>
                        @else
                        <div class="img"><img src="http://test.gmon.com.vn/?image=avatar.png" alt=""></div>
                        @endif
                        <p class="name text-center">{{ $cv->username }}</p>
                        <p class="university text-center">{{ $cv->school }}</p>
                        <div class="view">
                            <div class="info">
                                <div class="sub-img"><div class="border">
                                        @if(strlen($cv->avatar) > 0)
                                        <img src="http://test.gmon.com.vn/?image={{ $cv->avatar }}" alt="">
                                        @else
                                        <img src="http://test.gmon.com.vn/?image=avatar.png" alt="">
                                        @endif
                                    </div></div>
                                <p>{{ $cv->username }}</p>
                                <p>{{ $cv->birthday }}</p>
                                <!-- <p>CLB AIESEC Hà Nội</p> -->
                            </div>
                            <div class="link">
                                Xem hồ sơ của tôi &rsaquo;
                            </div>
                        </div>
                    </a>
                </div>  
                @endforeach
            </div>
        </div>
        @endif
        @if(count($jobsvip1) > 0)
        <div class="new-jobs row">
            <div class="title clearfix"><span>Việc làm HOT <i class="hot"></i></span></div>
            <div class="wrapper" id="wrapper3">
                <div style="width: 100%;overflow: visible;display: inline-block;position: relative;">
                    @foreach($jobsvip1 as $job)
                    <div class="row item-job">
                        <div class="job-image">
                            <div style="padding: 10%;"><img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></div>
                        </div>
                        <div class="job-content">
                            <div class="job-name"><a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}"> {{ $job->name }} </a></div>
                            <div class="job-info">
                                <span><i></i>Số lượng: {{ $job->number }}</span>
                                <span><i></i>{{ $job->district }}, {{ $job->city }}</span>
                                <span class="active"><i></i>Hạn nộp: {{ $job->expiration_date }}</span>
                            </div>
                            <span class="job-hot">HOT</span>
                            <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}" class="job-view">Chi tiết </a>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
        @endif
        @if(count($jobsvip2) > 0)
        <div class="new-jobs row">
            <div class="title clearfix"><span>Đang tuyển GẤP <i class="hot"></i></span></div>
            <div class="wrapper" id="wrapper3">
                <div style="width: 100%;overflow: visible;display: inline-block;position: relative;">
                    @foreach($jobsvip2 as $job)
                    <div class="row item-job">
                        <div class="job-image">
                            <div style="padding: 10%;"><img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></div>
                        </div>
                        <div class="job-content">
                            <div class="job-name"><a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}"> {{ $job->name }} </a></div>
                            <div class="job-info">
                                <span><i></i>Số lượng: {{ $job->number }}</span>
                                <span><i></i>{{ $job->district }}, {{ $job->city }}</span>
                                <span class="active"><i></i>Hạn nộp: {{ $job->expiration_date }}</span>
                            </div>
                            <span class="job-hot">HOT</span>
                            <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}" class="job-view">Chi tiết </a>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
        @endif
        @if(count($jobs) > 0)
        <div class="new-jobs row">
            <div class="title clearfix"><span>Việc làm mới </span><i class="new"></i></div>
            <div class="wrapper" id="wrapper3">
                <div style="width: 100%;overflow: visible;display: inline-block;position: relative;">
                    @foreach($jobs as $job)
                    <div class="row item-job">
                        <div class="job-image">
                            <div style="padding: 10%;"><img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></div>
                        </div>
                        <div class="job-content">
                            <div class="job-name"><a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}"> {{ $job->name }} </a></div>
                            <div class="job-info">
                                <span><i></i>Số lượng: {{ $job->number }}</span>
                                <span><i></i>{{ $job->district }}, {{ $job->city }}</span>
                                <span class="active"><i></i>Hạn nộp: {{ $job->expiration_date }}</span>
                            </div>
                            <span class="job-hot">HOT</span>
                            <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}" class="job-view">Chi tiết </a>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
        @endif
        @if(count($companies) > 0)
        <div class="new-employer row">
            <div class="title clearfix"><span>Nhà tuyển dụng mới</span> <i class="new"></i></div>
            <div class="wrapper" id="wrapper2">
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div class="contents" id="contents-employer">
                        @foreach($companies as $company)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info">
                                    <span class="icon-new"><img src="http://test.gmon.com.vn/?image=icon-new.png" alt=""></span>
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $company->name }}</p></div>
                                        <div class="work-view">
                                            <p>Xem thêm &rsaquo;&rsaquo;</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="container list-number">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Hồ sơ ứng viên</p>
                        <p class="number">4626 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Freelance</p>
                        <p class="number">1126 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng</p>
                        <p class="number">1452 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng đại học</p>
                        <p class="number">2332 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="footer-top row">
                <div class="col-md-4 col-xs-6 footer-col">
                    <p class="title">về gmon</p>
                    <p><a target="_self" href="">Giới thiệu</a></p>
                    <p><a target="_self" href="">Việc làm</a></p>
                    <p><a target="_self" href="">Nhà tuyển dụng</a></p>
                    <p><a target="_self" href="">Hồ sơ ứng viên</a></p>
                    <p><a target="_self" href="">Nhà tuyển dụng</a></p>
                </div>
                <div class="col-md-3 col-xs-6 footer-col">
                    <p class="title">công cụ</p>
                    <p><a target="_self" href="">Hồ sơ</a></p>
                    <p><a target="_self" href="">Việc làm của tôi</a></p>
                    <p><a target="_self" href="">Thông báo việc làm</a></p>
                    <p><a target="_self" href="">Phản hồi</a></p>
                    <p><a target="_self" href="">Tư vấn nghề nghiệp</a></p>
                </div>
                <div class="col-md-5 contact col-xs-12 footer-col">
                    <p class="title">kết nối với gmon</p>
                    <p class="mxh">
                        <a target="_self" href=""></a>
                        <a target="_self" href=""></a>
                        <a target="_self" href=""></a>
                    </p>
                </div>
            </div>
            <div class="footer-bot row">
                <div class="col-md-8">
                    <p>Công ty cổ phần Giải pháp và công nghệ GMon</p>
                    <p>Địa chỉ: Tầng 8 - Tòa nhà Trần Phú - số 17 tổ 24 đường Dương Đình Nghệ - P.Yên Hòa - Q.Cầu Giấy - Hà Nội</p>
                    <p>Điện thoại: 04.3212.1515</p>
                    <p>Email nhà tuyển dụng: vieclamhn@gmon.vnEmail nhà tuyển dụng</p>
                    <p>Email ứng viên: tuyendunghn@gmon.vn</p>
                </div>
                <div class="col-md-4">
                    <p style="margin-top: 15px">&#64; 2016-2017 Gmon.vn,inc. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        $(document).ready(function(){
            var site_url = $('base').attr('href');
            $('.search-btn').click(function(){
                var new_link = site_url + '/showmore?';
                var job_selected = $('#job-select').val();
                var city_selected = $('#tinh-select').val();
                var district_selected = $('#quanhuyen-select').val();
                if(job_selected > 0){
                    new_link = new_link + 'job_type=' + job_selected;
                    if(district_selected > 0){
                        new_link += '&district=' + district_selected;
                    }else{
                        if(city_selected > 0){
                            new_link += '&city=' + city_selected;
                        }
                    }
                }else{
                    if(district_selected > 0){
                        new_link += 'district=' + district_selected;
                    }else{
                        if(city_selected > 0){
                            new_link += 'city=' + city_selected;
                        }
                    }
                }
                window.location.replace(new_link);
                return false;
            });

            $("#tinh-select").change(function () {
                var citId = $("#tinh-select").val();
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getDistrict/" + citId,
                    method: "GET",
                    dataType: "html"
                });

                request.done(function (msg) {
                    $("#quanhuyen-select").html(msg);
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });
        });
    </script>
@endsection