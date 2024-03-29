@extends('layouts.user.header')

@section('title', 'NFT Markets | Home')

@section('content')
<style>
iframe {
  width: 98%;
  height: 100%;
}
.play.first-video::before {
    margin: -28px 0 0 -24px !important;
}
.play.first-video::after {
    margin: -12px 0 0 -6px !important;
}
.block-21 .text .heading {
    overflow: hidden !important;
    height: 75px !important;
}
p.flex-caption a:hover {
    color: #000;
    text-decoration: underline;
    box-shadow: inset 1000px 100px 0 0 #fff;
}
</style>
    <section class="ftco-section px-0 p-0">

        <div class="d-md-flex">
            <div class="col-md-8 border-right border-white col-12 px-0">
                <section class="slider grid-overlay">
                    <div class="flexslider">
                        <ul class="slides">
                            @foreach ($result as $data)
                                @if ($data->is_homeheader == 1)
                                {{-- @dd(file_exists($data->image)) --}}
                                    <li>@if(@$data->image != null || @$data->image != '' || file_exists($data->image) == true)
                                            <img src="{{ URL::asset('uploads/' . $data->image) }}" alt="{{ $data->image1_alt }}"/>
                                        @else
                                            <img src="{{ URL::asset('images/default-large-image-slider.png') }}" @if($data->image1_alt != null || $data->image1_alt != '') alt="{{ $data->image1_alt }}" @else alt="{{ $data->title }}" @endif/>
                                        @endif
                                        <p class="flex-caption">
                                            <span class="nwscpt">NEWS</span>
                                            <a class="strong-hover-shake"
                                                href="{{ route('user.news_detail', ['category'=> $data->category->name,'id' => $data->slug]) }}">{{ $data->title }}</a><br><span
                                                class="thrs">
                                                {{ \Carbon\Carbon::parse($data->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                        </p>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div> <!-- col-md-8 end -->

            @if (count($featured_news)>0)
                @php
                    $random_keys = array_rand($featured_news, 2);
                    //dd($random_keys);
                @endphp
                <div class="col-md-4 col-12 px-0">
                    <div class="row mx-0">
                        @if ($featured_news[$random_keys[0]]->is_homenews == 1)
                            <div class="col-md-12 col-6 grid-overlay border-bottom border-white d-xl-block d-lg-block px-0">
                                <p class="flex-caption-small w-auto">
                                    <span class="nwscpt">NEWS</span>
                                    <a
                                        href="{{ route('user.news_detail', ['category'=>@$featured_news[$random_keys[0]]->category->name,'id' => @$featured_news[$random_keys[0]]->slug]) }}">{{ @$featured_news[$random_keys[0]]->title }}</a><br><span
                                        class="thrs"><i class="fa fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse(@$featured_news[$random_keys[0]]->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                    </span>
                                </p>
                                <div class="media">
                                    <a href="{{ route('user.news_detail', ['id' => @$featured_news[$random_keys[0]]->slug]) }}"
                                        class="image-link">
                                        {{-- @dd($featured_news[$random_keys[0]]->article_1); --}}
                                        @if(@$featured_news[$random_keys[0]]->article_1 != null || @$featured_news[$random_keys[0]]->article_1 != '' || file_exists(@$featured_news[$random_keys[0]]->article_1) == true)
                                            <img src="{{ URL::asset('uploads/' . @$featured_news[$random_keys[0]]->article_1) }}"
                                            width="100%" height="auto" @if($featured_news[$random_keys[0]]->image2_alt != null || $featured_news[$random_keys[0]]->image2_alt != '') alt="{{ @$featured_news[$random_keys[0]]->image2_alt }}" @else alt="{{@$featured_news[$random_keys[0]]->title}}" @endif>
                                        @else
                                            <img src="{{ URL::asset('images/default-side-image.png') }}" width="100%" height="auto" @if($featured_news[$random_keys[0]]->image2_alt != null || $featured_news[$random_keys[0]]->image2_alt != '') alt="{{ @$featured_news[$random_keys[0]]->image2_alt }}" @else alt="{{@$featured_news[$random_keys[0]]->title}}" @endif/>   
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if ($featured_news[$random_keys[1]]->is_homenews == 1)
                            <div class="col-md-12 col-6 grid-overlay d-xl-block d-lg-block px-0">
                                <p class="flex-caption-small w-auto">
                                    <span class="nwscpt">NEWS</span>
                                    <a
                                        href="{{ route('user.news_detail', ['category'=>@$featured_news[$random_keys[1]]->category->name,'id' => @$featured_news[$random_keys[1]]->slug]) }}">{{ @$featured_news[$random_keys[1]]->title }}</a><br><span
                                        class="thrs"><i class="fa fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse(@$featured_news[$random_keys[0]]->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                    </span>
                                </p>

                                <div class="media">
                                    <a href="{{ route('user.news_detail', ['id' => @$featured_news[$random_keys[1]]->slug]) }}"
                                        class="image-link">
                                        @if(@$featured_news[$random_keys[1]]->article_1 != null || @$featured_news[$random_keys[1]]->article_1 != '' || file_exists(@$featured_news[$random_keys[1]]->article_1) == true)
                                            <img src="{{ URL::asset('uploads/' . @$featured_news[$random_keys[1]]->article_1) }}"
                                            width="100%" height="auto" @if(@$featured_news[$random_keys[1]]->image2_alt != null || @$featured_news[$random_keys[1]]->image2_alt != '') alt="{{ @$featured_news[$random_keys[1]]->image2_alt }}" @else alt="{{@$featured_news[$random_keys[1]]->title}}" @endif>
                                            
                                        @else
                                            <img src="{{ URL::asset('images/default-side-image.png') }}" width="100%" height="auto" 
                                            @if($featured_news[$random_keys[0]]->image2_alt != null || $featured_news[$random_keys[0]]->image2_alt != '') alt="{{ @$featured_news[$random_keys[0]]->image2_alt }}" @else alt="{{@$featured_news[$random_keys[0]]->title}}" @endif/>   
                                        @endif    
                                    </a>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="ftco-section pb-0 pt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-9 px-md-0 px-0">
                    <div class="container pr-md-3">
                        <div class="row mb-3 ftco-animate">
                            <div class="col-md-2 heading-section">
                                <h2 class="mb-0">LATEST NEWS</h2>
                            </div>
                            <div class="col-md-10 text-right">
                                <div class="tag-widget post-tag-container">
                                    <div class="tagcloud"><a href="javascript:void(0)" class="tagLink"
                                            onclick="filterCategory(0)">ALL</a>
                                        @if (@$categories)
                                            @foreach ($categories as $category)
                                                <a href="javascript:void(0)" class='tagLink'
                                                    onclick="filterCategory({{ @$category->id }})"
                                                    id="categoryId">{{ @$category->name }}</a>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="news-listing ftco-animate">
                            <div class="news-banner mb-3">
                                @if(@$homeTopBanner->location != null)
                                    <a href="{{@$homeTopBanner->url}}" class="text-dark" target="_blank"><img
                                    src="{{ URL::asset('uploads/' . @$homeTopBanner->image) }}" width="100%"
                                    height="auto" @if(@$homeTopBanner->banner_image_alt != null || @$homeTopBanner->banner_image_alt != '') alt="{{@$homeTopBanner->banner_image_alt}}" @else alt="Top Banner Image" @endif></a>
                                @endif
                            </div>
                            <div class="allNews"></div>
                            <div class="Newses">
                                @if (!empty(@$allNews))
                                    @foreach ($allNews as $news)
                                        <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                                            <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                class="text-dark">
                                                <div class="img"
                                                    @if($news->article_1 != null || $news->article_1 != '' || file_exists(@$news->article_1) == true)
                                                        style="background-image: url({{ URL::asset('uploads/' . @$news->article_1) }});"
                                                    @else
                                                        style="background-image: url({{ URL::asset('images/default-listing-news.png') }});" 
                                                    @endif
                                                    >
                                                </div>
                                            </a>
                                            <div class="text pl-md-3">
                                                <div class="meta mb-2">
                                                    <div><a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                            class="meta-chat">{{ $news->category->name }}</a></div>
                                                    <div><a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"><span
                                                                class="fa fa-clock"></span>
                                                                {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                                        </a></div>
                                                </div>
                                                <h4><a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                        class="text-dark">{{ @$news->title }}</a></h4>
                                                <p>{{ @$news->shortDescription }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="{{ route('user.news') }}" class="btn d-block btn-outline-light py-2 mt-4">More News</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    @if(@$homeSideBanner->location)
                        <div class="sidebar-box">
                            <a href="{{@$homeSideBanner->url}}" target="_blank">
                                <img src="{{ URL::asset('uploads/' . @$homeSideBanner->image) }}"
                                    width="100%" height="auto" @if(@$homeSideBanner->banner_image_alt != null || @$homeSideBanner->banner_image_alt != '') alt="{{@$homeSideBanner->banner_image_alt}}" @else alt="Home Side Banner Image" @endif>
                            </a>
                        </div>
                    @endif

                    <div class="sidebar-box ftco-animate">
                        <h3>Press Releases</h3>
                        @if (@$pressReleases)
                            @foreach ($pressReleases as $pressRelease)
                                <div class="block-21 border p-1 mb-2 d-flex">
                                    <a href="{{ route('user.press_detail', ['id' => @$pressRelease->slug]) }}" class="blog-img mr-2"
                                    @if($pressRelease->image)
                                        style="background-image: url({{ URL::asset('uploads/' . @$pressRelease->image) }});"
                                    @else
                                        style="background-image: url({{ URL::asset('images/default-press-releases.png') }});"
                                    @endif
                                    ></a>
                                    
                                    <div class="text">
                                        <h3 class="heading mb-1"><a
                                                href="{{ route('user.press_detail', ['id' => @$pressRelease->slug]) }}">{{ @$pressRelease->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Data Found..</p>
                        @endif
                    </div>

                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
                        <h5
                            style="background-image:url({{ URL::asset('user/images/envelope-icon.png') }}); padding-left: 35px; background-repeat:no-repeat;">
                            SUBSCRIBE NOW</h5>
                        <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
                        <form action="{{ route('user.subscribe') }}" class="form-consultation">
                            <div class="form-group">
                                <button type="submit" class="btn-outline-light-gradient px-3 btn border py-1">SIGN UP
                                    NOW</button>
                            </div>
                            <div class="form-group">
                                <small>Get this delivered to your inbox, and more info about our products and
                                    services. </small>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-animate pb-0">
        <div class="container">
            <div class="row mb-3 ftco-animate">
                <div class="col-md-3 heading-section">
                    <h2 class="mb-0">VIDEOS</h2>
                </div>
                <div class="col-md-9 text-right">
                    <div class="tag-widget post-tag-container">
                        <div class="tagcloud"><a href="javascript:void(0)" class="tagLink"
                                onclick="filterVideos(0)">ALL</a>
                            @if (@$categories)
                                @foreach ($categories as $category)
                                    <a href="javascript:void(0)" class='tagLink'
                                        onclick="filterVideos({{ @$category->id }})"
                                        id="categoryId">{{ @$category->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                {{-- @dd(@$videos[0]) --}}
                <div class="container">
                    <div class="row video-frame mb-4">
                        <div class="col-md-6 px-0 ftco-animate">
                          <a href="{{ route('user.videos') }}">
                            <span class="btn btn-outline-light-gradient border">Featured</span>
                          </a>
                          <h3 class="mt-md-5">{{substr(@$videos[0]->title, 0, 50) }}</h3>
                          <p class="text-dark">{{ substr(@$videos[0]->shortDescription, 0, 40) }}</p>
                          <a href="{{ route('user.video_detail', ['category'=> $videos[0]->category->slug,'id' => @$videos[0]->slug]) }}" class="btn btn-outline-light-gradient border py-1">Read More</a>
                        </div>

                        <div class="col-md-6">
                            <div class="play first-video">
                              <a href="{{ route('user.video_detail', ['category'=> $videos[0]->category->slug,'id' => @$videos[0]->slug]) }}">
                                <img    @if($videos[0]->uploadSocialBanner || file_exists(@$videos[0]->uploadSocialBanner) == true) 
                                            src="{{ URL::asset('uploads/' . @$videos[0]->uploadSocialBanner) }}"
                                        @else
                                            src="{{ URL::asset('images/default-video-featured-first.png') }}"
                                        @endif 
                                        height="300"
                                    width="100%" class="img-video" @if($videos[0]->social_banner_alt != null || $videos[0]->social_banner_alt != '') alt="{{ @$videos[0]->social_banner_alt}}" @else alt="{{@$videos[0]->title}}" @endif/>
                              </a>
                            </div>
                        </div> <!-- col-md-6 end -->
                    </div>

                    {{-- <div class="allVideos"></div>
            <div class="Videos"> --}}
                <style>
                    figure.effect-lily.video-section img{
                        height: auto !important;
                    }
                    figure.effect-lily.video-section p{
                        line-height: 0 !important;
                    }
                </style>
                    <div class="row">
                        <div class="col-md-12 px-0 videoSection">
                            <div class="featured-drops owl-carousel ftco-owl ">

                                @if (!empty($videos))
                                    @foreach ($videos as $video)
                                    
                                        <figure class="effect-lily video-section item play">
                                            <figcaption>
                                            <a href="{{ route('user.video_detail', ['category'=> $video->category->slug,'id' => @$video->slug]) }}"><img
                                                    @if($video->image1 != null || $video->image1 != '' || file_exists(@$video->image1) == true)
                                                        src="{{ URL::asset('uploads/' . @$video->image1) }}"
                                                    @else
                                                        src="{{ URL::asset('images/default-video-list-image.png') }}"
                                                    @endif
                                                    width="100%"
                                                    height="auto" @if($video->image1_alt != null || $video->image1_alt != '') alt="{{ @$video->image1_alt}}" @else alt="{{@$video->title}}" @endif></a>
                                            
                                                <p class="text-center" style="margin-bottom: 10px !important;"><a href="{{ route('user.video_detail', ['category'=> $video->category->slug,'id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$video->id}}">Watch Now</a> <a href="{{ route('user.video_detail', ['category'=> $video->category->slug,'id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5">View Details</a></p>
                                            </figcaption>       
                                            <span class="text-light d-block"
                                                title="{{ @$video->title }}">{{ substr(@$video->title, 0, 30) }}..</span>
                                            {{-- <p class="text-justify"><a
                                                    href="{{ route('user.video_detail', ['id' => @$video->slug]) }}"
                                                    title="{{ @$video->shortDescription }}"
                                                    class="text-dark">{{ substr(@$video->shortDescription, 0, 40) }}..</a>
                                            </p> --}}
                                        </figure>
                                    @endforeach
                                @endif
                            </div>


                            <a href="{{ route('user.videos') }}" class="btn d-block btn-outline-light py-2 mt-4">More
                                Videos</a>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="ftco-section pb-0 upcevent-section bg-info-gradient">
        <div class="container">
            <div class="row ftco-animate mx-1">
                @if(@$cryptoJournals != null || @$cryptoJournals != '')
                <div class="col-md-6 px-md-0 py-md-5 heading-section heading-section-white ftco-animate">
                    <span>Cryptonaire Weekly <span class="text-light">|</span> <span class="text-light">Latest Edition
                            Live</span></span>
                    <h3 class="mt-md-3">{{ @$cryptoJournals->title }}</h3>
                    <p class="text-dark">{{ @$cryptoJournals->shortDescription }}</p>
                    <a href="{{ route('user.cryptoJournals') }}" class="btn btn-outline-light-gradient bg-white py-1">Cryptonaire
                        Weekly</a>
                        
                    <a href="{{ route('user.crypto_detail', ['id' => @$cryptoJournals->slug]) }}"
                        class="btn btn-outline-light-gradient bg-white py-1">Read More</a>
                </div>
                <div class="col-md-6 p-4 text-center">
                    <img 
                    @if($cryptoJournals->image != null || $cryptoJournals->image!= ''  ||  file_exists(@$cryptoJournals->image) == true)
                        src="{{URL::asset('uploads/' . @$cryptoJournals->image)}}"
                    @else
                        src="{{URL::asset('images/default-crypto-journal-first.png')}}"
                    @endif
                    class="img" style="width:auto;" @if($cryptoJournals->image_alt != null || $cryptoJournals->image_alt != '') alt="{{ @$cryptoJournals->image_alt}}" @else alt="{{ @$cryptoJournals->title }}" @endif>                        
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Feature Drops --}}
    <section class="ftco-section pb-0 drops-section">
        <div class="container">
            <div class="row ftco-animate px-md-3">
                <div class="col-md-12 mb-3 heading-section text-left ftco-animate fadeInUp ftco-animated">
                    <h2 class="mb-0 py-1">FEATURED DROPS</h2>
                </div>
            </div>

            <div class="featured-drops owl-carousel ftco-owl">
                @if (@$resultFeaturedDrop)
                    @foreach ($resultFeaturedDrop as $data)
                        @if ($data->is_featuredDrop == 1)
                            <div class="item grid">
                                <figure class="effect-lily">
                                    <img 
                                    @if($data->article_2 != null || $data->article_2 != ''  ||  file_exists(@$data->article_2) == true)
                                        src="{{ URL::asset('uploads/' . @$data->article_2) }}"
                                    @else
                                        src="{{ URL::asset('images/default-featured-drop-news.png') }}"
                                    @endif
                                    @if($data->image2_alt != null || $data->image2_alt != '') alt="{{@$data->image2_alt}}" @else alt="{{@$data->title}}" @endif class="text-white"/>
                                    
                                        <figcaption>
                                        <div>
                                            <h2><small class="mb-2 d-block">
                                                {{ \Carbon\Carbon::parse($data->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                                </small>{{ substr(@$data->title, 0, 30) }}..
                                            </h2>
                                            <p>{{ substr(@$data->shortDescription, 0, 30) }}..</p>
                                        </div>
                                        <a href="{{ route('user.news_detail', ['category'=> $data->category->name, 'id' => @$data->slug]) }}">View more</a>
                                    </figcaption>
                                </figure>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>No Data Found..</p>
                @endif
            </div>
        </div>
        </div>
    </section>


    {{-- Upocoming drops --}}
    <section class="ftco-section pb-0 drops-section">
        <div class="container">
            <div class="d-md-flex ftco-animate">
                <div class="mb-2 heading-section ftco-animate">
                    <h2 class="mb-0 py-1">UPCOMING NFT DROPS</h2>
                </div>
                <div class="px-0 ml-auto text-right py-2">
                    <div class="tag-widget post-tag-container">
                        <div class="tagcloud"><a href="javascript:void(0)" class="tagLink"
                                onclick="filterNFTDrops(0)">ALL</a>
                            @if (@$categories)
                                @foreach ($categories as $category)
                                    <a href="javascript:void(0)" class='tagLink'
                                        onclick="filterNFTDrops({{ @$category->id }})"
                                        id="categoryId">{{ @$category->name }}</a>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <div class="allNFTDrops"></div>
            <div class="NFTDrops">
                <table class="table border text-dark table-responsive-sm table-striped table-borderless">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Name</th>
                            <th>Volume</th>
                            <th>Blockchain</th>
                            <th>Price</th>
                            <th>Sale Date</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allDropManagement as $dropManagement)
                            <tr>
                                <td><img src="@if (@$dropManagement->logo != null || @$dropManagement->logo != '' || file_exists(@$dropManagement->logo) == true) {{ URL::asset('uploads/' . @$dropManagement->logo) }} @else {{ URL::asset('images/default-logo.png') }} @endif"
                                        class="rounded-pill" width="34" height="34" alt="{{@$dropManagement->name}}" /></td>
                                <td>{{ @$dropManagement->name }}</td>
                                <td>{{ @$dropManagement->collectionItem }}</td>
                                <td><strong>{{ @$dropManagement->blockChain }}</strong></td>
                                <td>{{ @$dropManagement->priceOfSale }}</td>
                                <td>{{ @$dropManagement->saleDate }}</td>
                                <td><a href="{{ @$dropManagement->twitterLink }}" target="_blank"><i
                                            class="fa fa-twitter mr-3"></i> <a href="{{ @$dropManagement->discordLink }}"
                                            target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> {{-- end div of Drops --}}
            <a href="{{ route('user.list_nftDrops') }}" class="btn d-block btn-outline-light py-2 mt-4">View More NFT
                Drops</a>
        </div>
    </section>


    {{-- visa card ad --}}
    <section class="drops-section pt-5 ftco-animate">
        <div class="bg-video-wrap">
            <video src="{{ URL::asset('assets/user/images/video.mp4') }}" loop muted autoplay></video>
            <div class="overlay"></div>
            <div class="contbox">
                <h3 class="text-light">NFT MARKETS VISA CARD</h3>
                <h1>The only card you need</h1>
                <p class="text-white">Enjoy up to 5% back on all spending with your sleek, pure metal card.
                    No annual fees. Top-up with fiat or crypto.</p>
                <a href="#" class="btn btn-outline-light-gradient border mt-5">Choose Your Card</a>
            </div>
        </div>
    </section>


    {{-- market news| featured --}}
    <section class="ftco-section pb-0">
        <div class="container">
            <div class="row ftco-animate">
                <div class="col-md-12 mx-auto mb-3 heading-section heading-section-white text-left ftco-animate">
                    <h2 class="mb-0 py-1">MARKET NEWS <span class="text-light">|</span> FEATURED</h2>
                </div>
            </div>
            <div class="ftco-animate">
                <div class="mktnws-slider owl-carousel ftco-owl">
                    @if (@$resultFeaturedNews)
                        @foreach ($resultFeaturedNews as $news)
                            @if ($news->is_featurednew == 1)
                                <div class="item text-center">
                                    <div class="align-items-center justify-content-center"><a
                                            href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"><img
                                            @if($news->article_1 != null || $news->article_1 != '' || file_exists($news->article_1) == true)
                                                src="{{ URL::asset('uploads/' . @$news->article_1) }}"
                                            @else
                                                src="{{ URL::asset('images/default-market-news-featured.png') }}"
                                            @endif
                                            width="100%"
                                                class="img-thumbnail" height="auto" @if($news->image1_alt != null || $news->image1_alt != '') alt="{{@$news->image1_alt}}" @else alt="{{@$news->title}}" @endif/></a></div>
                                    <div class="text">
                                        <h4><a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                class="text-dark">{{ @$news->title }}</a></h4>
                                        <div class="meta d-md-flex mb-2">
                                            <a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                class="meta-chat text-dark">{{ @$news->category->name }}</a>
                                            <a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                class="text-light ml-2"><span class="fa fa-calendar"></span>
                                                {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                            </a>
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
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
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
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> 
                                                    {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                                </a></div>
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
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
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
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> 
                                                    {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                                </a></div>
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
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
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
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name, 'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span>
                                                    {{ \Carbon\Carbon::parse($news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}
                                                    </a></div>
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


    {{-- Guides --}}
    <section class="ftco-section pt-4 pb-5 bg-info-gradient">
        <div class="container">
            <div class="row justify-content-center mx-0">
                <div class="col-md-12 mb-4 heading-section text-center ftco-animate">
                    <h2>GUIDES</h2>
                </div>
                @if (@$guides)
                    @foreach ($guides as $guide)
                        <div class="col-md-3 no-gutters">
                            <h5 class="text-uppercase">{{ @$guide->guideCategory->name}}</h5>
                            <ul class="line-lists">
                                <li><a
                                        href="{{ url('guideList/' . @$guide->categorySlug . '/' . @$guide->slug) }}">{!! @$guide->question !!}</a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @endif


            </div>

            <div class="col-12 mt-4 text-center">
                <a href="{{ route('user.guide') }}" class="btn btn-outline-light py-2 bg-white mt-4">View More</a>
            </div>

        </div>
    </section>


    {{-- Supported By --}}
    <section class="ftco-section py-5">
        <div class="container">
            <div class="row ftco-animate mx-0">
                <div class="col-md-12 heading-section heading-section-white text-center ftco-animate">
                    <h4>Supported By</h4>
                </div>
                <div class="col-md-12 ml-auto pt-3">
                    <div class="logos-carousel owl-carousel ftco-owl">
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo01.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo1">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo02.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo2">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo03.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo3">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo04.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo4">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo05.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo5">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo06.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo6">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo07.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo7">
                        </div>
                        <div class="item">
                            <img src="{{ URL::asset('assets/user/images/logo08.jpg') }}" width="auto" height="72"
                                class="w-auto m-auto" alt="Company Logo8">
                        </div>

                    </div>

                    <div class="col-12 text-center"><a href="{{route('user.partners')}}"
                            class="btn btn-light border py-2 mt-4 text-center">View All Partners</a></div>

                </div>
            </div>
        </div>
    </section>

<!-- Quick View -->
    @foreach($videos as $video)
    <div class="modal fade" id="myModal-{{@$video->id}}" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%;margin: 0 auto;" role="document">  
          <!-- Modal content-->     
          <div class="modal-content" style="height: 625px;">
            <div class="modal-header">
                <h3>{{ @$video->title }}</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                {{-- <h4>{{@$video->title}}</h4><br> --}}
              {!!@$video->code!!}
              </div>
         </div>
  
        </div>
    </div>
    @endforeach
@endsection

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ URL::asset('assets/user/js/owl.carousel.min.js') }}"></script>

    <script>
        //For Link active and remove class add in category filter 
        $(document).ready(function() {
            $('.tagLink').click(function() {
                $('.tagLink.active').removeClass("active");
                $(this).addClass("active");
            });
        });

        function filterVideos(value) {
            var categoryId = parseInt(value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('userFilterVideos') }}",
                type: "GET",
                data: {
                    categoryId: categoryId,
                },
                dataType: 'html',
                success: function(videos) {
                    console.log(videos);
                    console.log('success'); // code here paste
                    $('.videoSection').html(videos);
                    $('.videoSection').find('.featured-drops').owlCarousel({
                        navigation: true,
                        center: false,
                        loop: true,
                        items: 1,
                        margin: 10,
                        stagePadding: 0,
                        dots: true,
                        nav: false,
                        navText: ['<span class="ion-ios-arrow-back">',
                            '<span class="ion-ios-arrow-forward">'
                        ],
                        responsive: {
                            0: {
                                items: 2
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 5
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {}
            });
        }

        function filterCategory(value) {
            var categoryId = parseInt(value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('userFilterCategory') }}",
                type: "GET",
                data: {
                    categoryId: categoryId,
                },
                dataType: 'html',
                success: function(allNews) {
                    console.log('success'); // code here paste
                    $('.Newses').html(allNews);
                    $('.allNews').hide();
                },
                error: function(xhr, status, error) {}
            });
        }

        function filterNFTDrops(value) {
            var categoryId = parseInt(value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('userFilterNFTDrops') }}",
                type: "GET",
                data: {
                    categoryId: categoryId,
                },
                dataType: 'html',
                success: function(allDropManagement) {
                    console.log('success'); // code here paste
                    $('.NFTDrops').html(allDropManagement);
                    $('.allNFTDrops').hide();
                },
                error: function(xhr, status, error) {}
            });
        }
    </script>
@endsection
