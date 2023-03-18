{{-- Extends layout --}}
@extends('layout.default')
@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css?v=7.2.9" rel="stylesheet" type="text/css">
@endsection
{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-1">
            @include('pages.widgets._widge-chart', ['class' => 'card-stretch gutter-b'])
        </div>
        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-1">
            @include('pages.widgets._widge-chart-user', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-1">
            @include('pages.widgets._widget-product', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-12 col-xxl-12 order-1 order-xxl-1">
            @include('pages.widgets._widget-2', ['class' => 'card-stretch gutter-b'])
        </div>
        <div class="col-lg-12 col-xxl-12 order-1 order-xxl-1">
            @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])
        </div>

        {{--        <div class="col-xxl-6 order-2 order-xxl-1"> --}}
        {{--            @include('pages.widgets._widget-6', ['class' => 'card-stretch gutter-b']) --}}
        {{--        </div> --}}

        {{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2"> --}}
        {{--            @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b']) --}}
        {{--        </div> --}}

        {{--        <div class="col-xxl-8 order-2 order-xxl-1"> --}}
        {{--            @include('pages.widgets._widget-66', ['class' => 'card-stretch gutter-b']) --}}
        {{--        </div> --}}


    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{-- Global Theme JS Bundle (used by all pages)  --}}
    @foreach (config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    <script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.2.9"></script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
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

            $('#datatable').DataTable({
                "dom": 'Bfrtlip',
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

                processing: true,
                serverSide: true,
                ajax: {
                    url: document.URL,
                },
                columns: [{
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
                    }, {
                        data: 'total',
                        name: 'total'
                    }, {
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
                ]
            });
        });
    </script>
    <script>
        var KTCalendarListView = function() {
            return {
                //main function to initiate the module
                init: function() {
                    var todayDate = moment().startOf('day');
                    var YM = todayDate.format('YYYY-MM');
                    var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                    var TODAY = todayDate.format('YYYY-MM-DD');
                    var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                    var calendarEl = document.getElementById('kt_calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],

                        isRTL: KTUtil.isRTL(),
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        },

                        height: 800,
                        contentHeight: 750,
                        aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                        views: {
                            dayGridMonth: {
                                buttonText: 'month'
                            },
                            timeGridWeek: {
                                buttonText: 'week'
                            },
                            timeGridDay: {
                                buttonText: 'day'
                            },
                            listDay: {
                                buttonText: 'list'
                            },
                            listWeek: {
                                buttonText: 'list'
                            }
                        },

                        defaultView: 'listWeek',
                        defaultDate: TODAY,

                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        navLinks: true,
                        events: [
                            @foreach (\App\Model\Event::all() as $ev)
                                {
                                    title: "{{ $ev['name'] }}",
                                    start: "{{ $ev['date'] }}" + "T" + "{{ $ev['from'] }}",
                                    end: "{{ $ev['date'] }}" + "T" + "{{ $ev['to'] }}",
                                    description: "{{ $ev['description'] }}",
                                    className: "fc-event-primary"

                                }
                            @endforeach

                        ],

                        eventRender: function(info) {
                            var element = $(info.el);

                            if (info.event.extendedProps && info.event.extendedProps.description) {
                                if (element.hasClass('fc-day-grid-event')) {
                                    element.data('content', info.event.extendedProps.description);
                                    element.data('placement', 'top');
                                    KTApp.initPopover(element);
                                } else if (element.hasClass('fc-time-grid-event')) {
                                    element.find('.fc-title').append('<div class="fc-description">' +
                                        info.event.extendedProps.description + '</div>');
                                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                    element.find('.fc-list-item-title').append(
                                        '<div class="fc-description">' + info.event.extendedProps
                                        .description + '</div>');
                                }
                            }
                        }
                    });

                    calendar.render();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTCalendarListView.init();
        });
    </script>
@endsection
