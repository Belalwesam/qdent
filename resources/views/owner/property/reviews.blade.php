{{-- Extends layout --}}
@extends('layout.default')
@section('styles')
<style>
    table.table-bordered.dataTable {
        border-right-width: 0;
    }
    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
        border-spacing: 0;
        -webkit-border-horizontal-spacing: 0px;
        -webkit-border-vertical-spacing: 0px;
    }
    .table-bordered {
        border: 1px solid #ECF0F3;
    }
    </style>
    @endsection
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
                <a href="ads/create" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>أضف عقار</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            @foreach($property as $item)

                    <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">{{$item->name}}</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                        @if(!$item->comment()->exists())
                            <label>لا يوجد مراجعات على هذا العقار</label>
                        @endif
                @foreach($item->comment as $comment)
                <div class="card-body pt-2">
                    <!--begin::Item-->


                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="background-image: url('{{$comment->ads->imgs[0]}}')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                            <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{$comment->user->name}}</a>
                            <span class="text-muted font-weight-bold">{{$comment->comment}}</span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center mt-lg-0 mt-3">
                            <!--begin::Label-->

                            <!--end::Label-->
                            <!--begin::Btn-->
                            <!--end::Btn-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->

                </div>
            @endforeach

            <!--end::Body-->
            </div>
                    @endforeach
        </div>

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('/js/ajax.js')}}"></script>

@endsection
