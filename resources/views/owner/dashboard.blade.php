{{-- Extends layout --}}
@extends('layout.default')
@section('styles')
    <style>
        .dropdown.dropdown-inline {
            display: none;
            display: none;
        }
    </style>
@endsection
{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            @include('pages.widgets1._widget-1', ['class' => 'card-stretch gutter-b'])
        </div>

{{--        <div class="col-lg-6 col-xxl-4">--}}
{{--            @include('pages.widgets1._widget-2', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-xxl-4">--}}
{{--            @include('pages.widgets._widget-3', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
{{--            @include('pages.widgets._widget-4', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
{{--        </div>--}}

        <div class="col-xxl-8 order-2 order-xxl-1">
            @include('pages.widgets1._widget-5', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-xxl-12 order-1 order-xxl-1">
            @include('pages.widgets1._widget-6', ['class' => 'card-stretch gutter-b'])
        </div>
        <div class="col-xxl-12 order-1 order-xxl-1">
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
        </div>

{{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets1._widget-7', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}

{{--        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">--}}
{{--            @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])--}}
{{--        </div>--}}
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
                let href = $(this).data('href'),
                    entityId = $(this).data('entity_id'),
                    token = $(this).data('token'),

                    csrfToken = jQuery('[name="csrf-token"]').attr('content');
                Swal.fire({
                    text: "لن تتمكن من التراجع عن هذا !",
                    icon: "error",
                    confirmButtonText: "نعم"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: 'post',
                            url: href,
                            data: {
                                '_token': token,
                                'id': entityId,
                            }, success: function (response) {
                                if (response.status == true) {
                                    jQuery('.alert-success').removeClass('d-none');
                                    jQuery('.alert-success').text(response.message);
                                    setTimeout(function () {
                                        jQuery('.alert-success').addClass('d-none');
                                    }, 5000);
                                    $('.deleted-row-' + response.id).remove();
                                }
                            }, error: function (response) {
                            }
                        })
                    }
                });
            });

            $(document).on('click', '.btn-save', function (event) {
                event.preventDefault();
                let form = jQuery(this).parents('form'),
                    formAction = form.attr('action'),
                    formData = new FormData($('.formAction')[0]);
                jQuery('.is-invalid').removeClass('is-invalid');
                jQuery.ajax({
                    type: 'post',
                    url: formAction,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $('.formAction')[0].reset();
                            $('img').removeAttr('src');
                            jQuery('.alert-success').removeClass('d-none');
                            jQuery('.invalid-response').remove();
                            jQuery('.field_wrapper .row').remove();
                            jQuery('.field_wrapper_rep .row').remove();
                            jQuery('.field_wrapper_fac .row .col-lg-4').remove();
                            jQuery('.dz-preview').remove();
                            jQuery('#show').attr('src', '');


                            jQuery(".wizard-step").attr("data-wizard-state","current");
                            jQuery(".wizard-step").first().attr("data-wizard-state","pending");

                            jQuery('.alert-success').text(response.message);
                            setTimeout(function () {
                                jQuery('.alert-success').addClass('d-none');
                            }, 5000);
                        }else{
                            jQuery('.alert-success').text(response.message);
                            setTimeout(function () {
                                jQuery('.alert-danger').addClass('is-invalid');
                            }, 5000);
                        }
                    },
                    error: function (response) {
                        let error = response.responseJSON
                        jQuery('.invalid-response').remove();
                        for (let index in error.errors) {
                            form.find('[name="' + index + '"]').addClass('is-invalid');
                            form.find('[name="' + index + '"]').parents('.form-group').append(('<div class="invalid-response mt-2" style="color: #f64e60">' + error.errors[index][0] + '</div>'));
                        }
                        jQuery('.alert-danger').removeClass('d-none');
                        jQuery('.alert-danger').text(response.message);
                        setTimeout(function () {
                            jQuery('.alert-danger').addClass('d-none');
                        }, 5000);
                    }
                });
            });

            $(document).on('click', '.btn-update', function (event) {
                event.preventDefault();
                let form = jQuery(this).parents('form'),
                    formAction = form.attr('action')
                formData = new FormData($('.formAction')[0]);
                jQuery('.is-invalid').removeClass('is-invalid');
                jQuery.ajax({
                    type: 'post',
                    url: formAction,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.status) {
                            jQuery('.alert-success').removeClass('d-none');
                            jQuery('.invalid-response').remove();
                            jQuery('.alert-success').text(response.message);
                            setTimeout(function () {
                                jQuery('.alert-success').addClass('d-none');
                            }, 5000);
                        }
                    },error: function (response) {
                        jQuery('.alert-danger').removeClass('d-none');
                        jQuery('.alert-danger').text('لم تتم العملية بنجاح يوجد خطأ ما');
                        let error = response.responseJSON
                        jQuery('.invalid-response').remove();
                        for(let index in error.errors) {
                            form.find('[name="' + index + '"]').addClass('is-invalid');
                            form.find('[name="' + index + '"]').parents('.form-group').append(('<div class="invalid-response mt-2" style="color: #f64e60">' + error.errors[index][0] + '</div>'));
                        }
                        setTimeout(function () {
                            jQuery('.alert-danger').addClass('d-none');
                        },5000)
                    }

                });
            });
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetch_data(page)
            });
            function fetch_data(page) {
                $.ajax({
                    url:"/dashboard/mosques/fetch_data?page="+page,
                    success:function (data) {
                        $('#table_data').html(data)
                    }
                })
            }

        })


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
