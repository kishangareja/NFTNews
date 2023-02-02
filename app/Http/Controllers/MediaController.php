<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Services\MediaService;
use DB;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = MediaService::get();
        return view('media', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        $data = MediaService::getMediaById($id);
        return view('add_media',compact('data','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->mediaId);
        $request->only([
            'title',
            'image_alt',
            'description',
        ]);
        
        if($request->file('image') != null)
        {
            $lastId = DB::table('media')->select('id')->latest('id')->first();

            // Get file name without extension
            // $file = $request->file('image')->getClientOriginalName();
            // $fileName = pathinfo($file,PATHINFO_FILENAME);
            // dd($fileName);
            
            if(empty($lastId))
            {
                $file      = $request->file('image');
                $getFileName = $request->file('image')->getClientOriginalName();
                $fileName  = pathinfo($getFileName,PATHINFO_FILENAME) . '_' . '1' . '.' . $file->extension();   
                $name = $file->move(base_path('uploads'), $fileName); 
                $data['image'] = $fileName;
            }
            else
            {
                $file      = $request->file('image');
                $getFileName = $request->file('image')->getClientOriginalName();
                $fileName  = pathinfo($getFileName,PATHINFO_FILENAME) . '_' . $lastId->id + 1 . '.' . $file->extension();   
                $name = $file->move(base_path('uploads'), $fileName); 
                $data['image'] = $fileName;
            }
        }

        $data['title'] =  $request->title;
        $data['description'] = $request->description;
        $data['image_alt'] = $request->image_alt;

        $result = MediaService::createUpdate($data,$request->mediaId);
        return json_encode(['success'=>1,'message'=>'Media Saved Successfully']);
    }

    public function mediaDetail($id)
    {
        $media        = MediaService::getMediaById($id);
        return view('mediaDetails',compact('media'));
    }
}