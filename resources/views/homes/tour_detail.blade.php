@extends('frontend.layouts.app')
@section('meta')
    <title>{!! isset($tour['name'])?$tour['name']:"" !!}</title>
    <meta name="description" content="{!! isset($content['description'])?$content['description']:"" !!}">
    <meta property="og:title" content="{!! isset($content['title'])?$content['title']:"" !!}">
    <meta name="keywords" content="{!! isset($content['title'])?$content['title']:"" !!}">
    <meta property="og:description" content="{!! isset($content['description'])?$content['description']:"" !!}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($tour->image)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tours.css?t='.env('VERSION_CSS'))}}">
@endpush
@section('content')
    <p class="p-icon-booking show-desktop" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></p>
    <p id="p-icon-booking" class="p-icon-booking show-mobile" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></p>
    <section id="block-slide-detail-tour">
        @if(isset($tour->images) && !empty($tour->images))
            <div id="wrapper-slider" class="position-relative">
                <div class="w-100 h-100 position-relative top-0 left-0 z-1">
                    <div class="owl-carousel w-100 h-100 " id="owl-carousel-tour-detail">
                        <?php
                        $count = 0;
                        foreach ($tour->images as $k=>$v){
                        $img = isset($v["image"]) ? $v["image"] : "";
                        ?>
                        <div class="item item1 item-owl">
                            <div class="w-100 h-100">
                                <img class="z-1" src="{{config('app.DOMAIN_IMG').Utility::thumb($img,1920,930)}}"/>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <section id="block-date-tour">
        <div class="container">
            <div class="flex-center">
                <h1 class="h2-detail-tour fs-2 font-18-mobile">{{$tour->name}}</h1>
            </div>
        </div>
        <div class="container">
            <input id="max_number_day" value="{{$tour->days}}" type="hidden"/>
            <input id="number_day" value="1" type="hidden"/>
            <div class="regular_day owl-carousel owl-theme">
            <?php for($i = 1; $i <= $tour->days;$i++) {
                $backgroundLeft = $i == 1 ? "no-background" : "";
                $classSelected = $i == 1 ? "slick-selected" : "";
                $backgroundRight = $i == $tour->days ? "no-background" : "";
                ?>
                <div class="item-day item item-day{{$i}} {{$classSelected}}" data="{{$i}}">
                    <div class="display-flex justify-content-center">
                        <div class="div-line-fly"></div>
                    </div>
                    <div class="display-flex justify-content-center align-items-center">
                        <div class="div-dot-g {{$backgroundLeft}}"></div>
                        <div class="div-line-dot"></div>
                        <div class="div-dot-g {{$backgroundRight}}"></div>
                    </div>
                    <div class="div-day">
                        <div class="display-flex justify-content-center">
                            <span class="day-item">NGÀY {{$i}}</span>
                        </div>
                        <?php
                        if(isset($routes[$i])) foreach($routes[$i] as $k=>$row) {
                        ?>
                        <?php if ($k > 0) echo '<div class="day-city-line"></div>'?>
                        <div class="display-flex justify-content-center">
                            <span class="day-city">{{$row->name}}</span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    @if(isset($tour->experience_video) && $tour->experience_video!="")
        @php
            $link = $tour->experience_video;
            if(str_contains($link,"watch?v=")){
                $link = explode("watch?v=",$link);
                $link = isset($link[1])?explode("&",$link[1]):[];
                $link = "https://www.youtube.com/embed/".$link[0];
            }else if(str_contains($link,"/youtu.be/")){
                $link = explode("/youtu.be/",$link);
                $link = isset($link[1])?explode("?",$link[1]):[];
                $link = "https://www.youtube.com/embed/".$link[0];
            }
        @endphp
        @if($link!="")
            <section id="block-video">
                <div class="container">
                    <h3 class="h3-title-detail-tour text-center fs-2 font-20-mobile">TRẢI NGHIỆM THỰC TẾ CỦA NHÀ HANVINA</h3>
                    <iframe id="iframe-yt" width="100%" src="{{$link}}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </section>
        @endif
    @endif
    <section id="date-for-tour">
        <div class="container">
            <h3 class="h3-title-detail-tour text-center fs-2 margin-top-30 font-20-mobile">LỊCH TRÌNH TOUR</h3>
            <?php for($i = 1; $i <= $tour->days; $i++) {
            $class = $i == 1 ? 'div-bor-date-active div-bor-default' : "";
            ?>
            <div class="div-bor-date div-bor-date{{$i}} {{$class}}">
                <div class="div-mt hover-pointer z-3 " data="{{$i}}"></div>
                <div class="row">
                    <div class="col-12 col-md-4 div-txt-tab" data="{{$i}}">
                        <h2 class="h2-title-day fs-3 font-16-mobile">NGÀY {{$i}}</h2>
                        <div class="div-des-tour h-100">
                            @if(isset($routes[$i]))
                                <h3>{{$routes[$i][0]->name}}{{(count($routes[$i])-1 > 0) ? " - ".$routes[$i][count($routes[$i])-1]->name : ""}}</h3>
                            @endif
                                <div class="show-desktop text-align-justify">{!! (isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->description : "") !!}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="div-tab">
                            <div class="div-wraper-right show-desktop">
                                <div class="display-flex-desk slick-list">
                                    <div class="title-tab title-tab-active" data="1">
                                        <p class="span-locale"></p>
                                        Nổi bật
                                    </div>
                                   {{-- <div class="title-tab" data="2">
                                        <p class="span-fly"></p>
                                        Phương tiện
                                    </div>
                                    <div class="title-tab" data="3">
                                        <p class="span-food"></p>
                                        Ẩm thực
                                    </div>
                                    <div class="title-tab" data="4">
                                        <p class="span-address"></p>
                                        Lưu trú
                                    </div>--}}
                                </div>
                            </div>
                            <div class="display-flex-desk div-wraper-right show-mobile regular_title_tab regular_title_tab">
                                <div class="title-tab title-tab-active item" data="1">
                                    <div class="display-flex">
                                        <p class="span-locale"></p>
                                        <div>Nổi bật</div>
                                    </div>
                                </div>
                               {{-- <div class="title-tab item" data="2">
                                    <div class="display-flex">
                                        <p class="span-fly"></p>
                                        <div>Phương tiện</div>
                                    </div>
                                </div>
                                <div class="title-tab item" data="3">
                                    <div class="display-flex">
                                        <p class="span-food"></p>
                                        <div>Ẩm thực</div>
                                    </div>
                                </div>
                                <div class="title-tab item" data="4">
                                    <div class="display-flex">
                                        <p class="span-address"></p>
                                        <div>Lưu trú</div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="div-content-tab div-content-tab1">
                            <div class="regular_tab1 regular_tab">
                                @if(isset($detailFeatures[$i][0]->images))
                                    @foreach($detailFeatures[$i][0]->images as $k=>$v)
                                        <div class="item">
                                            <img alt="{{$tour->name}}" title="{{$tour->name}}"
                                                 src="{{config('app.DOMAIN_IMG').Utility::thumb($v["url"],420,315)}}"/>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div
                                class="div-text font-14-mobile text-align-justify">{!! (isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->note : "") !!}</div>
                            <div class="show-mobile margin-top-20 des-tour-mobile text-align-justify">{!! (isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->description : "") !!}</div>
                        </div>
                       {{-- <div class="div-content-tab div-content-tab2">
                            <div class="regular_tab2 regular_tab">
                                @if(isset($detailVehicles[$i][0]->images))
                                    @foreach($detailVehicles[$i][0]->images as $k=>$v)
                                        <div class="item">
                                            <img alt="{{$tour->name}}" title="{{$tour->name}}"
                                                 src="{{config('app.DOMAIN_IMG').Utility::thumb($v["url"],420,315)}}"/>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div
                                class="div-text font-14-mobile">{!! isset($detailVehicles[$i]) ? $detailVehicles[$i][0]?->note : "" !!}</div>
                            <div class="show-mobile margin-top-20 des-tour-mobile">{!! isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->description : "" !!}</div>
                        </div>
                        <div class="div-content-tab div-content-tab3">
                            <div class="regular_tab3 regular_tab">
                                @if(isset($detailFoods[$i][0]->images))
                                    @foreach($detailFoods[$i][0]->images as $k=>$v)
                                        <div class="item">
                                            <img alt="{{$tour->name}}" title="{{$tour->name}}"
                                                 src="{{config('app.DOMAIN_IMG').Utility::thumb($v["url"],420,315)}}"/>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div
                                class="div-text font-14-mobile">{!! isset($detailFoods[$i]) ? $detailFoods[$i][0]?->note : "" !!}</div>
                            <div class="show-mobile margin-top-20 des-tour-mobile">{!! isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->description : "" !!}</div>
                        </div>
                        <div class="div-content-tab div-content-tab4">
                            <div class="regular_tab4 regular_tab">
                                @if(isset($detailHotels[$i][0]->images))
                                    @foreach($detailHotels[$i][0]->images as $k=>$v)
                                        <div class="item">
                                            <img alt="{{$tour->name}}" title="{{$tour->name}}"
                                                 src="{{config('app.DOMAIN_IMG').Utility::thumb($v["url"],420,315)}}"/>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div
                                class="div-text font-14-mobile">{!! isset($detailHotels[$i]) ? $detailHotels[$i][0]?->note : "" !!}</div>
                            <div class="show-mobile margin-top-20 des-tour-mobile">{!! isset($detailFeatures[$i]) ? $detailFeatures[$i][0]?->description : "" !!}</div>
                        </div>--}}
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </section>
    <section id="block-booking">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <h3 class="h3-title-booking fs-2 font-20-mobile">CHI TIẾT TOUR</h3>
                    <h3 id="h3-book" class="h3-small font-16-mobile"><p></p>Thông tin tour</h3>
                    <div class="div-table div-table-info">
                        {!! $tour->info !!}
                    </div>
                    <h3 id="h3-note" class="h3-small margin-top-30 font-16-mobile"><p></p>Ghi chú</h3>
                    <div class="div-table div-table-note">
                        {!! $tour->note !!}
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <h3 class="h3-title-booking fs-2 font-20-mobile">ĐẶT NGAY</h3>
                    <div class="div-booking" id="wrapper-booking">
                        <div class="display-flex justify-content-between">
                            <h3 class="font-24-700 color-black font-16-mobile">Bảng giá</h3>
                        </div>
                        <div class="div-line"></div>
                        <form class="row g-3 needs-validation form-booking" id="form-booking" novalidate>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="price_discount" type="hidden" value="{{ $tour->price_discount }}">
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <div class="mb-3 margin-top-mobile">
                                <label for="exampleFormControlInput1" class="form-label font-12-mobile">Tên của bạn:</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                       placeholder="Nhập họ và tên" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label font-12-mobile">Số điện thoại</label>
                                <input type="tel" name="phone" class="form-control" minlength="10" id="exampleFormControlInput2"
                                       placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="div-line"></div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="number_human" class="form-label font-12-mobile">Số người lớn:</label>
                                    <div class="div-bor-input-date">
                                        <p class="p-sub" form-id="form-booking"></p>
                                        <input type="text" min="0" class="form-control novalidate number_human" name="adult" form-id="form-booking"
                                               value="1">
                                        <p class="p-add" form-id="form-booking"></p>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <label for="exampleFormControlInput4" class="form-label font-12-mobile">Ngày khởi hành:</label>
                                    <select class="form-select select-date" name="date"
                                            aria-label="Default select example" form-id="form-booking">
                                        @php
                                            $price = 0;
                                        @endphp
                                        @foreach($tourPrices as $row)
                                            @php
                                                $days = explode(',',$row->days);
                                            @endphp
                                            @foreach($days as $row1)
                                                <?php
                                                if ($price == 0) $price = $row->price;
                                                ?>
                                                @if(trim($row1)!="")
                                                    <option value="{{$row1}}" data="{{$row->price}}">{{$row1}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="div-line"></div>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p class="font-16-mobile">Giá:</p>
                                <p class="font-18-700 p_price font-16-mobile">{{number_format($price,0,".",".")}}vnđ</p>
                            </div>
                            <?php
                            $price_discount = 0;
                            if(isset($tour->price_discount) && $tour->price_discount > 0) {
                            $price_discount = $tour->price_discount;
                            ?>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p class="font-16-mobile">Ưu đãi:</p>
                                <p class="p-i font-16-mobile">-{{number_format($tour->price_discount,0,".",".")}}
                                    vnđ</p>
                            </div>
                            <?php } ?>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p class="font-16-mobile">Tổng:</p>
                                <p class="p-b p_price_total font-16-mobile">{{number_format($price-$price_discount,0,".",".")}}vnđ</p>
                            </div>
                            <p class="p-label-booking font-12-mobile">Liên hệ để được tư vấn và báo giá chi tiết </p>
                            <div class="div-line"></div>
                            <button type="submit" class="btn-booking font-14-mobile" data-id="form-booking">ĐẶT TOUR VÀ TƯ VẤN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="div-booking">
                            <div class="display-flex justify-content-between">
                                <h3 class="font-24-700 color-black">Bảng giá</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <form class="row g-3 needs-validation form-booking" id="form-booking-modal" novalidate>
                            <input id="_token_booking" type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <div class="mb-3 margin-top-mobile">
                                <label for="exampleFormControlInput1" class="form-label">Tên của bạn:</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                       placeholder="Nhập họ và tên" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Số điện thoại</label>
                                <input type="tel" name="phone" class="form-control" minlength="10" id="exampleFormControlInput2"
                                       placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="div-line"></div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="number_human" class="form-label">Số người lớn:</label>
                                    <div class="div-bor-input-date">
                                        <p class="p-sub" form-id="form-booking-modal"></p>
                                        <input type="text" min="0" class="form-control novalidate number_human" name="adult"
                                               value="1" form-id="form-booking-modal">
                                        <p class="p-add" form-id="form-booking-modal"></p>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <label for="exampleFormControlInput4" class="form-label">Ngày khởi hành:</label>
                                    <select class="form-select select-date" name="date"
                                            aria-label="Default select example" form-id="form-booking-modal">
                                        @php
                                            $price = 0;
                                        @endphp
                                        @foreach($tourPrices as $row)
                                            @php
                                                $days = explode(',',$row->days);
                                            @endphp
                                            @foreach($days as $row1)
                                                <?php
                                                if ($price == 0) $price = $row->price;
                                                ?>
                                                @if(trim($row1)!="")
                                                    <option value="{{$row1}}" data="{{$row->price}}">{{$row1}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="div-line"></div>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p>Giá:</p>
                                <p class="font-18-700 p_price">{{number_format($price,0,".",".")}}vnđ</p>
                            </div>
                            <?php
                            $price_discount = 0;
                            if(isset($tour->price_discount) && $tour->price_discount > 0) {
                            $price_discount = $tour->price_discount;
                            ?>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p>Ưu đãi:</p>
                                <p class="p-i">-{{number_format($tour->price_discount,0,".",".")}}
                                    vnđ</p>
                            </div>
                            <?php } ?>
                            <div class="display-flex justify-content-between div-price-bk">
                                <p>Tổng:</p>
                                <p class="p-b p_price_total">{{number_format($price-$price_discount,0,".",".")}}vnđ</p>
                            </div>
                            <p class="p-label-booking">Liên hệ để được tư vấn và báo giá chi tiết </p>
                            <div class="div-line"></div>
                            <button type="submit" class="btn-booking" data-id="form-booking-modal">ĐẶT TOUR VÀ TƯ VẤN</button>
                        </form>
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
                        <a href="/chi-tiet-tour/{{$row->slug}}" title="{{$row->name}}" alt="{{$row->name}}">
                            <div class="wp-img-tour">
                                 <img src="{{config('app.DOMAIN_IMG').Utility::thumb($row->image,420,280)}}"
                             alt={!! $row->name !!} class="img-item-tour"/>
                            </div>
                        </a>
                        <div class="tour-des">
                           <a href="/chi-tiet-tour/{{$row->slug}}" title="{{$row->name}}" alt="{{$row->name}}">
                               <h3 class="title-tour text-two-line">{!! $row->name !!}</h3>
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
                                    <div class="div-btn-nb">
                                        Khám phá
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="show-mobile">
                <div class="regular_tour_mobile">
                    <?php
                    foreach ($hotTours as $k=>$row) {
                    ?>
                    <div class="col-6 col-xl-4">
                        <div class="tour-item">
                            <a href="/chi-tiet-tour/{{$row->slug}}" alt="{{$row->name}}" title="{{$row->name}}">
                                <div class="wp-img-tour">
                                    <img src="{{config('app.DOMAIN_IMG').Utility::thumb($row->image,310,280)}}" alt="{!! $row->name !!}" class="img-item-tour"/>
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
                                <div class="display-flex-desk justify-content-between display-flex-ipad">
                                    <div class="tour-price">
                                        @if(isset($row->price_old) && $row->price_old > 0)
                                            <p class="price-old">{{number_format($row->price_old)}}đ</p>
                                        @endif
                                        <p class="price-new">{{number_format($row->price)}}đ</p>
                                    </div>
                                    <a href="/chi-tiet-tour/{{$row->slug}}" title="{!! $row->name !!}" alt="{!! $row->name !!}">
                                        <div class="div-btn">
                                            <span>Khám phá</span>
                                            <p class="bor-img"></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script src="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.js') }}"></script>
    <script src="/assets/js/tours.js"></script>
    <script type="text/javascript">
        @php
        $days1 = 6;
        $days2 = 5;
        $days3 = 4;
        if ($tour->days < 6){
            $days1 = $tour->days;
        }
        if ($tour->days < 5){
            $days2 = $tour->days;
        }
        if ($tour->days < 4){
            $days3 = $tour->days;
        }

        @endphp
        $(document).ready(function () {
            const owl2 =  $('#owl-carousel-tour-detail').owlCarousel({
                smartSpeed: 1000, // Tốc độ chuyển đổi (tính bằng miligiây)
                autoplayTimeout: 3000,
                animateOut: 'fadeOut', // Hiệu ứng khi chuyển ra
                animateIn: 'fadeIn', // Hiệu ứng khi chuyển vào
                loop: true,
                margin: 0,
                responsiveClass: true,
                dots: true,
                autoplay: true,
                items:1
            });

            $("#owl-carousel-tour-detail .item").on('mouseover', function() {
                owl2.trigger('stop.owl.autoplay');
            });

            $("#owl-carousel-tour-detail .item").on('mouseleave', function() {
                owl2.trigger('play.owl.autoplay', [3000]);
            });
            $(".regular_tour_mobile").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: screen.width >= 744 ? 2.1 : 1.3,
                slidesToScroll: 1
            });
            if(screen.width < 768){
                $(".regular_title_tab").slick({
                    infinite: false,
                    autoplay: false,
                    slidesToShow: 2.6,
                    slidesToScroll: 1
                });
            }
            $(".regular_new").slick({
                dots: screen.width < 768,
                infinite: false,
                autoplay: true,
                slidesToShow: screen.width >= 768 ? 3.1 : 1,
                slidesToScroll: 1
            });
            $('.regular_day').owlCarousel({
                nav: true,
                loop: false,
                margin: 10,
                responsiveClass: true,
                dots: false,
                autoplay: false,
                responsive: {
                    0: {
                        items: 3,
                        nav: true,
                        loop: false,
                        dots: false,
                    },
                    600: {
                        items: "{{$days3}}",
                        nav: true,
                        loop: false,
                        dots: false,
                    },
                    1200: {
                        items: "{{$days2}}",
                        nav: true,
                        loop: false,
                        dots: false,
                    },
                    1300: {
                        items: "{{$days1}}",
                        nav: true,
                        loop: false,
                        dots: false,
                    }
                }
            })
            $(".regular_tab1").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: screen.width >= 768 ? 2 : 1,
                slidesToScroll: 1
            });
            $(".regular_tab2").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: screen.width >= 768 ? 2 : 1,
                slidesToScroll: 1
            });
            $(".regular_tab3").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: screen.width >= 768 ? 2 : 1,
                slidesToScroll: 1
            });
            $(".regular_tab4").slick({
                dots: false,
                infinite: false,
                autoplay: false,
                slidesToShow: screen.width >= 768 ? 2 : 1,
                slidesToScroll: 1
            });
        });
    </script>
@endpush

