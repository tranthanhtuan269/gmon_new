@extends('layouts.layout_news')

@section('content')
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
@endsection