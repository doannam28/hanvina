@extends('frontend.layouts.app')
@section('meta')
    <?php $setting = Utility::setting();?>
    <title>{{$setting->site_title}}</title>
    <meta name="description" content="{{$setting->meta_description}}">
    <meta property="og:title" content="{{$setting->site_title}}">
    <meta name="keywords" content="{{$setting->site_title}}">
    <meta property="og:description" content="{{$setting->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
@endsection
@section('content')
    <div id="wrapper-video">
        <video autoplay muted loop playsinline id="myVideo" class="d-none d-md-block myVideo">
            @if(isset($content['banner']))
                <source src="{{Storage::disk('admin')->url($content['banner']['video'])}}" type="video/mp4">
            @endif
        </video>
        <video autoplay muted loop playsinline id="myVideo_mobile" class="d-sm-block d-md-none myVideo">
            @if(isset($content['banner']))
                <source src="{{Storage::disk('admin')->url($content['banner']['video_mobile'])}}" type="video/mp4">
            @endif
        </video>
        <div class="div-welcome"></div>
        <img id="img-welcome" src="/assets/images/welcome.svg" class="show-mobile"/>
        <div id="div-muted"  class="div-muted show-desktop" data="myVideo"></div>
        <div class="div-muted show-mobile" data="myVideo_mobile"></div>
    </div>
    @if(isset($content['map']))
        <section id="block-map">
            <div class="div-bor">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 flex-center">
                            <img class="width-100-percent" alt="map"
                                 src="{{Storage::disk('admin')->url($content['map']['image'])}}">
                        </div>
                        <div class="col-12 col-md-5 flex-center">
                            <div>
                                <h2 class="h2-title title-red-mobile fs-2">{!! $content['map']['title']  !!}</h2>
                                <div class="margin-top-30 div-dev font-18 text-align-justify">{{$content['map']['content']}}</div>
                                <a href="{{url($content['map']['link'])}}">
                                    <button class="btn-hanvina margin-top-20 font-18">
                                        <span class="fs-6">Hiểu hơn về chúng tôi</span>
                                        <p class="bor-img"></p>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(isset($content['counter']))
        <section id="block-tq">
            <div class="container">
                {!! $content['counter']['title'] !!}
            </div>
            <div class="container">
                <div class="col-12 col-md-8 offset-md-2">
                    <div id="wrapper-tq" class="row">
                        @foreach($icons as $icon)
                            <div class="item col-3">
                                <img src="{{Storage::disk('admin')->url($icon['icon'])}}"/>
                                <h3>{{$icon['number']}}</h3>
                                <p>{{$icon['title']}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section id="block-tour">
        <div class="container pb-5 pb-md-0">
            <div class="flex-center">
                <h2 class="text-center title-red-mobile fs-2">Các Tour Du Lịch</h2>
            </div>
            <div class="flex-center "><img class="img-sh" src="/assets/images/sieuhot.png"/></div>
        </div>
        <div class="container margin-top-30 show-desktop">
            <div class="row">
                <div class="col-md-3">
                    @if(isset($tours[0]))
                        @php($tour = $tours[0])
                        <a class="div-tour-item" href="{{url('/chi-tiet-tour/'.$tour->slug)}}">
                            <div class="wp-img-tour">
                            <img alt="{{$tour->name}}" class="img-tour"
                                 src="{{Storage::disk('admin')->url($tour->image)}}"/>
                            </div>
                            <p class="p-date font-14"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                            <div class="title-tour fs-5 ">{{$tour->name}}</div>
                            <p class="p-price fs-5">{{number_format($tour->price)}}đ</p>
                        </a>
                    @endif
                    @if(isset($tours[1]))
                        @php($tour = $tours[1])
                        <a class="div-tour-item margin-top-30" href="{{url('/chi-tiet-tour/'.$tour->slug)}}">
                            <div class="wp-img-tour">
                            <img alt="{{$tour->name}}" class="img-tour"
                                 src="{{Storage::disk('admin')->url($tour->image)}}"/>
                            </div>
                            <p class="p-date font-14"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                            <div class="title-tour fs-5">{{$tour->name}}</div>
                            <p class="p-price fs-5">{{number_format($tour->price)}}đ</p>
                        </a>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row d-flex justify-content-center" >
                        <div class="col-md-10 col-12 d-flex justify-content-center" >
                            @if(isset($tours[2]))
                                @php($tour = $tours[2])
                                <a href="{{url('/chi-tiet-tour/'.$tour->slug)}}" class="div-tour-item">
                                    <p class="p-date font-14"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                                    <h3 class="fs-5 title-tour">{{$tour->name}}</h3>
                                    <p class="p-price fs-5">{{number_format($tour->price)}}đ</p>
                                    <div class="wp-img-tour">
                                    <img alt="{{$tour->name}}" class="img-tour img-tour-big"
                                         src="{{Storage::disk('admin')->url($tour->image)}}"/>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if(isset($tours[3]))
                        @php($tour = $tours[3])
                        <a class="div-tour-item" href="{{url('/chi-tiet-tour/'.$tour->slug)}}">
                            <div class="wp-img-tour">
                                <img alt="{{$tour->name}}" class="img-tour"
                                     src="{{Storage::disk('admin')->url($tour->image)}}"/>
                            </div>
                            <p class="p-date font-14"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                            <div class="title-tour fs-5">{{$tour->name}}</div>
                            <p class="p-price fs-5">{{number_format($tour->price)}}đ</p>
                        </a>
                    @endif
                    @if(isset($tours[4]))
                        @php($tour = $tours[4])
                        <a class="div-tour-item margin-top-30" href="{{url('/chi-tiet-tour/'.$tour->slug)}}">
                            <div class="wp-img-tour">
                            <img alt="{{$tour->name}}" class="img-tour"
                                 src="{{Storage::disk('admin')->url($tour->image)}}"/>
                            </div>
                            <p class="p-date font-14"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                            <div class="title-tour fs-5">{{$tour->name}}</div>
                            <p class="p-price fs-5">{{number_format($tour->price)}}đ</p>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container show-mobile">
            <div class="row">
                <div class="regular_tg slider">
                    @foreach($tours as $tour)
                        <a class="div-tour-item" href="{{url('/chi-tiet-tour/'.$tour->slug)}}">
                            <div class="wp-img-tour">
                                <img class="img-tour" src="{{Storage::disk('admin')->url($tour->image)}}"/>
                            </div>
                            <p class="p-date"><span>{{$tour->days}}N{{$tour->nights}}Đ</span></p>
                            <h3 class="title-tour-mobile font-16-mobile text-two-line">{{$tour->name}}</h3>
                            <p class="p-price">{{number_format($tour->price)}}đ</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="block-client">
        <div class="pt-md-5 pb-md-5 mb-md-3" ></div>
        <div class="container">
            <div class="flex-center">
                <h2 class="h2-title-client fs-2">Khách Hàng Nói Gì Về Chúng Tôi</h2>
            </div>
        </div>
        <div class="container margin-top-30">
            <div class="regular_5 slider row">
                @foreach($customers as  $customer)
                    <div class="item-client">
                        <a href="">
                            <div class="wp-img-client">
                                <?php if(isset($customer->image['image'])) {?>
                                <img alt="{{$customer->name}}" class="img-client"
                                     src="{{Storage::disk('admin')->url($customer->image['image'])}}"/>
                                <?php } ?>
                            </div>
                            <h3 class="h3-client fs-4 text-one-line">{{$customer->name}}</h3>
                            <div class="div-des-client">
                                <div class="div-dau">
                                    <p>&nbsp;</p>
                                </div>
                                <p class="p-des fs-6 text-align-justify text-six-line">{{$customer->content}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="margin-top-50">
            <div class="flex-center">
                <p class="p-title-g fs-4 font-16-mobile">Ghé thăm chúng tôi trên:</p>
            </div>
            <div class="flex-center">
                <div id="div-social">
                    @foreach($content['social_links'] ?? [] as $social_link)
                        <a href="{{$social_link['link']}}">
                            <div class="item-social flex-center">
                                <img alt="{{$social_link['title']}}"
                                     src="{{asset($social_icons[$social_link['type']])}}"/>
                                <p>{{$social_link['title']}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="block-news">
        <div class="container flex-center mb-4 mb-md-5 mt-2 mt-md-0">
            <h3 class="h3-title-new margin-top-30 title-red-mobile fs-2 text-center">Cẩm Nang Du Lịch Cùng HanVina</h3>
        </div>
        <div class="container">
            <div class="regular_new">
                @foreach($posts as $post)
                    <a href="{{url('tin-tuc/'.$post->slug)}}">
                        <div class="item-new">
                            <div class="wp-img-new" >
                                <img class="img-new" src="{{Storage::disk('admin')->url($post->thumbnail)}}"/>
                            </div>
                            <h3 class="fs-5 font-16-mobile text-two-line">{!! $post->title !!}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@stop
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var numberItem = screen.width >= 768 ? 2 : 1;
            $(".regular_5").slick({
                dots: false,
                infinite: true,
                autoplay: true,
                slidesToShow: numberItem,
                slidesToScroll: 1
            });
            var numberItemNew = screen.width >= 768 ? (screen.width < 821 ? 2.1 :3.1) : 1;
            $(".regular_new").slick({
                dots: screen.width < 768,
                infinite: true,
                autoplay: true,
                slidesToShow: numberItemNew,
                slidesToScroll: 1
            });
            if (screen.width < 768) {
                $(".regular_tg").slick({
                    dots: true,
                    infinite: true,
                    autoplay: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }else if (screen.width >= 768 && screen.width < 821) {
                $(".regular_tg").slick({
                    dots: true,
                    infinite: true,
                    autoplay: true,
                    slidesToShow: 2,
                    slidesToScroll: 1
                });
            }
        });
    </script>
@endpush

