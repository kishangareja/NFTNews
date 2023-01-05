<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoJournal;
use App\Services\CryptoJournalService;
use Illuminate\Support\Str;

class CryptoJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crypto = CryptoJournalService::getCrypto();      
        return view('cryptoJournal', compact('crypto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCrypto($id=null)
    {   
        $crypto = CryptoJournalService::getCryptoById($id);
        return view('add_cryptoJournal',compact('crypto','id')); 
    }
    
    public function filterCrypto(Request $request)
    {
        $title      = $request->filterNewsTitle;
        
        $crypto     = CryptoJournal::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(10);
        // $videos     = Video_management::where('title', 'LIKE', '%'.$title.'%')->where('categoryId', 'LIKE', '%'.$categoryId.'%')->where('authorId', 'LIKE', '%'.$authorId.'%')->orderby('id','desc')->paginate(10);

        return view('cryptoJournal', compact('crypto'));
    }

    public function saveCrypto(Request $request)
    {
        //validation
        $request->validate([
            'title'             => 'required',
            'shortDescription'  => 'required',
            'fullDescription'   => 'required',
            'metaTitle'         => 'required',
            'description'       => 'required',
            'keywords'          => 'required',
        ]);
        
        $newsdetails = $request->only([
            'title',
            'shortDescription',
            'fullDescription',
            'metaTitle',
            'description',
            'keywords',
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['image'] = $fileName;
        }
        if($request->file('pdf') != null)
        {
            $file      = $request->file('pdf');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['pdf'] = $fileName;
        }
        $newsdetails['slug']       = Str::slug($request->title); //Adds slug for crypto
        $news = CryptoJournalService::createCrypto($newsdetails,$request->newsId);
        return json_encode(['success'=>1,'message'=>'Crypto Journal Saved Successfully']);
    }

    public function deleteCrypto(Request $request)
    {
        $video = CryptoJournalService::deleteCrypto($request->id);
        return json_encode(['success'=>1,'message'=>'Crypto Journal has been deleted successfully']);
    }
}
