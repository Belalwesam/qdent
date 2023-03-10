{{-- Extends layout --}}
@extends('layout.default')
@section('styles')
    <style>
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
@endsection
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
                <a href="{{ url()->current() }}/create" class="btn btn-primary font-weight-bolder">
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
                    </span>{{ __('Add New') }} </a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <!--begin::Search Form-->

            <!--end::Search Form-->
            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th>{{ __('Name') }} </th>
                            <th>{{ __('job position') }} </th>
                            <th>{{ __('Phone') }} </th>
                            <th>{{ __('Email') }} </th>
                            <th>{{ __('Whatsapp') }} </th>
                            <th>{{ __('Join in') }} </th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    {{--                <tbody> --}}
                    {{--                @foreach ($buttons as $button) --}}
                    {{--                <tr class="deleted-row-{{$button->id}}"> --}}
                    {{--                    <td>{{$button}}</td> --}}
                    {{--                    <td class="pl-0 py-4"> --}}
                    {{--                        {{$image->id}} --}}
                    {{--                    </td> --}}
                    {{--                    <td class="pl-0 py-4"> --}}
                    {{--                        <div class="symbol symbol-50 symbol-light mr-1"> --}}
                    {{--                                <span class="symbol-label"> --}}
                    {{--                                    <img src="{{$image->src() ?? null}}" class="h-50 align-self-center"/> --}}
                    {{--                                </span> --}}
                    {{--                        </div> --}}
                    {{--                    </td> --}}

                    {{--                    <Td> --}}


                    {{--                        <a href="javascript:;" data-href="{{route('img.delete',$image->id)}}" data-entity_id="{{$image->id}}" data-token="{{csrf_token()}}" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف"> --}}
                    {{--                            {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }} --}}
                    {{--                        </a> --}}

                    {{--                    </Td> --}}
                    {{--                </tr> --}}
                    {{--                @endforeach --}}
                    {{--                </tbody> --}}
                </table>
            </div>
        </div>

    </div>
@endsection

{{-- Styles Section --}}

{{-- Scripts Section --}}
@section('scripts')
    @foreach (config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    {{-- vendors --}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/ajax.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            url = document.URL
            var table = $('#datatable').DataTable({
                dom: 'Bfrtlip',
                order: [
                    [1, 'desc']
                ],
                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> Pdf',
                        titleAttr: 'export to pdf ',
                        className: 'btn btn-primary glyphicon glyphicon-print'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Exel',
                        titleAttr: 'export to excel ',
                        className: 'btn btn-primary glyphicon glyphicon-print'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        titleAttr: 'export to CSV ',
                        className: 'btn btn-primary glyphicon glyphicon-print'
                    }
                ],

                lengthMenu: [10, 25, 100, -1],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,


                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'job_position',
                        name: 'job_position',
                    }, {
                        data: 'phone',
                        name: 'phone',
                    },

                    {
                        data: 'email',
                        name: 'email',
                    }, {
                        data: 'whatsapp',
                        name: 'whatsapp',
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });
            $(".fillter").on('change', function() {
                url = document.URL + "?fillter=" + $('.fillter').val() + "&userType=" + $('.fillter-type')
                    .val()
                $('#datatable').DataTable().ajax.url(url).load();




            });
            $(".fillter-type").on('change', function() {
                url = document.URL + "?fillter=" + $('.fillter').val() + "&userType=" + $('.fillter-type')
                    .val()
                $('#datatable').DataTable().ajax.url(url).load();




            });
        });


        function myFunction(id) {
            document.getElementById("myDropdown" + id).classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
@endsection
