@extends('frontend.layouts.app2')
@section('meta')
    <title>Giới thiệu | HanVina Travel</title>
    <meta name="description" content="Giới thiệu | HanVina Travel">
    <meta property="og:title" content="Giới thiệu | HanVina Travel">
    <meta name="keywords" content="Giới thiệu | HanVina Travel">
    <meta property="og:description" content="Giới thiệu | HanVina Travel">
    <?php $setting = Utility::setting();?>
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
    <meta property="og:type" content="article">
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css?v='.env('VERSION_CSS')) }}">
@endpush
@push('js')
    <script src="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.js') }}"></script>
    <script src="{{ asset('/assets/js/about.js?t='.time()) }}"></script>
@endpush
@section('content')
    <div class=" d-block d-md-none d-lg-block mb-3 mt-5 pb-2 pt-0 pt-md-5 pb-md-5"></div>
    <section id="section-about" class="header-image bg-section1 ">
        <div class=" m-0 p-0 pt-md-5 pb-md-5"></div>
        <div class="container ">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="title text-center text-md-start fs-2">{{$data['header']['title'] ?? ''}}</h2>
                    <h1 class="title text-center text-md-start fs-2">
                        {{$data['header']['sub_title'] ?? ''}}
                    </h1>
                    <p class="text-center fs-6 text-md-start mb-4 txt-des">
                        {{$data['header']['description'] ?? ''}}
                    </p>
                    <a href="{{url('/danh-sach-tour')}}">
                        <button class="btn-hanvina">
                            <span class="fs-6">Khám phá ngay</span>
                            <p class="bor-img"></p>
                        </button>
                    </a>
                </div>
                <div class="col-md-4">
                    <p class="counter-client mt-3 mt-md-0"><b>+ 50.000</b> Đoàn khách du lịch</p>
                    <p class="counter-text fs-6 txt-des">Đã tin tưởng và đồng hành cùng HanVina Travel</p>
                    <ul class="client-list d-flex justify-content-center justify-content-md-start align-items-center p-0 m-0">
                        @foreach($customers as $customer)
                            <li><img class="img" alt="client" src="{{Storage::disk('admin')->url($customer->avatar)}}">
                            </li>
                        @endforeach
                        <li>
                            <div class="img-more"><a href="{{url('/khach-hang')}}">+50.000</a></div>
                        </li>
                    </ul>
                    <ul class="list-icon-section p-0 m-0">
                        <li>
                            <a href="#s_vision">
                                <img alt="Tầm Nhìn"
                                     src="{{asset('/assets/images/img-about-header-1.png')}}">
                                <div class="txt-hover">Tầm Nhìn</div>
                            </a>
                        </li>
                        <li>
                            <a href="#s_mission">
                                <img alt="Sứ Mệnh"
                                     src="{{asset('/assets/images/img-about-header-2.png')}}">
                                <div class="txt-hover">Sứ Mệnh</div>
                            </a>
                        </li>
                        <li>
                            <a href="#s_values">
                                <img alt="Giá Trị Cốt Lõi"
                                     src="{{asset('/assets/images/img-about-header-3.png')}}">
                                <div class="txt-hover">Giá Trị <br>Cốt Lõi</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 pt-4 pt-md-0 ">
                    @if(isset($data['header']['image_1']))
                        <img alt="Hình ảnh" class="header-img-e w-100"
                             src="{{Storage::disk('admin')->url($data['header']['image_1'])}}">
                    @endif
                    @if(isset($data['header']['image_2']))
                        <img alt="Hình ảnh" class="header-img-e w-100"
                             src="{{Storage::disk('admin')->url($data['header']['image_2'])}}">
                    @endif
                </div>
            </div>
            <div class="row mb-2 mt-3 pb-0 pt-0  mb-md-5 mt-md-5 pb-md-5 pb-md-5" id="s_about_us"></div>
            <div class="row d-flex">
                <div class="col-md-6 d-md-flex d-none">
                    @if(isset($data['about_us']['image']))
                        <img alt="{{$data['about_us']['title'] ?? ''}}" class=" w-100 image-about"
                             src="{{Storage::disk('admin')->url($data['about_us']['image'])}}">
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="h-100  d-flex justify-content-center align-items-center">
                        <div class="p-md-5 mt-5 mt-md-0">
                            <h2 class="title2 fs-2">
                                {{ $data['about_us']['title'] ?? '' }}
                            </h2>
                            <p class="fs-6 txt-des" >
                                {{ $data['about_us']['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-md-none d-flex">
                    @if(isset($data['about_us']['image']))
                        <img alt="{{$data['about_us']['title']}}" class=" w-100"
                             src="{{Storage::disk('admin')->url($data['about_us']['image'])}}">
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="content bg-section2" id="s_vision">
        <div class="container">
            <div class="row mb-2 mt-3 pb-0 pt-0  mb-md-5 pb-md-5 pb-md-5"></div>
            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="h-100 d-flex justify-content-center align-items-center">
                        <div class="p-md-5 mt-5 mt-md-0">
                            <h2 class="title2 fs-2">
                                {{ $data['vision']['title'] ?? '' }}
                            </h2>
                            <p class="fs-6 txt-des">
                                {{ $data['vision']['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="d-none d-md-flex">
                        @if(isset($data['vision']['image']))
                            <img alt="{{$data['about_us']['title'] ?? ''}}" class=" w-100 image-about"
                                 src="{{Storage::disk('admin')->url($data['vision']['image'])}}">
                        @endif
                    </div>
                    <div class="d-md-none owl-carousel owl-theme" id="mb-mission">
                        @if(isset($data['vision']['image_mobile_1']))
                            <div class="item w-100">
                                <img alt="{{$data['about_us']['title'] ?? ''}}" class=" w-100"
                                     src="{{config('app.DOMAIN_IMG').Utility::thumb($data['vision']['image_mobile_1'],1000,780)}}">
                            </div>
                        @endif
                        @if(isset($data['vision']['image_mobile_2']))
                            <div class="item  w-100">
                                <img alt="{{$data['about_us']['title'] ?? ''}}" class=" w-100"
                                     src="{{config('app.DOMAIN_IMG').Utility::thumb($data['vision']['image_mobile_2'],1000,780)}}">
                            </div>
                        @endif
                        @if(isset($data['vision']['image_mobile_3']))
                            <div class="item  w-100">
                                <img alt="{{$data['about_us']['title'] ?? ''}}" class=" w-100"
                                     src="{{config('app.DOMAIN_IMG').Utility::thumb($data['vision']['image_mobile_3'],1000,780)}}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-2 mt-5 pb-0 pt-0  mb-md-5 pb-md-5 pb-md-5" id="s_mission"></div>
            <div class="row d-flex">
                <div class="col-md-6 d-none d-md-flex">
                    @if(isset($data['mission']['image']))
                        <div class="item  w-100">
                            <img alt="{{$data['mission']['title'] ?? ''}}" class=" w-100 image-about"
                                 src="{{Storage::disk('admin')->url($data['mission']['image'])}}">
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="h-100 d-flex justify-content-center align-items-center">
                        <div class="p-md-5 mt-5 mt-md-0">
                            <h2 class="title2 fs-2">
                                {{ $data['mission']['title'] ?? ''}}
                            </h2>
                            <p class="fs-6 txt-des">
                                {{ $data['mission']['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex d-md-none">
                    @if(isset($data['mission']['image']))
                        <div class="item  w-100">
                            <img alt="{{$data['mission']['title']}}" class=" w-100"
                                 src="{{Storage::disk('admin')->url($data['mission']['image'])}}">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-5 pt-md-0 pb-md-0 pt-lg-5 pb-lg-5 bg-section3" id="s_values">
        <div class="container">
            <div class="row mb-2 mt-3 pb-0 pt-0  mb-md-5 pb-md-5 pb-md-5"></div>
            <div class="row ">
                <div class="col-12 d-flex justify-content-center">
                    <h2 class="title2 text-center fs-2">GIÁ TRỊ CỐT LÕI</h2>
                </div>
            </div>
            <div class="row mb-2 mt-3 pb-0 pt-0  mb-md-5 pb-md-5 pb-md-5"></div>
            <div class="row d-none d-lg-flex ">
                @foreach($data['values'] ?? [] as $value)
                    <div class="col-md-3 value-card-col item">
                        <div class="w-100 h-100 value-card">
                            <div class="position-relative w-100 d-flex justify-content-center">
                                <div class="head-txt position-absolute fs-4">
                                    {{$value['title']}}
                                </div>
                            </div>
                            <div class="fs-6 text-align-justify value-content">
                                {{$value['content']}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row d-lg-none owl-carousel owl-theme" id="mb-values">
                @foreach($data['values'] ?? [] as $value)
                    <div class="item ps-3 pe-3 item-owl">
                        <div class="w-100 h-100 value-card">
                            <div class="position-relative w-100 d-flex justify-content-center">
                                <div class="head-txt position-absolute fs-5">
                                    {{$value['title']}}
                                </div>
                            </div>
                            <div class="content-value-mb text-align-justify" >
                                {!! strip_tags($value['content']) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row pb-4 pt-5 mt-5 d-flex justify-content-center">
                <div class="col-8 col-md-12  text-center d-flex justify-content-center">
                    <h2 class="title2 text-center fs-2">HANVINA TRAVEL TIN TỨC VÀ SỰ KIỆN</h2>
                </div>
                <div class="col-12 col-md-3 d-none d-md-flex"></div>
            </div>
            <div id="about-regular-new" class="regular_new">
                @foreach($tips as $tip)
                    <a class="item-new-boder1"  href="{{url('/tin-tuc/'.$tip->slug)}}">
                        <div class="item-new">
                            <div class="wp-img-new">
                                <img alt="{{$tip->title}}" class="img-new"
                                     src="{{Storage::disk('admin')->url($tip->thumbnail)}}"/>
                            </div>
                            <div class="date pt-4">{{!empty($tip->date_create) ? date('d/m/Y',strtotime($tip->date_create)) :  $tip->updated_at->format('d/m/Y')}}</div>
                            <h3 class="title-news fs-5 text-two-line">{!!$tip->title!!}</h3>
                            <div class="content-news fs-6 text-three-line">{!! \Illuminate\Support\Str::limit(strip_tags($tip->content) , 200) !!}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
