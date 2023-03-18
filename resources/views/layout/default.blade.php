{{--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
 --}}
    <!DOCTYPE html >
<html lang="{{\Illuminate\Support\Facades\App::getLocale()}}"  {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}
@if(\Illuminate\Support\Facades\App::getLocale()=="ar")
dir="rtl"
      @else
      dir="ltr"
    @endif
>
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('front/img/LogoRoz.png') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @if(\Illuminate\Support\Facades\App::getLocale()=="ar")
        <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/header/base/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/header/menu/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/brand/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/brand/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/aside/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/aside/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
        {{-- Includable CSS --}}
    @else
        <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/brand/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/aside/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    @endif
    @yield('styles')

    <style>
        body{
            font-family: 'Tajawal', sans-serif;

        }
        .aside {
            background-color: #77c28c;}
        .aside-menu {
            background-color: #77c28c;
        }
        /*.brand {*/
        /*    background-color: #77c28c;*/
        /*}*/
        /*@media (min-width: 992px) {*/
        /*    .brand {*/
        /*        background-color: #77c28c;*/
        /*    }*/
        /*}*/
        .menu-nav > .menu-item > .menu-link .menu-text {
            color: #ffffff;
        }
        .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-link .menu-text {
            color: #ffffff;
        }
        .aside-menu .menu-nav > .menu-item > .menu-link .menu-icon.svg-icon svg g [fill] {
            -webkit-transition: fill 0.3s ease;
            transition: fill 0.3s ease;
            fill: #ffffff;
        }

        .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
            color: #ffffff;
            font-weight: 500 !important;

        }
        .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-text {
            color: #3699FF !important;
        }
        .brand {
            background-color: #76c28b !important;
            height:110px;
        }
        .brand .btn .svg-icon svg g [fill] {
            -webkit-transition: fill 0.3s ease;
            transition: fill 0.3s ease;
            fill: #ffffff !important;
        }
        .brand-logo a img {
            vertical-align: middle;
            border-style: none;
            height: 101px;
            margin-top: 47px;
        }
    </style>
</head>
<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}
      @if(\Illuminate\Support\Facades\App::getLocale()=="ar")
      direction="rtl" dir="rtl" style="direction: rtl"
      @else
      direction="ltr" dir="ltr" style="direction: ltr"
    @endif

>

@if (config('layout.page-loader.type') != '')
    @include('layout.partials._page-loader')
@endif

@include('layout.base._layout')

<script>var HOST_URL = "";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')

</body>
</html>

