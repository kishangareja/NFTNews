@extends('layouts.user.header')

@if(@$newsDetail->metaTitle != null)
  @section('title', @$newsDetail->metaTitle)
@else
  @section('title', 'NFT Markets | News')
@endif

@section('content')
<section class="hero-wrap hero-wrap-2">
    <div class="container">
    <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate">
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>{{ $newsDetail->category->name }}<i class="fa fa-angle-right"></i></span><span>{{ @$newsDetail->title }}</span></p>
        </div>
    </div>
    </div>
</section>


<section class="ftco-section py-5">
    <div class="container">
        <div class="row">
        
        <div class="col-md-9 px-md-0 px-0">
        <div class="container">
        <div class="news-listing ftco-animate">
            <div class="news-wrap p-0 align-items-center">
            
            <div class="w-100 pb-2">
            <span class="text-dark"><img 
              @if($newsDetail->image)
                src="{{ URL::asset('uploads/' . @$newsDetail->image)}}"
              @else
                src="{{ URL::asset('images/default-large-image-detail-page.png')}}"
              @endif
              width="100%" @if($newsDetail->image1_alt == null || $newsDetail->image1_alt == '') alt="{{@$newsDetail->image1_alt}}" @else alt="{{@$newsDetail->title}}" @endif height="auto" class="img"></span>
            </div>
            <div class="row">
                <div class="col-md-6"><span  class="text-light">{{ $newsDetail->category->name }}</span> <span class="ml-4 text-light"><span class="fa fa-calendar"></span> &nbsp;{{ \Carbon\Carbon::parse($newsDetail->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</span></div>
                <div class="col-md-6 text-right">
                <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_kit_size_32 float-right a2a_default_style" data-a2a-icon-color="lightgray">
                  <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                  <a class="a2a_button_facebook"></a>
                  <a class="a2a_button_twitter"></a>
                  <a class="a2a_button_telegram"></a>
                  <a class="a2a_button_email"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
                </div>
            </div>
            <div class="text mt-3">
            
                <h1><span class="text-dark">{{ @$newsDetail->title }}</span></h1>
                <div class="text-justify">{!! @$newsDetail->fullDescription !!}</div>
                <br>       
                <h4>About Author</h4>
                @if(@$newsDetail->authorId != null || @$newsDetail->authorId != '')
                    <div class="container">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="imgAbt">
                                @if($newsDetail->author->image != null || $newsDetail->author->image != '')
                                    <img width="220" height="220" src="{{ URL::asset('uploads/' . @$newsDetail->author->image)}}" alt="{{@$newsDetail->author->name}}" />
                                @else
                                    <img width="220" height="220" src="{{ URL::asset('images/author.png')}}" alt="Default Author Image" />
                                @endif
                              </div>
                          </div>
                          <div class="col-md-8">
                            @if($newsDetail->author->name != null || $newsDetail->author->name != '')
                              <h4><strong>Name</strong>&nbsp;&nbsp;&nbsp;{{@$newsDetail->author->name}}</h4>
                            @endif
                            @if($newsDetail->author->short_bio != null || $newsDetail->author->short_bio != '')
                              <h4><strong>Short Bio</strong>&nbsp;&nbsp;&nbsp;{{@$newsDetail->author->short_bio}}</h4>
                            @endif
                            @if($newsDetail->author->twitterLink != null || $newsDetail->author->twitterLink != '')
                              <h4><strong>Social Media Link</strong>&nbsp;&nbsp;&nbsp;<a target="_blank" href="{{@$newsDetail->author->twitterLink}}" class="a2a_button_twitter"></a>
                            @endif
                            @if($newsDetail->author->linkedInLink != null || $newsDetail->author->linkedInLink != '')
                                <a target="_blank" href="{{@$newsDetail->author->linkedInLink}}"><i class="fa fa-globe"></i></a></h4>
                            @endif
                          </div>
                      </div>
                  </div>
                @else
                  <p>No Author Information Available For This News</p>
                @endif
            </div>
            </div>
            
        </div>
        <!--<a href="#" class="btn d-block btn-light py-2 mt-4">Load More News</a>-->
        </div>
        </div>
        
        <div class="col-md-3 pl-md-0">
        
        {{-- <div class="sidebar-box ftco-animate">
            <div class="categories">
            <h3>Browse Categories</h3>
            <li class="pl-2"><a href="#">Art </a></li>
            <li class="pl-2"><a href="#">Collectibles </a></li>
            <li class="pl-2"><a href="#">Education </a></li>
            <li class="pl-2"><a href="#">Gaming </a></li>
            <li class="pl-2"><a href="#">Metavers </a></li>
            <li class="pl-2"><a href="#">Music </a></li>
            <li class="pl-2"><a href="#">Web 3.0 </a></li>
            </div>
        </div> --}}

            @if(@$innerSideBanner->location != null)
              <div class="sidebar-box">
                  <a href="{{$innerSideBanner->url}}" target="_blank"><img src="{{ URL::asset('uploads/' . @$innerSideBanner->image) }}"
                          width="100%" height="auto" @if($innerSideBanner->banner_image_alt != null || $innerSideBanner->banner_image_alt != '') alt="{{@$innerSideBanner->banner_image_alt}}" @else  alt="Side Inner Banner Image" @endif></a>
              </div>
            @else
              <div class="sidebar-box">
                  <span><img src="{{ URL::asset('images/default-crypto-list.png') }}"
                          width="100%" height="auto" alt="Side Inner Banner Image"></span>
              </div>
            @endif
            {{-- <div class="sidebar-box">
            <a href="#" target="_blank"><img src="{{ URL::asset('uploads/' . @$newsDetail->article_2)}}" width="100%" height="auto" alt=""></a>
            </div> --}}
            
            <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
            <h5 style="background-image:url(images/envelope-icon.png); padding-left: 35px; background-repeat:no-repeat;">SUBSCRIBE NOW</h5>
            <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
            <form action="{{ route('user.subscribe') }}" class="form-consultation">
                <div class="form-group">
                <button type="submit" class="btn-outline-light-gradient px-3 btn border py-1">SIGN UP NOW</button>
                </div>
                <div class="form-group">
                <small>Get this delivered to your inbox, and more info about our products and services. </small>
                </div>
            </form>
            </div>
            
        </div>
        </div>
        
    </div>
</section>
    
{{-- market news| featured --}}
<section class="ftco-section bg-light mb-5 py-5">
    <div class="container">
    <div class="row ftco-animate">
        <div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
        <h2 class="mb-0 py-1">MARKET NEWS <span class="text-light">|</span> FEATURED</h2>
        </div>
    </div>
    <div class="ftco-animate">
        <div class="mktnws-slider owl-carousel ftco-owl">
            @if(@$resultFeaturedNews)
            @foreach($resultFeaturedNews as $news)
                @if($news->is_featurednew == 1)
                <div class="item text-center">
                    <div class="align-items-center justify-content-center"><a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">
                      <img 
                      @if($news->article_1 != null || $news->article_1 != '' || file_exists($news->article_1) == true)
                          src="{{ URL::asset('uploads/' . @$news->article_1) }}"
                      @else
                          src="{{ URL::asset('images/default-market-news-featured.png') }}"
                      @endif 
                      width="100%" class="img-thumbnail" height="auto" @if($news->image1_alt != null || $news->image1_alt != '') alt="{{@$news->image1_alt}}" @else alt="{{@$news->title}}" @endif/></a></div>
                    <div class="text">
                        <h4><a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                        <div class="meta d-md-flex mb-2">
                        <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}" class="meta-chat text-dark">{{ @$news->category->name }}</a>
                        <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}" class="text-light ml-2"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a>
                        </div>
                    </div>
                </div>
                @endif  
            @endforeach
            @endif
            
        </div>
    </div>
    </div>
</section>

 @php
        $i = 1;
        $ln = 0;
        $ln2 = 0;
        $sb = 0;
        $bz = 0;
        $sbcount = count($banners_small);
        $bzcount = count($banners_horizontal);
    @endphp
    <section class="ftco-section py-5">
        <div class="container">
            <div class="row d-flex">
                @if (count(@$getAllNewses))
                    @foreach ($getAllNewses as $news)
                        @if ($i == 5 || $i - $ln == 5)
                            {{-- Ad Banner small --}}
                            <div class="col-md-4 d-flex ftco-animate rounded">
                                <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                                    @if($sbcount == 0)
                                    <span><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}"
                                            width="100%" @if($banners_small[$sb]['banner_image_alt'] != null || $banners_small[$sb]['banner_image_alt'] != '') alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" @else alt="Middle Ad Banner" @endif class="img-fluid"></span>
                                    @else 
                                    <a href="{{@$banners_small[$sb]['url']}}"><img src="{{ URL::asset('uploads/'.@$banners_small[$sb]['image']) }}"
                                            width="100%" @if($banners_small[$sb]['banner_image_alt'] != null || $banners_small[$sb]['banner_image_alt'] != '') alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" @else alt="Middle Ad Banner" @endif class="img-fluid"></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $ln = $i;
                                $sb++;
                                if($sb>=$sbcount)
                                {
                                    $sb = 0;
                                }
                            @endphp
                        @elseif($i == 6 || $i - $ln2 == 5)
                            {{-- horizontal Ad --}}
                            <div class="col-md-12 d-flex mb-4 ftco-animate">
                                    @if($bzcount == 0)
                                    <span><img src="{{ URL::asset('user/images/banner-full-width.jpg') }}" width="100%"
                                    height="auto" class="img-fluid rounded" @if($banners_horizontal[$bz]['banner_image_alt'] != null || $banners_horizontal[$bz]['banner_image_alt'] != '') alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}" @else alt="Horizontal Banner Image" @endif></span>
                                    @else 
                                    <a href="{{ @$banners_horizontal[$bz]['url'] }}"><img src="{{ URL::asset('uploads/'.@$banners_horizontal[$bz]['image']) }}" width="100%"
                                    height="auto" class="img-fluid rounded" @if($banners_horizontal[$bz]['banner_image_alt'] != null || $banners_horizontal[$bz]['banner_image_alt'] != '') alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}" @else alt="Horizontal Banner Image" @endif></a>
                                    @endif
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $ln2 = $i;
                                $bz++;
                                if($bz >= $bzcount)
                                {
                                    $bz = 0;
                                }
                            @endphp
                        @else
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php      $i++;   @endphp
                    @endforeach
                @endif
            </div>

            <a href="{{ route('user.news') }}" class="btn d-block btn-outline-light py-2 mt-4">Load More Articles</a>

        </div>
    </section>
@endsection