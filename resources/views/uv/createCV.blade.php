@extends('layouts.layout_uv')

@section('content')
<script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
<script type="text/javascript" src="{{ url('/') }}/public/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
           <div class="col-lg-9 right profile-04">
                <div class="title">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span>Cập nhật hồ sơ</span>
                </div>
                <div class="content">
                    <div class="profile-04__info">
                        <div class="row">
                            <div class="avatar col-md-4">
                                <div class="wrap">
                                    <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar" />
                                    <div class="btn-camera">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                        <p>Thay đổi ảnh đại diện</p>
                                    </div>
                                </div>
                            </div>
                            <div class="info col-md-8">
                                <form>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Họ và tên(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <label for="name"></label>
                                                    <input type="text" class="form-control col-md-12" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Ngày sinh(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <div class='input-group date' id='datetimepicker'>
                                                        <input type='text' class="form-control" name="birthday" id="birthday" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Địa chỉ(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <div class="row margin-0">
                                                    <label for="provinde"></label>
                                                    <select id="provinde" class="form-control col-md-12">
                                                        <option value="1">Tỉnh/TP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <div class="row margin-0">
                                                    <label for="street"></label>
                                                    <select id="street" class="form-control col-md-12">
                                                        <option value="1">Quận/Huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Giới tính(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <label for="gender"></label>
                                                    <select class="form-control col-md-12" name="" id="gender">
                                                        <option value="1">Nam</option>
                                                        <option value="2">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Thời gian làm(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <label for="phone"></label>
                                                    <input type="text" class="form-control col-md-12" id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Số điện thoại(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <label for="phone"></label>
                                                    <input type="text" class="form-control col-md-12" id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="row">
                                                    <label class="col-form-label col-md-12">Email(<span class="star">*</span>)</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-9">
                                                <div class="row margin-0">
                                                    <label for="phone"></label>
                                                    <input type="email" class="form-control col-md-12" id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
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
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio">Chứng chỉ</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio">Đại học/Cao Đẳng/Trung cấp</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio">Dưới Đại học/Cao Đẳng/Trung cấp</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Trường học(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio">Đã tốt nghiệp</label>
                                                <label><input type="radio" name="optradio">Đang học</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Thời gian(<span class="star">*</span>)</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <label class="col-form-label col-md-2">Từ </label>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="month"></label>
                                                        <select id="month" class="form-control col-md-12">
                                                            <option value="1">Tháng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="year"></label>
                                                        <select id="year" class="form-control col-md-12">
                                                            <option value="1">Năm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <label class="col-form-label col-md-2">Đến </label>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="month"></label>
                                                        <select id="month" class="form-control col-md-12">
                                                            <option value="1">Tháng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="year"></label>
                                                        <select id="year" class="form-control col-md-12">
                                                            <option value="1">Năm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12" style="padding-right: 0">Chuyên nghành(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="phone"></label>
                                                <input type="text" class="form-control col-md-12" id="phone" placeholder="Nhập chuyên nghành học">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12" style="padding-right: 0">Loại tốt nghiệp(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="gender"></label>
                                                <select class="form-control col-md-12" name="" id="gender">
                                                    <option value="0">Chọn loại tốt nghiệp</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12" style="padding-right: 0">Thành tích học tập</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="phone"></label>
                                                <input type="text" class="form-control col-md-12" id="phone" placeholder="Kể về thành tích học tập của bạn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="add">
                                <a href="">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>Thêm học tập mới</span>
                                </a>
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
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Vị trí công việc</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Tên đơn vị(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Địa chỉ(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Thời gian(<span class="star">*</span>)</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <label class="col-form-label col-md-2">Từ </label>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="month"></label>
                                                        <select id="month" class="form-control col-md-12">
                                                            <option value="1">Tháng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="year"></label>
                                                        <select id="year" class="form-control col-md-12">
                                                            <option value="1">Năm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <label class="col-form-label col-md-2">Đến </label>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="month"></label>
                                                        <select id="month" class="form-control col-md-12">
                                                            <option value="1">Tháng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row margin-0">
                                                        <label for="year"></label>
                                                        <select id="year" class="form-control col-md-12">
                                                            <option value="1">Năm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <div class="row margin-0">
                                                <label for="name1">Tải ảnh tốt nhất về công việc</label>
                                                <div class="wrap">
                                                    <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar" />
                                                    <div class="btn-camera">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                        <p>Thay đổi ảnh đại diện</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-7">
                                            <div class="row margin-0">
                                                <label for="name1">Mô tả công việc</label>
                                                <textarea class="form-control col-md-12" id="name1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="add">
                                <a href="">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>Thêm kinh nghiệm làm việc mới</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__skill">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="{{ url('/') }}/public/assets/images/logo-4.png" alt="">
                                    <span>kỹ năng</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Tên kỹ năng(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1" placeholder="Ví dụ: Tin học văn phòng word, ...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="add">
                                <a href="">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>Thêm kỹ năng mới</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__language">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="{{ url('/') }}/public/assets/images/logo-5.png" alt="">
                                    <span>ngoại ngữ</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Tên kỹ năng(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1" placeholder="Nhập tên ngoại ngữ">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <input type="text" class="form-control col-md-12" id="name1" placeholder="Nhập trình độ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="add">
                                <a href="">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>Thêm ngoại ngữ mới</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__personal">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="{{ url('/') }}/public/assets/images/logo-6.png" alt="">
                                    <span>sở thích/tính cách</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <textarea class="form-control col-md-12" id="name1" placeholder="Sở thích"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <textarea class="form-control col-md-12" id="name1" placeholder="Tính cách"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__purpose">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="{{ url('/') }}/public/assets/images/logo-7.png" alt="">
                                    <span>mục đích làm việc</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
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
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Option 1</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Option 2</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="" disabled>Option 3</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="profile-04__study profile-04__activity">
                        <div class="profile-04__study__title">
                            <div class="row">
                                <div class="col-md-6 profile-04__study__title__left">
                                    <img src="{{ url('/') }}/public/assets/images/logo-8.png" alt="">
                                    <span>hoạt động ngoại khóa</span>
                                </div>
                                <div class="col-md-6 profile-04__study__title__right">
                                    <div class="container-fluid">
                                        <div class="row" style="float:right;padding-right: 15px;">
                                            <button type="submit" class="btn btn-primary btn-submit">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                <span>Lưu</span>
                                            </button>
                                            <button type="reset" class="btn btn-default btn-reset">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                <span>Xóa</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-04__study__content">
                            <form>
                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div class="row">
                                                <label class="col-form-label col-md-12">Tên kỹ năng(<span class="star">*</span>)</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <div class="row margin-0">
                                                <label for="name1"></label>
                                                <textarea class="form-control col-md-12" id="name1" placeholder="Nhập các thông tin ngoại khóa"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name1">Tải 3 ảnh tốt nhất về hoạt động ngoại khóa của bạn</label>
                                            <div class="row margin-0">
                                                <div class="wrap col-md-4">
                                                    <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar" />
                                                    <div class="btn-camera">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                        <p>Thay đổi ảnh đại diện</p>
                                                    </div>
                                                </div>
                                                <div class="wrap col-md-4">
                                                    <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar" />
                                                    <div class="btn-camera">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                        <p>Thay đổi ảnh đại diện</p>
                                                    </div>
                                                </div>
                                                <div class="wrap col-md-4">
                                                    <img src="{{ url('/') }}/public/assets/images/avatar.png" alt="Avatar" />
                                                    <div class="btn-camera">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                        <p>Thay đổi ảnh đại diện</p>
                                                    </div>
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

<script type="text/javascript">
  var site_url = $('base').attr('href');
  $('#datetimepicker').datetimepicker({
      format: 'DD/MM/YYYY'
  });
</script>
@endsection