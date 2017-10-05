@extends('layouts.layout_master')

@section('content')
<script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<style type="text/css">
    .header-homepage{
        background: none;
        background-size: cover;
        height: 595px;
        position: relative;
        font-family: Roboto, sans-serif;
    }
</style>
    <div class="container" id="info-page">
        <div class="row" id="images-company">
            @if(isset($company->images) && strlen($company->images) > 0)
            <?php 
                $company->images=rtrim($company->images,";");
                $images = explode(";",$company->images);
                for($i = 0; $i < count($images); $i++){ if($i == 3) break; ?>
                    <div class="col-md-4 col-xs-12">
                        <img src="http://test.gmon.com.vn/?image={{ $images[$i] }}" class="img-responsive img-thumbnail" alt="http://test.gmon.com.vn/?image={{ $images[$i] }}">
                    </div>
            <?php } ?>
            @endif
        </div>

        <hr>

        <div class="row" id="info-company-job">
            <div class="col-md-4 col-xs-12">
                <div class="logo-company">
                    @if(isset($company->logo) && strlen($company->logo) > 0)
                    <a class="col-md-12 col-xs-12" target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info">
                        <img src="http://test.gmon.com.vn/?image={{ $company->logo }}" class="img-responsive" alt="http://test.gmon.com.vn/?image={{ $company->logo }}" style="width: 100%;height: 100%;margin-left: -20px;">
                    </a>
                    @endif
                </div>
                <div class="info-company">
                    <div class="col-md-12 col-xs-12">
                        <h1 class="obj-name">{{ $company->name }}</h1>
                    </div>
                    <div class="col-md-12 col-xs-12 star-hold">
                        <img class="star-vote" src="http://test.gmon.com.vn/?image=star.png" alt="http://test.gmon.com.vn/?image=star.png">
                        <img class="star-vote" src="http://test.gmon.com.vn/?image=star.png" alt="http://test.gmon.com.vn/?image=star.png">
                        <img class="star-vote" src="http://test.gmon.com.vn/?image=star.png" alt="http://test.gmon.com.vn/?image=star.png">
                        <img class="star-vote" src="http://test.gmon.com.vn/?image=star.png" alt="http://test.gmon.com.vn/?image=star.png">
                        <img class="star-vote" src="http://test.gmon.com.vn/?image=star.png" alt="http://test.gmon.com.vn/?image=star.png">
                    </div>
                    <div class="col-md-12 col-xs-12 info-row hidden-xs">
                        <i class="fa fa-street-view"></i>{{ $company->address }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-map-marker"></i>{{ $company->district }}, {{ $company->city }}
                    </div>
                    @if(count($branches) > 0)
                        <?php $count = 0; ?>
                        <div class="col-md-12 col-xs-12 info-row"><i class="fa fa-map"></i>
                        @foreach($branches as $branch)
                            <?php 
                                if($count == 0){
                                    echo $branch->city;
                                }else{
                                    echo ', ' . $branch->city;
                                }
                                $count++; 
                            ?>
                        @endforeach
                        </div>
                    @endif
                    <?php 
                        if(strlen($company->jobs) > 0){
                            $company->jobs = rtrim($company->jobs,";");
                            $jobs = explode(";",$company->jobs);
                            foreach($jobs as $joba){
                                echo '<div class="col-md-12 col-xs-12 info-row"><i class="fa fa-building"></i>' . $joba . '</div>';
                            }
                        }
                    ?>
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-users"></i>{{ $company->size }} người
                    </div>
                    @if(strlen($company->sologan) > 0)
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-trophy"></i>{{ $company->sologan }}
                    </div>
                    @endif
                    @if(strlen($company->site_url)>0)
                    <div class="col-md-12 col-xs-12 info-row web-link">
                        <i class="fa fa-link" style="float: left;"></i><a style="word-break: break-all;" href="{{ $company->site_url }}">{{ $company->site_url }}</a>
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-xs-12 info-row link-job">
                        <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/listjobs"><i class="fa fa-angle-double-right"></i>Trang tuyển dụng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12 info-job">
                <div class="row simple-info">
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <h1 class="obj-name">{{ $job->name }}</h1>
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-map-marker"></i>
                        <span style="margin-right: 35px">
                            {{ $company->district }}, {{ $company->city }}
                        </span>
                    </div>
                    @if(strlen($job->branches) > 0)
                        <?php 
                            $job->branches = ltrim($job->branches,";");
                            $branches = explode(";",$job->branches);
                        ?>
                        @for($i = 0; $i < count($branches); $i++)
                            @if($i < 3)
                            <div class="col-md-12 col-xs-12 info-job-row">
                                <i class="fa fa-street-view"></i>
                                {{ $branches[$i] }} 
                                @if($i==2) 
                                    <span class="show-more-btn">...</span>
                                @endif
                            </div>
                            @else
                            <div class="col-md-12 col-xs-12 info-job-row">
                                <i class="fa fa-street-view"></i>
                                {{ $branches[$i] }}
                            </div>
                            @endif
                        @endfor
                    @endif
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-money"></i>
                        {{ $job->salary }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-clock-o"></i>
                        {{ $job->expiration_date }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-user"></i>
                        {{ $job->number }} người
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-intersex"></i>
                        <?php 
                        if($job->gender == 0) { 
                            echo "Không yêu cầu"; 
                        }else if($job->gender == 1) { 
                            echo "Nam"; 
                        }else{ 
                            echo "Nữ"; 
                        } ?>
                    </div>
                    <div class="col-md-12 col-xs-12 link-social">
                        <span class="text hidden-xs hidden-sm">Chi tiết tuyển dụng</span> 
                        <span style="padding:0;" id="share">
                            <a target="_self" class="icon" href=""><i class="i1"></i></a>
                            <a target="_self" class="icon" href=""> <i class="i2"></i></a>
                            <a target="_self" class="icon" href=""><i class="i3"></i></a>
                            <a target="_self" class="icon" href=""><i class="i4"></i></a>
                            <a target="_self" class="icon" href=""><i class="i5"></i></a>
                            <span class="hidden-xs hidden-sm">Chia sẻ qua</span>
                        </span>
                    </div>
                </div>
                <div class="row detail-info" id="description">
                    <div class="col-md-12 col-xs-12 title">
                        Việc bạn sẽ làm
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->description); ?>
                    </div>
                </div>
                <div class="row detail-info" id="required">
                    <div class="col-md-12 col-xs-12 title">
                        CHÚNG TÔI KỲ VỌNG Ở BẠN
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->requirement); ?>
                    </div>
                </div>
                <div class="row detail-info" id="benefit">
                    <div class="col-md-12 col-xs-12 title">
                        ĐIỀU BẠN MONG MUỐN
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->benefit); ?>
                    </div>
                </div>
                @if(!Auth::check())
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a id="join-btn" target="_self" href="javascript:void(0)" data-toggle="modal" data-target="#loginHeader" class="btn btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                    </div>
                </div>
                @elseif(Auth::check() && Auth::user()->hasRole('user'))
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a id="join-btn" target="_self" href="javascript:void(0)" class="btn btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                    </div>
                </div>
                @elseif($company->id == $company_id)
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a href="{{ url('/') }}/job/{{ $job->id }}/editJob" class="btn btn-primary bt-join">Sửa Việc</a>
                    </div>
                </div>
                @else
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var url_site = $('base').attr('href');
        function onOpenLogin() {
            $("#login").addClass("in active");
            $("#register").removeClass("in active");
            $("li.register a").removeClass("active");
            $("li.login a").addClass("active");
        }
        $('.bt-join').click(function(){
            var _sefl = $(this);
            var job_id = $(this).attr('data-id');
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_site + "/job/join",
                method: "POST",
                data: {
                    'job': job_id
                },
                dataType: "json"
            });
            request.done(function (msg) {
                if (msg.code == 200) {
                    $('.bt-join').off('click');
                        $('#join-btn').hide();
                        $('#joined-btn').show();
                    swal("Thông báo", "Bạn đã ứng tuyển thành công!", "success");
                }else if(msg.code == 401 && msg.message == "unauthen!"){
                        onOpenLogin();
                }else if(msg.code == 401 && msg.message == "No curriculum vitaes!"){
                        swal("Thông báo", "Bạn chưa có hồ sơ! Hãy tạo mới để ứng tuyển ngay nhé!", "error");
                         // Your application has indicated there's an error
                        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                            window.location.href = url_site + "/curriculumvitae/create";
                        }, 3000);
                }
            });
            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });
    </script>
@endsection