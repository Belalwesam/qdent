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
                    Calendar List View
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="#" class="btn btn-light-primary font-weight-bold">
                    <i class="ki ki-plus "></i> Add Event
                </a>
            </div>
        </div>
        <div class="card-body">
            <div id="kt_calendar"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/ajax.js')}}"></script>
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
                    locale : 'ar',
                    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                    isRTL: KTUtil.isRTL(),
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                        lang:'ar',
                    },

                    height: 800,
                    contentHeight: 750,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    views: {
                        dayGridMonth: { buttonText: 'شهر' },
                        timeGridWeek: { buttonText: 'أسبوع' },
                        timeGridDay: { buttonText: 'يوم' },
                        listDay: { buttonText: 'قائمة' },
                        listWeek: { buttonText: 'قائمة' }
                    },

                    defaultView: 'listWeek',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,

                    events: [
                        @foreach($event as $ev)
                        {
                            title: "{{$ev['title']}}",
                            start: "{{$ev['start']}}",
                            end:"{{$ev['end']}}",
                            description: "{{$ev['description']}}",
                            className: "fc-event-success",
                            anchor:"google.com"

                        }
                        ,
                            @endforeach



                    ]
                    ,


                    eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
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
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.1.1')}}"></script>

@endsection

