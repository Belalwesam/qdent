@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                            <!--begin::Item-->
                            <li class="nav-item mr-3">
                                <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1">
														<span class="nav-icon">
															<span class="svg-icon">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Layers.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"></polygon>
																		<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																		<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                                    <span class="nav-text font-size-lg">إضافة مدير</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->

                            <!--end::Item-->
                            <!--begin::Item-->
                            <!--end::Item-->

                        </ul>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <form  method="POST" action="{{route('admin.store')}}" class="formAction">
                        @csrf
                        <div class="tab-content">
                            <!--begin::Tab-->
                            <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-7 my-2">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <label class="col-3"></label>
                                            <div class="col-9">
                                                <h6 class="text-dark font-weight-bold mb-10">بيانات العميل:</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">الصورة</label>
                                            <div class="col-9">
                                                <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar"
                                                     style="background-image: url(/assets/media/users/blank.png)">
                                                    <div class="image-input-wrapper"></div>
                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" id="profile_avatar" name="img" accept=".png, .jpg, .jpeg">
                                                        <input type="hidden" name="profile_avatar_remove">
                                                    </label>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
																			<i class="ki ki-bold-close icon-xs text-muted"></i>
																		</span>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
																			<i class="ki ki-bold-close icon-xs text-muted"></i>
																		</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">الإسم</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" name="name"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> رقم الهاتف</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
                                                    </div>
                                                    <input type="text" name="phone"  class="form-control form-control-lg form-control-solid"  placeholder="Phone">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> البريد الإلكتروني </label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-at"></i>
																			</span>
                                                    </div>
                                                    <input type="text" name="email" class="form-control form-control-lg form-control-solid"  placeholder="Email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">الأدوار</label>
                                            <div class="col-9">
                                                <select name="role" class="form-control  form-control-lg form-control-solid">
                                                    <option> اختر الدور</option>
                                                    <option value="1" >  مدير مسئول </option>
                                                    <option value="2" >مشرف </option>
                                                    <option value="3" >مراقب </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> كلمة المرور الجديدة</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" name="password" type="password" placeholder="كلمة المرور الجديدة">
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> تأكيد كلمة المرور</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder=" تأكيد كلمة المرور">
                                            </div>
                                        </div>
                                        <div class="card-footer pb-0">
                                            <div class="row">
                                                <div class="col-xl-2"></div>
                                                <div class="col-xl-7">
                                                    <div class="row">
                                                        <div class="col-3"></div>
                                                        <div class="col-9">
                                                            <a href="#" class="btn btn-light-primary btn-save font-weight-bold"> حفظ التغييرات</a>
                                                            <a href="#" class="btn btn-clean font-weight-bold">إلغاء</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>

{{--                            <div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">--}}
{{--                                <!--begin::Body-->--}}
{{--                                <div class="card-body">--}}
{{--                                    <!--begin::Row-->--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-xl-2"></div>--}}
{{--                                        <div class="col-xl-7">--}}
{{--                                            <!--begin::Row-->--}}
{{--                                            <div class="row mb-5">--}}
{{--                                                <label class="col-3"></label>--}}
{{--                                                <div class="col-9">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Row-->--}}
{{--                                            <!--begin::Row-->--}}

{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-form-label col-3 text-lg-right text-left"> كلمة المرور الجديدة</label>--}}
{{--                                                <div class="col-9">--}}
{{--                                                    <input class="form-control form-control-lg form-control-solid" name="password" type="password" placeholder="كلمة المرور الجديدة">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Group-->--}}
{{--                                            <!--begin::Group-->--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-form-label col-3 text-lg-right text-left"> تأكيد كلمة المرور</label>--}}
{{--                                                <div class="col-9">--}}
{{--                                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder=" تأكيد كلمة المرور">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Group-->--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Row-->--}}
{{--                                </div>--}}
{{--                                <!--end::Body-->--}}
{{--                                <!--begin::Footer-->--}}
{{--                                <div class="card-footer pb-0">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-xl-2"></div>--}}
{{--                                        <div class="col-xl-7">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-3"></div>--}}
{{--                                                <div class="col-9">--}}
{{--                                                    <a href="#" class="btn btn-light-primary btn-update font-weight-bold"> حفظ التغييرات</a>--}}
{{--                                                    <a href="#" class="btn btn-clean font-weight-bold">إلغاء</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!--end::Footer-->--}}
{{--                            </div>--}}
                            <!--end::Tab-->
                            <!--begin::Tab-->

                            <!--end::Tab-->
                        </div>
                    </form>
                </div>
            </div>

        </div>
            <!--begin::Card body-->
        </div>


    <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#kt_user_edit_avatar').css("background-image", "url(" +  e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        function readURLCar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#car_img').css("background-image", "url(" +  e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        function readURLLicense(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#car_license').css("background-image", "url(" +  e.target.result + ")");
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#profile_avatar").change(function() {
            readURL(this);
        });

        $("#carImg").change(function() {
            readURLCar(this);
        });
    </script>
    <script src="{{asset('/js/ajax.js')}}"></script>
@endsection

