<?php
foreach ($tours as $row) {
?>
<div class="col-6 col-xxl-4">
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
            <div class="display-flex-desk row">
                <div class="col-12 col-lg-7 pr-lg-0">
                    <p class="p-fly ">Xuất phát: {!! $row->location_start !!} </p>
                </div>
                <div class=" col-12 col-lg-5 pl-lg-0 ">
                    <p class="p-day ms-0">{{$row->days}}N{{$row->nights}}Đ</p>
                </div>
            </div>
            <div class="display-flex-desk justify-content-between d-flex row">
                <div class="tour-price col-lg-5  pl-0 d-flex  align-items-center">
                    <div>
                        @if(isset($row->price_old) && $row->price_old > 0)
                            <p class="price-old">{{number_format($row->price_old)}}đ</p>
                        @else
                            <p class="price-old d-none d-lg-none" style="text-decoration: none">&nbsp;</p>
                        @endif
                        <p class="price-new">{{number_format($row->price)}}đ</p>
                    </div>
                </div>
                <div class="col-lg-7 mt-1 mt-lg-0 pr-0">
                    <a href="/chi-tiet-tour/{{$row->slug}}" class="float-lg-end" title="{!! $row->name !!}" >
                        <div class="div-btn ml-0">
                            <span>Khám phá</span>
                            <p class="bor-img"></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
