@extends('layouts.layout')

@section('content')
    <header>
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-md-3">
                        <a target="_self" href="" class="logo row"><img src="http://test.gmon.com.vn/?image=home.png" alt=""></a>
                    </div>
                    <div class="col-md-9" style="background-color:rgba(255, 255, 255, 0.9);">
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
                                    <p><i></i>0243.212.1515</p>
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
                        <a target="_self" href="{{ url('/') }}/home?field=1"><i></i>Khách sạn</a>
                        <a target="_self" href="{{ url('/') }}/home?field=2"><i></i>Nhà hàng</a>
                        <a target="_self" href="{{ url('/') }}/home?field=4"><i></i>Doanh nghiệp</a>
                        <a target="_self" href="{{ url('/') }}/home?field=5"><i></i>Nhân sự tài năng</a>
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

    <div class="container ads showmore-page">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <div class="my_row wp_breadcum">
                    <div class="breadcum f-left">
                        <a href="#"><i class="fa fa-home color-breadcum"></i></a>
                        <a href="#" class="color-breadcum">/&nbsp;Việc làm mới</a>
                    </div>
                    <div class="f-right">
                        <span class="red-color">{{ count($jobs) }}</span><span>&nbsp;việc làm</span>
                    </div>
                </div>
                    <ul class="ul-content">
                    @foreach($jobs as $job)
                    <li class="list-item">
                        <div class="img-item">
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}">
                                <span class="wp-avatar">
                                    
                                        <img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt="">
                                    
                                </span>
                            </a>
                        </div>

                        <div class="content-item">
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}"><h4>{{ $job->name }}</h4></a>
                            <p>
                                <span>Mức lương: </span><span class="grey-color">{{ $job->salary }}</span>
                            </p>
                            <p>
                                <div class="title-list">
                                    <span>Số lượng: </span><span class="grey-color">{{ $job->number }}</span>
                                </div>
                                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="grey-color">{{ $job->district }}, {{ $job->city }}</span></a>
                            </p>
                            <p>
                                <div class="title-list">
                                    <span>Nhận hồ sơ đến hết:</span>
                                </div>
                                <a href="#"><i class="fa fa-clock-o"></i><span class="grey-color">{{ $job->expiration_date }}</span></a>
                            </p>
                        </div>
                        <div class="last-item">
                            <span class="profile_num grey1-color">Lượt xem: <i class="fa fa-eye"></i><span class="grey-color">1042</span></span>
                            <span class="grey1-color">Hồ sơ ứng tuyển: <span class="grey-color">302</span></span>
                        </div>
                        <div class="new-bg">
                                Mới
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 col-xs-12 no_padding_right">
                <div class="content_hot">
                    <h4>VIỆC LÀM HOT</h4>
                    <ul>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Nhân viên phục vụ tại nhà hàng Cơm Thố</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Nhân viên phục vụ tại nhà hàng Cơm Thố</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Nhân viên phục vụ tại nhà hàng Cơm Thố</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Nhân viên phục vụ tại nhà hàng Cơm Thố</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Nhân viên phục vụ tại nhà hàng Cơm Thố</p>
                            </a>
                        </li>
                    </ul>
                </div>
                @if(false)
                <div class="ads">
                    <div class="ads-top"><a href=""><img src="{{ url('/') }}/public/images/ads.png" alt=""></a></div>
                    <div class="ads-bot">
                        <a href=""><img src="{{ url('/') }}/public/images/zalo.png" alt=""></a>
                    </div>
                </div>
                <div class="content_hot info">
                    <h4>Bạn nên biết!?</h4>
                    <ul>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Biết cảm ơn những thất bại</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Biết cảm ơn những thất bại</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Biết cảm ơn những thất bại</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Biết cảm ơn những thất bại</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <span class="wp-avatar-mini">
                                    <img src="{{ url('/') }}/public/images/khanhlinh.png" alt="">
                            </span>
                            <p class="title-content-right">Biết cảm ơn những thất bại</p>
                            </a>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="list-logo clearfix">
        <div class="container" style="position: relative;">
            <span id="btPrev" class="btPrev"></span>
            <span id="btNext" class="btNext"></span>
            <div class="wrapper row" id="wrapper-logo">
                <div class="contents clearfix" id="contents-logo">
                    <ul>
                        <li class="item-logo"><a href=""><img src="{{ url('/') }}/public/images/logoHome.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome1.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome2.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome3.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome4.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome5.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome6.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome7.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome8.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome3.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome10.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome11.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome12.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome2.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome3.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome5.png" alt=""></a></li>
                        <li><a href=""><img src="{{ url('/') }}/public/images/logoHome.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var $i = 0;
        $(window).scroll(function() {
            if($(window).scrollTop() == $(document).height() - $(window).height()) {
                   $i++;
                   $('.job-list-' + $i).show();
            }
        });
        $(document).ready(function(){
            $('.item-job').show();
            $('.job-list-0').show();
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