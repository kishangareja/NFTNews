@extends('layouts.user.header')

@section('title', 'NFT Markets | Videos')

@section('content')
<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Videos</span></p>
          </div>
          
        </div>
      </div>
    </section>
    
    <section class="ftco-section py-5 bg-info-gradient">
       <div class="container">
       <form action="{{ route('user.filter_videos') }}" id="video_form" method="POST">
        @csrf
         <div class="row">
            
            <div class="col-md-4 d-flex">
              <input type="hidden" name="filterValue" id="filterValue" value="{{@$filterValue}}">
              <a onclick="filterForVideos('all')" id="allData" class="page-link py-3 {{ @$filterValue == 'all' || @$filterValue == '' ? 'active' : '' }}">ALL</a> 
              <a onclick="filterForVideos('latest')" class="py-3 page-link px-4 mx-2 {{ @$filterValue == 'latest' ? 'active' : '' }}">LATEST</a> 
              <a onclick="filterForVideos('featured')" class="py-3 page-link px-4 {{ @$filterValue == 'featured' ? 'active' : '' }}">FEATURED</a>
            </div>
            
            <div class="col-md-3 px-0">
              {{-- <form action="#" class="w-100"> --}}
                <div class="form-group d-flex bg-white searchform border mb-0 mx-0">
                  <input type="text" name="search" class="form-control text-center" placeholder="SEARCH NEWS" value="{{@$search}}">
                  <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
                </div>
              {{-- </form> --}}
            </div>

          <div class="col-md-2 text-right pr-0">
          <select class="form-control" id="filternftcategoryValue" name="filternftcategoryValue" onchange="filterForVideos('category')">
            <option value="">Select Categories</option>
            {{-- <option value="all" {{ @$filtercategoryId == 'all' || @$filtercategoryId == ''  ? "selected" : "" }}>All</option> --}}
            @foreach($categories as $category)
                <option value="{{@$category->id}}" {{ @$filtercategoryId == @$category->id  ? "selected" : "" }}>{{@$category->name}}</option>
            @endforeach
            {{-- <option value="avalanche">Avalanche</option> --}}
          </select>
          </div>
          </div>
        </form>
          <br> 
          <div>
            {{ $videos->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
          </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-animate pt-0">
    <div class="container">
       <div class="row">
       @if(count($videos))
        @foreach($videos as $video)
        <div class="col-md-3"> 
       	  <figure class="effect-lily play">
           <img src="{{URL::asset('uploads/'. @$video->image1)}}" width="100%" class="img-fluid w-100 h-auto" alt="">
           <figcaption>
            <p class="text-center"><a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$video->id}}">Quick View</a> <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5">View Details</a></p>
           </figcaption>
          </figure>
          <div class="mt-md-n4">
          	<span class="text-light d-block mt-2" title="{{@$video->title}}">{{substr(@$video->title, 0, 30)}}..</span>
            <p class="text-justify"><a href="#" title="{{ @$video->shortDescription }}" class="text-dark">{{substr(@$video->shortDescription, 0, 40)}}..</a></p>	
          </div>
        </div>
        @endforeach
        @endif
       
         
         
	  </div>
      
      <div>
        {{ $videos->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
        </div>
     </div>
    </section>	
    <!-- Quick View -->
    @foreach($videos as $video)
    <div class="modal fade" id="myModal-{{@$video->id}}" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fa fa-calendar"></i>{{@$video->created_at->format('F d, Y')}}</h6>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>{{@$video->title}}</h4><br>
                <iframe width="100%" height="415" src="https://www.youtube.com/embed/vMnlgWFnJWU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
         </div>
  
        </div>
    </div>
    @endforeach
@endsection