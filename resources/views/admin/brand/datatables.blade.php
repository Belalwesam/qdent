{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ $page_title }}
                    <div class="text-muted pt-2 font-size-sm">{{ $page_description }}</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="brand/create" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> Add new</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <!--begin::Search Form-->
            <!--end::Search Form-->

            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                    <tr>
                        <th> #</th>
                        <th>Name</th>
                        <th>Img </th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr class="deleted-row-{{ $brand->id }}">
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}

                            </td>
                            <td>
                                <div class="symbol symbol-50 symbol-light mr-1">
                                    <span class="symbol-label">
                                        <img src=" {{ asset('qdent/storage/app/' . $brand->img) }}"
                                            class="h-50 align-self-center" />
                                    </span>
                                </div>



                            </td>
                            <Td>


                                <a href="{{ route('brands.edit', $brand->id) }}"
                                    data-href="{{ route('brands.edit', $brand->id) }}" data-entity_id="{{ $brand->id }}"
                                    class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل">
                                    {{ Metronic::getSVG('media/svg/icons/Communication/Write.svg', 'svg-icon-md svg-icon-primary') }}

                                </a>
                                <a href="javascript:;" data-href="{{ route('brands.delete', $brand->id) }}"
                                    data-entity_id="{{ $brand->id }}" data-token="{{ csrf_token() }}"
                                    class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                                    {{ Metronic::getSVG('media/svg/icons/General/Trash.svg', 'svg-icon-md svg-icon-primary') }}
                                </a>

                            </Td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
    @foreach (config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/ajax.js') }}"></script>
@endsection
