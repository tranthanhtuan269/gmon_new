<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
<div class="header-homepage news">
    <div class="top-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-8 left-menu">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="logo">
                                <a href="#"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                            </div>
                        </div>
                        <ul class="homepage-menu col-md-8">
                            <li class="active"><a href="#">Việc làm</a></li>
                            <li><a href="#">Nhà tuyển dụng</a></li>
                            <li><a href="#">Tư vấn nghề nghiệp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 right-menu">
                    <ul class="homepage-menu">
                        <li>
                            <a class="menuLogin" href="#" data-toggle="modal" data-target="#loginHeader"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
                        <li><a class="menuRegister" href="#" data-toggle="modal" data-target="#loginHeader">Đăng ký</a></li>
                        <li class="info">
                            <h5>dành cho nhà tuyển dụng</h5>
                            <h6 >Đăng tuyển dụng ứng viên & Tìm kiếm nhân tài</h6>
                        </li>
                    </ul>
                    <div id="loginHeader" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <!-- Nav tabs -->
                                <ul class="nav nav-justified" role="tablist">
                                    <li class="nav-item login">
                                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Đăng nhập</a>
                                    </li>
                                    <li class="nav-item register">
                                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Đăng ký</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane login active" id="home" role="tabpanel">
                                        <form>
                                            <div class="form-group">
                                                <label for="email"></label>
                                                <input type="email" class="form-control" id="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"></label>
                                                <input type="password" class="form-control" id="phone" placeholder="Mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                            </div>

                                        </form>
                                        <div class="clear"></div>
                                        <div class="footer text-center">
                                            <p>Hoặc đăng nhập bằng</p>
                                            <div class="rows">
                                                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i> facebook</a>
                                                <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i> google</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane register" id="profile" role="tabpanel">
                                        <h3>đăng ký tài khoản gmon ngay!</h3>
                                        <form>
                                            <div class="form-group">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control" id="name1" placeholder="Họ & tên">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone1"></label>
                                                <input type="text" class="form-control" id="phone1" placeholder="Số điện thoại">
                                            </div>
                                            <div class="form-group">
                                                <label for="email1"></label>
                                                <input type="email" class="form-control" id="email1" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass1"></label>
                                                <input type="password" class="form-control" id="pass1" placeholder="Mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <label for="repass1"></label>
                                                <input type="password" class="form-control" id="repass1" placeholder="Xác nhận mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Đăng ký ngay</button>
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
                    <a href="#"><img src="http://test.gmon.com.vn/?image=logo-2.png" alt="logo"/></a>
                </div>
                <div class="col-sm-6 col-6 right">
                    <a href="#menu" class="fa fa-bars"></a>
                    <nav id="menu">
                        <ul>
                            <li><a href="#">Việc làm</a></li>
                            <li><a href="#">Nhà tuyển dụng</a></li>
                            <li><a href="#">Tư vấn nghề nghiệp</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#loginHeader">Đăng nhập</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#loginHeader">Đăng ký</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="images">
        <img src="{{ url('/') }}/public/images/bg-news.jpg" alt="news">
    </div>
</div>
<div class="wrapper-homepage news">
    <div class="container-fluid">
        <div class="row menu-top">
            <div class="col-md-3"></div>
            <div class="col-md-6 content">
                <ul class="list-inline">
                    <?php 
                        $categorySelected = 0;
                        $count = 0;
                        if (isset($_GET['category'])) {
                            $categorySelected = $_GET['category'];
                        }
                    ?>
                    @foreach($categories as $category)
                        <li><a @if($categorySelected == $category->id || ($categorySelected == 0 && $count == 0)) class="active" @endif href="{{ url('/') }}/?category={{ $category->id }}">{{ $category->name }}</a></li>
                        <?php $count++; ?>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="main-content-news row">
            <div class="col-md-3 left">
                <div class="left-menu">
                    <h3>chủ đề</h3>
                    <ul class="list-inline">                        
                        <?php 
                            $categorySelected = 0;
                            $count = 0;
                            if (isset($_GET['category'])) {
                                $categorySelected = $_GET['category'];
                            }
                        ?>
                        @foreach($categories as $category)
                            <li><a @if($categorySelected == $category->id || ($categorySelected == 0 && $count == 0)) class="active" @endif href="{{ url('/') }}/?category={{ $category->id }}">{{ $category->name }}</a></li>
                            <?php $count++; ?>
                        @endforeach
                        <li><a href="">liên hệ <i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="left-content">
                    <h3>Việc làm HOT</h3>
                    @foreach($jobs as $job)
                    <div class="item">
                        <div class="image">
                            <img src="http://test.gmon.com.vn/?image={{ $job->banner }}" width="305" height="156" alt="HOT" />
                        </div>
                        <div class="title">
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}">{{ $job->companyName }} TUYỂN DỤNG {{ $job->name }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 middle">
                @foreach($posts as $post)
                <div class="item">
                    <div class="top-content">
                        <div class="avatar">
                            <img src="http://test.gmon.com.vn/?image=avatar.png" alt="" />
                        </div>
                        <div class="name">
                            <h3>Gmon</h3>
                            <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> 15 phút trước</div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                    <div class="middle-content">
                        <div class="title">
                            {{ $post->title }}
                        </div>
                        <p>
                            <?php echo substr($post->description, 0, 500); ?> <a href="{{ url('/')}}/post/{{ $post->id }}">Xem thêm</a>
                        </p>
                        <div class="images">
                            <img src="http://test.gmon.com.vn/?image={{  $post->image }}" alt="" />
                        </div>
                    </div>
                    <div class="bottom-content row" style="display: none">
                        <a class="comment col-md-3" href=""><i class="fa fa-commenting-o" aria-hidden="true"></i> 0 Bình luận</a>
                        <a class="facebook col-md-3" href=""><i class="fa fa-facebook-official" aria-hidden="true"></i> Chia sẻ</a>
                        <a class="like col-md-3" href=""><i class="fa fa-heart" aria-hidden="true"></i> 0 Yêu thích</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3 right">
                <h3>Nhà tuyển dụng HOT</h3>
                @foreach($companies as $company)
                <div class="item">
                    <div class="image">
                        <img src="http://test.gmon.com.vn/?image={{ $company->banner }}" alt="" />
                        <div class="logo">
                            <img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt="" />
                        </div>
                    </div>
                    <div class="title">
                        <a href="{{ url('/') }}/company/{{ $company->id }}/info">Công việc tại {{ $company->name }}</a>
                    </div>
                </div>
                @endforeach
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
                        <li><a href="">giới thiệu</a></li>
                        <li><a href="">việc làm</a></li>
                        <li><a href="">nhà tuyển dụng</a></li>
                        <li><a href="">hồ sơ ứng viên</a></li>
                        <li><a href="">nhà tuyển dụng</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-2 item">
                    <div class="title">
                        công cụ
                    </div>
                    <ul>
                        <li><a href="">hồ sơ</a></li>
                        <li><a href="">việc làm của tôi</a></li>
                        <li><a href="">thông báo việc làm</a></li>
                        <li><a href="">phản hồi</a></li>
                        <li><a href="">tư vấn nghề nghiệp</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-3 item">
                    <div class="title">
                        về gmon
                    </div>
                    <ul>
                        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <p>Công ty cổ phần giải pháp Gmon</p>
            <p>Địa chỉ: P801 - Tòa nhà Trần Phú, số 17 tổ 24 đường Dương Đình Nghệ - P.Yên Hòa - Q. Cầu Giấy, Hà Nội</p>
            <p>Điện thoại: 024.3212.1515</p>
            <p>Email nhà tuyển dụng: <a href="">vieclamhn@gmail.com</a></p>
            <p>Email ứng viên: <a href="">tuyendunghn@gmon.com</a></p>
        </div>
    </div>
</div>
</body>
</html>