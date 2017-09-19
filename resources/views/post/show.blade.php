@extends('layouts.layout_news')

@section('content')
<div class="wrapper-homepage news">
    <div class="container-fluid">
        <div class="row menu-top">
            <div class="col-md-3"></div>
            <div class="col-md-6 content">
                <ul class="list-inline">
                    <?php 
                        $categorySelected = 0;
                        $postSelected = 0;
                        $count = 0;
                        if (isset($_GET['post'])) {
                            $postSelected = $_GET['post'];
                        }
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
                            $count = 0;
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
                        <div class="title" style="text-transform: uppercase;">
                            <a href="http://gmon.vn/job/view/{{ $job->id }}">{{ $job->companyName }} TUYỂN DỤNG {{ $job->name }}</a>
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
                            <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php $datetime = new \DateTime($post->created_at);
                            echo $datetime->format('H:i d-m-Y'); ?></div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                    <div class="middle-content">
                        <div class="title">
                            <?php echo $post->title; ?>
                        </div>
                        <p>
                        <div class="description">
                            <?php echo str_replace("/public/templateEditor/kcfinder/upload/images/","http://gmon.vn/public/templateEditor/kcfinder/upload/images/",$post->description); ?>
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
              @if(count($partners) > 0)
                <h3>Đối tác</h3>
                @foreach($partners as $partner)
                <div class="item">
                  <a href="{{ $partner->link }}">
                    <div class="image">
                        <img src="{{ $partner->image }}" alt="" />
                    </div>
                  </a>
                </div>
                @endforeach
                <hr>
              @endif
                <h3>Nhà tuyển dụng HOT</h3>
                @foreach($companies as $company)
                <div class="item">
                    <div class="image">
                        <img src="http://test.gmon.com.vn/?image={{ $company->banner }}" alt="" />
                    </div>
                    <div class="title">
                        <a href="http://gmon.vn/company/{{ $company->id }}/info">Công việc tại {{ $company->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection