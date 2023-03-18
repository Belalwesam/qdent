@extends('layout.default')
@section('styles')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKAsrWNb6YR0muSYWnc-fqC69j7dY2EOg&callback=initMap&libraries=&v=weekly&language=ar&region=SA"
        defer
    ></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
{{--                <div class="card-header">--}}
{{--                    <div class="card-title"> {{حجز}}  </div>--}}
{{--                </div>--}}
                <div class="row justify-content-center pt-8 px-8 pt-md-27 px-md-0">
                    <div class="col-md-9">
                        <!-- begin: Invoice header-->
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10">حجز</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-5 max-w-200px">
                                    <i class="fa fa-bookmark"></i>
                                                                <!--end::Svg Icon-->
															</span>
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end font-size-h5 font-weight-bold text-muted">
															<span>{{$booking->property->name ?? null}}</span>
															<span>{{$booking->user->name ?? null}}</span>
															<span>{{$booking->date}}</span>
														</span>
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden w-100 max-h-md-250px mb-30">
                            <img src="/metronic/theme/html/demo1/dist/assets/media/bg/bg-invoice-5.jpg" class="w-100" alt="">
                        </div>
                        <!--end: Invoice header-->
                        <!--begin: Invoice body-->
                        <div class="row border-bottom pb-10">
                            <div class="col-md-9 py-md-10 pr-md-10">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">تاريخ الحجز</th>
                                            <th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase">نوع االحجز</th>
                                            <th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase">الوقت</th>
                                            <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">العربون</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pl-0 pt-7 d-flex align-items-center">
																		<span class="navi-icon mr-2">
																			<i class="fa fa-genderless text-danger font-size-h2"></i>
																		</span>@php

                                                                               $format='D d F Y';                                          $time = \Carbon\Carbon::make($booking->date);
																		@endphp
                                                {{$time->formatLocalized('%d %B %Y') }}
																		</td>
                                            <td class="text-right pt-7">
                                                {{$booking->property->getType() ?? null}}
                                            </td>
                                            <td class="text-right pt-7">

                                                {{$booking->getTypeText()}}
                                            </td>
                                            <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">{{$booking->total}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="border-bottom w-100 mt-7 mb-13"></div>
                                <div class="d-flex flex-column mb-10 mb-md-0">
                                    <div class="font-weight-bold font-size-h6 mb-3">الحالة</div>
                                    <div class="d-flex justify-content-between font-size-lg mb-3">
                                        <span class="font-weight-bold mr-15">الحالة:</span>
                                        <span class="label label-xl label-{{$booking->span()}} label-pill label-inline mr-2">{{$booking->arabic()}}</span>

                                        {{--                                        <span class="text-right">{{$booking->banking->name}}</span>--}}
                                    </div>
                                    @if($booking->status == 'unpaid')
                                    <div class="form-group font-weight-bold font-size-h6 mb-3">

                                    <form class="form formAction" action="{{route('booking.update',$booking)}}" method="post">
                                        @csrf

                                        @method('Patch')
                                        <span>

                                            تغير حالة الحجز :

                                        </span>
                                <input value="{{$booking->id}}" name="id" type="hidden">
                                <input value="canceled" name="status" type="hidden">
                                        <button class="label label-xl btn label-light-danger label-pill label-inline mr-2  " name="status" value="canceled">إلغاء الحجز</button>

                                    </form>
                                    </div>
@endif

                                </div>

                                <div class="d-flex flex-column flex-md-row">
                                    @if($booking->payment_gateway == 1)
                                        <div class="d-flex flex-column mb-10 mb-md-0">
                                            <div class="font-weight-bold font-size-h6 mb-3">حوالة بنكية</div>
                                            <div class="d-flex justify-content-between font-size-lg mb-3">
                                                <span class="font-weight-bold mr-15">إسم البنك:</span>
                                                <span class="text-right">{{$booking->banking->name}}</span>
                                            </div>

                                                <img id="largeImage" src="" height="600">
                                            </div>


                                    @else
                                        <div class="d-flex flex-column mb-10 mb-md-0">

                                            <div class="font-weight-bold font-size-h6 mb-3">دفع عبر البطاقة الإئتمانية</div>
                                            <div class="d-flex justify-content-between font-size-lg mb-3">
                                                <span class="font-weight-bold mr-15">   تاريخ الدفع:</span>
                                                <span class="text-right" style="color: darkgrey">{{$booking->paid_date ?? 'لم يتم الدفع'}}</span>
                                            </div>
{{--                                            <div class="d-flex justify-content-between font-size-lg mb-3">--}}
{{--                                                <span class="font-weight-bold mr-15">Account Number:</span>--}}
{{--                                                <span class="text-right">1234567890934</span>--}}
{{--                                            </div>--}}

                                        </div>

                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 border-left-md pl-md-10 py-md-10 text-right">
                                <!--begin::Total Amount-->
                                <div class="font-size-h4 font-weight-bolder text-muted mb-3">إجمالي المبلغ المدفوع</div>
                                <div class="font-size-h1 font-weight-boldest">{{$booking->total}}  </div>
                                <div class="text-muted font-weight-bold mb-16"> {{$booking->property->price - $booking->total}} المتبقي  </div>
                                <!--end::Total Amount-->
                                <div class="border-bottom w-100 mb-16"></div>
                            <!--begin::Invoice To- ->
                                <div class="text-dark-50 font-size-lg font-weight-bold mb-3">دفع من </div>
                                <div class="font-size-lg font-weight-bold mb-10">{{$booking->user->name ?? null}}
                                <br>{{$booking->city}}</div>
                                <!--end::Invoice To-->
                                <!--begin::Invoice No-->
                                <div class="text-dark-50 font-size-lg font-weight-bold mb-3">رقم الفاتورة</div>
                                <div class="font-size-lg font-weight-bold mb-10">{{$booking->id}}</div>
                                <!--end::Invoice No-->
                                <!--begin::Invoice Date-->
                                <div class="text-dark-50 font-size-lg font-weight-bold mb-3">تاريخ إنشاء الحجز</div>
                                <div class="font-size-lg font-weight-bold">{{$booking->created_at->formatLocalized('%d %B %Y')}}</div>
                                <!--end::Invoice Date-->
                            </div>
                        </div>
                        <!--end: Invoice body-->
                    </div>
                </div>
                <div class="row justify-content-center py-8 px-8 py-md-28 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex font-size-sm flex-wrap">
                            <button type="button" class="btn btn-primary font-weight-bolder py-4 mr-3 mr-sm-14 my-1" onclick="window.print();">Print Invoice</button>
                            <button type="button" class="btn btn-light-primary font-weight-bolder mr-3 my-1">Download</button>
                            <button type="button" class="btn btn-dark font-weight-bolder ml-sm-auto my-1">Create Invoice</button>
                        </div>
                    </div>
                </div>

            </div>
    </div>



    </div>
@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>

@endsection

