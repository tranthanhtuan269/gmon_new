@extends('layouts.layout_news')

@section('title')
    
@endsection

@section('content')
<div class="col-md-6 middle">
    @foreach($posts as $post)
    <div class="item">
        <div class="middle-content">
            <div class="title">
                <a href="{{ url('/') }}/post/{{ $post->id }}/{{ $post->slug }}"><h1><?php echo $post->title; ?></h1></a>
            </div>
            <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php $datetime = new \DateTime($post->created_at);
                echo $datetime->format('H:i d-m-Y'); ?></div>
            <p>
            <div class="sub-description">
                <?php echo $post->sub_description; ?><a href="{{ url('/') }}/post/{{ $post->id }}/{{ $post->slug }}">Xem thêm</a>
            </div>
            <div class="description" style="display: none;">
                <?php echo str_replace("/public/templateEditor/kcfinder/upload/images/","http://gmon.vn/public/templateEditor/kcfinder/upload/images/",$post->description); ?>
            </div>
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
<script type="text/javascript">
    var site_url = $('base').attr('href');
    var $currentPost = 10;
    var $numberGet = 5;
    var $currentPossion = 0;
    var $newPossion = 0;
    $(window).scroll(function (event) {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
        var scroll = $(window).scrollTop();
        $newPossion = scroll;
        if($newPossion - $currentPossion > 1280){
            $currentPossion = $newPossion;
            $('.mass-content').show();
            $('.loader').show();
            var request = $.ajax({
                url: "{{ URL::to('/') }}/getPost/?start=" + $currentPost + "&number=" + $numberGet + "&category={{ $id }}",
                method: "GET",
                dataType: "json"
            });
            request.done(function (msg) {
                $('.mass-content').hide();
                $('.loader').hide();
                if(msg['code'] == 200){
                    var $html = '';
                    $currentPost += $numberGet;
                    $('.main-content-news .middle').append(msg['posts']);
                }
            });
            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    }
    });
</script>
@endsection