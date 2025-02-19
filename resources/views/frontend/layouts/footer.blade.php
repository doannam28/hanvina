<?php $setting = Utility::setting();?>
<a href="tel:{{"+84".substr($setting->phone,1,strlen($setting->phone))}}" class="a-animation" id="a-phone">
    <img id="img-phone" src="/assets/images/phone-new.svg"/>
</a>
<a href="https://m.me/hanvinatravel" class="a-animation" id="a-chat-fb">
    <img id="img-phone" src="/assets/images/chat-fb.svg"/>
</a>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5 col-12">
                <a href="">
                    <img id="logo-footer" src="{{Storage::disk('admin')->url($setting->logo_footer)}}"/>
                </a>
                <p class="p-des-footer text-align-justify fs-6">HanVina Travel - Nơi mà chuyến du lịch của bạn trở nên đáng nhớ và tuyệt vời. Với cam kết về uy tín, chất lượng dịch vụ và đội ngũ chuyên viên tư vấn giàu kinh nghiệm, chúng tôi tự hào là đối tác tin cậy của bạn trên hành trình khám phá thế giới.</p>
            </div>
            <div class="col-lg-2 col-md-3 col-12 padding-left-desktop-20">
                <h3 class="h3-footer">VỀ CHÚNG TÔI</h3>
                <ul class="ul-footer">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/gioi-thieu">Giới thiệu</a></li>
                    <li><a href="/danh-sach-tour">Danh sách tour</a></li>
                    <li><a href="/khach-hang">Khách hàng</a></li>
                    <li><a href="/tin-tuc">Tin tức</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-12 padding-left-desktop-20">
                <h3 class="h3-footer">THÔNG TIN LIÊN HỆ</h3>
                <a href="tel:{{"+84".substr($setting->phone,1,strlen($setting->phone))}}">
                    <div class="p-social-f">
                        <p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"/>
                                <path d="M18.5 9C18.5 8.4 18.03 7.48 17.33 6.73C16.69 6.04 15.84 5.5 15 5.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 9C22 5.13 18.87 2 15 2" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </p>
                        <span>{{$setting->phone}} <br>{{$setting->phone_display}}</span>
                    </div>
                </a>
                <a href="tel:{{"+84".substr($setting->phone2,1,strlen($setting->phone2))}}">
                    <div class="p-social-f">
                        <p>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.7267 0H5.27331C2.37942 0 0 2.37942 0 5.27331V6.43087C0 7.3955 0.771704 8.1672 1.73633 8.1672H4.05145C5.01608 8.1672 5.78778 7.3955 5.78778 6.43087V5.27331C5.78778 4.95177 6.04502 4.69453 6.36656 4.69453H13.5048C13.8264 4.69453 14.0836 4.95177 14.0836 5.27331V6.43087C14.0836 7.3955 14.8553 8.1672 15.8199 8.1672H18.135C19.0997 8.1672 19.8714 7.3955 19.8714 6.43087V5.27331C20 2.37942 17.6206 0 14.7267 0ZM4.69453 6.43087C4.69453 6.75241 4.4373 7.00965 4.11576 7.00965H1.73633C1.41479 7.00965 1.15756 6.75241 1.15756 6.43087V5.85209H4.69453V6.43087ZM13.5691 3.53698H6.43087C5.65916 3.53698 5.01608 4.05145 4.75884 4.69453H1.22187C1.4791 2.70096 3.21543 1.15756 5.27331 1.15756H14.7267C16.7846 1.15756 18.5209 2.70096 18.7781 4.69453H15.1769C14.9839 3.98714 14.3408 3.53698 13.5691 3.53698ZM18.8424 6.43087C18.8424 6.75241 18.5852 7.00965 18.2637 7.00965H15.9486C15.627 7.00965 15.3698 6.75241 15.3698 6.43087V5.85209H18.9068V6.43087H18.8424Z" fill="#272B35"/>
                                <path d="M18.586 16.3988C15.3706 8.61747 15.5635 9.06763 15.5635 9.06763C15.242 8.55316 14.6632 8.23162 14.0844 8.23162H12.9911V7.65284C12.9911 6.68821 12.2194 5.9165 11.2548 5.9165H8.81108C7.84645 5.9165 7.07475 6.68821 7.07475 7.65284V8.23162H5.91719C5.14549 8.23162 4.56671 8.74609 4.37378 9.13194L1.41558 16.3988C1.28696 16.7847 1.22266 17.1062 1.22266 17.4921V18.1995C1.22266 19.1641 1.99436 19.9358 2.95899 19.9358H17.1069C18.0715 19.9358 18.8432 19.1641 18.8432 18.1995V17.4921C18.8432 17.1705 18.7789 16.7847 18.586 16.3988ZM8.2323 7.58853C8.2323 7.26699 8.48954 7.00975 8.81108 7.00975H11.2548C11.5764 7.00975 11.8336 7.26699 11.8336 7.58853V8.16731H8.2323V7.58853ZM17.6857 18.2638C17.6857 18.5853 17.4284 18.8425 17.1069 18.8425H2.95899C2.63745 18.8425 2.38021 18.5853 2.38021 18.2638V17.5564C2.38021 17.2991 2.44452 17.1062 2.50883 16.849L5.46703 9.64641C5.59565 9.51779 5.78857 9.38917 5.9815 9.38917C6.17443 9.38917 13.6342 9.38917 14.0844 9.38917C14.2773 9.38917 14.4702 9.51779 14.5989 9.64641L17.5571 16.9133C17.6214 17.1062 17.6857 17.3634 17.6857 17.5564V18.2638Z" fill="#272B35"/>
                                <path d="M10.0331 10.5466C8.10381 10.5466 6.49609 12.1543 6.49609 14.0836C6.49609 16.0129 8.10381 17.6206 10.0331 17.6206C11.9623 17.6206 13.57 16.0129 13.57 14.0836C13.57 12.1543 11.9623 10.5466 10.0331 10.5466ZM10.0331 16.3987C8.7469 16.3987 7.71796 15.3698 7.71796 14.0836C7.71796 12.7974 8.7469 11.7685 10.0331 11.7685C11.3192 11.7685 12.3482 12.7974 12.3482 14.0836C12.3482 15.3698 11.3192 16.3987 10.0331 16.3987Z" fill="#272B35"/>
                                <path d="M10.0326 12.8618C9.38947 12.8618 8.875 13.3763 8.875 14.0194C8.875 14.6625 9.38947 15.1769 10.0326 15.1769C10.6756 15.1769 11.1901 14.6625 11.1901 14.0194C11.1901 13.4406 10.6756 12.8618 10.0326 12.8618Z" fill="#272B35"/>
                            </svg>
                        </p>
                        <span>{{$setting->phone2}} <br>{{$setting->phone2_display}}</span>
                    </div>
                </a>
                <a href="mailto:{{$setting->email}}">
                    <div class="p-social-f">
                        <p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </p>
                        <span>{{$setting->email}}</span>
                    </div>
                </a>
                <div class="p-social-f">
                    <p>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9999 13.4299C13.723 13.4299 15.1199 12.0331 15.1199 10.3099C15.1199 8.58681 13.723 7.18994 11.9999 7.18994C10.2768 7.18994 8.87988 8.58681 8.87988 10.3099C8.87988 12.0331 10.2768 13.4299 11.9999 13.4299Z" stroke="#292D32" stroke-width="1.5"/>
                            <path d="M3.6202 8.49C5.5902 -0.169998 18.4202 -0.159997 20.3802 8.5C21.5302 13.58 18.3702 17.88 15.6002 20.54C13.5902 22.48 10.4102 22.48 8.3902 20.54C5.6302 17.88 2.4702 13.57 3.6202 8.49Z" stroke="#292D32" stroke-width="1.5"/>
                        </svg>

                    </p>
                    <span>{{$setting->address}}</span>
                </div>
                <div class="p-social-f">
                    <p>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9999 13.4299C13.723 13.4299 15.1199 12.0331 15.1199 10.3099C15.1199 8.58681 13.723 7.18994 11.9999 7.18994C10.2768 7.18994 8.87988 8.58681 8.87988 10.3099C8.87988 12.0331 10.2768 13.4299 11.9999 13.4299Z" stroke="#292D32" stroke-width="1.5"/>
                            <path d="M3.6202 8.49C5.5902 -0.169998 18.4202 -0.159997 20.3802 8.5C21.5302 13.58 18.3702 17.88 15.6002 20.54C13.5902 22.48 10.4102 22.48 8.3902 20.54C5.6302 17.88 2.4702 13.57 3.6202 8.49Z" stroke="#292D32" stroke-width="1.5"/>
                        </svg>

                    </p>
                    <span>{{$setting->address2}}</span>
                </div>
                <h3 class="h3-footer margin-top-30">CHỨNG NHẬN</h3>
                <p class="margin-top-20 font-16-mobile fs-6">Số GPLHQT: 01-1074/2020/TCDL-GP LHQT</p>
            </div>
            <div class="col-lg-4 col-md-6 col-12 padding-left-desktop-20">
                <h3 class="h3-footer">ĐĂNG KÝ NHẬN THÔNG BÁO</h3>
                <form id="register-phone" class="row g-3 needs-validation" novalidate>
                    <div class="div-bor-register position-relative">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="tel" class="form-control" id="input-phone" name="phone" minlength="10" maxlength="10" placeholder="Nhập số điện thoại" required/>
                        <div class="invalid-tooltip">
                            Xin vui lòng nhập số điện thoại của bạn
                        </div>
                        <button id="btn-phone" type="submit">&nbsp;</button>
                    </div>
                </form>
                <div class="div-social-footer">
                    <a href="{{$setting->facebook}}" target="_blank"><img src="/assets/images/icon-fb.png"/></a>
                    <a href="{{$setting->tiktok}}" target="_blank"><img src="/assets/images/icon-tiktok.png"/></a>
                    <a href="{{$setting->youtube}}" target="_blank"><img src="/assets/images/icon-yt.png"/></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="div-copyright">
            Copyright 2024 © All Right Reserved Design by HanVina
        </div>
    </div>
</footer>
