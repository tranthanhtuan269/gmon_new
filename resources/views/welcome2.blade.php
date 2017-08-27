<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmon.vn</title>
    <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/jquery.mmenu.all.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style-new-home.min.css">

    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/tether.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/jquery.mmenu.all.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/js/custom.js"></script>
</head>
<body>
    <nav id="menu" class="mm-menu mm-offcanvas" aria-hidden="true">
        <div class="mm-panels">
            <div class="mm-panel mm-hasnavbar mm-opened" id="mm-1">
                <div class="mm-navbar">
                    <a class="mm-title">Menu</a>
                </div>
                <ul class="mm-listview">
                    <li><a href="http://gmon.com.vn/showmore?job=new">Việc làm</a></li>
                    <li><a href="http://gmon.com.vn/showmore?company=new">Nhà tuyển dụng</a></li>
                    <li><a href="{{ url('/') }}#">Tư vấn nghề nghiệp</a></li>
                    <li><a href="{{ url('/') }}#">Đăng nhập</a></li>
                    <li><a href="{{ url('/') }}#">Đăng ký</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="mm-0" class="mm-page mm-slideout" style=""><div class="header-homepage">
       <div class="top-menu">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-xl-6 col-lg-8 left-menu">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="logo">
                                   <a href="{{ url('/') }}#"><img src="{{ url('/') }}/public/images/logo-2.png" alt="logo"></a>
                               </div>
                           </div>
                           <ul class="homepage-menu col-md-8">
                               <li class="active"><a href="http://gmon.com.vn/showmore?job=new">Việc làm</a></li>
                               <li><a href="http://gmon.com.vn/showmore?company=new">Nhà tuyển dụng</a></li>
                               <li><a href="{{ url('/') }}#">Tư vấn nghề nghiệp</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-xl-6 col-lg-4 right-menu">
                       <ul class="homepage-menu">
                           <li><a href="{{ url('/') }}#"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
                           <li><a href="{{ url('/') }}#">Đăng ký</a></li>
                           <li class="info">
                               <h5>dành cho nhà tuyển dụng</h5>
                               <h6>Đăng tuyển dụng ứng viên &amp; Tìm kiếm nhân tài</h6>
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
                        <a href="{{ url('/') }}#"><img src="{{ url('/') }}/public/images/logo-2.png" alt="logo"></a>
                    </div>
                    <div class="col-sm-6 col-6 right">
                        <a href="{{ url('/') }}#menu" class="fa fa-bars"></a>
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
                                <a href="http://gmon.com.vn/showmore?job=new">Tất cả công việc</a>
                                <a href="http://gmon.com.vn/showmore?job=vip1">Việc làm vip</a>
                                <a href="http://gmon.com.vn/showmore?job=vip2">Việc làm hot</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><div class="wrapper-homepage">
        <div class="part-1">
            <div class="container">
                <div class="wrap">
                    <h2>Tìm một công việc bạn yêu thích với <span>GMON #1 jod site</span></h2>
                    <div class="hr"></div>
                    <ul class="number">
                        <li><span>#1</span> Trang tuyển dụng chuyên nghiệp</li>
                        <li><span>1,500</span> lượt xem mỗi đăng tuyển</li>
                        <li><span>20,000</span> ứng viên tiềm năng</li>
                    </ul>

                    <div class="list-job row">
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
                        <div class="item col-md-4">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/job.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="{{ url('/') }}#">Công việc tại khách sạn Mường Thanh</a>
                            </div>
                        </div>
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
                    <img src="{{ url('/') }}/public/images/part-2.jpg" alt="">
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
                                <img src="{{ url('/') }}/public/images/linh_vuc1.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://spa.gmon.com.vn">Spa</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/linh_vuc2.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?field=1">Khách sạn</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/linh_vuc3.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?field=2">Nhà hàng</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/linh_vuc4.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?field=4">Doanh nghiệp</a>
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
                                <img src="{{ url('/') }}/public/images/khu_vuc1.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?city=1">Hà Nội</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/khu_vuc2.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?city=3">Đà Nẵng</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/khu_vuc3.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?city=2">Hồ Chí Minh</a>
                            </div>
                        </div>
                        <div class="item col-md-3">
                            <div class="image">
                                <img src="{{ url('/') }}/public/images/khu_vuc4.jpg" alt="">
                            </div>
                            <div class="title">
                                <a href="http://gmon.com.vn/?city=other">Khu vực khác</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><div class="footer-homepage">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-1 item">
                        <div class="title">
                            về gmon
                        </div>
                        <ul>
                            <li><a href="{{ url('/') }}">giới thiệu</a></li>
                            <li><a href="{{ url('/') }}/">việc làm</a></li>
                            <li><a href="{{ url('/') }}/showmore?company=new">nhà tuyển dụng</a></li>
                            <li><a href="{{ url('/') }}/showmore?cv=vip">hồ sơ ứng viên</a></li>
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
                <p>Công ty cổ phần giải pháp Gmon</p>
                <p>Địa chỉ: P801 - Tòa nhà Trần Phú, số 17 tổ 24 đường Dương Đình Nghệ - P.Yên Hòa - Q. Cầu Giấy, Hà Nội</p>
                <p>Điện thoại: 024.3212.1515</p>
                <p>Email nhà tuyển dụng: <a href="{{ url('/') }}">vieclamhn@gmail.com</a></p>
                <p>Email ứng viên: <a href="{{ url('/') }}">tuyendunghn@gmon.com</a></p>
            </div>
        </div>
    </div>
</div>
<div id="mm-blocker" class="mm-slideout"></div>
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