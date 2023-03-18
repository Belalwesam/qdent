<!DOCTYPE html>


<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8"/>

    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', "تسجيل حساب جديد"?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
<!--<link href="{{asset('assets/css/pages/login/classic/login-6.css?v=7.0.4')}}" rel="stylesheet" type="text/css" />-->
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('/assets/assets/plugins/global/plugins.bundle.css?v=7.0.4')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.4')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css?v=7.0.4" rel="stylesheet')}}" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('index/css.css')}}" rel="stylesheet" type="text/css" />


    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    @yield('styles')
    <style>
        * {
            direction: rtl;
        }
        body {
            font-family: 'Almarai', sans-serif;
        }

        button.btn.btn-primary.font-weight-bolder.font-size-h6.pl-8.pr-4.py-4.my-3 {
            margin: 15px;
        }
        @media (min-width: 992px) {
            .display1-lg {
                font-size: 3.5rem !important;
            }

        }
        .was-validated .form-control:valid, .form-control.is-valid {
            border-color: #1BC5BD;
            padding-right: calc(1.5em + 1.3rem) !important;}
    </style>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">

<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login" data-wizard-state="first">
        <!--begin::Content-->
        <div class="login-container d-flex flex-center flex-row flex-row-fluid order-2 order-lg-1 flex-row-fluid bg-white py-lg-0 pb-lg-0 pt-15 pb-12">
            <!--begin::Container-->
            <div class="login-content login-content-signup d-flex flex-column">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column px-10">
                    <!--begin::Aside header-->
                    <a href="#" class="login-logo pb-lg-4 pb-10">
                        <img src="assets/media/logos/logo-4.png" class="max-h-70px" alt="">
                    </a>
                    <!--end::Aside header-->
                    <!--begin: Wizard Nav-->
                    <div class="wizard-nav pt-5 pt-lg-15 pb-10">
                        <!--begin::Wizard Steps-->
                        <div class="wizard-steps d-flex flex-column flex-sm-row">
                            <!--begin::Wizard Step 1 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-wrapper pr-7">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">1</span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">الباينات الأساسية</h3>
                                        <div class="wizard-desc">تفاصيل الحساب</div>
                                    </div>
                                    <span class="svg-icon pl-6">
											<i class="fa fa-arrow-left pl-6" style="margin: 8px"></i>

											</span>
                                </div>
                            </div>
                            <!--end::Wizard Step 1 Nav-->
                            <!--begin::Wizard Step 2 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="pending">
                                <div class="wizard-wrapper pr-7">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">2</span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">بيانات ثانوية</h3>
                                        <div class="wizard-desc">بيانات اضافية</div>
                                    </div>
                                    <i class="fa fa-arrow-left pl-6" style="margin: 8px"></i>

                                    </span>
                                </div>
                            </div>
                            <!--end::Wizard Step 2 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step" data-wizard-state="pending">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <i class="wizard-check ki ki-check"></i>
                                        <span class="wizard-number">3</span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">إكمال</h3>
                                        <div class="wizard-desc">إرسال الطلب</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Step 3 Nav-->
                        </div>
                        <!--end::Wizard Steps-->
                    </div>
                    <!--end: Wizard Nav-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Signin-->
                <div class="login-form">
                    <!--begin::Form-->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form px-10 fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" id="kt_login_signup_form" method="post" action="{{route('ownerRegisterPost')}}">
                        <!--begin: Wizard Step 1-->
                        <div class="" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Title-->
                            <div class="pb-10 pb-lg-12">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">إنشاء حساب</h3>
                                <div class="text-muted font-weight-bold font-size-h4">هل لديك حساب ؟
                                    <a href="{{route('login')}}" class="text-primary font-weight-bolder">تسجيل دخول</a></div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form Group-->
                            <div class="form-group fv-plugins-icon-container">
                                <label class="font-size-h6 font-weight-bolder text-dark">الإسم الأول</label>
                                <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="fname" placeholder=" الإسم الأول" value="{{ old('fname') }}">
                                <div class="fv-plugins-message-container"></div></div>
                            <!--end::Form Group-->
                            <!--begin::Form Group-->
                            <div class="form-group fv-plugins-icon-container">
                                <label class="font-size-h6 font-weight-bolder text-dark">الإسم الثاني</label>
                                <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="lname" placeholder=" الإسم الأخير" value="{{ old('lname') }}">
                                <div class="fv-plugins-message-container"></div></div>

                            <!--end::Form Group-->

                            <!--begin::Form Group-->
                            <div class="form-group fv-plugins-icon-container">
                                <label class="font-size-h6 font-weight-bolder text-dark">البريد الإلكتروني</label>
                                <input type="email" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="email" placeholder="البريد الإلكتروني " value="{{ old('email') }}">
                                <div class="fv-plugins-message-container"></div></div>
@csrf
                            <!--end::Form Group-->
                            <div class="form-group fv-plugins-icon-container">
                                <label class="font-size-h6 font-weight-bolder text-dark">رقم الهاتف</label>
                                <input type="phone" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="phone" placeholder="الهاتف " value="{{ old('phone') }}">
                                <div class="fv-plugins-message-container"></div></div>
                            <!--end::Form Group-->
                            <div class="form-group fv-plugins-icon-container">
                                <label class="font-size-h6 font-weight-bolder text-dark">كلمة المرور</label>
                                <input type="password" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="password" placeholder="كلمة المرور  " value="{{ old('phone') }}">
                                <div class="fv-plugins-message-container">كلمة المرور يجب ان تبقى آكثر من 8 </div></div>

                            <!--end::Form Group-->
                            <!--end::Form Group-->
                        </div>
                        <!--end: Wizard Step 1-->
                        <!--begin: Wizard Step 2-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <!--begin::Title-->
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">تفاصيل أخرى</h3>
                                <div class="text-muted font-weight-bold font-size-h4">أضف معلوماتك
                                    <a href="#" class="text-primary font-weight-bolder"></a></div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Row-->
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-6">
                                    <!--begin::Input-->
                                    <div class="form-group fv-plugins-icon-container">
                                        <label class="font-size-h6 font-weight-bolder text-dark">العنوان</label>
                                        <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="address" placeholder="المدينة"  value="{{ old('address') }}">
                                        <span class="form-text text-muted">أدخل عنوانك </span>
                                        <div class="fv-plugins-message-container"></div></div>
                                    <!--end::Input-->
                                </div>
                                <div class="col-xl-6">
                                    <!--begin::Select-->
                                    <div class="form-group fv-plugins-icon-container">
                                        <label class="font-size-h6 font-weight-bolder text-dark">المدينة</label>
                                        <select name="city" class="form-control form-control-solid h-auto py-7 px-5 border-0 rounded-lg font-size-h6">
                                            <option value="">Select</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="fv-plugins-message-container"></div></div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end: Wizard Step 2-->
                        <!--begin: Wizard Step 3-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <!--begin::Title-->
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">اكمال الطلب</h3>
                                <div class="text-muted font-weight-bold font-size-h4">اكمال طلب تسجيل مالك عقارات</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Section-->
                            <!-- Large modal -->
                            <div class="form-group">
                                <div class="form-check">

                                    <input class="form-check-input checkbox checkbox-success" checked type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        شروط الإستخدام الموافقة على
                                        <a href="{{url('privacy')}}" type="button" class="btn " target="_blank" style="
    padding: 0px !important;
    text-decoration: underline;
">إضعط هنا </a>

                                    </label>
                                    <div class="invalid-feedback">
                                        يجب عليك الموافقة على شروط الاستخدام
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       شروط الإستخدام
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end: Wizard Step 5-->
                        <!--begin: Wizard Actions-->
                        <div class="d-flex justify-content-between pt-7" style="float: right;">
                            <div class="mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pr-8 pl-6 py-4 my-3 mr-3" data-wizard-type="action-prev">
{{--										<span class="svg-icon svg-icon-md mr-2">--}}
{{--											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->--}}
{{--											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--													<polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
{{--													<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1"></rect>--}}
{{--													<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)"></path>--}}
{{--												</g>--}}
{{--											</svg>--}}
                                    <i class="fa fa-arrow-left pl-6" style="margin: 8px"></i>
                                            <!--end::Svg Icon-->
										</span>السابق</button>
                            </div>
                            <div>
                                <button class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-submit" type="submit" id="kt_login_signup_form_submit_button">إرسال
                                    <span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
																						<i class="fa fa-arrow-left pl-6" style="margin: 8"></i>

                                        <!--end::Svg Icon-->
										</span></button>
                                <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next">التالي
                                    <span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
																						<i class="fa fa-arrow-left pl-6" style="margin: 8px"></i>

                                        </svg>
                                        <!--end::Svg Icon-->
										</span></button>
                            </div>
                        </div>
                        <!--end: Wizard Actions-->
                        <div></div><div></div></form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Container-->
        </div>
        <!--begin::Content-->
        <!--begin::Aside-->
        <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-center bgi-position-y-center" style="background-image: url({{asset('index/Riyadh-low-res.jpg')}});box-shadow: inset 0 0 0 2000px rgba(255, 165, 0, 0.3);
            ">
            <h3 class="pt-lg-40 pl-lg-0 pb-lg-0 pl-0py-0 m-0 justify-content-lg-start  display1-lg text-white">
                <div class="main-text" style="    margin: 50px;">                نضع بين يديك
                <br> أفضل المميزات
                <br>بخطوات بسيطة
                </div>
            </h3>
            <!--end::Aside title-->
        </div>
            <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom" >
                <!--begin::Aside title-->

        </div>
        <!--end::Aside-->
    </div>
    <!--end::Login-->
</div>

<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach
<script src="{{asset('assets/assets/js/scripts.bundle.js?v=7.0.4')}}"></script>

<script src="{{asset('assets/assets/plugins/global/plugins.bundle.js?v=7.0.4')}}"></script>
<script src="{{asset('assets/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4')}}"></script>
<script src="{{asset('assets/assets/js/scripts.bundle.js?v=7.0.4')}}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/assets/js/pages/custom/login/login-4.js?v=7.0.4')}}"></script>
<!--end::Page Scripts-->
<script>
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_1');

    // Toggle event handlers
    card.on('beforeCollapse', function (card) {
        setTimeout(function () {
            toastr.info('Before collapse event fired!');
        }, 100);
    });

    card.on('afterCollapse', function (card) {
        setTimeout(function () {
            toastr.warning('Before collapse event fired!');
        }, 2000);
    });

    card.on('beforeExpand', function (card) {
        setTimeout(function () {
            toastr.info('Before expand event fired!');
        }, 100);
    });

    card.on('afterExpand', function (card) {
        setTimeout(function () {
            toastr.warning('After expand event fired!');
        }, 2000);
    });

    // Remove event handlers
    card.on('beforeRemove', function (card) {
        toastr.info('Before remove event fired!');

        return confirm('Are you sure to remove this card ?'); // remove card after user confirmation
    });

    card.on('afterRemove', function (card) {
        setTimeout(function () {
            toastr.warning('After remove event fired!');
        }, 2000);
    });

    // Reload event handlers
    card.on('reload', function (card) {
        toastr.info('Leload event fired!');

        KTApp.block(card.getSelf(), {
            overlayColor: '#ffffff',
            type: 'loader',
            state: 'primary',
            opacity: 0.3,
            size: 'lg'
        });

        // update the content here

        setTimeout(function () {
            KTApp.unblock(card.getSelf());
        }, 2000);
    });
</script>
<script src="{{asset('assets/assets/js/pages/features/cards/tools.js?v=7.1.2')}}"></script>

</body>
<!--end::Body-->
</html>
