<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/libraries/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    @yield('meta')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/slick/slick-theme.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css?v='.env('VERSION_CSS'))}}">
    <?php $setting = Utility::setting();?>
    <link rel="shortcut icon" href="{{Storage::disk('admin')->url($setting->favicon)}}">
    @stack('css')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RRHDKFZQ3R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-RRHDKFZQ3R');
    </script>
    <!-- TikTok Pixel Code Start -->
    <script>
        !function (w, d, t) {
            w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
                var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
            ;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};


            ttq.load('CRGFPMRC77U82D2B2VPG');
            ttq.page();
        }(window, document, 'ttq');
    </script>
    <!-- TikTok Pixel Code End -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TRMGDX7B');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRMGDX7B"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script async="" src="https://s.zzcdn.me/ztr/ztracker.js?id=7209125742024753152"></script>

</head>
<body>
@include('frontend.layouts.header2')
@yield('content')
@include('frontend.layouts.footer')
</body>
<script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="/assets/libraries//bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('/assets/js/hanvina.js?t='.time()) }}"></script>
<script src="/assets/libraries//slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    (() => {
        'use strict'
        // add with + 10px for all .nav-item
        const navLink = document.querySelectorAll('.nav-item')
        navLink.forEach((item) => {
            item.style.width = `calc(${item.clientWidth}px + 15px)`
        })
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<script type="text/javascript">
    ttq.identify({
        "email": "<hashed_email_address>", // string. The email of the customer if available. It must be hashed with SHA-256 on the client side.
        "phone_number": "<hashed_phone_number>", // string. The phone number of the customer if available. It must be hashed with SHA-256 on the client side.
        "external_id": "<hashed_extenal_id>" // string. Any unique identifier, such as loyalty membership IDs, user IDs, and external cookie IDs.It must be hashed with SHA-256 on the client side.
    });

    ttq.track('ViewContent', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('Contact', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('CompleteRegistration', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('AddToCart', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('PlaceAnOrder', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('Schedule', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('Search', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>", // string. The 4217 currency code. Example: "USD".
        "query": "<search_keywords>" // string. The word or phrase used to search. Example: "SAVE10COUPON".
    });

    ttq.track('SubmitForm', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('CompletePayment', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });

    ttq.track('Subscribe', {
        "contents": [
            {
                "content_id": "<content_identifier>", // string. ID of the product. Example: "1077218".
                "content_type": "<content_type>", // string. Either product or product_group.
                "content_name": "<content_name>" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "<content_value>", // number. Value of the order or items sold. Example: 100.
        "currency": "<content_currency>" // string. The 4217 currency code. Example: "USD".
    });
</script>
@stack('js')
</html>
