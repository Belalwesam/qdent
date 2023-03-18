{{-- Header Mobile --}}
<div id="kt_header_mobile" class="header-mobile {{ Metronic::printClasses('header-mobile', false) }}" {{ Metronic::printAttrs('header-mobile') }}>
    <div class="mobile-logo">
        <a href="{{ url('/owner') }}">

            @php
                $kt_logo_image = 'logo-light.png'
            @endphp

            @if (config('layout.aside.self.display') == false)

                @if (config('layout.header.self.theme') === 'light')
                    @php $kt_logo_image = 'logo-dark.png' @endphp
                @elseif (config('layout.header.self.theme') === 'dark')
                    @php $kt_logo_image = 'logo-light.png' @endphp
                @endif

            @else

                @if (config('layout.brand.self.theme') === 'light')
                    @php $kt_logo_image = 'logo-dark.png' @endphp
                @elseif (config('layout.brand.self.theme') === 'dark')
                    @php $kt_logo_image = 'logo-light.png' @endphp
                @endif

            @endif

            <img alt="{{ config('app.name') }}" height="50px" src="{{ asset('qdent.png') }}"/>
        </a>
    </div>
    <div class="mobile-toolbar">

        @if (config('layout.aside.self.display'))
            <button class="mobile-toggle mobile-toggle-left  btn btn-light" id="kt_aside_mobile_toggle"><span><i class="fa fa-list"></i></span></button>
        @endif

{{--        @if (config('layout.header.menu.self.display'))--}}
{{--            <button class="mobile-toggle ml-3" id="kt_header_mobile_toggle"><span></span></button>--}}
{{--        @endif--}}

        <button class="topbar-toggle ml-3  btn btn-light" id="kt_header_mobile_topbar_toggle"  >
            {{ Metronic::getSVG('media/svg/icons/General/User.svg') }}
        </button>
    </div>
</div>
