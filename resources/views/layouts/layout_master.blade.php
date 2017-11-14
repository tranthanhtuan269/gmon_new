<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($company) && isset($company->name))
      @if(isset($job) && isset($job->name))
      <title>{{ $job->name }} - {{ $company->name }}</title>
      @else
      <title>{{ $company->name }}</title>
      @endif
    @elseif(isset($curriculumvitae) && isset($curriculumvitae->name))
      <title>{{ $curriculumvitae->name }}</title>
    @else
      <title>{{ config('app.name', 'Gmon') }}</title>
    @endif

    @if(isset($content_share))
      <meta property="og:url"           content="{{ $content_share['url'] }}" />
      <meta property="og:type"          content="website" />
      <meta property="og:title"         content="{{ $content_share['title'] }}" />
      <meta property="og:description"   content="<?php echo $content_share['description']; ?>" />
      <meta property="og:image"         content="{{ $content_share['image'] }}" />
    @endif

    <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style-new-home.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/customize.css">

    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/tether.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.mmenu.all.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/custom.js"></script>
    <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <base href="{{ url('/') }}" target="_self">
</head>
<body>
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
                   <ul class="homepage-menu">
                        @if (Auth::guest())
                        <li>
                           <a class="menuLogin" href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader" onclick="onOpenLogin()"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
                        <li><a class="menuRegister" href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader" onclick="onOpenRegister()">Đăng ký</a></li>
                        <li class="info">
                           <h5>dành cho nhà tuyển dụng</h5>
                           <h6 >Đăng tuyển dụng ứng viên & Tìm kiếm nhân tài</h6>
                        </li>
                        @else
                        <li class="dropdown">
                            <a target="_self" href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" style="background-color: #4160a1;">
                                <?php $user_info = \Auth::user()->getUserInfo() ?>
                                @if(Auth::user()->hasRole('admin'))
                                <li><a target="_self" href="{{ url('/admin') }}">Administrator</a></li>
                                @elseif(Auth::user()->hasRole('master'))
                                <li><a target="_self" href="{{ url('/city/admin') }}">Administrator</a></li>
                                @elseif(Auth::user()->hasRole('creator'))
                                <li><a target="_self" href="{{ url('/post/create') }}">Create Post</a></li>
                                @elseif(Auth::user()->hasRole('poster'))
                                    @if($user_info['company_id'] > 0)
                                    <li><a href="{{ url('/') }}/company/{{ $user_info['company_id'] }}/info">Xem trang tuyển dụng</a></li>
                                    <li><a href="{{ url('/') }}/company/editCompany">Cập nhật trang tuyển dụng</a></li>
                                    <li><a href="{{ url('/') }}/job/create">Tạo tuyển dụng</a></li>
                                    @else
                                    <li><a href="{{ url('/') }}/company/create">Tạo trang tuyển dụng</a></li>
                                    @endif
                                    <li class="end-group"><a href="{{ url('/') }}/user/jobcreated">Tin đã đăng</a></li>
                                    <li><a href="{{ url('/') }}/user/jobactive">Tin đang tuyển</a></li>
                                    <li><a href="{{ url('/') }}/user/jobinactive">Tin chờ duyệt</a></li>
                                    <li><a href="{{ url('/') }}/user/jobexpired">Tin hết hạn</a></li>
                                    <li><a href="{{ url('/') }}/user/cvapplied">Hồ sơ đã ứng tuyển</a></li>
                                    <li><a href="{{ url('/') }}/user/cvappliednew">Hồ sơ ứng tuyển mới</a></li>
                                    <li><a href="{{ url('/') }}/user/cvviewed">Hồ sơ đã xem </a></li>
                                    <li><a href="{{ url('/') }}/user/cvsaved">Hồ sơ đã lưu</a></li>
                                    <li><a href="{{ url('/') }}/user/cvsuggest">Hồ sơ được đề xuất</a></li>
                                @elseif(Auth::user()->hasRole('user'))
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
                                @else 

                                @endif
                                <li>
                                    <a target="_self" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        Đăng Xuất
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                   </ul>
                   <div id="loginHeader" class="modal fade" role="dialog">
                       <div class="modal-dialog">

                           <!-- Modal content-->
                           <div class="modal-content">
                               <!-- Nav tabs -->
                               <ul class="nav nav-justified" role="tablist">
                                   <li class="nav-item login">
                                       <a class="nav-link active" data-toggle="tab" href="#home" role="tab" onclick="onOpenLogin()">Đăng nhập</a>
                                   </li>
                                   <li class="nav-item register">
                                       <a class="nav-link" data-toggle="tab" href="#profile" role="tab" onclick="onOpenRegister()">Đăng ký</a>
                                   </li>
                               </ul>

                               <!-- Tab panes -->
                               <div class="tab-content">
                                   <div id="login" class="tab-pane login active" id="home" role="tabpanel">
                                       <form action="javascript:void(0);" onsubmit="return(loginFunc());"  name="loginForm" id="loginForm">
                                           <div class="form-group">
                                               <label for="email"></label>
                                               <input type="email" class="form-control" id="login-email" placeholder="Email">
                                           </div>
                                           <div class="form-group">
                                               <label for="phone"></label>
                                               <input type="password" class="form-control" id="login-password" placeholder="Mật khẩu">
                                           </div>
                                           <div class="form-group">
                                               <p class="text-center text-danger" id="login-message"></p>
                                           </div>
                                           <div class="form-group">
                                               <input type="submit" class="btn btn-primary" id="login-btn" value="Đăng nhập">
                                           </div>
                                           
                                       </form>
                                       <div class="clear"></div>
                                       <div class="footer text-center">
                                           <p>Hoặc đăng nhập bằng</p>
                                           <div class="rows">
                                               <a href="{{ url('/auth/facebook') }}"><i class="fa fa-facebook" aria-hidden="true"></i> facebook</a>
                                               <a href="{{ url('/auth/google') }}"><i class="fa fa-google-plus" aria-hidden="true"></i> google</a>
                                           </div>
                                       </div>
                                    </div>
                                    <div id="register" class="tab-pane register" id="profile" role="tabpanel">
                                        <h3>đăng ký tài khoản gmon ngay!</h3>
                                        <form action="javascript:void(0);" onsubmit="return(registerFunc());"  name="registerForm" id="registerForm">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" placeholder="Họ & tên">
                                            </div>
                                            <div class="form-group">
                                               <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại">
                                            </div>
                                            <div class="form-group">
                                               <input type="email" class="form-control" id="register-email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                               <input type="password" class="form-control" id="register-password" placeholder="Mật khẩu">
                                            </div>
                                            <div class="form-group">
                                               <input type="password" class="form-control" id="r_password" placeholder="Xác nhận mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <select name="areyou" id="areyou" class="form-control">
                                                    <option value="0">Chọn vai trò</option>
                                                    <option value="1">Ứng viên</option>
                                                    <option value="2">Nhà tuyển dụng</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="text-center text-danger" id="register-message"></p>
                                            </div>
                                            <div class="form-group">
                                            <input type="submit" class="btn btn-primary" id="register-btn" value="Đăng ký ngay">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="top-menu-mobile">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-6 left">
                    <a href="{{ url('/') }}"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                </div>
                <div class="col-sm-6 col-6 right">
                    <a href="#menu" class="fa fa-bars"></a>
                    <nav id="menu">
                      <ul>
                        @if (Auth::guest())
                        <li><a href="{{ url('/') }}/showmore?job=new">Việc làm</a></li>
                        <li><a href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></li>
                        <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                        <li><a href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader">Đăng nhập</a></li>
                        <li><a href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader">Đăng ký</a></li>
                        @else
                        @if(Auth::check() && Auth::user()->hasRole('admin'))
                        <li><a target="_self" href="{{ url('/admin') }}">Administrator</a></li>
                        @elseif(Auth::check() && Auth::user()->hasRole('master'))
                        <li><a target="_self" href="{{ url('/city/admin') }}">Administrator</a></li>
                        @elseif(Auth::check() && Auth::user()->hasRole('creator'))
                        <li><a target="_self" href="{{ url('/post/create') }}">Create Post</a></li>
                        @elseif(Auth::check() && Auth::user()->hasRole('poster'))
                            @if($company_id > 0)
                            <li><a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info">Trang tuyển dụng</a></li>
                            <li><a target="_self" href="{{ url('/') }}/job/create">Đăng tin tuyển dụng</a></li>
                            @else
                            <li><a target="_self" href="{{ url('/') }}/company/create">Tạo trang tuyển dụng</a></li>
                            @endif
                            <li class="end-group"><a href="{{ url('/') }}/user/jobcreated">Tin đã đăng</a></li>
                            <li><a href="{{ url('/') }}/user/jobactive">Tin đang tuyển</a></li>
                            <li><a href="{{ url('/') }}/user/jobinactive">Tin chờ duyệt</a></li>
                            <li><a href="{{ url('/') }}/user/jobexpired">Tin hết hạn</a></li>
                            <li><a href="{{ url('/') }}/user/cvapplied">Hồ sơ đã ứng tuyển</a></li>
                            <li><a href="{{ url('/') }}/user/cvappliednew">Hồ sơ ứng tuyển mới</a></li>
                            <li><a href="{{ url('/') }}/user/cvviewed">Hồ sơ đã xem </a></li>
                            <li><a href="{{ url('/') }}/user/cvsaved">Hồ sơ đã lưu</a></li>
                            <li><a href="{{ url('/') }}/user/cvsuggest">Hồ sơ được đề xuất</a></li>
                        @elseif(Auth::check() && Auth::user()->hasRole('user'))
                            @if($cv_id > 0)
                            <li><a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv_id }}">Trang hồ sơ</a></li>
                            @else
                            <li><a target="_self" href="{{ url('/') }}/curriculumvitae/create">Tạo hồ sơ</a></li>
                            @endif
                        @else 

                        @endif
                        <li>
                            <a target="_self" href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Đăng Xuất
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif
                        </ul>
                    </nav>
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
                            <li><a href="http://news.gmon.vn/post/10/lich-su-phat-trien-gmon">Giới thiệu</a></li>
                            <li><a href="{{ url('/') }}/showmore?job=new">Việc làm</a></li>
                            <li><a href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></li>
                            <li><a href="{{ url('/') }}">Hồ sơ ứng viên</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-2 item">
                        <div class="title">
                            công cụ
                        </div>
                        <ul>
                            <li><a href="{{ url('/') }}/privacy-policy">Quy định bảo mật</a></li>
                            <li><a href="{{ url('/') }}/terms-of-service">Điều khoản sử dụng</a></li>
                            <li><a href="{{ url('/') }}">Thông báo việc làm</a></li>
                            <li><a href="{{ url('/') }}">Phản hồi</a></li>
                            <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-3 item">
                        <div class="title">
                            Về gmon
                        </div>
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{ url('/') }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="{{ url('/') }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
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
                url: "{{ url('/') }}/auth/login",
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
            url: "{{ url('/') }}/auth/register",
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
                    // window.location.replace("{{ url('/') }}");
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

    onOpenLogin();
    $('#login-btn').click(function () {
        loginFunc();
    });

    $('#register-btn').click(function () {
        registerFunc();
    });        
</script>
</body>
</html>