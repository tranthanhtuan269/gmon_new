<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gmon') }}</title>
    <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style-new-home.min.css" />

    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/tether.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.mmenu.all.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/custom.js"></script>
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
                           <li><a href="{{ url('/') }}">Tư vấn nghề nghiệp</a></li>
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
                                @if(Auth::check() && Auth::user()->hasRole('admin'))
                                <li><a target="_self" href="{{ url('/admin') }}">Administrator</a></li>
                                @elseif(Auth::check() && Auth::user()->hasRole('master'))
                                <li><a target="_self" href="{{ url('/city/admin') }}">Administrator</a></li>
                                @elseif(Auth::check() && Auth::user()->hasRole('poster'))
                                    @if($company_id > 0)
                                    <li><a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info">Trang tuyển dụng</a></li>
                                    <li><a target="_self" href="{{ url('/') }}/job/create">Đăng tin tuyển dụng</a></li>
                                    @else
                                    <li><a target="_self" href="{{ url('/') }}/company/create">Tạo trang tuyển dụng</a></li>
                                    @endif
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
                                               <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại">
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
                            <li><a href="{{ url('/') }}/showmore?job=new">Việc làm</a></li>
                            <li><a href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></li>
                            <li><a href="{{ url('/') }}">Tư vấn nghề nghiệp</a></li>
                            <li><a href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader">Đăng nhập</a></li>
                            <li><a href="{{ url('/') }}" data-toggle="modal" data-target="#loginHeader">Đăng ký</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="top-search">
        <div class="container-fluid">
            <div class="row">
                <div class="wrapper-header">
                    <h3>Trao cho bạn <span>chìa khóa thành công</span></h3>
                    <div class="form-search">
                        <h4>Tìm kiếm việc làm. <span>Hàng ngàn cơ hội!</span></h4>

                        <form class="form-inline">
                            <div class="form-group">
                                <div class="dropdown">
                                    <button id="select-job-type-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" data-id="0">- Chọn ngành nghề -<span class="caret"></span></button>

                                    <ul id="select-job-type" class="dropdown-menu job-type-select">
                                        <li value="0">- Chọn ngành nghề -</li>
                                        @foreach($job_types as $job_type)
                                        <li value="{{ $job_type->id }}">{{ $job_type->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <div class="dropdown">
                                        <button id="select-city-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            <span class="fa fa-map-marker"></span>- Thành phố -
                                        </button>

                                        <ul id="select-city" class="dropdown-menu city-select">
                                            <li value="0">- Thành phố -</li>
                                            @foreach($cities as $city)
                                            <li value="{{ $city->id }}">{{ $city->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <button id="select-district-btn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <span class="fa fa-map-marker"></span>- Quận/Huyện
                                    </button>

                                    <ul id="select-district" class="dropdown-menu district-select">
                                        <li value="0">- Quận/Huyện -</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group submit">
                                <button type="submit" id="search-btn" class="btn btn-default">Tìm kiếm</button>
                            </div>

                        </form>
                        <div class="bottom-search">
                            <span>Tìm kiếm nhanh: </span>
                            <a href="{{ url('/') }}/showmore?job=new">Tất cả công việc</a>
                            <a href="{{ url('/') }}/showmore?job=vip1">Việc làm vip</a>
                            <a href="{{ url('/') }}/showmore?job=vip2">Việc làm hot</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper-homepage">
    <div class="part-1">
        <div class="container">
            <div class="wrap">
                <h2>Tìm một công việc bạn yêu thích với <span>GMON #1 job site</span></h2>
                <div class="hr"></div>
                <ul class="number">
                    <li><span>#1</span> Trang tuyển dụng chuyên nghiệp</li>
                    <li><span>1,500</span> lượt xem mỗi đăng tuyển</li>
                    <li><span>20,000</span> ứng viên tiềm năng</li>
                </ul>

                <div class="list-job row">
                    @foreach($companies as $company)
                    <div class="item col-md-4">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image={{ $company->banner }}" alt=""  width="350" height="180"  />
                            <div class="logo">
                                <img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""  width="100" height="100" />
                            </div>
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/company/{{ $company->id }}/info">{{ $company->name }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="btn-more">
                    <a href="{{ url('/') }}/showmore?job=new">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
    <div class="part-2">
        <div class="container">
            <div class="row">
                <img src="http://test.gmon.com.vn/?image=part-2.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="part-3">
        <div class="container">
            <div class="wrap">
                <h2>Chọn công việc theo lĩnh vực</h2>
                <h3>Xem các công việc mới nhất ngay bây giờ</h3>
                <div class="list-job-3 row">
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=linh_vuc1.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="http://spa.gmon.com.vn">Spa</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=linh_vuc2.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?field=1">Khách sạn</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=linh_vuc3.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?field=2">Nhà hàng</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=linh_vuc4.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?field=4">Doanh nghiệp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="part-4">
        <div class="container">
            <div class="wrap">
                <h2>Chọn công việc theo khu vực</h2>
                <h3>Xem các công việc quanh bạn, tìm kiếm công việc gần nhà</h3>
                <div class="list-job-3 row">
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=khu_vuc1.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?city=1">Hà Nội</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=khu_vuc2.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?city=3">Đà Nẵng</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=khu_vuc3.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?city=2">Hồ Chí Minh</a>
                        </div>
                    </div>
                    <div class="item col-md-3">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image=khu_vuc4.jpg" alt="" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/home?city=other">Khu vực khác</a>
                        </div>
                    </div>
                </div>
            </div>
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
                        <li><a href="{{ url('/') }}">giới thiệu</a></li>
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
                        <li><a href="{{ url('/') }}">tư vấn nghề nghiệp</a></li>
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
            <p>Công ty cổ phần giải pháp và công nghệ Gmon</p>
            <p>Địa chỉ: P801 - Tòa nhà Trần Phú, số 17 tổ 24 Dương Đình Nghệ - P.Yên Hòa - Q. Cầu Giấy, Hà Nội</p>
            <p>Điện thoại: 0243.212.1515</p>
            <p>Email: vieclamhn@gmon.vn, tuyendunghn@gmon.com</p>
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
      var loginEmail = $('#login-email').val();
      var loginPassword = $('#login-password').val();
      if(loginEmail.length == 0){
          $('#login-message').val('Email rỗng!');
      }else if(loginPassword.length == 0){
          $('#login-message').val('Password rỗng!');
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
                  // window.location.replace("{{ url('/') }}");
              }else{
                  $('#login-message').val('Tài khoản không tồn tại!');
              }
          });

          request.fail(function (jqXHR, textStatus) {
              alert("Request failed: " + textStatus);
          });
      }
    }

    function registerFunc(){
      $('#register-message').val('');
      var username = $('#username').val();
      var registersdt = $('#sdt').val();
      var registerEmail = $('#register-email').val();
      var registerPassword = $('#register-password').val();
      var rPassword = $('#r_password').val();
      var role = $('#areyou').val();
      if (registerPassword != rPassword) {
          $('#register-message').val('Password được đánh lại chưa chính xác!');
          return false;
      }else if(username.length == 0){
          $('#register-message').val('Username rỗng!');
          return false;
      }else if(registersdt.length == 0){
          $('#register-message').val('Số điện thoại rỗng!');
          return false;
      }else if(registerEmail.length == 0){
          $('#register-message').val('Email rỗng!');
          return false;
      }else if(registerPassword.length == 0){
          $('#register-message').val('Password rỗng!');
          return false;
      }else if(role == 0){
          $('#register-message').val('Bạn chưa chọn vai trò của bạn!');
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
              if (msg.code == 200) {
                  location.reload();
                  // window.location.replace("{{ url('/') }}");
              }else{
                  $('#register-message').val('Email của bạn đã có người sử dụng!');
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

        $('#select-job-type li').click(function(){
            $('#select-job-type-btn').text($(this).text());
            $('#select-job-type-btn').attr('data-id', $(this).val());
        });
        $('#select-city li').click(function(){
            $('#select-city-btn').html('<span class="fa fa-map-marker"></span>' + $(this).text());
            $('#select-city-btn').attr('data-id', $(this).val());

            var citId = $(this).val();
            var request = $.ajax({
                url: "{{ url('') }}/getDistrictli/" + citId,
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
            var new_link = '{{ url("/") }}/showmore?';
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