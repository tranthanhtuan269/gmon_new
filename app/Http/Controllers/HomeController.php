<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyCompanyType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = [];
        $jobs = [];
        $companies = [];
        $categorySelect = 0;
        $postSelect = 0;

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
        $number_get = 10;
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

        if(isset($_GET['post']) && is_numeric($_GET['post'])){
            $postSelect = (int)$_GET['post'];
        }

        $partners = \App\Partner::take(4)->get();

        $categories = \DB::table('categories')
            ->select('id', 'name', 'slug')
            ->get();

        $post = new \App\Post;

        if($categorySelect == 0){
            if($postSelect > 0){
                $posts = $post->getPosts(null, $postSelect, 0, $number_get);
            }else{
                $posts = $post->getPosts(null, null, 0, $number_get);
            }
        }else{
            $posts = $post->getPosts($categorySelect, null, 0, $number_get);
        }

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
        return view('home', compact('categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id', 'partners'));
    }

    public function welcome()
    {
        return redirect('/home');
    }

    public function generatorSitemap(){
        // create new sitemap object
        $sitemap = \App::make("sitemap");
        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(\URL('/'), '2017-09-28T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(\URL('/'), '2017-09-28T12:30:00+02:00', '0.9', 'monthly');
        $sitemap->add(\URL('/') . '/showmore?cv=vip', '2017-09-28T20:10:00+02:00', '0.8', 'daily');
        $sitemap->add(\URL('/') . '/showmore?company=new', '2017-09-28T20:10:00+02:00', '0.8', 'daily');
        $sitemap->add(\URL('/') . '/showmore?company=new', '2017-09-28T20:10:00+02:00', '0.8', 'daily');
        // get all posts from db
        $categories = \DB::table('categories')->orderBy('created_at', 'desc')->get();
        $companies = \DB::table('companies')->orderBy('created_at', 'desc')->get();
        $jobs = \DB::table('jobs')->orderBy('created_at', 'desc')->get();
        // add every post to the sitemap
        foreach ($curriculum_vitaes as $curriculum_vita)
        {
            $sitemap->add(URL('/'). '/curriculumvitae/view/'.$curriculum_vita->id, $curriculum_vita->updated_at, 0.6, 'monthly');
        }
        // add every post to the sitemap
        foreach ($companies as $company)
        {
            $sitemap->add(URL('/'). '/company/'.$company->id. '/' .$company->slug, $company->updated_at, 0.6, 'monthly');
        }
        // add every post to the sitemap
        foreach ($jobs as $job)
        {
            $sitemap->add(URL('/'). '/job/'.$job->id. '/' .$job->slug, $job->updated_at, 0.6, 'monthly');
        }
        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
    }

    public function updateSlugJob(){
        $jobs = \App\Job::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Job::find($j->id);
            $job->slug = null;
            $job->save();
        }
    }

    public function updateSlugCategory(){
        $jobs = \App\Category::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Category::find($j->id);
            $job->slug = null;
            $job->save();
        }
    }

    public function updateSlugPost(){
        $jobs = \App\Post::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Post::find($j->id);
            $job->slug = null;
            $job->save();
        }
    }
}
