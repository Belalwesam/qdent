@extends('layout.default')
@section('styles')

    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    اختر عقار لاضافة حجز عليه
                </h3>
            </div>
            <div class="row">
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">عقاراتي</h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-ver"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2">
                @foreach($ads as $ad)
                    <!--begin::Item-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <a href="{{route('createBooking',$ad->id)}}">
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="background-image: url('{{asset('funny/storage/app/'.$ad->imgs[0])}}')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="{{route('createBooking',$ad->id)}}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$ad->name}}</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">{{$ad->city->name}} &amp; {{$ad->address}}</span>
                            <span class="text-muted font-weight-bold font-size-sm">آلية الحجز:
														<span class="text-primary font-weight-bold">{{$ad->getType()}}</span></span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <span class="text-dark-75 font-weight-bolder font-size-h4">{{$ad->price}}</span>
                                <span class="text-muted font-size-sm font-weight-bolder">عربون : {{$ad->deposit}}</span>
                            </div>
                        </div>
                        </a>
                        <!--end::Info-->
                    </div>

                    <!--end::Item-->
                    @endforeach
                </div>
                <!--end::Body-->
            </div>
            </div>
        <div class="card-body">
            <div id="kt_calendar"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.1.1')}}"></script>

@endsection

