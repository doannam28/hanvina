@extends('frontend.layouts.app2')
@section('meta')
    <title>{{$post->title}}</title>
    <meta name="description" content="{{$post->meta}}">
    <meta name="keywords" content="{{$post->title}}">
    <meta property="og:title" content="{{$post->title}}">
    <meta property="og:description" content="{{$post->meta}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($post->thumbnail)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer.css?v='.env('VERSION_CSS')) }}">
@endpush
@push('js')
    <script src="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.js') }}"></script>
    <script src="{{ asset('/assets/js/news.js?t='.time()) }}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row pt-5 pb-3 mt-5 mb-5 show-desktop"></div>
        <div class="row pt-5 pb-3 mt-5 mb-5 show-desktop"></div>
        <div class="title mb-5 title-new">
            <h1 class="fs-1 font-18-mobile">{{$post->title}}</h1>
        </div>
        <div id="content-new" class="content fs-6 text-align-justify font-12-mobile">
            {!! $post->content !!}
        </div>

    </div>
    <section class="pt-md-5 pt-3 pb-md-5" id="block-news ">
        <div class="container">
            <div class="row pb-4">
                <div class="col-12 col-md-9 text-center text-md-start">
                    <h2 class="h2 fs-2 font-16-mobile">Bài viết liên quan</h2>
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
