<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" target="_self">
    <title>{{ config('app.name', 'Gmon') }}</title>
    <link rel="stylesheet" href="{{ url('/') }}/public/css/view01.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ url('/') }}/public/css/view02.css">
</head>
<body class="homepage">
    <header>
        <div class="header-top clearfix">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                                <img src="http://test.gmon.com.vn/?image=menu.png" alt="" width="25px">
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-collapse">
                            <div class="row">
                                <div class="link-left">
                                    <a target="_self" href="{{ url('/') }}"><i></i>Trang chủ</a>
                                    <a target="_self" href="{{ url('/') }}/showmore?job=new"><i></i>Việc làm</a>
                                    <a target="_self" href="{{ url('/') }}/showmore?company=new"><i></i>Nhà tuyển dụng</a>
                                </div>
                                <div class="login">
                                    @if (Auth::guest())
                                    <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenLogin()"><i></i>Đăng nhập</a>
                                    <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()">Đăng ký</a>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <button class="exit-login visible-xs" onclick="onCloseModalLogin()" style="margin-bottom: 5px;line-height: 0;background-color: transparent;border:1px solid #C9C9C9;padding: 5px"><img src="http://test.gmon.com.vn/?image=del.png" width="15px" alt=""></button>
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div style="margin:-15px -15px 0 -15px!important;">
                                                        <ul class="nav nav-justified header-tab-login">
                                                            <li class=""><a target="_self" data-toggle="tab" href="#login">Đăng nhập</a></li>
                                                            <li class=""><a target="_self" data-toggle="tab" href="#register">Đăng ký</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-content">
                                                        <div id="register" class="tab-pane fade">
                                                            <h3>ĐĂNG KÝ TÀI KHOẢN GMON NGAY !</h3>
                                                            <form method="post">
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group ">
                                                                        <input type="text" class="form-control" id="firstname" placeholder="Họ" required autofocus><span class="required">*</span>
                                                                    </div>
                                                                    <div class="col-md-6 form-group ">
                                                                        <input type="text" class="form-control" id="lastname" placeholder="Tên" required><span class="required">*</span>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại" required><span class="required">*</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <input type="email" class="form-control" id="register-email" placeholder="Email" required><span class="required">*</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group ">
                                                                        <input type="password" class="form-control" id="register-password" placeholder="Mật khẩu" required><span class="required">*</span>
                                                                    </div>
                                                                    <div class="col-md-6 form-group ">
                                                                        <input type="password" class="form-control" id="r_password" placeholder="Xác nhận mật khẩu" required><span class="required">*</span>
                                                                    </div>
                                                                </div>
                                                                <div style="margin-top: -5px;margin-bottom: 20px">
                                                                    <label for="">Bạn là:</label>
                                                                    <select name="areyou" id="areyou">
                                                                        <option value="1">Ứng viên</option>
                                                                        <option value="2">Nhà tuyển dụng</option>
                                                                    </select>
                                                                </div>
                                                                <p class="text-center text-danger" id="register-message" style="display: none;">Đăng ký không thành công!</p>
                                                                <div class="text-center">
                                                                    <div id="register-btn" class="btn btn-primary">ĐĂNG KÝ NGAY</div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="login" class="tab-pane fade">
                                                            <!-- <h3>ĐĂNG NHẬP</h3> -->
                                                            <form>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <input type="email" class="form-control" id="login-email" placeholder="Email" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <input type="password" class="form-control" id="login-password" placeholder="Mật khẩu" required>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center text-danger" id="login-message" style="display: none;">Tài khoản không chính xác!</p>
                                                                <div class="text-center">
                                                                    <div id="login-btn" class="btn btn-primary">ĐĂNG NHẬP</div>
                                                                </div>
                                                                <hr>
                                                                <p class="text-center">Hoặc đăng nhập nhanh bằng</p>
                                                                <div class="row text-center">
                                                                    <a target="_self" href="{{ url('/auth/facebook') }}" class="facebook"><i></i> Facebook</a>
                                                                    <a target="_self" href="{{ url('/auth/google') }}" class="google"><i></i> Google</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->
                                    </div>
                                    @else
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a target="_self" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                @if(Auth::check() && Auth::user()->hasRole('admin'))
                                                <li><a target="_self" href="{{ url('/admin') }}">Administrator</a></li>
                                                @elseif(Auth::check() && Auth::user()->hasRole('master'))
                                                <li><a target="_self" href="{{ url('/city/admin') }}">Administrator</a></li>
                                                @elseif(Auth::check() && Auth::user()->hasRole('user'))
                                                @if($cv_id > 0)
                                                <li><a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv_id }}">Trang hồ sơ</a></li>
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
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="wrapper">
        <div class="container">
            <div class="row gmon-details">          
                <div class="col-md-3 col-lg-3">
                    <div class="details-box">
                        <div class="details-logo">
                            <img src="http://test.gmon.com.vn/?image={{ $company->logo }}">
                        </div>
                        <div class="about-us">
                            <div class="sblg-title"><span>KHÁCH SẠN MƯỜNG THANH</span></div>
                            <div class="sb-body clearfix">
                                <p>
                                    <img src="{{ url('/') }}/public/images/sbicon1.png">
                                    <span>124 Trung Hòa, Cầu Giấy, Hà Nội.</span>
                                </p>
                                <p><img src="{{ url('/') }}/public/images/sbicon2.png"><span>Cầu Giấy, Hà Nội.</span></p>
                                <p><img src="{{ url('/') }}/public/images/sbicon3.png"><span>Khách sạn.</span></p>
                                <p><img src="{{ url('/') }}/public/images/sbicon4.png"><span>Từ 20 đến 50 người.</span></p>
                                <p><img src="{{ url('/') }}/public/images/sbicon5.png"><span>Thứ 2 đến thứ 6.</span></p>
                                <p><img src="{{ url('/') }}/public/images/sbicon6.png"><span>Chuyển động không ngừng.</span></p>
                            </div>

                        </div>
                        <div class="rate">
                            <p>Đánh giá chung</br>
                                <img src="{{ url('/') }}/public/images/ratestar.png">
                                <img src="{{ url('/') }}/public/images/ratestar.png">
                                <img src="{{ url('/') }}/public/images/ratestar.png">
                                <img src="{{ url('/') }}/public/images/ratestar.png">
                                <img src="{{ url('/') }}/public/images/ratestar.png">
                            </p>
                        </div>
                        <div class="comment">
                            <div class="sb-title"><span>MỌI NGƯỜI NÓI VỀ CHÚNG TÔI</span></div>
                            <div class="sb-body">
                                <p>
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                                <p>
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                                <p>
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                                <p>
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                                <p>
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png">
                                    <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="details-map">
                        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.0541367990278!2d105.79174358393226!3d21.024019707272046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe2d0921dae22414a!2sEleganz+Hanoi!5e0!3m2!1svi!2s!4v1503165789664" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9">
                    <div class="btn-tab">
                        <div class="btn-about2">
                            <div class="btn-link2"><a href="GmonInfo.html">VỀ CHÚNG TÔI</a></div>
                        </div>
                        <div class="btn-about1">
                            <div class="btn-link1"><a href="GmonEmploy.html">TIN TUYỂN DỤNG</a></div>
                        </div>
                    </div>
                    <table class="table-bordered">
                        <tr>
                            <td>
                                <div class="wkplace">
                                    <img src="http://test.gmon.com.vn/?image={{ $company->banner }}">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-ok"></span> Theo dõi
                                    </button>
                                </div>
                                <div class="wkp-txt">
                                    <p>Tập đoàn Mường Thanh đã phát triển bền vững thành Tập đoàn kinh tế tổng hợp đa ngành hoạt động trên các lĩnh vực Đầu tư- Xây dựng- Du lịch giải trí và hiện nay Tập đoàn mở rộng sang các lĩnh vực Đào tạo, Y tế, trở thành một Tập đoàn lớn mạnh với hơn 50 khách sạn  và dự án khách sạn, tạo việc làm và đời sống ổn định cho hơn 10000 lao động, hàng năm đóng góp hàng ngàn tỷ đồng cho ngân sách nhà nước. Tập đoàn Mường Thanh đã làm tốt công tác xã hội, giành một ngân quỹ rất lớn hàng chục tỷ đồng cho công tác xóa đói giảm nghèo, phát triển dân trí, phát triển tài năng cho đất nước, góp phần giải quyết việc làm, phát triển kinh tế xã hội cho đất nước và thủ đô Hà Nội.</p>
                                </div>
                                <div class="wkp-slider">
                                    <img src="http://test.gmon.com.vn/?image=room1.png" class="col-md-6">
                                    <img src="http://test.gmon.com.vn/?image=room2.png" class="col-md-6">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="details-video">
                        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/nrpjNgZCdlM" frameborder="0" allowfullscreen></iframe>
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
                    <p><a href="">Giới thiệu</a></p>
                    <p><a href="">Việc làm</a></p>
                    <p><a href="">Nhà tuyển dụng</a></p>
                    <p><a href="">Hồ sơ ứng viên</a></p>
                    <p><a href="">Nhà tuyển dụng</a></p>
                </div>
                <div class="col-md-3 col-xs-6 footer-col">
                    <p class="title">công cụ</p>
                    <p><a href="">Hồ sơ</a></p>
                    <p><a href="">Việc làm của tôi</a></p>
                    <p><a href="">Thông báo việc làm</a></p>
                    <p><a href="">Phản hồi</a></p>
                    <p><a href="">Tư vấn nghề nghiệp</a></p>
                </div>
                <div class="col-md-5 contact col-xs-12 footer-col">
                    <p class="title">kết nối với gmon</p>
                    <p class="mxh">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
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
    <script>
        function onCloseModalLogin(){
            $("#myModal").modal('toggle');
        }
        function onOpenRegister(){
            $("#register").addClass("in active");
            $(".header-tab-login li:nth-child(1)").removeClass("active");
            $(".header-tab-login li:nth-child(2)").addClass("active");
        }
        function onOpenLogin(){
            $("#login").addClass("in active");
            $(".header-tab-login li:nth-child(2)").removeClass("active");
            $(".header-tab-login li:nth-child(1)").addClass("active");
        }
        function onFocusCandidates(event){
            $(event.target).find(".view").animate({top: 0+'px'},300);
        }
        function onDisFocusCandidates(event){
            $(event.target).find(".view").animate({top: 200+'px'});
        }
    </script>
</body>
</html>

