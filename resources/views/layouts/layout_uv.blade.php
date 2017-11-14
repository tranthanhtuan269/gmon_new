<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/style.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/style-new-home.min.css" />

    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/tether.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery.mmenu.all.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/custom.js"></script>
    <link rel="shortcut icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <base href="{{ url('/') }}" target="_self">
</head>
<body class="backend">
    <?php $user_info = \Auth::user()->getUserInfo() ?>
    <div class="header-homepage">
        <div class="mass-content">
            <div class="loader"></div>
        </div>
        <style type="text/css">
            .mass-content{
                width: 100%;
                height: 100%;
                position: fixed;
                background-color:rgba(0, 0, 0, 0.5);
                z-index: 1;
                display: none;
            }
            .loader {
                z-index: 10000;
                border: 16px solid #f3f3f3; /* Light grey */
                border-top: 16px solid #3498db; /* Blue */
                border-bottom: 16px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 1s linear infinite;
                position: absolute;
                top: 50%;
                left: 45%;
                display: none;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        <div class="top-menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-8 left-menu">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="logo">
                                    <a href="http://gmon.vn"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                                </div>
                            </div>
                            <ul class="homepage-menu col-md-8">
                                <li class="active"><a href="http://gmon.vn/showmore?job=new">Việc làm</a></li>
                                <li><a href="http://gmon.vn/showmore?company=new">Nhà tuyển dụng</a></li>
                                <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4 right-menu">
                        <ul class="homepage-menu">
                            <?php 
                                // dd(\Auth::user()->avatar);
                                $avatar = '';
                                if(isset($myInfo)){
                                    $avatar = $myInfo->avatar;
                                }else{
                                    $avatar = \Auth::user()->avatar;
                                }
                                ?>
                            <li>
                                <a href="{{ url('/') }}/user/main" class="avatar"><img src="http://test.gmon.com.vn/?image={{ $avatar }}" alt=""></a>
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ \Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/') }}/user/main">Trang chính</a>
                                    @if($user_info['cv_id'] > 0)
                                    <a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/view/{{ $user_info['cv_id'] }}">Xem hồ sơ</a>
                                    <a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/{{ $user_info['cv_id'] }}/edit">Cập nhật hồ sơ</a>
                                    @else
                                    <a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/create">Tạo hồ sơ</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ url('/') }}/user/applied">Việc đã ứng tuyển</a>
                                    <a class="dropdown-item" href="{{ url('/') }}/user/jobrelative">Việc làm phù hợp</a>
                                    <a class="dropdown-item" href="{{ url('/') }}/user/companyfollow">Nhà tuyển dụng đã theo dõi</a>
                                    <a class="dropdown-item" href="{{ url('/') }}/user/companynew">Nhà tuyển dụng mới</a>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-menu-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-6 left">
                        <a href="http://gmon.vn"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                    </div>
                    <div class="col-sm-6 col-6 right">
                        <a href="#menu" class="fa fa-bars"></a>
                        <nav id="menu">
                            <ul>
                                <li><a href="http://gmon.vn/showmore?job=new">Việc làm</a></li>
                                <li><a href="http://gmon.vn/showmore?company=new">Nhà tuyển dụng</a></li>
                                <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                                <li>
                                    <a href="{{ url('/') }}/user/main" class="avatar-mobile"><img src="http://test.gmon.com.vn/?image=avatar.png" alt=""> Tên ứng viên</a>
                                    <ul class="sub-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a href="{{ url('/') }}/user/main">Trang chính</a></li>
                                        @if($user_info['cv_id'] > 0)
                                        <li><a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/view/{{ $user_info['cv_id'] }}">Xem hồ sơ</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/{{ $user_info['cv_id'] }}/edit">Cập nhật hồ sơ</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="{{ url('/') }}/curriculumvitae/create">Tạo hồ sơ</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ url('/') }}/user/applied">Việc đã ứng tuyển</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/') }}/user/jobrelative">Việc làm phù hợp</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/') }}/user/companyfollow">Nhà tuyển dụng đã theo dõi</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/') }}/user/companynew">Nhà tuyển dụng mới</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-lg-3 col-md-12">
                        <a target="_self" href="" class="logo row"><img src="http://test.gmon.com.vn/?image=home.png" alt=""></a>
                    </div>
                    <div class="col-lg-9 col-md-12" style="margin-top: 30px">
                        <div class="row">
                            <div class="col-lg-9 bstr">
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
                                        <option value="11">Bếp trưởng</option>
                                        <option value="12">Nhân viên spa</option>
                                        <option value="14">Bell man</option>
                                        <option value="15">Chăm sóc khách hàng</option>
                                        <option value="16">Giao nhận/Ship</option>
                                        <option value="17">Kinh doanh</option>
                                        <option value="18">Hành chính nhân sự</option>
                                        <option value="19">Phiên dịch/Biên tập viên</option>
                                        <option value="20">Gia sư</option>
                                        <option value="21">Hướng dẫn viên</option>
                                        <option value="22">Giám sát/Ca trưởng</option>
                                        <option value="23">Phục vụ, bồi bàn</option>
                                        <option value="24">Telesale</option>
                                        <option value="25">Cộng tác viên</option>
                                        <option value="27">Lễ tân</option>
                                        <option value="28">Thu ngân</option>
                                        <option value="29">Marketing online</option>
                                        <option value="30">Phát tờ rơi</option>
                                        <option value="31">Buồng phòng</option>
                                        <option value="32">Pha chế</option>
                                        <option value="33">Shipper</option>
                                        <option value="34">Kế toán</option>
                                        <option value="35">Kỹ thuật viên Spa</option>
                                        <option value="36">Quản lý nhân sự</option>
                                        <option value="37">Quản lý Spa</option>
                                        <option value="38">Nhân viên tư vấn phẩu thuật thẩm mỹ</option>
                                        <option value="39">Tư vấn viên chăm sóc da</option>
                                        <option value="40">Trưởng phòng/Quản lý</option>
                                        <option value="41">Nhân viên Order</option>
                                        <option value="42">Nhân viên bếp</option>
                                        <option value="43">Nhân viên kỹ thuật</option>
                                        <option value="44">Nhân viên IT</option>
                                        <option value="45">Bác sĩ</option>
                                        <option value="46">Y tá</option>
                                        <option value="47">Tạp vụ</option>
                                        <option value="48">Tạo mẫu tóc</option>
                                        <option value="49">Nhân viên phụ tóc</option>
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
                                    <button class="submit hidden-md-up search-btn" style="width: auto;border:1px solid #EBEAEA;padding:5px 7px;height: auto;margin:auto;margin-top: 10px;background-color: #F5F5F5;color:#A8A8A8;border-radius: 4px">Tìm kiếm</button>
                                </form>
                                <div class="city">
                                    <a target="_self" href="http://gmon.vn/city/1/ha-noi">Hà Nội</a>
                                    <a target="_self" href="http://gmon.vn/city/2/ho-chi-minh">TP HCM</a>
                                    <a target="_self" href="http://gmon.vn/city/3/da-nang">Đà Nẵng</a>
                                    <a target="_self" href="http://gmon.vn/city/4/hai-phong">Hải Phòng</a>
                                    <a target="_self" href="http://gmon.vn/city/14/binh-duong">Bình Dương</a>
                                </div>
                            </div>
                            <div class="col-lg-3 clearfix">
                                <div class="contact row">
                                    <p><i></i>0243.212.1515</p>
                                    <p><i></i>support@gmon.vn</p>
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
                        <a target="_self" href="http://gmon.vn/home?field=1"><i></i>Khách sạn</a>
                        <a target="_self" href="http://gmon.vn/home?field=2"><i></i>Nhà hàng</a>
                        <a target="_self" href="http://gmon.vn/home?field=4"><i></i>Doanh nghiệp</a>
                        <a target="_self" href="http://gmon.vn/home?field=5"><i></i>Nhân sự tài năng</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="wrapper-homepage profile-01 profile-05">
       <div class="container">
           <div class="row">
               <div class="left col-lg-3">
                    <div class="avatar">
                        @if(isset($myInfo))
                        <img src="http://test.gmon.com.vn/?image={{ \Auth::user()->avatar }}" alt="Avatar">
                        @else
                        @endif
                    </div>
                    <div class="name">
                        <h3>{{ \Auth::user()->name }}</h3>
                        @if(isset($myInfo))
                        <h4>{{ $myInfo->school }}</h4>
                        @endif
                    </div>
                    <div class="job">
                        <h3>Quản lý tài khoản</h3>
                        <ul>
                            <li><a href="{{ url('/') }}/user/main">Trang chính</a></li>
                            @if($user_info['cv_id'] > 0)
                            <li><a href="{{ url('/') }}/curriculumvitae/view/{{ $user_info['cv_id'] }}">Xem hồ sơ</a></li>
                            <li><a href="{{ url('/') }}/curriculumvitae/{{ $user_info['cv_id'] }}/edit">Cập nhật hồ sơ</a></li>
                            @else
                            <li><a href="{{ url('/') }}/curriculumvitae/create">Tạo hồ sơ</a></li>
                            @endif
                            <li><a href="{{ url('/') }}/user/applied">Việc đã ứng tuyển</a></li>
                            <li><a href="{{ url('/') }}/user/jobrelative">Việc làm phù hợp</a></li>
                            <li><a href="{{ url('/') }}/user/companyfollow">Nhà tuyển dụng đã theo dõi</a></li>
                            <li><a href="{{ url('/') }}/user/companynew">Nhà tuyển dụng mới</a></li>
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
            @yield('content')
            </div>
        </div>
    </div>
    <div class="footer-homepage">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-1 item">
                        <div class="title">
                            về gmon
                        </div>
                        <ul>
                            <li><a href="http://news.gmon.vn/post/10/lich-su-phat-trien-gmon">giới thiệu</a></li>
                            <li><a href="http://gmon.vn/showmore?job=new">việc làm</a></li>
                            <li><a href="http://gmon.vn/showmore?company=new">nhà tuyển dụng</a></li>
                            <li><a href="http://gmon.vn">hồ sơ ứng viên</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-2 item">
                        <div class="title">
                            công cụ
                        </div>
                        <ul>
                            <li><a href="http://gmon.vn">hồ sơ</a></li>
                            <li><a href="http://gmon.vn">việc làm của tôi</a></li>
                            <li><a href="http://gmon.vn">thông báo việc làm</a></li>
                            <li><a href="http://gmon.vn">phản hồi</a></li>
                            <li><a href="http://news.gmon.vn">tư vấn nghề nghiệp</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-3 item">
                        <div class="title">
                            về gmon
                        </div>
                        <ul>
                            <li><a href="http://gmon.vn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="http://gmon.vn"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="http://gmon.vn"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        </ul>
                        <div style="font-size: 15px;">Giấy phép đăng ký kinh doanh số 0107560903</div>
                        <div style="font-size: 15px;">Cấp lần đầu ngày 12/9/2016</div>
                        <div style="font-size: 15px;">Nơi cấp: Sở Kế hoạch và Đầu tư thành phố Hà Nội</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="container">
                <p><b>Công ty cổ phần giải pháp và công nghệ Gmon</b></p>
                <p><b>Trụ sở chính:</b> Tầng 8, Tòa nhà Trần Phú, Dương Đình Nghệ, Cầu Giấy, Hà Nội</p>
                <p><b>Điện thoại:</b> 0243.212.1515</p>
                <p><b>VPĐD:</b> Số 31, Trần Phú, Hải Châu I, Hải Châu, Đà Nẵng</p>
                <p><b>Điện thoại:</b> 0961 545 115</p>
                <p><b>Email:</b> support@gmon.vn</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#select-job-type li').click(function(){
                $('#select-job-type-btn').text($(this).text());
                $('#select-job-type-btn').attr('data-id', $(this).val());
            });
            $('#select-city li').click(function(){
                $('#select-city-btn').html('<span class="fa fa-map-marker"></span>' + $(this).text());
                $('#select-city-btn').attr('data-id', $(this).val());

                var citId = $(this).val();
                var request = $.ajax({
                    url: "http://gmon.vn/getDistrictli/" + citId,
                    method: "GET",
                    dataType: "html"
                });
                request.done(function (msg) {
                    $("#select-district").html(msg);
                    $('#select-district li').off('click');
                    $('#select-district li').click(function(){
                        $('#select-district-btn').html('<span class="fa fa-map-marker"></span>' + $(this).text());
                        $('#select-district-btn').attr('data-id', $(this).val());
                    });
                });
                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });

            $('.form-search #search-btn').click(function(){
                var new_link = 'http://gmon.vn/showmore?';
                var job_selected = $('#select-job-type-btn').attr('data-id');
                var city_selected = $('#select-city-btn').attr('data-id');
                var district_selected = $('#select-district-btn').attr('data-id');

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

        });
    </script>
</body>
</html>