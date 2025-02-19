<?php $setting = Utility::setting();?>
<div id="wrapper-menu" data-no-change="1">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-red">
        <div class="container-xl container-xxl" id="div-menu">
            <div class="bor-menu-top">
                <a class="navbar-brand" href="/"><img id="img-logo" src="{{Storage::disk('admin')->url($setting->logo)}}"/></a>
                <button class="navbar-toggler collapsed" data-id="navbar-red" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse show-desktop" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('/')? 'active' :''}}" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('gioi-thieu')? 'active' :''}}" href="/gioi-thieu">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('danh-sach-tour')? 'active' :''}}" href="/danh-sach-tour">Danh sách tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('khach-hang')? 'active' :''}} " href="/khach-hang">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('tin-tuc')? 'active' :''}} " href="/tin-tuc">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('lien-he')? 'active' :''}}" href="/lien-he">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="menu menu_mobi d-none show-mobile">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('/')? 'active' :''}}" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('gioi-thieu')? 'active' :''}}" href="/gioi-thieu">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('danh-sach-tour')? 'active' :''}}" href="/danh-sach-tour">Danh sách tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('khach-hang')? 'active' :''}} " href="/khach-hang">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('tin-tuc')? 'active' :''}} " href="/tin-tuc">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('lien-he')? 'active' :''}}" href="/lien-he">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
