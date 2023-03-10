{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$page_title}}
                    <div class="text-muted pt-2 font-size-sm">{{$page_description}}</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->


                    <a href="{{route('order.download','xlsx')}}" class="btn btn-bg-light font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                    <!--end::Svg Icon-->

                   تصدير اكسل</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body" id="card-body">
            <form method="get" action="{{route('orders.index')}}">

            <div class="mb-7" bis_skin_checked="1">
                <div class="row align-items-center" bis_skin_checked="1">

                    <div class="col-lg-9 col-xl-8" bis_skin_checked="1">

                        <div class="row align-items-center" bis_skin_checked="1">

                            <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                <div class="input-icon" bis_skin_checked="1">
                                    <input type="text" class="form-control" name="text" placeholder="البحث" id="kt_datatable_search_query">
                                    <span>

																	<i class="flaticon2-search-1 text-muted"></i>

																</span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                <div class="d-flex align-items-center" bis_skin_checked="1">
                                    <label class="mr-3 mb-0 d-none d-md-block">حالة الطلب:</label>
                                       <select name="status" class="form-control" id="kt_datatable_search_status">
                                            <option value="null" >الكل</option>
                                            <option value="complete">مكتملة</option>
                                            <option value="accepted">مقبولة </option>
                                            <option value="pending">بإنتظار القبول </option>
                                            <option value="cancled">مرفوضة </option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                <div class="d-flex align-items-center" bis_skin_checked="1">
                                    <label class="mr-3 mb-0 d-none d-md-block">حالة الدفع:</label>
                                        <select class="form-control" name="payment_status" id="kt_datatable_search_type">
                                            <option value="null" >الكل</option>
                                            <option value="paid">مدفوعة</option>
                                            <option value="cancled">مرفوضة </option>
                                            <option value="unpaid">غير مدفوعة </option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0" bis_skin_checked="1">
                        <button type="submit" href="#" name="search" value="search" class="btn btn-light-primary px-6 font-weight-bold btn-Serach">بحث</button>
                    </div>
                </div>
            </div>
            </form>

            <form method="post" action="{{route('orders.updates')}}">
                @csrf

            @include('admin.order.table')


                <div class="mb-7" bis_skin_checked="1">
                    <div class="row align-items-center" bis_skin_checked="1">
                    <h6> تعديل الطلبات</h6>
                    </div>
                </div>
                <div class="mb-7" bis_skin_checked="1">
                    <div class="row align-items-center" bis_skin_checked="1">

                        <div class="col-lg-9 col-xl-8" bis_skin_checked="1">

                            <div class="row align-items-center" bis_skin_checked="1">

                                <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                    <div class="d-flex align-items-center" bis_skin_checked="1">
                                        <label class="mr-3 mb-0 d-none d-md-block">حالة الطلب:</label>
                                        <select name="status" class="form-control" id="kt_datatable_search_status">
                                            <option value="complete">مكتملة</option>
                                            <option value="accepted">مرفوضة </option>
                                            <option value="pending">مقبولة </option>
                                            <option value="cancled">ملغاة </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                    <div class="d-flex align-items-center" bis_skin_checked="1">
                                        <label class="mr-3 mb-0 d-none d-md-block">حالة الدفع:</label>
                                        <select class="form-control" name="payment_status" id="kt_datatable_search_type">
                                            <option value="paid">مدفوعة</option>
                                            <option value="cancled">مرفوضة </option>
                                            <option value="unpaid">غير مدفوعة </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0" bis_skin_checked="1">
                                    <div class="d-flex align-items-center" bis_skin_checked="1">
                                        <label class="mr-3 mb-0 d-none d-md-block">حالة التوصيل:</label>
                                        <select class="form-control" name="delivery_status" id="kt_datatable_search_type">
                                            <option value="placed"  >استلام الطلب  </option>
                                            <option value="accepted" >الطلب مقبول  </option>
                                            <option value="packed"  >الطلب جاهز للشحن</option>
                                            <option value="shipped"  >الطلب مشحون </option>
                                            <option value="delivered" >الطلب واصل  </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="form_search" type="hidden" value="1">
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0" bis_skin_checked="1">
                            <button type="submit" href="#" name="search" value="search" class="btn btn-light-primary px-6 font-weight-bold ">تعديل</button>
                        </div>
                    </div>
                </div>
            </form>



        </div>



    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $('#kt_search').on('click',function(){
            $value =$("#s_id").val();

            $.ajax({
                type : 'get',
                url : '{{URL::to('admin/user/teachers/')}}',
                data:{'value':$value},
                success:function(data){
                    $('#card-body').html(data)
                }
            });
        })

        function checkAll(){
            var items = document.getElementsByName('check[]');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = true;
            }
            console.log(items)
        }
        $('#selectAll').click(function (e) {
            $('input:checkbox').prop('checked', this.checked);
        });

        $(document).on('click', '.btn-change-status', function (e) {
            e.preventDefault();
            let href = $(this).data('href'),
                id = $(this).data('id'),
                value = $(this).data('value'),
                token = $(this).data('token'),
               key = $(this).data('key'),
                csrfToken = jQuery('[name="csrf-token"]').attr('content');
            Swal.fire({
                title: 'هل تريد تغيير الحالة ',
                text: "تغير حالة الطلب ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم , تعديل!'


            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'post',
                        url: '/admin/orders/status/'+id,
                        data: {
                            '_token': token,
                            'id': id,
                            'key':key,
                            'value':value,
                        },
                        success: function (response) {
                            if(response.status) {
                                jQuery('.alert-success').removeClass('d-none');
                                jQuery('.invalid-response').remove();
                                jQuery('.alert-success').text(response.message);

                                Swal.fire("تم تحديث هذا العصنر بنجاح", response.message, "success");


                                setTimeout(function () {
                                    jQuery('.alert-success').addClass('d-none');
                                }, 5000);

                                $.ajax({
                                    url:window.location.href,
                                    success:function (data) {
                                        $('#table_data').html(data)
                                    }
                                });
                            }
                        },error: function (response) {
                            jQuery('.alert-danger').removeClass('d-none');
                            jQuery('.alert-danger').text('Something went wrong');
                            let error = response.responseJSON

                            Swal.fire({
                                title: 'حدث خطأ ما ',
                                icon:'error',
                                text:response.message,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            });
                            jQuery('.invalid-response').remove();
                            for(let index in error.errors) {
                                form.find('[name="' + index + '"]').addClass('is-invalid');
                                form.find('[name="' + index + '"]').parents('.form-group').append(('<div class="invalid-response mt-2" style="color: #f64e60">' + error.errors[index][0] + '</div>'));
                            }
                            setTimeout(function () {
                                jQuery('.alert-danger').addClass('d-none');
                            },5000)
                        }
                    })
                }
            });
        });

    </script>


@endsection
