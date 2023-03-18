{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{$page_title}}
                            <div class="text-muted pt-2 font-size-sm">{{$page_description}}</div>
                        </h3>
                    </div>
                </div>
                <form  method="POST" action="{{route('attrabiuteValue.store')}}" class="formAction">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"  class="form-control">
                        </div>
                        <input type="hidden" value="3" name="type">
                        <input type="hidden" value="{{$attrabiute->id}}" name="attribute_id">
                        <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">Add</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$page_title}}
                    <div class="text-muted pt-2 font-size-sm">{{$page_description}}</div>
                </h3>
            </div>
        </div>

        <div class="card-body">

            <!--begin::Search Form-->
            <!--end::Search Form-->

            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th> #</th>
                    <th>Name</th>

                    <th>Actions</th>
                </tr>
                </thead>

            </table>

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
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#datatable').DataTable({
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
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endsection
