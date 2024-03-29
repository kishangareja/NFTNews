<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\GuideCategory;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Banner;


class UserGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $guideTopBanner = Banner::where('location', 'guidefull')->first();
        $guidesCategory = GuideCategory::get();           
        return view('user.guide',compact('guidesCategory', 'guideTopBanner'));
    }

    public function guideList($category=null, $slug=null)
    {
        $guideDetail = [];
        $guidesCategory = GuideCategory::where('slug', $category)->first();
        $category_id = $guidesCategory->id;
        $guides = Guide::where('category', $category_id)->get();
        if (empty($slug)) {
            $slug = @$guides[0]->slug;
            if (!$slug) {
                return view('user.guide');
            }
            $guideDetail = Guide::where(['category'=> $category_id,'slug'=> $guides[0]->slug])->first();            
            return redirect()->route('user.guideList', ['category' => $category, 'slug'=> $guides[0]->slug ]);
        } else {
            $guideDetail = Guide::where(['category'=> $category_id,'slug'=> $slug])->first();
        }
        return view('user.guideDetails', compact('guides', 'guideDetail', 'slug','category'));
    }    
}
