{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Interested - {{ $event->name }}
                    {{--                    <div class="text-muted pt-2 font-size-sm">{{$page_description}}</div>--}}
                </h3>
            </div>
            {{--            <div class="card-toolbar">--}}
            {{--                <!--begin::Dropdown-->--}}
            {{--                <!--end::Dropdown-->--}}
            {{--                <!--begin::Button-->--}}
            {{--                <a href="{{url()->current()}}/create" class="btn btn-primary font-weight-bolder">--}}
            {{--                <span class="svg-icon svg-icon-md">--}}
            {{--                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"--}}
            {{--                         version="1.1">--}}
            {{--                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--                            <rect x="0" y="0" width="24" height="24"/>--}}
            {{--                            <circle fill="#000000" cx="9" cy="15" r="6"/>--}}
            {{--                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"--}}
            {{--                                  fill="#000000" opacity="0.3"/>--}}
            {{--                        </g>--}}
            {{--                    </svg>--}}
            {{--                    <!--end::Svg Icon-->--}}
            {{--                </span>Add new</a>--}}
            {{--                <!--end::Button-->--}}
            {{--            </div>--}}
        </div>

        <div class="card-body">

            <!--begin::Search Form-->
            <!--end::Search Form-->

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th> #</th>
                    <th>{{__("Name")}} </th>
                    <th>{{__("Username")}} </th>
                    <th>{{__("Phone")}} </th>
                    <th>{{__("Email")}} </th>
                    <th>{{__("Join in")}} </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d A g:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
@endsection
