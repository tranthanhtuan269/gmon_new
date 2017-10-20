<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />
    <link rel="stylesheet" href="assets/css/style-new-home.min.css" />

    <script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="assets/js/tether.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mmenu.all.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
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
                        <li>
                            <a href="#" class="avatar"><img src="assets/images/avatar.png" alt=""></a>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tên ứng viên
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li></li>
                        <li class="info">
                            <h5>dành cho nhà tuyển dụng</h5>
                            <h6 >Đăng tuyển dụng ứng viên & Tìm kiếm nhân tài</h6>
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
                            <li><a href="http://gmon.vn/showmore?job=new">Việc làm</a></li>
                            <li><a href="http://gmon.vn/showmore?company=new">Nhà tuyển dụng</a></li>
                            <li><a href="http://news.gmon.vn">Tư vấn nghề nghiệp</a></li>
                            <li>
                                <a href="#" class="avatar-mobile"><img src="assets/images/avatar.png" alt=""> Tên ứng viên</a>
                                <ul class="sub-menu" aria-labelledby="dropdownMenuButton">
                                   <li> <a class="dropdown-item" href="#">Action</a></li>
                                    <li> <a class="dropdown-item" href="#">Action</a></li>
                                    <li> <a class="dropdown-item" href="#">Action</a></li>
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
<div class="wrapper-homepage profile-05">
   <div class="container">
       <div class="row">
           <div class="left col-lg-3">
                <div class="avatar">
                    <img src="assets/images/avatar.png" alt="Avatar">
                </div>
                <div class="name">
                    <h3>nguyễn thị thục uyên</h3>
                    <h4>Đại học Kinh doanh và Công nghệ</h4>
                </div>
                <div class="job">
                    <h3>Việc làm</h3>
                    <ul>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                        <li><a href="">Trang chính</a></li>
                    </ul>
                </div>
               <div class="hot-job">
                   <h3>việc đang hot</h3>
                   <ul>
                       <li>
                           <div class="image">
                               <img src="assets/images/avatar.png" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="#">Nhân viên phục vụ tại Nhà hàng Thổ</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                       <li>
                           <div class="image">
                               <img src="assets/images/avatar.png" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="#">Nhân viên phục vụ tại Nhà hàng Thổ</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                       <li>
                           <div class="image">
                               <img src="assets/images/avatar.png" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="#">Nhân viên phục vụ tại Nhà hàng Thổ</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                       <li>
                           <div class="image">
                               <img src="assets/images/avatar.png" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="#">Nhân viên phục vụ tại Nhà hàng Thổ</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                       <li>
                           <div class="image">
                               <img src="assets/images/avatar.png" alt="avatar">
                           </div>
                           <div class="name-hot-job">
                               <a href="#">Nhân viên phục vụ tại Nhà hàng Thổ</a>
                           </div>
                           <div class="clearfix"></div>
                       </li>
                   </ul>
               </div>
               <div class="image-adv">
                   <img src="assets/images/job.jpg" alt="">
               </div>
           </div>
           <div class="col-lg-9 right profile-04 profile-03">
                <div class="title">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span>Cập nhật hồ sơ</span>
                </div>
                <div class="content">
                    <div class="profile-04__info">
                        <div class="row">
                            <div class="avatar col-md-4">
                                <div class="wrap">
                                    <img src="assets/images/avatar.png" alt="Avatar" />
                                </div>
                            </div>
                            <div class="info col-md-8">
                                <h2 class="name">Nguyễn Thị Thục Uyên</h2>
                                <div class="info-detail">
                                    <p>Sinh năm: <span>1997</span></p>
                                    <p>Giới tính: <span>Nữ</span></p>
                                    <p>Tỉnh/thành phố: <span>Hà Nội</span></p>
                                    <p>Quận huyện: <span>Cầu Giấy</span></p>
                                    <p>Có thể đi làm: <span>18h đến 23h</span></p>
                                    <p>Năng lực:
                                        <span class="black">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                        </span>
                                        <span class="white">
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </span>
                                    </p>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <p class="col-md-12 text-right btn-edit">
                                                <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    <span>quá trình học tập</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Trường học</td>
                                            <td>Đại học Thương Mại</td>
                                            <td>Đang học</td>
                                        </tr>
                                        <tr>
                                            <td>Thời gian học</td>
                                            <td>Từ 9/2015</td>
                                            <td>Đến nay</td>
                                        </tr>
                                        <tr>
                                            <td>Chuyên nghành</td>
                                            <td>Marketing & Sales</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Năm học</td>
                                            <td>2</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Thành tích học tập</td>
                                            <td>Khá - Sử dụng tốt tiếng Anh</td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__work">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>kinh nghiệm làm việc</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="item-profile-03">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="image col-md-4">
                                            <img src="assets/images/avatar.png" alt="">
                                        </div>
                                        <div class="col-md-8 profile-02_content">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td>Vị trí công việc</td>
                                                        <td>Mentor</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tên đơn vị đã làm</td>
                                                        <td>Volunterr for Education Organization (VEO)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Địa chỉ</td>
                                                        <td>BK-up Building số 17 Tạ Quang Bửu</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian làm</td>
                                                        <td>
                                                            <span>Từ 25/05/2017</span>
                                                            <span>Đến 10/07/2017</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mô tả công việc</td>
                                                        <td>
                                                            <p>
                                                                Dẫn đoàn, phân công công việc và hỗ trợ các thành viên trong team trong suốt
                                                                chuyến đi tình nguyện - Giao lưu kết nối các thành viên trong team, tạo không
                                                                khí vui vẻ đoàn kết - Lên timeline các chương trình giao lưu
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-profile-03">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="image col-md-4">
                                            <img src="assets/images/avatar.png" alt="">
                                        </div>
                                        <div class="col-md-8 profile-02_content">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td>Vị trí công việc</td>
                                                        <td>Mentor</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tên đơn vị đã làm</td>
                                                        <td>Volunterr for Education Organization (VEO)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Địa chỉ</td>
                                                        <td>BK-up Building số 17 Tạ Quang Bửu</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian làm</td>
                                                        <td>
                                                            <span>Từ 25/05/2017</span>
                                                            <span>Đến 10/07/2017</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mô tả công việc</td>
                                                        <td>
                                                            <p>
                                                                Dẫn đoàn, phân công công việc và hỗ trợ các thành viên trong team trong suốt
                                                                chuyến đi tình nguyện - Giao lưu kết nối các thành viên trong team, tạo không
                                                                khí vui vẻ đoàn kết - Lên timeline các chương trình giao lưu
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__skill">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="assets/images/logo-4.png" alt="">
                                    <span>Kỹ năng</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="container-fluid">
                                <div class="row">
                                    <p>Thành thạo Word và Excel</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__language">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="assets/images/logo-5.png" alt="">
                                    <span>Ngoại ngữ</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Tiếng Anh</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <span>Trình độ:</span>
                                            <span>Giao tiếp tốt (Toiec 550)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__personal">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="assets/images/logo-6.png" alt="">
                                    <span>sở thích/tính cách</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-justify">
                                            Thích đọc sách Marketing vì liên quan đến chuyên ngành - người luôn theo đuổi chủ nghĩa xê dịch luôn muốn đi du lịch khám phá giới hạn bản thân - đam mê những trò chơi mạo hiểm - Tham gia các hoạt động tình nguyện các tổ chức xã hội - Nghe nhạc
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-justify">
                                            Thích đọc sách Marketing vì liên quan đến chuyên ngành - người luôn theo đuổi chủ nghĩa xê dịch luôn muốn đi du lịch khám phá giới hạn bản thân - đam mê những trò chơi mạo hiểm - Tham gia các hoạt động tình nguyện các tổ chức xã hội - Nghe nhạc
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__purpose">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="assets/images/logo-7.png" alt="">
                                    <span>mục đích làm việc</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                            <li>Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__activity">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="assets/images/logo-8.png" alt="">
                                    <span>hoạt động ngoại khóa</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row btn-edit" style="float:right;padding-right: 15px;">
                                            <a href="">Chỉnh sửa <img src="assets/images/logo-9.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <p>
                                                Tham gia và hoạt động trong tổ chức tình nguyện giáo dục vì cộng đồng - CTV cho event " Make a different " gây quỹ phẫu thuật cho các bé bị dị tật bẩm sinh trên toàn quốc của tổ chức tình nguyện tại Mỹ ( UsA) kết hợp với các bệnh viện hàng đầu Hà Nội như: Bệnh viện Hồng Ngọc , bệnh viện Việt Đức , bệnh viện Xanh-Pôn......
                                            </p>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="row margin-0">
                                                <div class="wrap col-md-4">
                                                    <img src="assets/images/avatar.png" alt="Avatar" />
                                                </div>
                                                <div class="wrap col-md-4">
                                                    <img src="assets/images/avatar.png" alt="Avatar" />
                                                </div>
                                                <div class="wrap col-md-4">
                                                    <img src="assets/images/avatar.png" alt="Avatar" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                url: "http://gmon.vn/auth/login",
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
                url: "http://gmon.vn/auth/register",
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