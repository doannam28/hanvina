@extends('frontend.layouts.app')
@section('meta')
    <title>Tin tức | HanVina Travel</title>
    <meta name="description" content="Tin tức | HanVina Travel">
    <meta name="keywords" content="Tin tức | HanVina Travel">
    <meta property="og:title" content="Tin tức | HanVina Travel">
    <meta property="og:description" content="Tin tức | HanVina Travel">
    <meta property="og:type" content="article">
    <?php $setting = Utility::setting();?>
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/news.css?v='.env('VERSION_CSS'))}}">
@endpush
@push('js')
    <script src="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.js') }}"></script>
    <script src="{{ asset('/assets/js/news.js?t='.time()) }}"></script>
@endpush
@section('content')
    <section class="header-image " id="section-news">
        <div class="w-100 position-relative ">
            @if(isset($page['image']))
                <img alt="banner" class="hero-image" src="{{Storage::disk('admin')->url($page['image'])}}">
            @endif
            <div class="position-absolute bottom-0 w-100 h-100">
                <div class="container position-relative h-100">
                    <div class="box-header">
                        <h5 class="fs-3 h5-title-new font-14-mobile">{{$page['title'] ?? ''}}</h5>
                        <div class="text fs-6 font-12-mobile text-align-justify">
                            {{$page['content'] ?? ''}}
                        </div>
                        <a href="{{$page['link'] ?? ''}}">
                            <button class="btn-hanvina">
                                <span class="fs-6">Khám phá ngay</span>
                                <p class="bor-img"></p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="block-destination" class="container pt-5 bg-news destination">
        <div class="row pb-4">
            <div class="col-12 col-md-9 text-center text-md-start">
                <h2 class="h2 fs-2 font-16-mobile h-destination">CÁC ĐỊA ĐIỂM ĐANG ĐƯỢC SĂN ĐÓN</h2>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex justify-content-end">
                <button class="btn btn-default arrow-btn m-0 p-0 customPreviousBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path
                            d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z"
                            stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M31 24H19" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M23 18L17 24L23 30" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="btn btn-default arrow-btn  m-0 p-0 customNextBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path
                            d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z"
                            stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M31 24H19" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M23 18L17 24L23 30" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($destinations as $destination)
                <div class="item position-relative">
                    <a href="{{url('/tin-tuc/'.$destination->slug)}}">
                    <img class="img-destination" src="{{Storage::disk('admin')->url($destination->thumbnail)}}"
                         alt="{{$destination->title}}">
                    </a>
                    <div class="title w-100 ">
                        <a class="fs-6 font-12-mobile" href="{{url('/tin-tuc/'.$destination->slug)}}">{{$destination->title}}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container pt-5 bg-news destination">
        <div class="row pb-4">
            <div class="col-12 col-md-9 text-center text-md-start">
                <h2 class="h2 fs-2 font-16-mobile">TIN TỨC</h2>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex"></div>
        </div>
        <div class="row d-none d-md-flex">
            @foreach($listNews as $news)
                <div class="col-12 col-md-4 pb-4">
                    <div class="item news-item">
                        <a href="{{url('/tin-tuc/'.$news->slug)}}">
                            <div class="wp-img-new">
                                <img class="w-100 img-news" src="{{Storage::disk('admin')->url($news->thumbnail)}}"
                                     alt="news">
                            </div>
                        </a>
                        <div class="title-news text-two-line">
                            <a href="{{url('/tin-tuc/'.$news->slug)}}">{{$news->title}}</a>
                        </div>
                        <div class="mt-2 item-footer d-flex justify-content-start align-items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 2V5" stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 2V5" stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3.5 9.08997H20.5" stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path
                                    d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                    stroke="#999999" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                                <path d="M15.6947 13.7H15.7037" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M15.6947 16.7H15.7037" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M11.9955 13.7H12.0045" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M11.9955 16.7H12.0045" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.29431 13.7H8.30329" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.29431 16.7H8.30329" stroke="#999999" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                            <span>{{!empty($news->date_create) ? date('d/m/Y',strtotime($news->date_create)) :  $news->updated_at->format('d/m/Y')}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex d-md-none">
            <div class="owl-carousel owl-theme" id="owl-carousel-news">
                @foreach($listNews as $news)
                    <div class="item position-relative">
                        <div class="item news-item">
                            <img class="w-100 img-news" src="{{Storage::disk('admin')->url($news->thumbnail)}}"
                                 alt="news">
                            <div class="title-news text-two-line">
                                <a class="font-14-mobile" href="{{url('/tin-tuc/'.$news->slug)}}">{!!$news->title!!}</a>
                            </div>
                            <div class="mt-2 item-footer d-flex justify-content-start align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2V5" stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 2V5" stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.5 9.08997H20.5" stroke="#999999" stroke-width="1.5"
                                          stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path
                                        d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                        stroke="#999999" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M15.6947 13.7H15.7037" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M15.6947 16.7H15.7037" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M11.9955 13.7H12.0045" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M11.9955 16.7H12.0045" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M8.29431 13.7H8.30329" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M8.29431 16.7H8.30329" stroke="#999999" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <span class="font-12-mobile">{{!empty($news->date_create) ? date('d/m/Y',strtotime($news->date_create)) :  $news->updated_at->format('d/m/Y')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row pt-3 ">
            <div id="div-pagination-new" class="col-12 d-flex justify-content-center">
                {{$listNews->links('frontend.pagination')}}
            </div>
        </div>
    </section>
    <section class="pt-md-5 pt-3 pb-md-5" id="block-news ">
        <div class="container">
            <div class="row pb-4">
                <div class="col-12 col-md-9 text-center text-md-start">
                    <h2 class="h2 fs-2 font-16-mobile">“Bí kíp” cho những chuyến đi</h2>
                </div>
                <div class="col-12 col-md-3 d-none d-md-flex"></div>
            </div>
            <div class="regular_new">
                @foreach($tips as $tip)
                    <a href="{{url('/tin-tuc/'.$tip->slug)}}">
                        <div class="item-new">
                            <div class="wp-img-new">
                                <img alt="{{$tip->title}}" class="img-new"
                                     src="{{Storage::disk('admin')->url($tip->thumbnail)}}"/>
                            </div>
                            <h3 class="fs-5 show-desktop">{!! Str::limit($tip->title, 60, '...') !!}</h3>
                            <h3 class="fs-5 show-mobile font-14-mobile">{!! Str::limit($tip->title, 42, '...') !!}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
