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

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
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

        $categories = \DB::table('categories')
            ->select('id', 'name')
            ->get();

        if($categorySelect == 0){
            $posts = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->select('posts.id', 'posts.title', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                ->get();
        }else{
            $posts = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->select('posts.id', 'posts.title', 'posts.description', 'posts.sub_description', 'posts.category', 'posts.image', 'posts.created_at')
                ->where('posts.category', '=', $categorySelect)
                ->get();
        }

        $companies = \DB::table('companies')
            ->select('id', 'logo', 'banner', 'name')
            ->take(5)
            ->get();

        $jobs = \DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->select('companies.logo', 'companies.banner', 'jobs.name', 'companies.name as companyName', 'jobs.id')
            ->take(5)
            ->get();
        return view('home', compact('categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id'));
    }

    public function welcome()
    {
        return redirect('/home');
    }
}
