@extends('layouts.layout_master')

@section('content')
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=212812479241763";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <style type="text/css">
        .header-homepage{
            background: none;
            background-size: cover;
            height: 595px;
            position: relative;
            font-family: Roboto, sans-serif;
        }

        .obj-name:first-letter {
            text-transform: uppercase;
        }

        .single p:first-letter {
            text-transform: uppercase;
        }

    </style>
        <div class="container" id="listjobs">
            <div class="main-menu row">
                <div class="slide"><img src="http://test.gmon.com.vn/?image={{ $company->banner }}" width="100%" height="auto" alt=""><img class="logo" src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></div>
                <p class="menu">
                    <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info">Thông Tin</a>
                    <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/listjobs" class="active">Tuyển Dụng</a>
                    @if (Auth::guest())
                    <button class="bt-rate btn btn-primary" data-toggle="modal" data-target="#loginHeader" onclick="onOpenLogin()"><i></i>Theo dõi</button>
                    @else
                        <button type="button" data-id="{{ $company->id }}" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
                        <button type="button" data-id="{{ $company->id }}" class="btn btn-danger" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
                    @endif
                </p>
            </div>
            <div class="main-content row">
                <div class="col-left col-md-9 col-xs-12">
                    <div class="row">
                        <div class="hot-new"><span style="color:#f99f3c">Tin nóng: </span><a target="_self" href="">Khai trương nhà hàng tại 156 Cầu Giấy
                            <span class="hot-new-img"></span></a>
                            @if (Auth::guest())
                            <button class="bt-rate btn btn-primary" data-toggle="modal" data-target="#loginHeader" onclick="onOpenLogin()"><i></i>Thêm đánh giá</button>
                            @else
                            <button  type="button" class="bt-rate btn btn-primary" data-toggle="modal" data-target="#add-comment"><i></i>Thêm đánh giá</button>
                            @endif
                        </div>
                    </div>
                    @foreach($jobs as $job)
                    <div class="row item-job">
                        <div class="job-image">
                            <div style="padding: 10%;"><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></div>
                        </div>
                        <div class="job-content">
                            <div class="job-name"><a target="_self" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}"> {{ $job->name }} </a></div>
                            <div class="job-info">
                                <span><i></i>Số lượng: {{ $job->number }}</span>
                                <span><i></i>Cầu Giấy, Ba Đình</span>
                                <span class="active"><i></i>Hạn nộp: {{ $job->expiration_date }}</span>
                            </div>
                            <span class="job-hot">HOT</span>
                            <a target="_self" href="{{ url('/') }}/job/{{ $job->id }}/{{ $job->slug }}" class="job-view">Chi tiết </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="row text-center">
                        {{ $jobs->links() }}
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
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" 
                            @if($comment->star > 1) class="vote" @else class="no-vote" @endif>
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 2) class="vote" @else class="no-vote" @endif>
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 3) class="vote" @else class="no-vote" @endif>
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" @if($comment->star > 4) class="vote" @else class="no-vote" @endif>
                            <span>{{ $comment->description }}</span>
                        </p>
                        @endforeach
                        <div class="bot">
                            <span class="active"></span>
                            <span class="active"></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <input type="hidden" name="company" value="{{ $company->id }}">
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
            var company = $('#follow-btn').attr('data-id');
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
            var company = $('#follow-btn').attr('data-id');
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
                } else {
                    swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
                }
            });

            request.fail(function (jqXHR, textStatus) {
                swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
            });
        });
        $('#unfollow-btn').click(function () {
            var company = $('#unfollow-btn').attr('data-id');
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

        function onOpenLogin() {
            $("#login").addClass("in active");
            $("#register").removeClass("in active");
            $("li.register a").removeClass("active");
            $("li.login a").addClass("active");
        }
        </script>
@endsection