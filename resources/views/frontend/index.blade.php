@extends('frontend.layouts.app')

@section('content')
  {{-- Banner Section 2 --}}
  {{--  @if (get_setting('home_banner2_images') != null)

        <div class="container-fluid pt-3 bg-white">
            <div class="row gutters-10">
                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
   
    @endif --}}
    
    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area pb-4 bg-white">
        <div class="container-fluid">
            <div class="row gutters-10 position-relative">
              {{-- categories menu
              <div class="col-lg-3 position-static d-none d-lg-block">
                    @include('frontend.partials.category_menu')
                </div> --}}
                
                @php
                    $num_todays_deal = count($todays_deal_products);
                @endphp

                <div class="@if($num_todays_deal > 0) col-lg-12 @else col-lg-12 @endif">
                    <div class="row">
                        <div class="col-md-12 p-0">
                        @if (get_setting('home_slider_images') != null)
                            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
                                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                                @foreach ($slider_images as $key => $value)
                                    <div class="carousel-box">
                                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                            <img
                                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                                src="{{ uploaded_asset($slider_images[$key]) }}"
                                                alt="{{ env('APP_NAME')}} promo"
                                                @if(count($featured_categories) == 0)
                                                height="457"
                                                @else
                                                height=""
                                                @endif
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                            >
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        </div>
                    </div>
                    @if (count($featured_categories) > 0)
                    <div class="col-lg-12 text-center pt-5">
                    <h2>THOUGHTFUL GIFTS FOR EVERYONE</h2>
                    <p>At Gift Society we have gifts for everyone so that you can let someone know that you care for them. All of our gifts can tailored with options and add on. </p>
                </div>
                        <ul class="list-unstyled mb-0 row gutters-5">
                            @foreach ($featured_categories as $key => $category)
                            <li class="minw-0 col-12 col-md-6" style="margin-top:1px;padding:1px !important;">
                                    <a href="{{ route('products.category', $category->slug) }}" class="d-block ">
                                        <img
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $category->getTranslation('name') }}"
                                            class="lazyload img-fit"
                                            height="250"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex justify-content-center align-items-center w-50 fs-15" style="font-weight:bold;margin-top: -49px !important;position: relative;border: 1px solid #000;background: #fff;height: 35px;color: black;" class="text-truncate fs-15 fw-700 mt-2 text-center">{{ $category->getTranslation('name') }}</div>
                                        </div>
                                    </a>
                                </li>
                               {{-- <li class="minw-0 col-12 col-md-3 mt-3">
                                    <a href="{{ route('products.category', $category->slug) }}" class="d-block rounded bg-white p-2 text-reset shadow-sm">
                                        <img
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $category->getTranslation('name') }}"
                                            class="lazyload img-fit"
                                            height="250"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                        <div class="text-truncate fs-15 fw-700 mt-2 opacity-70 text-center">{{ $category->getTranslation('name') }}</div>
                                    </a>
                                </li> --}}
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>

{{-- todays deal --}}
  @if($num_todays_deal > 0)
 <section class="pb-4 bg-white">
        <div class="container-fluid">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">  {{ translate('Todays Deal') }}</span>
                    </h3>
                    <span class="badge badge-primary badge-inline ml-2">{{ translate('Hot') }}</span>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="3" data-sm-items="1" data-xs-items="1" data-arrows='true'>
                      @foreach ($todays_deal_products as $key => $product)
                                @if ($product != null)
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                              <a href="{{ route('product', $product->slug) }}" class="d-block p-2 text-reset bg-white h-100 rounded">
                                        <div class="row gutters-5 align-items-center">
                                            <div class="col-xxl">
                                                <div class="img">
                                                    <img
                                                        class="lazyload img-fit h-140px h-lg-210px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xxl">
                                                <div class="fs-16">
                                                    <span class="d-block text-primary fw-600">{{ home_discounted_base_price($product) }}</span>
                                                    <div class="rating rating-sm mt-1">
                                                            {{ renderStarRating($product->rating) }}
                                                        </div>
                                                   <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                       <span class="d-block fw-600">{{$product->name }}</span>
                                                    </h3>
                                                    @if(home_base_price($product) != home_discounted_base_price($product))
                                                        <del class="d-block opacity-70">{{ home_base_price($product) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    </div>
                            </div>
                     @endif
                            @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
 @endif
 
 
    {{-- Banner section 1 --}}
     @if (get_setting('home_banner1_images') != null)
    <section class="pb-4 bg-white">
        <div class="container-fluid">
            <div class="px-md-2 py-md-2 bg-white shadow-sm rounded">
                    <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="false" data-dots="true" data-autoplay="true">
                        @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                                @foreach ($banner_1_imags as $key => $value)
                            <div class="carousel-box">
                               <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                </a>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </section>
    @endif
     
    {{-- trending product --}}
    <!--   <section class="pb-4 bg-white">-->
    <!--    <div class="container-fluid">-->
    <!--        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">-->
    <!--            <div class="d-flex mb-3 align-items-baseline border-bottom">-->
    <!--                <h3 class="h5 fw-700 mb-0">-->
    <!--                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Tranding Product') }}</span>-->
    <!--                </h3>-->
                     <!--<a href="javascript:void(0)" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All') }}</a>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                 <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="4" data-lg-items="4"  data-md-items="3" data-sm-items="1" data-xs-items="1" data-arrows='true'>-->
    <!--                     <div class="carousel-box">-->
    <!--                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">-->
    <!--                          <a href="#" class="d-block p-2 text-reset bg-white h-100 rounded">-->
    <!--                                    <div class="row gutters-5 align-items-center">-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="img">-->
    <!--                                                  <img src="https://thegiftsociety.in/wp-content/uploads/2022/06/bulk-order-website-01-1.webp" class="img-fluid lazyload w-100">-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="fs-16">-->
    <!--                                                <span class="d-block text-primary fw-600">Gift them Prosperity with Artistic Plants</span>-->
    <!--                                                <div class="rating rating-sm mt-1">-->
                                                            
    <!--                                                    </div>-->
    <!--                                               <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">-->
    <!--                                                   <span class="d-block fw-600">Artistic Plants</span>-->
    <!--                                                </h3>-->
                                                  
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                     <div class="carousel-box">-->
    <!--                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">-->
    <!--                          <a href="#" class="d-block p-2 text-reset bg-white h-100 rounded">-->
    <!--                                    <div class="row gutters-5 align-items-center">-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="img">-->
    <!--                                                  <img src="https://thegiftsociety.in/wp-content/uploads/2022/06/bulk-order-website-01-1.webp" class="img-fluid lazyload w-100">-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="fs-16">-->
    <!--                                                <span class="d-block text-primary fw-600">Gift them Prosperity with Artistic Plants</span>-->
    <!--                                                <div class="rating rating-sm mt-1">-->
                                                            
    <!--                                                    </div>-->
    <!--                                               <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">-->
    <!--                                                   <span class="d-block fw-600">Artistic Plants</span>-->
    <!--                                                </h3>-->
                                                  
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                     <div class="carousel-box">-->
    <!--                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">-->
    <!--                          <a href="#" class="d-block p-2 text-reset bg-white h-100 rounded">-->
    <!--                                    <div class="row gutters-5 align-items-center">-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="img">-->
    <!--                                                  <img src="https://thegiftsociety.in/wp-content/uploads/2022/06/bulk-order-website-01-1.webp" class="img-fluid lazyload w-100">-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="fs-16">-->
    <!--                                                <span class="d-block text-primary fw-600">Gift them Prosperity with Artistic Plants</span>-->
    <!--                                                <div class="rating rating-sm mt-1">-->
                                                            
    <!--                                                    </div>-->
    <!--                                               <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">-->
    <!--                                                   <span class="d-block fw-600">Artistic Plants</span>-->
    <!--                                                </h3>-->
                                                  
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                     <div class="carousel-box">-->
    <!--                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">-->
    <!--                          <a href="#" class="d-block p-2 text-reset bg-white h-100 rounded">-->
    <!--                                    <div class="row gutters-5 align-items-center">-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="img">-->
    <!--                                                  <img src="https://thegiftsociety.in/wp-content/uploads/2022/06/bulk-order-website-01-1.webp" class="img-fluid lazyload w-100">-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="fs-16">-->
    <!--                                                <span class="d-block text-primary fw-600">Gift them Prosperity with Artistic Plants</span>-->
    <!--                                                <div class="rating rating-sm mt-1">-->
                                                            
    <!--                                                    </div>-->
    <!--                                               <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">-->
    <!--                                                   <span class="d-block fw-600">Artistic Plants</span>-->
    <!--                                                </h3>-->
                                                  
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                     <div class="carousel-box">-->
    <!--                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">-->
    <!--                          <a href="#" class="d-block p-2 text-reset bg-white h-100 rounded">-->
    <!--                                    <div class="row gutters-5 align-items-center">-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="img">-->
    <!--                                                  <img src="https://thegiftsociety.in/wp-content/uploads/2022/06/bulk-order-website-01-1.webp" class="img-fluid lazyload w-100">-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-xxl">-->
    <!--                                            <div class="fs-16">-->
    <!--                                                <span class="d-block text-primary fw-600">Gift them Prosperity with Artistic Plants</span>-->
    <!--                                                <div class="rating rating-sm mt-1">-->
                                                            
    <!--                                                    </div>-->
    <!--                                               <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">-->
    <!--                                                   <span class="d-block fw-600">Artistic Plants</span>-->
    <!--                                                </h3>-->
                                                  
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
                       
    <!--                </div>-->
                   
                   
               
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    @php
    $trending_product = Cache::remember('trending_product', 3600, function () {
        return filter_products(\App\Models\Product::where('published', 1)->where('tranding', '1'))->limit(12)->get();
    });
@endphp

@if (count($trending_product) > 0)
    <section class="mb-4">
        <div class="container-fluid">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Trending Products') }}</span>
                    </h3>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="3" data-sm-items="1" data-xs-items="1" data-arrows='true'>
                    @foreach ($trending_product as $key => $product)
                    <div class="carousel-box">
                        @include('frontend.partials.product_box_1',['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>   
@endif

    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="mb-4 bg-white">
        <div class="container-fluid">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif



     {{-- Banner Section 2 --}}
    @if (get_setting('home_banner3_images') != null)
    <div class="mb-4 bg-white">
        <div class="container-fluid">
            <div class="row gutters-10">
                @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                @foreach ($banner_3_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_3_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    {{-- Featured Section --}}
    <div id="section_featured">

    </div>

    {{-- Best Selling  --}}
    <div id="section_best_selling">

    </div>

    <!-- Auction Product -->
    @if(addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif


    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Classified Product --}}
    @if(get_setting('classified_product') == 1)
        @php
            $classified_products = \App\Models\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
           @if (count($classified_products) > 0)
               <section class="mb-4">
                   <div class="container-fluid">
                       <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                                </h3>
                                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                            </div>
                           <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                               @foreach ($classified_products as $key => $classified_product)
                                   <div class="carousel-box">
                                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                            <div class="position-relative">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block">
                                                    <img
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </a>
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if($classified_product->conditon == 'new')
                                                       <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                       <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                <div class="fs-15 mb-1">
                                                    <span class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                            </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </section>
           @endif
       @endif

   

    {{-- Best Seller --}}
    <div id="section_best_sellers">

    </div>

    {{-- Top 10 categories and Brands --}}
    @if (get_setting('top10_categories') != null && get_setting('top10_brands') != null)
    <section class="mb-4">
        <div class="container-fluid">
            <div class="row gutters-10">
                @if (get_setting('top10_categories') != null)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                            </h3>
                            <a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                            @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Models\Category::find($value); @endphp
                                @if ($category != null)
                                    <div class="col-sm-6">
                                        <a href="{{ route('products.category', $category->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-3 text-center">
                                                    <img
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($category->banner) }}"
                                                        alt="{{ $category->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                                <div class="col-7">
                                                    <div class="text-truncat-2 pl-3 fs-14 fw-600 text-left">{{ $category->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (get_setting('top10_brands') != null)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Brands') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                            @foreach ($top10_brands as $key => $value)
                                @php $brand = \App\Models\Brand::find($value); @endphp
                                @if ($brand != null)
                                    <div class="col-sm-6">
                                        <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-4 text-center">
                                                    <img
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($brand->logo) }}"
                                                        alt="{{ $brand->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-truncate-2 pl-3 fs-14 fw-600 text-left">{{ $brand->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
