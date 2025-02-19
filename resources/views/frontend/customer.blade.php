@extends('frontend.layouts.app2')
@section('meta')
    <title>Khách Hàng Nói Gì Về HanVina Travel?</title>
    <meta name="description" content="Khách Hàng Nói Gì Về HanVina Travel?">
    <meta name="keywords" content="Khách Hàng Nói Gì Về HanVina Travel?">
    <meta property="og:title" content="Khách Hàng Nói Gì Về HanVina Travel?">
    <meta property="og:description" content="Khách Hàng Nói Gì Về HanVina Travel?">
    <meta property="og:type" content="article">
    <?php $setting = Utility::setting();?>
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/libraries/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer.css?v='.env('VERSION_CSS')) }}">
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('.btn-more').click(function () {
                let page = $(this).data('page');
                page = page + 1
                $.ajax({
                    url: '{{route('customer.loadMore')}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        page: page
                    },
                    success: function (response) {
                        $('#customer-list').append(response.html);
                        if (response.hasNext) {
                            $('.btn-more').data('page', page + 1);
                        } else {
                            $('.btn-more').remove();
                        }
                    }
                });
            });
            const viewer = new bootstrap.Modal('#image-viewer', {})
            const carousel = new bootstrap.Carousel('#imageviewerbody', {
                interval: 2000,
                touch: false
            })



            $(document).on('click', '.image-customer', function () {
                const id = $(this).data('client-id');
                $.ajax({
                    url: '{{route('customer.detail')}}',
                    data: {
                        id: id
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('#carousel-inner').html(response.html);
                        $('#image-avatar').attr('src', response.avatar);
                        $('#client-name').text(response.name);
                        $('.counter').text('1/' + response.total);
                        //reset carousel
                        carousel.to(0);
                        setTimeout(() => {
                            const height = $('#imageviewerbody').height();
                            $('.carousel-item img').each(function (item) {
                                $(this).css('height', height + 'px')
                            })
                        }, 500);
                    }
                });

                //next
                $('#imageviewerbody').on('click', '.carousel-control-next', function () {
                    carousel.next();
                })
                //prev
                $('#imageviewerbody').on('click', '.carousel-control-prev', function () {
                    carousel.prev();
                })

                //get index
                $('#imageviewerbody').on('slid.bs.carousel', function () {
                    const index = $('.carousel-item.active').index() + 1;
                    const total = $('.carousel-item').length;
                    $('.counter').text(index + '/' + total);
                })
                viewer.show();
            })
            //carousel-inner height
        });
    </script>
@endpush
@section('content')
    <div class="customer-list">
        <div class="container ">
            <div class="row pt-5 pb-3 mt-5 mb-5 d-none d-md-block d-block d-md-none d-lg-block "></div>
            <div class="row pt-5 pb-3 mt-1 mb-1"></div>
            <section>
                <div class="modal fade" id="image-viewer" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="row pt-4 pb-3 pt-md-5 pb-md-4 ms-3 me-2 ms-md-4 me-md-4">
                                <div class="col-10">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="/assets/images/img-avatar.png" alt="avatar" id="image-avatar">
                                        <h5 class="modal-title ps-3" id="client-name">Youtuber Thắng Cuội</h5>
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-end">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row ms-2 me-2 ms-md-4 me-md-4 mb-md-5 mb-4">
                                <div class="col-12 h-100 position-relative d-flex justify-content-center ">
                                    <div class="position-absolute counter-image d-none d-md-flex" style="z-index: 1000">
                                        <span class="counter">1/4</span>
                                    </div>
                                    <div class="modal-body pt-0 pb-0 image-slide" id="imageviewerbody">
                                        <div id="carousel-image-viewer" class="carousel slide w-100 h-100"
                                             data-bs-ride="carousel">
                                            <div class="carousel-inner" id="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class=" d-flex justify-content-center align-items-center ">
                                                        <img src="/assets/images/img-client-1.png" class="d-block w-75"
                                                             alt="...">
                                                    </div>
                                                </div>
                                                <div class="carousel-item active">
                                                    <div class=" d-flex justify-content-center align-items-center ">
                                                        <img src="/assets/images/img-client-1.png" class="d-block w-75"
                                                             alt="...">
                                                    </div>
                                                </div>
                                                <div class="carousel-item active">
                                                    <div class=" d-flex justify-content-center align-items-center ">
                                                        <img src="/assets/images/img-client-1.png" class="d-block w-75"
                                                             alt="...">
                                                    </div>
                                                </div>

                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#imageviewerbody" data-bs-slide="prev">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20 3.33329C10.7952 3.33329 3.33329 10.7952 3.33329 20C3.33329 29.2047 10.7952 36.6666 20 36.6666C29.2047 36.6666 36.6666 29.2047 36.6666 20C36.6666 10.7952 29.2047 3.33329 20 3.33329Z"
                                                        fill="#BB2C26" stroke="#BB2C26" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M25.8334 20H15.8334" stroke="white" stroke-width="1.5"
                                                          stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M19.1666 15L14.1666 20L19.1666 25" stroke="white"
                                                          stroke-width="1.5" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                    data-bs-target="#imageviewerbody" data-bs-slide="next">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20 36.6667C29.2048 36.6667 36.6667 29.2048 36.6667 20C36.6667 10.7953 29.2048 3.33337 20 3.33337C10.7953 3.33337 3.33337 10.7953 3.33337 20C3.33337 29.2048 10.7953 36.6667 20 36.6667Z"
                                                        fill="#BB2C26" stroke="#BB2C26" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M14.1666 20H24.1666" stroke="white" stroke-width="1.5"
                                                          stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M20.8334 25L25.8334 20L20.8334 15" stroke="white"
                                                          stroke-width="1.5" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="thumbnail-container d-flex justify-content-center align-items-center">
                            @foreach($topCustomers as $topCustomer)
                                <div class="spotlight-img-wrapper position-relative">
                                    <img class="position-absolute spotlight-img"
                                         src="{{Storage::disk('admin')->url($topCustomer->avatar)}}" alt="Image 1">
                                </div>
                            @endforeach
                            <div class="spotlight-img-wrapper position-relative ">
                                <div class="spotlight-img d-flex justify-content-center align-items-center bg-red font-10-mobile">
                                    +50,000
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Text -->
                <div class="row customer-feedback">
                    <div class="col-12 d-flex justify-content-center align-items-center mt-1">
                        <h2>
                            <p class="normal p-0 mt-md-5 mt-3 mb-0 text-center p-title-mobile fs-1">Khách Hàng Nói Gì Về</p>
                            <p class="highlight m-0 text-center p-title-mobile fs-1">HanVina Travel?</p>
                        </h2>
                    </div>
                </div>
            </section>
            <section lass="mt-0 mt-md-0  mt-lg-5 ">
                <div id="customer-list" class="row customer-list">
                    @include('frontend.customer_item', ['customers' => $customers])
                </div>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <button class="btn btn-default btn-more" data-page="1">Xem thêm</button>
                    </div>
                </div>
            </section>
            <div class="pt-5 pb-5 mt-md-3"></div>
        </div>
    </div>
@endsection
