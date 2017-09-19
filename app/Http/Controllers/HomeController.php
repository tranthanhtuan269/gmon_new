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
                $posts = $post->getPosts(null, $postSelect, 0, 1);
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
}
