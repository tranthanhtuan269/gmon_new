@extends('layouts.layout')

@section('content')
<?php 
    $jobstype = \App\JobType::select('id', 'name')->get(); 
?>
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
        @if(count($cvs) > 0)
        <div class="vip-candidates row">
            <div class="title clearfix"><span>Ứng viên VIP <i class="hot"></i></span></div>
            <div class="clearfix wrapper" id="wrapper-candidates">
                @foreach($cvs as $cv)
                <div class="item-u" >
                    <a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv->id }}" onmouseenter="onFocusCandidates(event)" onmouseleave ="onDisFocusCandidates(event)">
                        <?php 
                            if($cv->avatarCV == null){
                                $avatar = $cv->avatarU;
                            }else{
                                $avatar = $cv->avatarCV;
                            }
                        ?>
                        @if(strlen($avatar) > 0)
                            @if (strpos($avatar, 'https') !== false)
                                <div class="img"><img src="{{ $avatar }}" alt="{{ $avatar }}"></div>
                            @else
                                <div class="img"><img src="http://test.gmon.com.vn/?image={{ $avatar }}" alt="{{ $avatar }}"></div>
                            @endif
                        @else
                        <div class="img"><img src="http://test.gmon.com.vn/?image=avatar.png" alt=""></div>
                        @endif
                        <p class="name text-center">{{ $cv->username }}</p>
                        <p class="university text-center">{{ $cv->school }}</p>
                        <div class="view">
                            <div class="info">
                                <div class="sub-img">
                                    <div class="border">
                                        @if(strlen($avatar) > 0)
                                            @if (strpos($avatar, 'https') !== false)
                                                <img src="{{ $avatar }}" alt="{{ $avatar }}">
                                            @else
                                                <img src="http://test.gmon.com.vn/?image={{ $avatar }}" alt="{{ $avatar }}">
                                            @endif
                                        @else
                                        <img src="http://test.gmon.com.vn/?image=avatar.png" alt="">
                                        @endif
                                    </div>
                                </div>
                                <p>{{ $cv->username }}</p>
                                <p>{{ $cv->birthday }}</p>
                                <!-- <p>CLB AIESEC Hà Nội</p> -->
                            </div>
                            <div class="link">
                                Xem hồ sơ của tôi &rsaquo;
                            </div>
                        </div>
                    </a>
                </div>  
                @endforeach
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
            if($newPossion - $currentPossion > 650){
                if($loading) return;
                $currentPossion = $newPossion;
                $('.mass-content').show();
                $('.loader').show();
                $loading = true;
                $currentPossion = $newPossion;
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getCV/?start=" + $currentObj + "&number=" + $numberGet + "&<?php echo parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY); ?>",
                    method: "GET",
                    dataType: "json"
                });

                request.done(function (msg) {
                    $('.mass-content').hide();
                    $('.loader').hide();
                    if(msg['code'] == 200){
                        var $html = '';
                        $(msg['cvs']).each(function( index ) {
                            $html += '<div class="item-u" >';
                                $html += '<a target="_self" href="' + site_url + '/curriculumvitae/view/' + $(this)[0].id + '" onmouseenter="onFocusCandidates(event)" onmouseleave ="onDisFocusCandidates(event)">';
                                    var avatar = '';
                                    if($(this)[0].avatarCV == null){
                                        avatar =  $(this)[0].avatarU;
                                    }else{
                                        avatar =  $(this)[0].avatarCV;
                                    }
                                    if(avatar != null && avatar.length > 0){
                                        if(avatar.indexOf('https') !== -1){
                                            $html += '<div class="img"><img src="'+ avatar + '" alt=""></div>';
                                        }else{
                                            $html += '<div class="img"><img src="http://test.gmon.com.vn/?image='+ avatar + '" alt=""></div>';
                                        }
                                    }else{
                                    $html += '<div class="img"><img src="http://test.gmon.com.vn/?image=avatar.png" alt=""></div>';
                                    }
                                    $html += '<p class="name text-center">'+ $(this)[0].username +'</p>';
                                    $html += '<p class="university text-center">';
                                    if($(this)[0].school != null){
                                        $html += $(this)[0].school;
                                    }
                                    $html += '</p>';
                                    $html += '<div class="view">';
                                        $html += '<div class="info">';
                                            $html += '<div class="sub-img"><div class="border">';
                                                    if(avatar != null && avatar.length > 0){
                                                        if(avatar.indexOf('https') !== -1){
                                                            $html += '<img src="'+ avatar +'" alt="'+ $(this)[0].name +'">';
                                                        }else{
                                                            $html += '<img src="http://test.gmon.com.vn/?image='+ avatar +'" alt="'+ $(this)[0].name +'">';
                                                        }
                                                    }else{
                                                    $html += '<img src="http://test.gmon.com.vn/?image=avatar.png" alt="'+ $(this)[0].username +'">';
                                                    }
                                                $html += '</div></div>';
                                            $html += '<p>'+ $(this)[0].username +'</p>';
                                            $html += '<p>'+ $(this)[0].birthday +'</p>';
                                        $html += '</div>';
                                        $html += '<div class="link">';
                                            $html += 'Xem hồ sơ của tôi &rsaquo;';
                                        $html += '</div>';
                                    $html += '</div>';
                                $html += '</a>';
                            $html += '</div>';
                        });
                        $currentObj += $numberGet;
                        $('#wrapper-candidates').append($html);
                        $loading = false;

                        function onFocusCandidates(event) {
                            $(event.target).find(".view").animate({top: 0 + 'px'}, 300);
                        }
                        function onDisFocusCandidates(event) {
                            $(event.target).find(".view").animate({top: 200 + 'px'});
                        }
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

        function onFocusCandidates(event) {
            $(event.target).find(".view").animate({top: 0 + 'px'}, 300);
        }
        function onDisFocusCandidates(event) {
            $(event.target).find(".view").animate({top: 200 + 'px'});
        }
    </script>
@endsection