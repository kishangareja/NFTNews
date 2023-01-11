<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PressReleaseService;
use App\Services\NewsService;
use App\Models\PressRelease;
use App\Models\Category;
use App\Models\Banner;
use App\Models\News;
use Carbon\Carbon;
use Mail;

class UserPressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pressReleases          = PressRelease::orderBy('id', 'DESC')->paginate(20);
        $pressRecommended = PressRelease::orderBy('id', 'DESC')->get();

        $newses          = News::orderBy('id', 'DESC')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();

        foreach($newses as $key => $news)
        {
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        // dd($resultFeaturedNews);
        $categories     = Category::all();
        $getAllNewses   = News::all();
        $banners        = Banner::where('size', '280 x 400 pixels')->first();
        $pressTopBanner = Banner::where('location', 'pressrelfull')->first();
        $pressSideBanner = Banner::where('location', 'prssrelrect')->first();
        return view('user.pressRelease', compact('pressSideBanner', 'pressTopBanner', 'pressReleases', 'pressRecommended', 'categories', 'getAllNewses', 'resultFeaturedNews', 'banners'));
    }

    public function pressDetail($id)
    {
        $pressDetail = PressReleaseService::getPressBySlug($id);
        $newses          = News::orderBy('id', 'DESC')->get();
        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();

        foreach($newses as $key => $news)
        {
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }

        $categories     = Category::all();
        $getAllNewses   = News::all();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        return view('user.pressDetails',compact('innerSideBanner', 'pressDetail', 'categories', 'getAllNewses', 'resultFeaturedNews'));
    }
    
    public function filterPress(Request $request)
    {
        $pressRecommended = PressRelease::orderBy('id', 'DESC')->get();
        $pressReleases  = PressRelease::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all' || $request->filterValue == 'all') {
                $dm->get();
            }
            else if($request->filternftcategoryValue > 0) {
                $dm->where('categoryId', '=', $request->filternftcategoryValue);
            }
            if($request->search != null && $request->search != '') {
                $dm->where('title', 'like', '%'.$request->search.'%');
            }
            if($request->filterValue == 'thisWeek') {
                $dm->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            }
            if($request->filterValue == 'thisMonth')
            {
                $dm->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
            }
            // if($request->filterValue == 'featured')
            // {
            //      $currentDate              = date('d-m-Y');
            //      $dm->where('newsType->featurednew->start_date','<=', $currentDate);
            //      $dm->where('newsType->featurednew->end_date','>=', $currentDate);
            // }
        })->orderby('id','desc')->paginate(20);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        $categories     = Category::all();
        $getAllNewses   = News::all();
        $banners        = Banner::where('size', '280 x 400 pixels')->first();
        return view('user.pressRelease', compact('banners', 'pressReleases', 'pressRecommended', 'getAllNewses', 'search', 'filterValue', 'categories', 'filtercategoryId'));
    }

    public function sendMail(Request $request)
    {
        $email = $request->email;
        Mail::send('mailForSubscribe', ['email' => $email], function ($message) use ($email){
            $message->to('info@infinitedryer.com', 'NFT News | Admin')->subject('NFT News Mail For Subscription Request.');
            $message->from($email,'NFT News');
        });
        return redirect()->back()->with('success', 'Email Has Been Sent Successfully');
    }
    
}
