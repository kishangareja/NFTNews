@extends('layouts.user.header')

@section('title', 'NFT Markets | Home')

@section('content')
<section class="ftco-section px-0 p-0">
     
     <div class="d-md-flex">
      <div class="col-md-8 border-right border-white col-12 px-0">
       <section class="slider grid-overlay">
        <div class="flexslider">
          <ul class="slides">
            @foreach($result as $data)
              @if($data->is_homeheader == 1)
                <li><img src="{{ URL::asset('uploads/' . $data->image)}}" />
                <p class="flex-caption">
                  <span class="nwscpt">NEWS</span>
                  <a href="{{ route('user.news_detail', ['id' => $data->slug]) }}">{{$data->title}}</a><br><span class="thrs">{{$data->created_at->diffForHumans()}}</span></p>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
      </section>
     </div> <!-- col-md-8 end -->
    
    @if($resultHomeNews)
        <div class="col-md-4 col-12 px-0">
          <div class="row mx-0">
            @if($resultHomeNews[0]->is_homenews == 1)
              <div class="col-md-12 col-6 grid-overlay border-bottom border-white d-xl-block d-lg-block px-0">
                <p class="flex-caption-small w-auto">
                  <span class="nwscpt">NEWS</span>
                    <a href="{{ route('user.news_detail', ['id' => $resultHomeNews[0]->slug]) }}">{{$resultHomeNews[0]->title}}</a><br><span class="thrs"><i class="fa fa-calendar"></i> {{$resultHomeNews[0]->created_at->diffForHumans()}}</span></p>
                <div class="media">
                  <a href="{{ route('user.news_detail', ['id' => $resultHomeNews[0]->slug]) }}" class="image-link"><img src="{{ URL::asset('uploads/' . $resultHomeNews[0]->article_1)}}" width="100%" height="auto" alt=""></a>
                </div>
              </div>
            @endif

            @if($resultHomeNews[1]->is_homenews == 1)
              <div class="col-md-12 col-6 grid-overlay d-xl-block d-lg-block px-0">
                <p class="flex-caption-small w-auto">
                <span class="nwscpt">NEWS</span>
                <a href="{{ route('user.news_detail', ['id' => $resultHomeNews[1]->slug]) }}">{{$resultHomeNews[1]->title}}</a><br><span class="thrs"><i class="fa fa-calendar"></i> {{$resultHomeNews[1]->created_at->diffForHumans()}}</span></p>
                
                <div class="media">
                  <a href="{{ route('user.news_detail', ['id' => $resultHomeNews[1]->slug]) }}" class="image-link">
                <img src="{{ URL::asset('uploads/' . $resultHomeNews[1]->article_1)}}" width="100%" height="auto" alt="">
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
            <div class="col-md-3 heading-section">
             <h2 class="mb-0">LATEST NEWS</h2>
            </div>
            <div class="col-md-9 text-right">
            	<div class="tag-widget post-tag-container">
              <div class="tagcloud"><a href="javascript:void(0)" class="tagLink" onclick="filterCategory(0)">ALL</a>
                @if(@$categories)
                  @foreach($categories as $category)
                    <a href="javascript:void(0)" class='tagLink' onclick="filterCategory({{@$category->id}})" id="categoryId">{{@$category->name}}</a>
                  @endforeach
                @endif
              </div>
              
            </div>
            </div>
           </div>
           	
            <div class="news-listing ftco-animate">
            <div class="news-banner mb-3"><a href="#" class="text-dark" target="_blank"><img src="{{ URL::asset('user/images/banner-horizontal.png')}}" width="100%" height="auto" alt=""></a></div>
             
            <div class="allNews"></div>
            <div class="Newses">
              @if(!empty(@$allNews))
                @foreach($allNews as $news)
                  <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
                      <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark"><div class="img" style="background-image: url({{ URL::asset('uploads/' . @$news->image)}});"></div></a>
                      <div class="text pl-md-3">
                        <div class="meta mb-2">
                            <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">INDUSTRY TALK</a></div>
                            <div><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><span class="fa fa-clock"></span> {{ @$news->created_at->diffForHumans() }}</a></div>
                          </div>
                          <h4><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <p>{{ @$news->shortDescription }}</p>
                      </div>
                  </div>
                @endforeach
              @else
                <p>No Data Found..</p>
              @endif
            </div>
             
            </div>
           
           </div>
          </div>
          
          <div class="col-md-3">
          	 <div class="sidebar-box">
                <a href="#" target="_blank"><img src="{{ URL::asset('user/images/side-banner.png') }}" width="100%" height="auto" alt=""></a>
             </div>
             
              <div class="sidebar-box ftco-animate">
                  <h3>Press Releases</h3>
                  @if(@$pressReleases)
                    @foreach($pressReleases as $pressRelease)
                      <div class="block-21 border p-1 mb-2 d-flex">
                        <a href="#" class="blog-img mr-2" style="background-image: url({{URL::asset('uploads/' . @$pressRelease->image)}});"></a>
                        <div class="text">
                          <h3 class="heading mb-1"><a href="{{ route('user.press_detail', ['id' => base64_encode(@$pressRelease->id)]) }}">{{ @$pressRelease->title}}</a></h3>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <p>No Data Found..</p>
                  @endif
                </div>
                
                <div class="sidebar-box ftco-animate fadeInUp ftco-animated border bg-info-gradient p-3">
                <h5 style="background-image:url({{ URL::asset('user/images/envelope-icon.png')}}); padding-left: 35px; background-repeat:no-repeat;">SUBSCRIBE NOW</h5>
                <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
                <form action="subscribe.html" class="form-consultation">
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


    <section class="ftco-section ftco-animate pb-0">
    <div class="container">
     <div class="row mb-3 ftco-animate">
      <div class="col-md-3 heading-section">
    	<h2 class="mb-0">VIDEOS</h2>
      </div>
      <div class="col-md-9 text-right">
       <div class="tag-widget post-tag-container">
        <div class="tagcloud"><a href="javascript:void(0)" class="tagLink" onclick="filterVideos(0)">ALL</a>
          @if(@$categories)
            @foreach($categories as $category)
              <a href="javascript:void(0)" class='tagLink' onclick="filterVideos({{@$category->id}})" id="categoryId">{{@$category->name}}</a>
            @endforeach
          @endif
        </div>
       </div>
     </div>
     
     
        
          <div class="container">
            <div class="row video-frame mb-4">
              <div class="col-md-6 px-0 ftco-animate">
              <span class="btn btn-outline-light-gradient border">Featured</span>
                <h3 class="mt-md-5">Macro analysis of FTX’s downfall: Is a Domino effect incoming?</h3>
                <p class="text-dark">Mike McGlone, senior commodity strategist at Bloomberg, explains how the FTX debacle is triggering a domino effect that could spread beyond the crypto markets.</p>
                <a href="#" class="btn btn-outline-light-gradient border py-1">Read More</a>
              </div>
              
              <div class="col-md-6">
              <div class="play">
                <img src="{{ URL::asset('assets/user/images/video-feature-img.png')}}" height="300" width="100%" class="img-video" /></div>
              </div> <!-- col-md-6 end -->
            </div>

            {{-- <div class="allVideos"></div>
            <div class="Videos"> --}}
            <div class="row">
              <div class="col-md-12 px-0">
              
                
                <div class="featured-drops owl-carousel ftco-owl">
                    @if(!empty($videos))
                      @foreach($videos as $video)
                        <div class="item play">          
                        <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}"><img src="{{URL::asset('uploads/' . @$video->image1)}}" width="100%" height="auto" alt=""></a>
                        <span class="text-light d-block mt-2" title="{{@$video->title}}">{{substr(@$video->title, 0, 30)}}..</span>
                      <p class="text-justify"><a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" title="{{ @$video->shortDescription }}" class="text-dark">{{substr(@$video->shortDescription, 0, 40)}}..</a></p>			
                        </div>
                      @endforeach
                    @else
                      <div><h2>No Videos Available..</h2></div>
                    @endif
                </div>
                
                
                <a href="{{ route('user.videos') }}" class="btn d-block btn-outline-light py-2 mt-4">More Videos</a>
                
                
              </div>
            </div>
            </div>
          </div>
        
    </div>
    </section>


    <section class="ftco-section pb-0 upcevent-section bg-info-gradient">
       <div class="container">
        <div class="row ftco-animate mx-1">
           <div class="col-md-6 px-md-0 py-md-5 heading-section heading-section-white ftco-animate">
            <span>Cryptonaire Weekly <span class="text-light">|</span> <span class="text-light">Latest Edition Live</span></span>
            <h3 class="mt-md-3">Trade Like a Pro with PrimeXBT's Copy Trading Option</h3>
            <p class="text-dark">Disclaimer: The following article is part of Cryptonews Deals Series and was written as a promotiona...</p>
            <a href="weekly-magazine.html" class="btn btn-outline-light-gradient bg-white py-1">Cryptonaire Weekly</a> <a href="weekly-magazine.html" class="btn btn-outline-light-gradient bg-white py-1">Read More</a>
          </div>
          <div class="col-md-6 p-4">
            <img src="{{ URL::asset('assets/user/images/cryptonaire-weekly-img.png')}}" class="img" width="100%" height="337" alt="">
          </div>
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
          @if(@$resultFeaturedDrop)
            @foreach($resultFeaturedDrop as $data)
              @if($data->is_featuredDrop == 1)
                <div class="item grid">
                  <figure class="effect-lily">
                        <img src="{{URL::asset('uploads/' . @$data->article_2)}}" alt="img12"/>
                        <figcaption>
                            <div>
                              <h2><small class="mb-2 d-block">{{@$data->created_at->diffForHumans()}}</small>{{substr(@$data->title, 0, 30)}}..</h2>
                                <p>{{substr(@$data->shortDescription, 0, 30)}}..</p>
                            </div>
                            <a href="{{ route('user.news_detail', ['id' => @$data->slug]) }}">View more</a>
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
            <div class="tagcloud"><a href="javascript:void(0)" class="tagLink" onclick="filterNFTDrops(0)">ALL</a>
                @if(@$categories)
                  @foreach($categories as $category)
                    <a href="javascript:void(0)" class='tagLink' onclick="filterNFTDrops({{@$category->id}})" id="categoryId">{{@$category->name}}</a>
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
                <th>Token</th>
                <th>Blockchain</th>
                <th>Price of Sale</th>
                <th>Sale Date</th>
                <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
             @foreach($allDropManagement as $dropManagement)
              <tr>
                  <td><img src="{{URL::asset('uploads/' . @$dropManagement->logo) }}" class="rounded-pill" width="34" height="34" alt="" /></td>
                  <td>{{@$dropManagement->name}}</td>
                  <td>{{@$dropManagement->token}}</td>
                  <td><strong>{{@$dropManagement->blockChain}}</strong></td>
                  <td>{{@$dropManagement->priceOfSale}}</td>
                  <td>{{@$dropManagement->saleDate}}</td>
                  <td><a href="{{@$dropManagement->twitterLink}}" target="_blank"><i class="fa fa-twitter mr-3"></i> <a href="{{@$dropManagement->discordLink}}" target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
              </tr>
            @endforeach
           </tbody>
        </table>
        </div> {{-- end div of Drops --}}
        <a href="{{ route('user.list_nftDrops') }}" class="btn d-block btn-outline-light py-2 mt-4" >View More NFT Drops</a>
      </div>
    </section>
    

    {{-- visa card ad --}}
    <section class="drops-section pt-5 ftco-animate">
      <div class="bg-video-wrap">
	     <video src="{{ URL::asset('assets/user/images/video.mp4')}}" loop muted autoplay></video>
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
              @if(@$resultFeaturedNews)
                @foreach($resultFeaturedNews as $news)
                  @if($news->is_featurednew == 1)
                    <div class="item text-center">
                      <div class="align-items-center justify-content-center"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}"><img src="{{URL::asset('uploads/' . @$news->article_1)}}" width="100%" class="img-thumbnail" height="auto" alt=""/></a></div>
                        <div class="text">
                          <h4><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-dark">{{ @$news->title }}</a></h4>
                          <div class="meta d-md-flex mb-2">
                            <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat text-dark">INDUSTRY TALK</a>
                            <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light ml-2"><span class="fa fa-calendar"></span> {{ @$news->created_at->diffForHumans() }}</a>
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
    $i=1;
    $ln=0;
    $ln2=0;
@endphp
    <section class="ftco-section py-5">
      <div class="container">
        <div class="row d-flex">
          @if(count(@$getAllNewses))
          @foreach($getAllNewses as $news)
          @if($i==5 || ($i-$ln)==5)
            {{-- Ad Banner small --}}
            <div class="col-md-4 d-flex ftco-animate rounded">
              <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                <a href="#"><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}" width="100%" alt="" class="img-fluid"></a>
              </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" style="background-image: url({{ URL::asset('uploads/' . @$news->image)}});">
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
            
@php
            $ln = $i;
@endphp
          @elseif($i==6 || ($i-$ln2)==5)
            {{-- horizontal Ad --}}
            <div class="col-md-12 d-flex mb-4 ftco-animate">
              <img src="{{ URL::asset('user/images/banner-full-width.jpg')}}" width="100%" height="auto" class="img-fluid rounded">
            </div>
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" style="background-image: url({{ URL::asset('uploads/' . @$news->image)}});">
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
            @php
            $ln2 = $i;
@endphp
          @else
            <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry rounded shadow align-self-stretch">
                <a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="block-30 rounded" style="background-image: url({{ URL::asset('uploads/' . @$news->image)}});">
                </a>
                <div class="text px-4 mt-3">
                  <h3 class="heading"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}">{{$news->title}}</a></h3>
                  <div class="mb-5">
                    <div class="float-left"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="meta-chat">Admin</a></div>
                    <div class="float-right"><a href="{{ route('user.news_detail', ['id' => @$news->slug]) }}" class="text-light"><span class="fa fa-calendar"></span> 3 hours ago</a></div>
                  </div>
                </div>
              </div>
            </div>
          @endif
@php      $i++;   @endphp
          @endforeach
          @endif        
        </div>
        
        <a href="{{route('user.news')}}" class="btn d-block btn-outline-light py-2 mt-4">Load More Articles</a>
        
      </div>
    </section>


    {{-- Guides --}}
    <section class="ftco-section pt-4 pb-5 bg-info-gradient">
      <div class="container">
   		<div class="row justify-content-center mx-0">
          <div class="col-md-12 mb-4 heading-section text-center ftco-animate">
            <h2>GUIDES</h2>
          </div>
      
          <div class="col-md-3 no-gutters">
          	<h5 class="text-uppercase">Bitcoin</h5>
            <ul class="line-lists">
            	<li><a href="#">How Does Bitcoin Mining Work?</a></li>
                <li><a href="#">Is Bitcoin a Pyramid Scheme?</a></li>
                <li><a href="#">Is Bitcoin a Bubble?</a></li>
                <li><a href="#">Is Bitcoin Legal?</a></li>
                <li><a href="#">How Does Bitcoin Mining Work?</a></li>
            </ul>            
          </div>
          <div class="col-md-3 no-gutters">
          	<h5 class="text-uppercase">NFT</h5>
            <ul class="line-lists">
            	<li><a href="#">A Beginner's Guide to NFTs: What You Should Know</a></li>
                <li><a href="#">How to Create an NFT?</a></li>
                <li><a href="#">Top 10 NFT Marketplaces</a></li>
                <li><a href="#">How to Add Tokens to MetaMask Wallet</a></li>
                <li><a href="#">How to Create an NFT?</a></li>
            </ul>            
          </div>
          <div class="col-md-3 no-gutters">
          	<h5 class="text-uppercase">Cryptocurrency</h5>
            <ul class="line-lists">
            	<li><a href="#">How To Store Cryptocurrency Safely in 2022</a></li>
                <li><a href="#">How To Make Money With Crypto Arbitrage</a></li>
                <li><a href="#">Why It Is Risky To Leave Your Cryptocurrency In Exchange</a></li>
                <li><a href="#">Beginner's Guide to Crypto Trading Strategies</a></li>
                <li><a href="#">How Does Bitcoin Mining Work?</a></li>
            </ul>            
          </div>
          <div class="col-md-3 no-gutters">
          	<h5 class="text-uppercase">Ethereum</h5>
            <ul class="line-lists">
            	<li><a href="#">Before You Sell Ethereum</a></li>
                <li><a href="#">Countries Where Ethereum is Banned or Legal</a></li>
                <li><a href="#">Hardware for Ethereum Mining</a></li>
                <li><a href="#">How to Buy and Sell Ethereum in India?</a></li>
                <li><a href="#">How Does Bitcoin Mining Work?</a></li>
            </ul>            
          </div>
          
          
       </div>
       
       <div class="col-12 mt-4 text-center">
       	<a href="guide.html" class="btn btn-outline-light py-2 bg-white mt-4">View More</a>
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
                <img src="{{ URL::asset('assets/user/images/logo01.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo02.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo03.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo04.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo05.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo06.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo07.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              <div class="item">
                <img src="{{ URL::asset('assets/user/images/logo08.jpg')}}" width="auto" height="72" class="w-auto m-auto" alt="">
              </div>
              
            </div>
               
            <div class="col-12 text-center"><a href="#" class="btn btn-light border py-2 mt-4 text-center">View All Partners</a></div>
            
          </div>
        </div>
      </div>
    </section>
    
@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
//For Link active and remove class add in category filter 
$(document).ready(function() {
    $('.tagLink').click(function() {
        $('.tagLink.active').removeClass("active");
        $(this).addClass("active");
    });
});

// function filterVideos(value)
// {
//   var categoryId = parseInt(value);

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         url: "{{ url('userFilterVideos') }}",
//         type: "GET",
//         data: {
//             categoryId: categoryId,
//         },
//         dataType : 'html',
//         success: function(videos) {
//           console.log(videos);
//           console.log('success'); // code here paste
//           $('.Videos').html(videos);
//           $('.allVideos').hide();
//         },
//         error: function(xhr, status, error) {}
//     });
// }

function filterCategory(value){
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
        dataType : 'html',
        success: function(allNews) {
          console.log('success'); // code here paste
          $('.Newses').html(allNews);
          $('.allNews').hide();
        },
        error: function(xhr, status, error) {}
    });
  }

function filterNFTDrops(value)
{
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
        dataType : 'html',
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