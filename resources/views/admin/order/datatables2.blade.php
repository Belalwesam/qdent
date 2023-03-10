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
                <a href="{{url()->current()}}/create" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                         version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                  fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Add new</a>
                <!--end::Button-->
            </div>
        </div>
{{--        <form method="post" action="{{route('order.status')}}">--}}
            @csrf
            <div class="card-body">

                <!--begin::Search Form-->
                <!--end::Search Form-->
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <select class="form-control" id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="delivered">Delivered</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button class="btn btn-primary" id="filter">Update</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" name="select_all" class="form-control">
                        </th>
                        <th>{{__("#")}}</th>
                        <th>{{__("Status")}}</th>
                        <th>{{__(" User Name")}}</th>
                        <th>{{__("Product")}}</th>
                        <th>{{__("Quantity ")}}</th>
                        <th>{{__("total ")}}</th>
                        <th>{{__("Delivery Location")}} </th>
                        <th>{{__("  Ordered Data")}}</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                </table>

            </div>
{{--        </form>--}}

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('scripts')
    {{-- vendors --}}
    <script>
        import Labels from "../../../../node_modules2/jqvmap/examples/labels.html";

        export default {
            components: {Labels}
        }
    </script>
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {

            var table = $('#datatable').DataTable({
                "dom": 'Bfrtlip',
                buttons: [
                    {
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

                processing: true,
                serverSide: true,
                ajax: {
                    url: document.URL,
                },
                columns: [
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        selectRow: true

                    },


                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    }
                    , {
                        data: 'total',
                        name: 'total'
                    }
                    , {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],

                order: [[1, 'asc']],
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                },
                select: true
                , rowGroup: {
                    dataSrc: 'group'
                }
            });

            $("#selectAll").on("click", function (e) {
                if ($('.manual_entry_cb').is(":checked")) {
                    $('.manual_entry_cb').prop('checked', false);
                } else {
                    $('.manual_entry_cb').prop('checked', true);
                }
                // if ($(this).is( ":checked" )) {
                //     table.rows(  ).select();
                // } else {
                //     table.rows(  ).deselect();
                // }
            });
        });

    </script>
@endsection
