@extends('frontend.layouts.app')
<?php
$content = isset($page->content) ? $page->content : "";
?>
@section('meta')
    <title>{!! isset($content['title'])?$content['title']:"" !!}</title>
    <meta name="description" content="{!! isset($content['description'])?$content['description']:"" !!}">
    <meta property="og:title" content="{!! isset($content['title'])?$content['title']:"" !!}">
    <meta name="keywords" content="{!! isset($content['title'])?$content['title']:"" !!}">
    <meta property="og:description" content="{!! isset($content['description'])?$content['description']:"" !!}">
    <meta property="og:type" content="article">
    <?php $setting = Utility::setting();?>
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="/assets/css/tours.css?v={{ env('VERSION_CSS') }}"/>
@endpush
@section('content')
    <section>
        <div id="wrapper-slider" class="position-relative">
            <div class="w-100 h-100 position-relative top-0 left-0 z-1">
                <div class="owl-carousel owl-theme " id="owl-carousel-tour">
                    @foreach($slideTours as $row)
                        <?php if(!empty($row->images)) foreach ($row->images as $k=>$v){
                        $img = isset($v["image"]) ? $v["image"] : "";
                        if($img!="") {
                        ?>
                            <div class="item item1">
                                <div class="wp-item w-100 h-100 ">
                                    <img class="z-1 w-100 "
                                         style="object-fit: cover"
                                         src="{{config('app.DOMAIN_IMG').Utility::thumb($img,1920,930)}}"/>
                                </div>
                                <div class="item-slide">
                                    <div>
                                        <div class="d-flex flex-center">
                                            <p class="p-fly">Xuất phát: {!! $row->location_start !!} </p>
                                            <p class="p-day">{{$row->days}}N{{$row->nights}}Đ</p>
                                        </div>
                                        <h3 class="h3-slide text-two-line">{{$row->name}}</h3>
                                        <div class="tour-price d-flex flex-center">
                                            <p class="price-new">{{number_format($row->price)}}đ</p>
                                            @if(isset($row->price_old) && $row->price_old > 0)
                                                <p class="price-old">{{number_format($row->price_old)}}đ</p>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-center">
                                        <a href="/chi-tiet-tour/{{$row->slug}}" title="{!! $row->name !!}"
                                           alt="{!! $row->name !!}">
                                        <div class="div-btn flex-center">
                                                <span>Khám phá</span>
                                                <p class="bor-img"></p>
                                        </div>
                                        </a>
                                        </div>
                                    </div>
                                   </div>
                            </div>
                        <?php } } ?>
                    @endforeach
                </div>
            </div>
          {{-- <div class="w-100  h-100 position-absolute top-0 left-0 d-flex justify-content-center  z-2">
              --}}{{-- <img alt="human" class="w-auto" src="{{ asset('assets/images/human.png')}}"
                    style="object-fit: contain"/>--}}{{--
           </div>
            <div class="w-100 h-100 position-absolute top-0 start-0-0  z-3">
                <div class="owl-carousel w-100 h-100 " id="owl-carousel-tour2">
                    <?php
                        for ($i = 1; $i < 6; $i++){
                            if (isset($content["image" . $i]) && $content["image" . $i] != ""){ ?>
                                <div class="item item2">
                                    <div class="wp-item w-100 h-100 ">
                                        <div class="item-slide">
                                            <h3 class="h3-slide d-flex justify-content-center align-items-center">--}}{{--{{$content["title_image".$i] ?? '' }}--}}{{--</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                    ?>
                </div>
            </div>--}}

        </div>
    </section>
    <section id="block-list-tour">
        <div class="container" id="list-tour">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <form method="get" id="frm-filter">
                        <input type="hidden" id="input_token" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" class="page" name="page"
                               value="{{isset($request['page']) ? $request['page'] : 0}}">
                        <input type="hidden" class="limit" name="limit" value="9">
                        <div class="col-12 d-block d-md-none">
                            <div class="display-flex justify-content-between ">
                                <input type="text" id="inp-search" name="key" placeholder="Tìm kiếm"/>
                                <button type="button" id="btn-filter" data-bs-toggle="offcanvas"
                                        data-bs-target="#div-filter-mobile"></button>
                            </div>
                        </div>
                        <div id="div-filter" class="d-none d-md-block w-100">
                            <div class="position-relative">
                                <div id="div-bor-search">
                                    <button type="button" class="btn-search-filter" data-id-form="frm-filter">Tìm kiếm
                                    </button>
                                    <button type="button" class="btn-clear-filter" data-id-form="frm-filter">Xóa bộ
                                        lọc
                                    </button>
                                </div>
                                <div id="div-bor-filter" class="w-100 div-bor-filter">
                                    <div>
                                        <h3 class="title-filter font-16-mobile">ĐIỂM XUẤT PHÁT</h3>
                                        @foreach($locationStarts as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       {{isset($request['location_start']) && in_array($row->name, $request['location_start']) ? 'checked="checked"' : ""}} name="location_start[]"
                                                       type="checkbox" value="{!! $row->name !!}"
                                                       id="flexCheckDefaultDD{{$k}}" data-id="frm-filter">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefaultDD{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">ĐỊA ĐIỂM</h3>
                                        @foreach($localtions as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       {{isset($request['locations']) && in_array($row->id, $request['locations']) ? 'checked="checked"' : ""}} name="locations[]"
                                                       type="checkbox" value="{!! $row->id !!}"
                                                       id="flexCheckDefault{{$k}}" data-id="frm-filter">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefault{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">CÁC TOUR ĐƯỜNG BỘ</h3>
                                        @foreach($ways as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input" name="ways[]"
                                                       {{isset($request['ways']) && in_array($row->id, $request['ways']) ? 'checked="checked"' : ""}} type="checkbox"
                                                       value="{!! $row->id !!}" id="flexCheckDefaultWay{{$k}}" data-id="frm-filter">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefaultWay{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <?php
                                        $setting = Utility::setting();
                                        $contentSetting = isset($setting->content) ? json_decode($setting->content) : '';
                                        $maxDay = intval($contentSetting->day_max ?? config('admin.max_day_of_tour'));
                                        $maxPrice = intval($contentSetting->price_max ?? config('admin.max_price_of_tour'));
                                        ?>
                                        <h3 class="title-filter font-16-mobile">KHOẢNG GIÁ</h3>
                                        <div>
                                            <p class="p-range"><span>0</span><span>{{number_format($maxPrice,0,'.','.')}}vnđ</span>
                                            </p>
                                            <?php
                                            $style = "";
                                            if (isset($request['price']) && $request['price'] != "") {
                                                $percent = intval($request['price']) / $maxPrice * 100;
                                                $style = 'background: linear-gradient(to right, #BB2C26 0%, #BB2C26 ' . $percent . '%, #E6E6E6 ' . $percent . '%, #E6E6E6 100%)';
                                            }
                                            ?>
                                            <div class="range-wrap">
                                                <input type="range" style="{{$style}}" min=0 max="{{$maxPrice}}"
                                                       name="price"
                                                       value="{{isset($request['price']) ? $request['price'] : 0}}"
                                                       id="max_price"
                                                       name="max_price" class="price-range-field range max_price" data-id="frm-filter"/>
                                                <output class="bubble" data=""></output>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">THỜI GIAN</h3>
                                        <div>
                                            <p class="p-range"><span>0</span><span>{{$maxDay}} ngày</span></p>
                                            <div class="range-wrap">
                                                <?php
                                                $style = "";
                                                if (isset($request['day']) && $request['day'] != "") {
                                                    $percent = intval($request['day']) / $maxDay * 100;
                                                    $style = 'background: linear-gradient(to right, #BB2C26 0%, #BB2C26 ' . $percent . '%, #E6E6E6 ' . $percent . '%, #E6E6E6 100%)';
                                                }
                                                ?>
                                                <input type="range" style="{{$style}}" min=0 max="{{$maxDay}}"
                                                       value="{{isset($request['day']) ? $request['day'] : 0}}"
                                                       name="day" id="max_day"
                                                       class="price-range-field range max_day" data-id="frm-filter"/>
                                                <output class="bubble" data=" ngày"></output>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="get" id="frm-filter-mobile">
                        <input type="hidden" id="input_token" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" class="page" name="page"
                               value="{{isset($request['page']) ? $request['page'] : 0}}">
                        <input type="hidden" id="inp-search-mobile" name="key"
                               value="{{isset($request['key']) ? $request['key'] : ""}}">
                        <input type="hidden" class="limit" name="limit" value="8">
                        <div id="div-filter-mobile" class="offcanvas offcanvas-end d-block d-md-none"
                             data-bs-backdrop="true">
                            <div class="position-relative">
                                <div id="div-bor-search">
                                    <button type="button" class="btn-search-filter" data-id-form="frm-filter-mobile">Tìm
                                        kiếm
                                    </button>
                                    <button type="button" class="btn-clear-filter" data-id-form="frm-filter-mobile">Xóa
                                        bộ lọc
                                    </button>
                                </div>
                                <div id="div-bor-filter" class="div-bor-filter">
                                    <div class="show-mobile">
                                        <div class="display-flex justify-content-between">
                                            <p class="p-title-filter">Bộ lọc</p>
                                            <p id="span-close" data-bs-dismiss="offcanvas" aria-label="Close"></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">ĐIỂM XUẤT PHÁT</h3>
                                        @foreach($locationStarts as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       {{isset($request['location_start']) && in_array($row->name, $request['location_start']) ? 'checked="checked"' : ""}} name="location_start[]"
                                                       type="checkbox" value="{!! $row->name !!}"
                                                       id="flexCheckDefaultDD{{$k}}" data-id="frm-filter-mobile">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefaultDD{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">ĐỊA ĐIỂM</h3>
                                        @foreach($localtions as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       {{isset($request['locations']) && in_array($row->id, $request['locations']) ? 'checked="checked"' : ""}} name="locations[]"
                                                       type="checkbox" value="{!! $row->id !!}"
                                                       id="flexCheckDefault{{$k}}" data-id="frm-filter-mobile">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefault{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">CÁC TOUR ĐƯỜNG BỘ</h3>
                                        @foreach($ways as $k=>$row)
                                            <div class="form-check">
                                                <input class="form-check-input" name="ways[]"
                                                       {{isset($request['ways']) && in_array($row->id, $request['ways']) ? 'checked="checked"' : ""}} type="checkbox"
                                                       value="{!! $row->id !!}" id="flexCheckDefaultWay{{$k}}" data-id="frm-filter-mobile">
                                                <label class="form-check-label font-14-mobile"
                                                       for="flexCheckDefaultWay{{$k}}">
                                                    {!! $row->name !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <?php
                                        $setting = Utility::setting();
                                        $contentSetting = isset($setting->content) ? json_decode($setting->content) : '';
                                        $maxDay = intval($contentSetting->day_max ?? config('admin.max_day_of_tour'));
                                        $maxPrice = intval($contentSetting->price_max ?? config('admin.max_price_of_tour'));
                                        ?>
                                        <h3 class="title-filter font-16-mobile">KHOẢNG GIÁ</h3>
                                        <div>
                                            <p class="p-range"><span>0</span><span>{{number_format($maxPrice,0,'.','.')}}vnđ</span>
                                            </p>
                                            <?php
                                            $style = "";
                                            if (isset($request['price']) && $request['price'] != "") {
                                                $percent = intval($request['price']) / $maxPrice * 100;
                                                $style = 'background: linear-gradient(to right, #BB2C26 0%, #BB2C26 ' . $percent . '%, #E6E6E6 ' . $percent . '%, #E6E6E6 100%)';
                                            }
                                            ?>
                                            <div class="range-wrap">
                                                <input type="range" style="{{$style}}" min=0 max="{{$maxPrice}}"
                                                       name="price"
                                                       value="{{isset($request['price']) ? $request['price'] : 0}}"
                                                       id="max_price_mobile"
                                                       name="max_price" class="price-range-field range max_price" data-id="frm-filter-mobile"/>
                                                <output class="bubble" data=""></output>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-line"></div>
                                    <div>
                                        <h3 class="title-filter font-16-mobile">THỜI GIAN</h3>
                                        <div>
                                            <p class="p-range"><span>0</span><span>{{$maxDay}} ngày</span></p>
                                            <div class="range-wrap range-wrap-time">
                                                <?php
                                                $style = "";
                                                if (isset($request['day']) && $request['day'] != "") {
                                                    $percent = intval($request['day']) / $maxDay * 100;
                                                    $style = 'background: linear-gradient(to right, #BB2C26 0%, #BB2C26 ' . $percent . '%, #E6E6E6 ' . $percent . '%, #E6E6E6 100%)';
                                                }
                                                ?>
                                                <input type="range" style="{{$style}}" min=0 max="{{$maxDay}}"
                                                       value="{{isset($request['day']) ? $request['day'] : 0}}"
                                                       name="day" id="max_day_mobile"
                                                       class="price-range-field range max_day" data-id="frm-filter-mobile"/>
                                                <output class="bubble" data=" ngày"></output>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="row" id="content-tours">
                    </div>
                    <div class="row">
                        <div class="col-12 display-flex justify-content-center" id="div-page">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="block-news">
        <div class="container">
            <h3 class="h3-title-tour margin-top-30 title-red-mobile show-desktop fs-2">Các Tour Nổi Bật</h3>
            <h3 class="h3-title-tour margin-top-30 title-black-mobile show-mobile">Khám phá các Tour nổi bật</h3>
        </div>
        <div class="container">
            <div class="regular_new show-desktop">
                @foreach($hotTours as $row)
                    <div class="tour-item">
                        <a href="/chi-tiet-tour/{{$row->slug}}">
                            <div class="wp-img-tour">
                                <img src="{{config('app.DOMAIN_IMG').Utility::thumb($row->image,420,280)}}"
                                     alt={!! $row->name !!} class="img-item-tour"/>
                            </div>
                        </a>
                        <div class="tour-des">
                            <a href="/chi-tiet-tour/{{$row->slug}}">
                                <h3 class="title-tour">{!! Str::limit($row->name, 35, '...') !!}</h3>
                            </a>
                            <div class="display-flex">
                                <p class="p-fly">Xuất phát: {!! $row->location_start !!} </p>
                                <p class="p-day">{{$row->days}}N{{$row->nights}}Đ</p>
                            </div>
                            <div class="display-flex justify-content-between display-block-ipad">
                                <div class="tour-price tour-price-nb">
                                    @if(isset($row->price_old) && $row->price_old > 0)
                                        <p class="price-old">{{number_format($row->price_old)}}đ</p>
                                    @endif
                                    <p class="price-new">{{number_format($row->price)}}đ</p>
                                </div>
                                <a href="/chi-tiet-tour/{{$row->slug}}" title="{{$row->name}}" alt="{{$row->name}}">
                                    <div class="div-btn">
                                        <span>Khám phá</span>
                                        <p class="bor-img"></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="show-mobile">
                <div class="regular_new_mobile">
                    <?php
                    foreach ($hotTours as $k => $row) {
                        if ($k % 4 == 0) echo '<div class="row row-item-tour-nb">';
                        ?>
                    <div class="col-6 col-md-6 col-xl-4">
                        <div class="tour-item">
                            <a href="/chi-tiet-tour/{{$row->slug}}" alt="{{$row->name}}" title="{{$row->name}}">
                                <div class="wp-img-tour">
                                    <img src="{{config('app.DOMAIN_IMG').Utility::thumb($row->image,310,280)}}"
                                         alt="{!! $row->name !!}" class="img-item-tour"/>
                                </div>
                            </a>
                            <div class="tour-des">
                                <a href="/chi-tiet-tour/{{$row->slug}}" alt="{{$row->name}}" title="{{$row->name}}">
                                    <h3 class="title-tour text-two-line">{!! $row->name !!}</h3>
                                </a>
                                <div class="display-flex-desk">
                                    <p class="p-fly">Xuất phát: {!! $row->location_start !!} </p>
                                    <p class="p-day">{{$row->days}}N{{$row->nights}}Đ</p>
                                </div>
                                <div class="display-flex-desk justify-content-between">
                                    <div class="tour-price">
                                        @if(isset($row->price_old) && $row->price_old > 0)
                                            <p class="price-old">{{number_format($row->price_old)}}đ</p>
                                        @endif
                                        <p class="price-new">{{number_format($row->price)}}đ</p>
                                    </div>
                                    <a href="/chi-tiet-tour/{{$row->slug}}" title="{!! $row->name !!}"
                                       alt="{!! $row->name !!}">
                                        <div class="div-btn">
                                            <span>Khám phá</span>
                                            <p class="bor-img"></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                        if ($k % 4 == 3) echo "</div>";
                    } ?>
                    <?php
                    if (isset($k) && $k % 4 > 0) echo "</div>" ?>
                </div>
            </div>
        </div>
    </section>
    <?php if(isset($setting->is_show_popup) && $setting->is_show_popup == 1) {?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div id="popup-left" style="background: url('{{Storage::disk('admin')->url($setting->image_popup)}}') center center; background-size: cover;">
                    </div>
                    <div id="popup-right">
                        <h4>LIÊN HỆ VỚI CHÚNG TÔI</h4>
                        <p>Chinh phục thế giới – điền form để chúng tôi giúp bạn góp ý tùy chỉnh cho chuyến đi của bạn được trở nên phù hợp nhất</p>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{url('/send')}}" enctype="multipart/form-data" method="post" class="form-contact needs-validation" novalidate>
                            @csrf
                            <div class="form-group pt-2 ">
                                <input type="text" placeholder="Họ tên" class="form-control input-sec border-sec" id="name"
                                       name="name" required id="validationServer03" aria-describedby="validationServer03Feedback">
                                <div class="invalid-tooltip">
                                    Xin vui lòng nhập họ tên
                                </div>
                            </div>
                            <div class="form-group pt-2 ">
                                <input type="text" placeholder="Số điện thoại" class="form-control input-sec border-sec"
                                       id="phone" name="phone" required>
                                <div class="invalid-tooltip">
                                    Xin vui lòng nhập số điện thoại
                                </div>
                            </div>

                            <div class="form-group pt-2 ">
                                <input type="text" placeholder="Email" class="form-control input-sec border-sec"
                                       id="email" name="email">
                            </div>
                            <div class="form-group pt-2">
                            <textarea name="messages" id="messages" class="form-control textarea-sec border-sec"
                                      placeholder="Để lại lời nhắn" required></textarea>
                                <div class="invalid-tooltip">
                                    Xin vui lòng nhập lời nhắn
                                </div>
                            </div>
                            <div class="form-group pt-2 margin-top-15">
                                <div class="row">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="submit" id="btn-submit-popup" class="btn-primary-secondary">Gửi ngay</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Hiển thị modal khi trang tải xong
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        });
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <?php }?>
@stop
@push('js')
    <script src="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.js') }}"></script>
    <script src="{{ asset('/assets/js/tours.js?t='.time()) }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
         /*   const owl1 = $('#owl-carousel-tour').owlCarousel({
                autoplayTimeout: 3000,
                smartSpeed: 1000, // Tốc độ chuyển đổi (tính bằng miligiây)
                //animateOut: 'fadeOut', // Hiệu ứng khi chuyển ra
                //animateIn: 'fadeIn', // Hiệu ứng khi chuyển vào
                loop: true,
                margin: 0,
                responsiveClass: true,
                dots: false,
                autoplay: false,
                touchDrag: false, // Vô hiệu hóa gạt ngang bằng cảm ứng
                mouseDrag: false, // Vô hiệu hóa gạt ngang bằng chuột
                items: 1
            })*/
            const owl2 = $('#owl-carousel-tour').owlCarousel({
                smartSpeed: 1000, // Tốc độ chuyển đổi (tính bằng miligiây)
                autoplayTimeout: 5000,
                //animateOut: 'fadeOut', // Hiệu ứng khi chuyển ra
                //animateIn: 'fadeIn', // Hiệu ứng khi chuyển vào
                loop: true,
                rewind: true, // Kết hợp với loop để mượt hơn
                margin: 0,
                dots: false,
                autoplay: true,
                touchDrag: false, // Vô hiệu hóa gạt ngang bằng cảm ứng
                mouseDrag: false, // Vô hiệu hóa gạt ngang bằng chuột
                items: 1
            })
          /*  //sync owl1 with owl2
            owl2.on('change.owl.carousel', function (event) {
                if (event.namespace && event.property.name === 'position') {
                    let target = event.relatedTarget.relative(event.property.value, true);
                    owl1.owlCarousel('to', target, 1000, true);
                }
            });*/
            // $('#owl-carousel-tour2 .owl-stage').mousemove(function () {
            //     let style = $(this).attr('style');
            //     $('#owl-carousel-tour .owl-stage').attr('style', style);
            // })
            // $('#owl-carousel-tour2 .owl-stage').bind('touchmove', function () {
            //     let style = $(this).attr('style');
            //     $('#owl-carousel-tour .owl-stage').attr('style', style);
            // })
            var numberItemNew = screen.width > 1200 ? 3.1 : (screen.width >= 768 ? 2.2 : 1);
            $(".regular_new").slick({
                dots: screen.width < 768,
                infinite: false,
                autoplay: true,
                slidesToShow: numberItemNew,
                slidesToScroll: 1
            });
            $(".regular_new_mobile").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
        document.getElementById("max_price").oninput = function () {
            var value = (this.value - this.min) / (this.max - this.min) * 100
            this.style.background = 'linear-gradient(to right, #BB2C26 0%, #BB2C26 ' + value + '%, #E6E6E6 ' + value + '%, #E6E6E6 100%)'
        };
        document.getElementById("max_day").oninput = function () {
            var value = (this.value - this.min) / (this.max - this.min) * 100
            this.style.background = 'linear-gradient(to right, #BB2C26 0%, #BB2C26 ' + value + '%, #E6E6E6 ' + value + '%, #E6E6E6 100%)'
        };
        document.getElementById("max_price_mobile").oninput = function () {
            var value = (this.value - this.min) / (this.max - this.min) * 100
            this.style.background = 'linear-gradient(to right, #BB2C26 0%, #BB2C26 ' + value + '%, #E6E6E6 ' + value + '%, #E6E6E6 100%)'
        };
        document.getElementById("max_day_mobile").oninput = function () {
            var value = (this.value - this.min) / (this.max - this.min) * 100
            this.style.background = 'linear-gradient(to right, #BB2C26 0%, #BB2C26 ' + value + '%, #E6E6E6 ' + value + '%, #E6E6E6 100%)'
        };
        document.getElementById('frm-filter').addEventListener('submit', function(event) {
            event.preventDefault();  // Chặn hành vi gửi form
        });
    </script>
@endpush

