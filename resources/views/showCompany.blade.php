@extends('layouts.layout')

@section('content')
<?php $jobstype = \App\JobType::select('id', 'name')->get(); ?>
    <header>
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-md-3">
                        <a target="_self" href="" class="logo row"><img src="http://test.gmon.com.vn/?image=home.png" alt=""></a>
                    </div>
                    <div class="col-md-9" style="margin-top: 30px">
                        <div class="">
                            <div class="col-md-9">
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
                                    <button class="submit visible-xs search-btn" style="width: auto;border:1px solid #EBEAEA;padding:5px 7px;height: auto;margin:auto;margin-top: 10px;background-color: #F5F5F5;color:#A8A8A8;border-radius: 4px">Tìm kiếm</button>
                                </form>
                                <div class="city">
                                    <a target="_self" href="{{ url('/') }}/city/1/ha-noi">Hà Nội</a>
                                    <a target="_self" href="{{ url('/') }}/city/2/ho-chi-minh">TP HCM</a>
                                    <a target="_self" href="{{ url('/') }}/city/3/da-nang">Đà Nẵng</a>
                                    <a target="_self" href="{{ url('/') }}/city/4/hai-phong">Hải Phòng</a>
                                    <a target="_self" href="{{ url('/') }}/city/14/binh-duong">Bình Dương</a>
                                </div>
                            </div>
                            <div class="col-md-3 clearfix">
                                <div class="contact row">
                                    <p><i></i>0977898312</p>
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
                    <div class="menu-right">
                        @if (Auth::guest())
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Tạo hồ sơ</a>
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Trang tuyển dụng</a>
                        @else
                            @if(Auth::user()->hasRole('user'))
                            <a target="_self" href="{{ url('/') }}/curriculumvitae/create"><i></i>Tạo hồ sơ</a>
                            @endif
                            @if(Auth::user()->hasRole('poster'))
                            @if($company_id == -1)
                            <a target="_self" href="{{ url('/') }}/company/create"><i></i>Trang tuyển dụng</a>
                            @else
                            <a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info"><i></i>Trang tuyển dụng</a>
                            <a target="_self" href="{{ url('/') }}/job/create"><i></i>Đăng tuyển dụng</a>
                            @endif
                            @endif
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </header>

    <div class="container list-info">
        @if(count($companies) > 0)
        <div class="new-employer row">
            <div class="title clearfix"><span>Nhà tuyển dụng mới</span> <i class="new"></i></div>
            <div class="wrapper" id="wrapper2">
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div class="contents" id="contents-employer">
                        @foreach($companies as $company)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/{{ $company->slug }}">
                                    <span class="icon-new"><img src="http://test.gmon.com.vn/?image=icon-new.png" alt=""></span>
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $company->name }}</p></div>
                                        <div class="work-view">
                                            <p>Xem thêm &rsaquo;&rsaquo;</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="container list-number">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Hồ sơ ứng viên</p>
                        <p class="number">4626 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Freelance</p>
                        <p class="number">1126 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng</p>
                        <p class="number">1452 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng đại học</p>
                        <p class="number">2332 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var $i = 0;
        var site_url = $('base').attr('href');
        var $currentObj = 25;
        var $numberGet = 20;
        var $currentPossion = 0;
        var $newPossion = 0;
        var $loading = false;
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            $newPossion = scroll;
            console.log($newPossion);
            if($newPossion - $currentPossion > 880){
                $currentPossion = $newPossion;
                $('.mass-content').show();
                $('.loader').show();
                $currentPossion = $newPossion;
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getCompany/?start=" + $currentObj + "&number=" + $numberGet + "&<?php echo parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY); ?>",
                    method: "GET",
                    dataType: "json"
                });

                request.done(function (msg) {
                    $('.mass-content').hide();
                    $('.loader').hide();
                    if(msg['code'] == 200){
                        var $html = '';
                        $(msg['companies']).each(function( index ) {
                            $html += '<div class="item-work" >';
                                $html += '<div class="border-item">';
                                    $html += '<a target="_self" href="' + site_url + '/company/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">';
                                        $html += '<span class="icon-new"><img src="http://test.gmon.com.vn/?image=icon-new.png" alt=""></span>';
                                        $html += '<p class="work-img"><img  src="http://test.gmon.com.vn/?image='+ $(this)[0].logo +'" alt="'+ $(this)[0].name +'"></p>';
                                        $html += '<div class="details">';
                                            $html += '<div class="single"><p>'+ $(this)[0].name +'</p></div>';
                                            $html += '<div class="work-view">';
                                                $html += '<p>Xem thêm &rsaquo;&rsaquo;</p>';
                                            $html += '</div>';
                                        $html += '</div>';
                                    $html += '</a>';
                                $html += '</div>';
                            $html += '</div>';
                        });
                        $currentObj += $numberGet;
                        $('#contents-employer').append($html);
                        $loading = false;
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
        });

        $(document).ready(function(){
            $('.item-job').show();
            $('.job-list-0').show();
            var site_url = $('base').attr('href');
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
                    url: "{{ URL::to('/') }}/getDistrict/" + citId,
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
@endsection