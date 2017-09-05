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

    <div class="container gmon-move">
        <div class="row move-content">
                <div class="move-header clearfix">
                    <div class="move-title">{{ $company->sologan }}</div>
                    <div class="move-img"><img src="{{ url('/') }}/public/images/{{ $company->banner }}" width="100%"></div>
                    <!--<div class="move-logo"><img src="{{ url('/') }}/public/images/ksmt-logo.png"></div>-->
                </div>
                <div class="move-info row">
                    <div class="col-md-10 col-lg-10">
                        <h4>{{ $company->name }}</h4>
                    </div>
                    <div class="col-md-2 col-lg-2 btn-follow">
                        @if(false)
                        <button type="button" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
                        <button type="button" class="btn btn-danger" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
                        @else
                        <div class="btn-group pull-right" id="select-template">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Thay đổi giao diện <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><div class="select-template" data-id="0">Giao diện mặc định</a></li>
                            <li><div class="select-template" data-id="1">Giao diện 1</a></li>
                            <li><div class="select-template" data-id="2">Giao diện 2</a></li>
                            <li><div class="select-template" data-id="3">Giao diện 3</a></li>
                          </ul>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
        <div class="move-txt">
            <p><?php echo $company->description; ?></p>
        </div>
    </div>
    <div class="container">
        <div class="row gmon-info">
            <div class="col-md-9 col-lg-9 content-company">
                <div class="nav nav-tabs" role="tablist">
                    <button role="presentation" class="btn btn-warning"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></button>
                    <span> | </span>
                    <button role="presentation" class="btn btn-primary"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></button>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="workplace-title">
                            <span>NƠI BẠN SẼ LÀM VIỆC </span>
                            <img src="{{ url('/') }}/public/images/circle.png">
                        </div>
                        <div class="row workplace-img">
                            <div class="col-md-6 col-lg-6">
                                <img src="{{ url('/') }}/public/images/room1.png">
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <img src="{{ url('/') }}/public/images/room2.png">
                            </div>
                        </div>
                        <div class="video">
                            <span>VIDEO</span>
                            <div class="embed-responsive embed-responsive-16by9">
                              <iframe src="https://www.youtube.com/embed/nrpjNgZCdlM" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="map video">
                            <span>BẢN ĐỒ</span>
                            <div><iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.0541367990278!2d105.79174358393226!3d21.024019707272046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe2d0921dae22414a!2sEleganz+Hanoi!5e0!3m2!1svi!2s!4v1503165789664" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        @foreach($jobs as $job)
                        <div class="row employ-info">
                            <div class="employ-img col-md-2 col-lg-2">
                                <img src="{{ url('/') }}/public/images/{{ $job->logo }}">
                            </div>
                            <div class="col-md-10 col-lg-10 clearfix">
                                <div class="employ-title">
                                    <a href="{{ url('/') }}/job/view/{{ $job->id }}">{{ $job->name }}</a>
                                </div>
                                <div class="employ-content">
                                    <div>
                                        <p>
                                            Mức lương: <span>{{ $job->salary }}</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <p>Số lượng: <span>{{ $job->number }}</span></p>
                                        </div>
                                        <div class="col-md-9 col-lg-9">
                                            <img src="{{ url('/') }}/public/images/sbicon1.png"> 
                                            <span>{{ $job->district }}, {{ $job->city }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <p>Nhận hồ sơ đến hết: </p>
                                        </div>
                                        <div class="col-md-9 col-lg-9">
                                            <img src="{{ url('/') }}/public/images/clockicon.png">
                                            <span> {{ $job->expiration_date }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="employ-ft"> 
                                    <div class="employ-txt">
                                        <p>Lượt xem: <img src="{{ url('/') }}/public/images/eyeicon.png">
                                            <span>1024</span>
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            Hồ sơ ứng tuyển: 
                                            <span>332&nbsp;</span>
                                            <img src="{{ url('/') }}/public/images/new-employ.png" style="max-width: 60%;">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="aboutus">
                    <div class="sb-title"><span>VỀ CHÚNG TÔI</span></div>
                    <div class="sb-body clearfix">
                        <p>
                            <img src="{{ url('/') }}/public/images/sbicon1.png">
                            <span>{{ $company->address }}, {{ $company->district }}, {{ $company->city }}.</span>
                        </p>
                        <p><img src="{{ url('/') }}/public/images/sbicon2.png"><span>{{ $company->district }}, {{ $company->city }}.</span></p>
                        @if(strlen($company->jobs) > 0)
                        <p><img src="{{ url('/') }}/public/images/sbicon3.png"><span>{{ rtrim($company->jobs,";") }}.</span></p>
                        @endif
                        <p><img src="{{ url('/') }}/public/images/sbicon4.png"><span>{{ $company->size }} người.</span></p>
                        <p><img src="{{ url('/') }}/public/images/sbicon6.png"><span>{{ $company->sologan }}</span></p>
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
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                            <span>Môi trường chuyên nghiệp, thân thiện.</span>
                        </p>
                        <p>
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                            <span>Quản lý tốt bụng, quan tâm.</span>
                        </p>
                        <p>
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png">
                            <img src="{{ url('/') }}/public/images/ratestar.png"></br>
                            <span>Đồng nghiệp vui vẻ, tốt tính.</span>
                        </p>
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
        window.onresize = function(event){
            resetSlide();
        }
        window.onload =function(){resetSlide();}
        function resetSlide()
        {
            clearTimeout(listLogo.action);
            clearTimeout(listNewEmployer.action);
            clearTimeout(listNewJobs.action);
            $( "#"+listLogo.contents ).css("margin-left","0");
            $( "#"+listNewEmployer.contents ).css("margin-left","0");
            $( "#"+listNewJobs.contents ).css("margin-left","0");
            var w=screen.width;
            var w2=$(".new-jobs #wrapper").outerWidth();
            var w3;
            if(w>1000){
                w3=w2/5;
                $(".need-jobs .wrapper" ).css("width",w3*4+"px");
                $(".need-jobs .title" ).css("width",w3*4+"px");
                $("#col-ads").css("width",w3+"px");
            }else if(w>800){
                w3=w2/4;
                $(".need-jobs .wrapper" ).css("width",w3*3+"px");
                $(".need-jobs .title" ).css("width",w3*3+"px");
                $("#col-ads").css("width",w3+"px");
            }else if(w>600){
                w3=w2/3;
                $(".need-jobs .wrapper" ).css("width",w3*2+"px");
                $(".need-jobs .title" ).css("width",w3*2+"px");
                $("#col-ads").css("width",w3+"px");
            }else if(w>400){
                w3=w2/2;
            }else{
                w3=w2;
            }
            $(".item-work").css("width",w3+"px");
            $(".new-jobs .contents" ).css("width",w3*( $( "#contents-jobs .item-work" ).length)+"px");
            $(".new-employer .contents" ).css("width",w3*( $( "#contents-employer .item-work" ).length)+"px");
            $(".vip-candidates .item-u" ).css("width",w3+"px");
           
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(".new-jobs #wrapper" ).addClass("mobile");
                $(".new-employer .next").css("margin-right","0px");
                $(".new-employer .prev").css("margin-left","0px");
            }

            w2=$("#wrapper-logo").outerWidth();
            if(w>1000){
                w3=w2/13;
            }else if(w>800){
                w3=w2/10;
            }else if(w>600){
                w3=w2/8;
            }else if(w>400){
                w3=w2/5;
            }else{
                w3=w2/4;
            }
            $("#wrapper-logo li").css("width",w3+"px");
            $("#wrapper-logo li").css("height",w3+"px");
            $("#contents-logo").css("width",w3*($( "#wrapper-logo li" ).length)+"px");
            $("#wrapper-logo").parent().children("span").css("top",w3/2+"px");

            setTimeout(function(){onNext(true,listLogo)},2000);
            setTimeout(function(){onPrev(true,listNewEmployer)},3000);
            setTimeout(function(){onNext(true,listNewJobs)},4000);
        };
        var listLogo={
            isRun:false,
            wrapper:"wrapper-logo",
            contents:"contents-logo",
            item:"item-logo",
            action:""
        }
        var listNewEmployer={
            isRun:false,
            wrapper:"wrapper2",
            contents:"contents-employer",
            item:"item-work",
            action:""
        }
        var listNewJobs={
            isRun:false,
            wrapper:"wrapper",
            contents:"contents-jobs",
            item:"item-work",
            action:""
        }
        $("#btPrev").click(function(){onPrev(true,listLogo);});
        $("#btNext").click(function(){onNext(true,listLogo);});
        $("#btPrevNewJobs").click(function(){onPrev(true,listNewJobs);});
        $("#btNextNewJobs").click(function(){onNext(true,listNewJobs);});
        $("#btPrevNewEmployer").click(function(){onPrev(true,listNewEmployer);});
        $("#btNextNewEmployer").click(function(){onNext(true,listNewEmployer);});
        function onNext(b,ob){
            if(ob.isRun) return;
            if(b)clearTimeout(ob.action);
            ob.isRun=true;
            var w=$("#"+ob.contents +" ."+ob.item).outerWidth();
             var n=parseFloat($( "#"+ob.contents ).css("margin-left"));
             var w2=$( "#"+ob.contents ).outerWidth();
             var w3=$( "#"+ob.wrapper ).outerWidth();
             var n2=n-w;
             if(n2+w2-w3>=0){
                $( "#"+ob.contents ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){ob.isRun=false;}});
                ob.action=setTimeout(function(){onNext(false,ob);},2000);
             }
             else{ob.isRun=false;ob.action=setTimeout(function(){onPrev(false,ob);},2000);}
        }
        function onPrev(b,ob){
            if(ob.isRun) return;
            if(b)clearTimeout(ob.action);
            ob.isRun=true;
             var w=$("#"+ob.contents +" ."+ob.item).outerWidth();
             var n=parseFloat($( "#"+ob.contents ).css("margin-left"));
             var n2=n+w;
             if(n2<=0){
                $( "#"+ob.contents ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){ob.isRun=false;}});
                ob.action=setTimeout(function(){onPrev(false,ob);},2000);
             }
             else{ob.isRun=false;ob.action=setTimeout(function(){onNext(b,ob);},2000);}
        }
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

        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('.select-template').click(function(){
            var template_id = $(this).attr('data-id');

            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/company/changeTemplate",
                method: "POST",
                data: {
                    'template': template_id
                },
                dataType: "json"
            });

            request.done(function (msg) {
                if (msg.code == 200) {
                    location.reload();
                }else{
                    $('#register-message').show();
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });
    </script>
</body>
</html>

