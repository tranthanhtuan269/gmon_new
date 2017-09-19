<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Http\Request;
use Session;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $post = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->where('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('category', 'LIKE', "%$keyword%")
                ->select('posts.id', 'posts.title', 'posts.image', 'posts.views', 'posts.likes', 'categories.name as categoryName')
				->paginate($perPage);
        } else {
            $post = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->select('posts.id', 'posts.title', 'posts.image', 'posts.views', 'posts.likes', 'categories.name as categoryName')
                ->paginate($perPage);
        }

        return view('post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('master')){
                $img_avatar = '';
                if ($request->hasFile('imagePost')) {
                    $file_avatar = $request->file('imagePost');
                    $filename = $file_avatar->getClientOriginalName();
                    $extension = $file_avatar->getClientOriginalExtension();
                    $img_avatar = date('His') . $filename;
                    $destinationPath = base_path('../../images');
                    // $destinationPath = base_path() . '/public/images';
                    $file_avatar->move($destinationPath, $img_avatar);
                }

                $requestData = $request->all();
                unset($requestData['imagePost']);

                $requestData['image'] = $img_avatar;
                $requestData['active'] = 1;
                
                Post::create($requestData);

                Session::flash('flash_message', 'Post added!');

                return redirect('post');
            }else if(Auth::user()->hasRole('bientap')){
                $img_avatar = '';
                if ($request->hasFile('imagePost')) {
                    $file_avatar = $request->file('imagePost');
                    $filename = $file_avatar->getClientOriginalName();
                    $extension = $file_avatar->getClientOriginalExtension();
                    $img_avatar = date('His') . $filename;
                    $destinationPath = base_path('../../images');
                    // $destinationPath = base_path() . '/public/images';
                    $file_avatar->move($destinationPath, $img_avatar);
                }

                $requestData = $request->all();
                unset($requestData['imagePost']);

                $requestData['image'] = $img_avatar;
                $requestData['active'] = 0;
                
                Post::create($requestData);

                Session::flash('flash_message', 'Post added!');

                return redirect('post');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function getPost($id, $slug)
    {
        $categories = [];
        $jobs = [];
        $companies = [];
        $categorySelect = 0;

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
        $number_get = 3;
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($company){
                $company_id = $company->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user){
                $cv_id = $cv_user->id;
            }
        }

        if(isset($_GET['category']) && is_numeric($_GET['category'])){
            $categorySelect = (int)$_GET['category'];
        }

        $partners = \App\Partner::take(4)->get();

        $categories = \DB::table('categories')
            ->select('id', 'name', 'slug')
            ->get();

        $post = new \App\Post;
        $posts = $post->getPosts(null, $id, 0, 1);

        $companies = \DB::table('companies')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.id', 'companies.logo', 'companies.banner', 'companies.name', 'companies.slug')
            ->take(5)
            ->get();

        $jobs = \DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.logo', 'companies.banner', 'jobs.name', 'companies.name as companyName', 'jobs.id', 'jobs.slug')
            ->take(5)
            ->get();

        if(count($posts) > 0){
            $id = $posts[0]->category;
        }

        return view('post.show', compact('id' ,'categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id', 'partners'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $categories = [];
        $jobs = [];
        $companies = [];
        $categorySelect = 0;

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
        $number_get = 3;
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($company){
                $company_id = $company->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user){
                $cv_id = $cv_user->id;
            }
        }

        if(isset($_GET['category']) && is_numeric($_GET['category'])){
            $categorySelect = (int)$_GET['category'];
        }

        $partners = \App\Partner::take(4)->get();

        $categories = \DB::table('categories')
            ->select('id', 'name', 'slug')
            ->get();

        $post = new \App\Post;
        $posts = $post->getPosts(null, $id, 0, 1);

        $companies = \DB::table('companies')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.id', 'companies.logo', 'companies.banner', 'companies.name', 'companies.slug')
            ->take(5)
            ->get();

        $jobs = \DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.logo', 'companies.banner', 'jobs.name', 'companies.name as companyName', 'jobs.id', 'jobs.slug')
            ->take(5)
            ->get();
        return view('post.show', compact('categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id', 'partners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $img_avatar = '';
        if ($request->hasFile('imagePost')) {
            $file_avatar = $request->file('imagePost');
            $filename = $file_avatar->getClientOriginalName();
            $extension = $file_avatar->getClientOriginalExtension();
            $img_avatar = date('His') . $filename;
            $destinationPath = base_path('../../images');
            // $destinationPath = base_path() . '/public/images';
            $file_avatar->move($destinationPath, $img_avatar);
        }

        $requestData = $request->all();
        unset($requestData['imagePost']);

        if(strlen($img_avatar) > 0){
            $requestData['image'] = $img_avatar;
        }
                
        $post = Post::findOrFail($id);
        $post->update($requestData);

        Session::flash('flash_message', 'Post updated!');

        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('post');
    }

    public function getPosts(){
        $postGetObj = new Post;
        $category = $post = $start = $number = null;

        if(isset($_GET)){
            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }
            if(isset($_GET['number']) && $_GET['number'] > 0){
                $number = $_GET['number'];
            }
            if(isset($_GET['category']) && $_GET['category'] > 0){
                $category = $_GET['category'];
            }
            if(isset($_GET['post']) && $_GET['post'] > 0){
                $post = $_GET['post'];
            }
            $posts = $postGetObj->getPosts($category, $post, $from, $number);
            $dataRet = $postGetObj->getPostsHtml($posts, $category, $post);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'posts' => $dataRet));
        }
    }

    public function updateSlug(){
        $jobs = \App\Company::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Company::find($j->id);
            $job->slug = null;
            $job->save();
        }
    }
}
