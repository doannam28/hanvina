@extends('frontend.layouts.app')
@section('meta')
    <title>Liên hệ</title>
    <meta name="description" content="Liên hệ | HanVina Travel">
    <meta name="keywords" content="Liên hệ | HanVina Travel">
    <meta property="og:title" content="Liên hệ">
    <meta property="og:description" content="Liên hệ">
    <meta property="og:type" content="article">
    <?php $setting = Utility::setting();?>
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}" />
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css?v='.env('VERSION_CSS')) }}">
@endpush
@section('content')
    <section class="header-image">
        <div class="w-100 ">
            <img alt="banner" class="hero-image" src="{{asset('/assets/images/header-about.png')}}">
        </div>
    </section>
    <section class="pt-120"></section>
    <section class="container bg-contact">
        <div class="row">
            <div class="col-md-7">
                <h1 class="h1 fs-2 font-20-mobile">{{$data['title'] ?? ''}}</h1>
                <h2 class="fs-4 font-12-mobile">{{$data['content'] ?? ''}}</h2>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{url('/send')}}" enctype="multipart/form-data" method="post" class="form-contact">
                    @csrf
                    <div class="form-group pt-2 ">
                        <input type="text" placeholder="Họ tên" class="form-control input-sec border-sec" id="name"
                               name="name" required>
                        @if($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group pt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" placeholder="Số điện thoại" class="form-control input-sec border-sec"
                                       id="phone" name="phone" required>
                                @if($errors->has('phone'))
                                    <span class="help-block">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 pt-2 pt-md-0">
                                <input type="text" placeholder="Email" class="form-control input-sec border-sec"
                                       id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <textarea name="messages" id="messages" class="form-control textarea-sec border-sec"
                                  placeholder="Để lại lời nhắn" required></textarea>
                        @if($errors->has('messages'))
                            <span class="help-block">{{ $errors->first('messages') }}</span>
                        @endif
                    </div>
                    <div class="form-group pt-2 margin-top-15">
                        <div class="row" >
                            <div class="mt-md-12 d-md-flex align-items-center">
                                <button type="button" class="btn btn-default p-0 position-relative">
                                    <input type="file"
                                           style="opacity: 0; width: 100%; height: 100%; top: 0; left: 0; position: absolute; z-index: 10000"
                                           id="image" name="image" accept="image/*">
                                    <img class="select-file" src="{{asset('/assets/images/btn-file.png')}}" alt="file">
                                </button>
                                <div class="d-flex text-help font-12-mobile" >Hỗ trợ định dạng: *.jpeg, *.jpg, *.png</div>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('image'))
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                    <div class="form-group pt-2 margin-top-15">
                        <div class="row">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn-primary-secondary">Gửi ngay</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 mt-5 mt-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                @if(isset($data['image']))
                    <img src="{{Storage::disk('admin')->url($data['image'])}}" alt="contact"
                         class="img-fluid img-contact">
                @endif
            </div>
        </div>

    </section>
    <section class="pt-120"></section>
@endsection

