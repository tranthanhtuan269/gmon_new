<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" target="_blank">
    <title>{{ config('app.name', 'Gmon') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/customize.css">
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
                                        <a target="_self" href=""><i></i>Việc làm</a>
                                        <a target="_self" href=""><i></i>Nhà tuyển dụng</a>
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
                                                                    <!-- <div class="row text-center">
                                                                        <p>Tiếp tục với</p>
                                                                        <a target="_self" href="#" class="facebook"><i></i> Facebook</a>
                                                                        <a target="_self" href="#" class="google"><i></i> Google</a>
                                                                        <span class="col-md-12" style="display: inline-block;margin-bottom: 30px"><hr style="float: left;width: 40%;margin-top: 25px">Hoặc<hr style="float: right;width: 40%;margin-top: 25px"></span>
                                                                    </div> -->
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
                                                    <li><a target="_self" href="http://gmon.vn/admin">Administrator</a></li>
                                                    @elseif(Auth::check() && Auth::user()->hasRole('master'))
                                                    <li><a target="_self" href="http://gmon.vn/admin">Administrator</a></li>
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
    
        <div class="container info-page">
            <div class="main-menu row">
                <div class="slide"><img src="http://test.gmon.com.vn/?image={{ $company->banner }}" width="100%" height="auto" alt=""><img class="img-thumbnail logo" src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt="" width="250" height="250"></div>
                <p class="menu">
                    <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info" class="active"dụng>Thông Tin</a>
                    <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/listjobs">Tuyển Dụng</a>
                    <button type="button" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
                    <button type="button" class="btn btn-danger" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
                </p>
            </div>
            <div class="main-content row">
                <div class="col-left col-md-9 col-xs-12">
                    <div class="row">
                        <div class="hot-new">
                            <span style="color:#f99f3c; display: none;">Tin nóng: </span>
                            <a target="_self" href="" style="display: none;">Khai trương nhà hàng tại 156 Cầu Giấy
                                <span class="hot-new-img"></span></a>
                            @if(Auth::user())
                                @if($company->user != Auth::user()->id)
                                    <button type="button" class="bt-rate btn btn-primary" data-toggle="modal" data-target="#add-comment"><i></i>Thêm đánh giá</button>
                                @else
                                    <button id="create_job_btn" class="bt-rate btn btn-primary"><i></i>Tạo tuyển dụng</button>
                                @endif
                            @else  
                                <button  type="button" class="bt-rate btn btn-primary" data-toggle="modal" data-target="#add-comment"><i></i>Thêm đánh giá</button>
                            @endif
                        </div>
                    </div>

                    <div class="pn-left pn-hightlight row info-company">
                        <h5>VỀ CHÚNG TÔI</h5>
                        <div class="col-md-4 col-xs-12">
                            <img src="http://test.gmon.com.vn/?image={{ $company->logo }}">
                        </div>
                        <div class="col-md-8 col-xs-12 border-blue">
                            <p class="row"><h3 class="text-upper">{{ $company->name }}</h3></p>
                            <p class="row"><i></i>{{ $company->address }}, {{ $company->city }}</p>
                            <p class="row"><i></i>{{ $company->district }}, {{ $company->city }}</p>
                            @if(strlen($company->jobs) > 0)
                                <p class="row"><i></i>{{ rtrim($company->jobs,";") }}</p>
                            @endif
                            <p class="row"><i></i>{{ $company->size }} người</p>
                            <p class="row"><i></i>Thứ 2 -  Thứ 6</p>
                            @if(strlen($company->sologan)>0)<p class="row"><i></i>{{ $company->sologan }}</p>@endif
                        </div>
                        <div class="col-md-12 col-xs-12" style="margin-top: 15px;">
                            <div class="row"><div class="col-md-12 col-xs-12"><?php echo $company->description; ?></div></div>
                        </div>
                    </div>
                    <?php 
                        if(strlen($company->images)>0){
                            ?>
                    <div class="pn-left pn-hightlight row">
                        <h5>NƠI BẠN SẼ LÀM VIỆC</h5>
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="wrapper-big" id="wrapper-big">
                                        <div class="prev" id="btPrev-big"><img src="http://test.gmon.com.vn/?image=prev.png" alt=""></div>
                                        <div class="next"  id="btNext-big"><img src="http://test.gmon.com.vn/?image=next.png" alt=""></div>
                                        <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                                            <div id="contents-big">
                                                <?php 
                                                    
                                                    $imageString=rtrim($company->images,";");
                                                    $images = explode(";",$imageString);
                                                    foreach ($images as $image) {
                                                ?>
                                                <div class="item-work-big" >
                                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $image }}" alt=""></p>
                                                </div>
                                                <?php 
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>

                    <?php 
                        if(strlen($company->youtube_link)>0){
                            ?>
                    <div class="pn-left pn-hightlight row">
                        <h5>VIDEO VỀ CHÚNG TÔI</h5>
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12" style="text-align: center">
                                    <iframe width="560" height="315" src="{{ str_replace('watch?v=','embed/',$company->youtube_link) }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="pn-left pn-hightlight row">
                        <h5>ĐỊA CHỈ</h5>
                        <div id="map"></div>
                    </div>
                </div>
                <div class="col-md-3 col-right col-xs-12">
                    <div class="pn-rating pn-left row">
                        <h5>Đánh giá chung</h5>
                        <p class="star-vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($votes > 1) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($votes > 2) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($votes > 3) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($votes > 4) class="vote" @else class="no-vote" @endif>
                        </p>
                    </div>
                    <div class="pn-left pn-hightlight row">
                        <h5>Mọi người nói về chúng tôi</h5>
                        @foreach($comments as $comment)
                        <p class="content">
                            <span>{{ $comment->title }}</span>
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 1) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 2) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 3) class="vote" @else class="no-vote" @endif>
                                 <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 4) class="vote" @else class="no-vote" @endif>
                                 <span>{{ $comment->description }}</span>
                        </p>
                        @endforeach
                        <div class="bot"><span class="active"></span>
                            <span class="active"></span>
                            <span></span>
                            <span></span></div>
                    </div>
                </div>
            </div>
            <!-- <div class="related-work row">
                <p class="title"><i></i>Thêm cơ hội làm việc cho bạn</p>
                <div class="wrapper" id="wrapper">
                    <div class="prev" id="btPrev"><img src="http://test.gmon.com.vn/?image=prev.png" alt=""></div>
                    <div class="next"  id="btNext"><img src="http://test.gmon.com.vn/?image=next.png" alt=""></div>
                    <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                        <div id="contents">
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item-work" >
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <p class="single">Nhân viên pha chế Starbucks Coffee</p>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
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
                        <p>Điện thoại: 0243.212.1515</p>
                        <p>Email nhà tuyển dụng: vieclamhn@gmon.vnEmail nhà tuyển dụng</p>
                        <p>Email ứng viên: tuyendunghn@gmon.vn</p>
                    </div>
                    <div class="col-md-4">
                        <p style="margin-top: 15px">&#64; 2016-2017 Gmon.vn,inc. All rights reserved</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="add-comment" tabindex="-1" role="dialog" aria-labelledby="addComment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Đánh giá nhà tuyển dụng</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <input type="hidden" name="company-id" value="{{ $company->id }}">
                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-3 control-label">Đánh giá</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputDescription" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputScore" class="col-sm-3 control-label">Cho điểm</label>
                                <div class="col-sm-9">
                                    <p class="star-vote" id="star-vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="vote">
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                        <button type="button" class="btn btn-primary" id="send-comment">Gửi đánh giá</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = function ()
            {
                var w = screen.width;
                var w2 = $("#wrapper").outerWidth();
                var w3;
                if (w > 768) {
                    w3 = w2 / 5;
                } else if (w > 600) {
                    w3 = w2 / 3;

                } else {
                    w3 = w2;
                }
                $(".item-work").css("width", w3 + "px");
                var n = w3 * ($("#contents .item-work").length);
                $("#contents").css("width", n + "px");
                setTimeout(function () {
                    onNext(false);
                }, 2000);

                //------------------------------------------------//

                var w2_big = $("#wrapper-big").outerWidth();
                var w3_big = w2_big;
                $(".item-work-big").css("width", w3_big + "px");
                var n_big = w3_big * ($("#contents-big .item-work-big").length);
                $("#contents-big").css("width", n_big + "px");
                setTimeout(function () {
                    onNext_big(false);
                }, 2000);
            };

            var isR = false;
            var action;
            $("#btPrev").click(function () {
                onPrev(true);
            });
            $("#btNext").click(function () {
                onNext(true);
            });
            function onNext(b) {
                if (b)
                    clearTimeout(action);
                if (isR)
                    return;
                isR = true;
                var w = $(".item-work").outerWidth();
                var n = parseFloat($("#contents").css("margin-left"));
                var w2 = $("#contents").outerWidth();
                var w3 = $("#wrapper").outerWidth();
                var n2 = n - w;
                if (n2 + w2 - w3 >= 0) {
                    $("#contents").animate({marginLeft: n2 + 'px'}, {duration: 300, complete: function () {
                            isR = false;
                        }});
                    action = setTimeout(function () {
                        onNext(false);
                    }, 2000);
                } else {
                    isR = false;
                    action = setTimeout(function () {
                        onPrev(false);
                    }, 2000);
                }
            }
            function onPrev(b) {
                if (b)
                    clearTimeout(action);
                if (isR)
                    return;
                isR = true;
                var w = $(".item-work").outerWidth();
                var n = parseFloat($("#contents").css("margin-left"));
                var w2 = $("#contents").outerWidth();
                var n2 = n + w;
                if (n2 <= 0) {
                    $("#contents").animate({marginLeft: n2 + 'px'}, {duration: 300, complete: function () {
                            isR = false;
                        }});
                    action = setTimeout(function () {
                        onPrev(false);
                    }, 2000);
                } else {
                    isR = false;
                    action = setTimeout(function () {
                        onNext(false);
                    }, 2000);
                }
            }

            // -----------------------------------------------------
            var isR_big = false;
            var action_big;
            $("#btPrev-big").click(function () {
                onPrev_big(true);
            });
            $("#btNext-big").click(function () {
                onNext_big(true);
            });
            function onNext_big(b_big) {
                if (b_big)
                    clearTimeout(action_big);
                if (isR_big)
                    return;
                isR_big = true;
                var w_big = $(".item-work-big").outerWidth();
                var n_big = parseFloat($("#contents-big").css("margin-left"));
                var w2_big = $("#contents-big").outerWidth();
                var w3_big = $("#wrapper-big").outerWidth();
                var n2_big = n_big - w_big;
                if (n2_big + w2_big - w3_big >= 0) {
                    $("#contents-big").animate({marginLeft: n2_big + 'px'}, {duration: 300, complete: function () {
                            isR_big = false;
                        }});
                    action_big = setTimeout(function () {
                        onNext(false);
                    }, 2000);
                } else {
                    isR_big = false;
                    action_big = setTimeout(function () {
                        onPrev(false);
                    }, 2000);
                }
            }
            function onPrev_big(b_big) {
                if (b_big)
                    clearTimeout(action_big);
                if (isR_big)
                    return;
                isR_big = true;
                var w_big = $(".item-work-big").outerWidth();
                var n_big = parseFloat($("#contents-big").css("margin-left"));
                var w2_big = $("#contents-big").outerWidth();
                var n2_big = n_big + w_big;
                if (n2_big <= 0) {
                    $("#contents-big").animate({marginLeft: n2_big + 'px'}, {duration: 300, complete: function () {
                            isR_big = false;
                        }});
                    action_big = setTimeout(function () {
                        onPrev(false);
                    }, 2000);
                } else {
                    isR_big = false;
                    action_big = setTimeout(function () {
                        onNext(false);
                    }, 2000);
                }
            }

            function initMap() {
                <?php if($company->lat == "" || $company->lng == ""){ ?>
                    var uluru = {lat: 21.027443939911, lng: 105.83038324971};
                <?php }else{ ?>
                    var uluru = {lat: {{ $company->lat }}, lng: {{ $company->lng }}};
                <?php } ?>
                
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,
                  center: uluru
                });
                var marker = new google.maps.Marker({
                  position: uluru,
                  map: map
                });
            }

            $('#star-vote>img').click(function () {
                switch ($(this).attr('id')) {
                    case 'star-vote-1':
                        $('#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote-2').removeClass('vote').addClass('no-vote');
                        $('#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-2':
                        $('#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-3':
                        $('#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-4':
                        $('#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-5':
                        $('#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote-5').removeClass('no-vote').addClass('vote');
                        break;
                    default:
                        break;
                }
            });
            $('#send-comment').click(function () {
                var countStar = $('#star-vote>img.vote').length;
                var title = '';
                var description = $('#inputDescription').val();
                var company = $('input[name=company-id]').val();
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/send-comment",
                    method: "POST",
                    data: {
                        'company': company,
                        'title': title,
                        'description': description,
                        'countStar': countStar,
                    },
                    dataType: "json"
                });

                request.done(function (msg) {
                    if (msg.code == 200) {
                        $('#add-comment').modal('toggle');
                        swal("Thông báo", "Thêm đánh giá thành công!", "success");
                    } else if(msg.code == 404 && msg.message == "unauthen"){
                        $('#add-comment').modal('toggle');
                        swal("Cảnh báo", "Bạn phải đăng nhập để có thể sử dụng chức năng này!", "error");
                    }else{
                        $('#add-comment').modal('toggle');
                        swal("Cảnh báo", msg.message, "error");
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });
            $('#follow-btn').click(function () {
                var company = $('input[name=company-id]').val();
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/follow-company",
                    method: "POST",
                    data: {
                        'company': company
                    },
                    dataType: "json"
                });

                request.done(function (msg) {
                    if (msg.code == 200) {
                        // thong bao khi follow thanh cong
                        $('#follow-btn').hide();
                        $('#unfollow-btn').show();
                    } else if(msg.code == 200) {
                        swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });
            $('#unfollow-btn').click(function () {
                var company = $('input[name=company-id]').val();
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/unfollow-company",
                    method: "POST",
                    data: {
                        'company': company
                    },
                    dataType: "json"
                });

                request.done(function (msg) {
                    if (msg.code == 200) {
                        // thong bao khi unfollow thanh cong
                        $('#follow-btn').show();
                        $('#unfollow-btn').hide();
                    } else {
                        swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });

            $('#create_job_btn').click(function(){
                window.location.href = "{{ url('/') }}/job/create";
            });

            function onCloseModalLogin() {
                $("#myModal").modal('toggle');
            }
            function onOpenRegister() {
                $("#register").addClass("in active");
                $("#login").removeClass("in active");
                $(".header-tab-login li:nth-child(1)").removeClass("active");
                $(".header-tab-login li:nth-child(2)").addClass("active");
            }
            function onOpenLogin() {
                $("#login").addClass("in active");
                $("#register").removeClass("in active");
                $(".header-tab-login li:nth-child(2)").removeClass("active");
                $(".header-tab-login li:nth-child(1)").addClass("active");
            }
            function onFocusCandidates(event) {
                $(event.target).find(".view").animate({top: 0 + 'px'}, 300);
            }
            function onDisFocusCandidates(event) {
                $(event.target).find(".view").animate({top: 200 + 'px'});
            }
            $(document).ready(function () {
                onOpenLogin();
                $('#login-btn').click(function () {
                    var loginEmail = $('#login-email').val();
                    var loginPassword = $('#login-password').val();
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
                            $('#login-message').show();
                        }
                    });

                    request.fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    });
                });

                $('#register-btn').click(function () {
                    $('#register-message').hide();
                    var registerFirstname = $('#firstname').val();
                    var registerLastname = $('#lastname').val();
                    var username = registerFirstname + ' ' + registerLastname;
                    var registersdt = $('#sdt').val();
                    var registerEmail = $('#register-email').val();
                    var registerPassword = $('#register-password').val();
                    var rPassword = $('#r_password').val();
                    var role = $('#areyou').val();
                    if (registerPassword != rPassword) {
                        return false;
                    }

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
                        }else{
                            $('#register-message').show();
                        }
                    });

                    request.fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    });
                });
            });
        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhlfeeJco9hP4jLWY1ObD08l9J44v7IIE&callback=initMap">
        </script>
    </body>
</html>