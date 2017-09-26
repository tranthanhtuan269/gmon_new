<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'sub_description', 'description', 'category', 'views', 'likes', 'image', 'sub_url', 'slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function getPosts($category, $post, $start, $number){
        $posts = [];
        if(isset($category) && $category > 0){
            if($post > 0){
                $posts = \DB::table('posts')
                    ->join('categories', 'categories.id', '=', 'posts.category')
                    ->select('posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                    ->where('posts.id', '=', $post)
                    ->where('posts.active', '=', 1)
                    ->orderBy('posts.created_at', 'desc')
                    ->get();
            }else{
                $posts = \DB::table('posts')
                    ->join('categories', 'categories.id', '=', 'posts.category')
                    ->select('posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                    ->where('posts.active', '=', 1)
                    ->where('posts.category', '=', $category)
                    ->orderBy('posts.created_at', 'desc')
                    ->skip($start)->take($number)
                    ->get();
            }
        }else{
            if($post > 0){
                $posts = \DB::table('posts')
                    ->join('categories', 'categories.id', '=', 'posts.category')
                    ->select('posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                    ->where('posts.id', '=', $post)
                    ->where('posts.active', '=', 1)
                    ->orderBy('posts.created_at', 'desc')
                    ->get();
            }else{
                $posts = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->select('posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                ->where('posts.active', '=', 1)
                ->orderBy('posts.created_at', 'desc')
                ->skip($start)->take($number)
                ->get();
            }
        }

        return $posts;
    }

    public function getPostsHtml($posts, $categorySelected, $postSelected){
        $dataRet = '';
        foreach($posts as $post){
        $dataRet .= '<div class="item">';
            $dataRet .= '<div class="clearboth"></div>';
            $dataRet .= '<div class="middle-content">';
                $dataRet .= '<div class="title">';
                    $dataRet .= $post->title;
                $dataRet .= '</div>';
                $dataRet .= '<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i>';
                $datetime = new \DateTime($post->created_at);
                $dataRet .= $datetime->format('H:i d-m-Y');
                $dataRet .= '</div>';
                $dataRet .= '<p>';
                if($postSelected > 0){
                  $dataRet .= '<div class="description">';
                    $dataRet .= str_replace("/public/templateEditor/kcfinder/upload/images/","http://gmon.vn/public/templateEditor/kcfinder/upload/images/",$post->description);
                  $dataRet .= '</div>';
                }else{
                $dataRet .= '<div class="sub-description">';
                    $dataRet .= $post->sub_description;
                    $dataRet .= '<a href="' . url('/') . '/post/' . $post->id . '/' . $post->slug .'">Xem thêm</a>';
                $dataRet .= '</div>';
                $dataRet .= '<div class="description" style="display: none;">';
                    $dataRet .= str_replace("/public/templateEditor/kcfinder/upload/images/","http://gmon.vn/public/templateEditor/kcfinder/upload/images/",$post->description);
                $dataRet .= '</div>';
                $dataRet .= '</p>';
                $dataRet .= '<div class="images">';
                    $dataRet .= '<img src="http://test.gmon.com.vn/?image=' . $post->image .'" alt="" />';
                $dataRet .= '</div>';
                }
            $dataRet .= '</div>';
            $dataRet .= '<div class="bottom-content row" style="display: none">';
                $dataRet .= '<a class="comment col-md-3" href=""><i class="fa fa-commenting-o" aria-hidden="true"></i> 0 Bình luận</a>';
                $dataRet .= '<a class="facebook col-md-3" href=""><i class="fa fa-facebook-official" aria-hidden="true"></i> Chia sẻ</a>';
                $dataRet .= '<a class="like col-md-3" href=""><i class="fa fa-heart" aria-hidden="true"></i> 0 Yêu thích</a>';
            $dataRet .= '</div>';
        $dataRet .= '</div>';
        }
        return $dataRet;
    }
}
