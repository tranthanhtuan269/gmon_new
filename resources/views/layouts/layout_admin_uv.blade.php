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

    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/style-new-home.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/css/style.min.css" />

    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/tether.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/jquery.mmenu.all.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/js/custom.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <base href="{{ url('/') }}" target="_self">
</head>
<body class="backend">
<div class="header-homepage">
    <div class="top-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-8 left-menu">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="logo">
                                <a href="{{ url('/') }}"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                            </div>
                        </div>
                        <ul class="homepage-menu col-md-8">
                            <li class="active"><a href="{{ url('/') }}/showmore?job=new">Việc làm</a></li>
                            <li><a href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></li>
                            <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 right-menu">
                    <ul class="homepage-menu v1-02">
                        <li>
                            <a href="#" class="avatar"><img src="{{ url('/') }}/public/assets/images/avatar.png" alt=""></a>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tên nhà tuyển dụng
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Đăng tin tuyển dụng</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-address-book" aria-hidden="true"></i> Tin đã đăng</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-heart" aria-hidden="true"></i> Hồ sơ ứng tuyển mới</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Hồ sơ ứng tuyển</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-tag" aria-hidden="true"></i> Hồ sơ phỏng vấn</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-star" aria-hidden="true"></i> Hồ sơ đã lưu</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Thay đổi giao diện</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-lock" aria-hidden="true"></i> Tài khoản</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a>
                            </div>
                        </li>
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
                            <li><a href="{{ url('/') }}/showmore?job=new">Việc làm</a></li>
                            <li><a href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></li>
                            <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                            <li>
                                <a href="#" class="avatar-mobile"><img src="{{ url('/') }}/public/assets/images/avatar.png" alt=""> Tên nhà tuyển dụng</a>
                                <ul class="sub-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Đăng tin tuyển dụng</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-address-book" aria-hidden="true"></i> Tin đã đăng</a></li>
                                    <li> <a class="dropdown-item" href="#"><i class="fa fa-heart" aria-hidden="true"></i> Hồ sơ ứng tuyển mới</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Hồ sơ ứng tuyển</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-tag" aria-hidden="true"></i> Hồ sơ phỏng vấn</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-star" aria-hidden="true"></i> Hồ sơ đã lưu</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Thay đổi giao diện</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-lock" aria-hidden="true"></i> Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $jobstype = \App\JobType::select('id', 'name')->get(); 
    ?>
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
                                    @foreach($jobstype as $jobtype)
                                    <option value="{{ $jobtype->id }}">{{ $jobtype->name }}</option>
                                    @endforeach
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
                                <a target="_self" href="{{ url('/') }}/city/1/ha-noi">Hà Nội</a>
                                <a target="_self" href="{{ url('/') }}/city/2/ho-chi-minh">TP HCM</a>
                                <a target="_self" href="{{ url('/') }}/city/3/da-nang">Đà Nẵng</a>
                                <a target="_self" href="{{ url('/') }}/city/4/hai-phong">Hải Phòng</a>
                                <a target="_self" href="{{ url('/') }}/city/14/binh-duong">Bình Dương</a>
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
                    <a target="_self" href="{{ url('/') }}/home?field=1"><i></i>Khách sạn</a>
                    <a target="_self" href="{{ url('/') }}/home?field=2"><i></i>Nhà hàng</a>
                    <a target="_self" href="{{ url('/') }}/home?field=4"><i></i>Doanh nghiệp</a>
                    <a target="_self" href="{{ url('/') }}/home?field=5"><i></i>Nhân sự tài năng</a>
                </div>
            </div>

        </div>
    </div>
</div>
    @yield('content')
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
                        <li><a href="{{ url('/') }}/showmore?job=new">việc làm</a></li>
                        <li><a href="{{ url('/') }}/showmore?company=new">nhà tuyển dụng</a></li>
                        <li><a href="{{ url('/') }}">hồ sơ ứng viên</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-2 item">
                    <div class="title">
                        công cụ
                    </div>
                    <ul>
                        <li><a href="{{ url('/') }}">hồ sơ</a></li>
                        <li><a href="{{ url('/') }}">việc làm của tôi</a></li>
                        <li><a href="{{ url('/') }}">thông báo việc làm</a></li>
                        <li><a href="{{ url('/') }}">phản hồi</a></li>
                        <li><a href="http://news.gmon.vn">tư vấn nghề nghiệp</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-3 item">
                    <div class="title">
                        về gmon
                    </div>
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ url('/') }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="{{ url('/') }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    </ul>
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

    var site_url = $('base').attr('href');

    function onCloseModalLogin() {
        $("#myModal").modal('toggle');
    }
    function onOpenRegister() {
        $("#register").addClass("in active");
        $("#login").removeClass("in active");
        $("li.login a").removeClass("active");
        $("li.register a").addClass("active");
    }
    function onOpenLogin() {
        $("#login").addClass("in active");
        $("#register").removeClass("in active");
        $("li.register a").removeClass("active");
        $("li.login a").addClass("active");
    }
    function onFocusCandidates(event) {
        $(event.target).find(".view").animate({top: 0 + 'px'}, 300);
    }
    function onDisFocusCandidates(event) {
        $(event.target).find(".view").animate({top: 200 + 'px'});
    }

    function loginFunc(){
        $('#login-message').html('');
        var loginEmail = $('#login-email').val();
        var loginPassword = $('#login-password').val();
        if(loginEmail.length == 0){
            $('#login-message').html('Email rỗng!');
        }else if(loginPassword.length == 0){
            $('#login-message').html('Password rỗng!');
        }else{
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + "/auth/login",
                method: "POST",
                data: {
                    'email': loginEmail,
                    'password': loginPassword
                },
                dataType: "json"
            });

            request.done(function (msg) {
                if (msg.code == 200) {
                    location.reload();
                    // window.location.replace("http://gmon.vn");
                }else{
                    $('#login-message').html('Tài khoản không tồn tại!');
                    $('#login-message').show();
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    }

    function registerFunc(){
        $('#register-btn').off('click');
        $('#register-message').val('');
        var username = $('#username').val();
        var registersdt = $('#sdt').val();
        var registerEmail = $('#register-email').val();
        var registerPassword = $('#register-password').val();
        var rPassword = $('#r_password').val();
        var role = $('#areyou').val();
        if (registerPassword != rPassword) {
            $('#register-message').html('Password được đánh lại chưa chính xác!');
            return false;
        }else if(username.length == 0){
            $('#register-message').html('Username rỗng!');
            return false;
        }else if(registersdt.length == 0){
            $('#register-message').html('Số điện thoại rỗng!');
            return false;
        }else if(registerEmail.length == 0){
            $('#register-message').html('Email rỗng!');
            return false;
        }else if(registerPassword.length == 0){
            $('#register-message').html('Password rỗng!');
            return false;
        }else if(role == 0){
            $('#register-message').html('Bạn chưa chọn vai trò của bạn!');
            return false;
        }else{
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + "/auth/register",
                method: "POST",
                data: {
                    'username': username,
                    'password': registerPassword,
                    'email': registerEmail,
                    'phone': registersdt,
                    'role': role
                },
                dataType: "json"
            });

            request.done(function (msg) {
                $('#register-btn').on('click');
                if(msg.code == 200) {
                    location.reload();
                    // window.location.replace("http://gmon.vn");
                }else if(msg.code == 201) {
                    $('#register-message').html('Email của bạn đã có người sử dụng!');
                }else{
                    $('#register-message').html('Đăng ký bị lỗi! <br /> Xin hãy liên hệ quản trị viên');
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    }

    $(document).ready(function(){
        onOpenLogin();
        $('#login-btn').click(function () {
            loginFunc();
        });

        $('#register-btn').click(function () {
            registerFunc();
        });

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
                url: site_url + "/getDistrict/" + citId,
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
</body>
</html>

