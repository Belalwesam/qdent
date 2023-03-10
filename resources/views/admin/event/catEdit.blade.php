@extends('layout.default')
@section('styles')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKAsrWNb6YR0muSYWnc-fqC69j7dY2EOg&callback=initMap&libraries=&v=weekly&language=ar&region=SA"
        defer
    ></script>

    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
            text-align: right;
        }
        #map{ width:auto; height: 500px; }

    </style>
    <style>
        .bootstrap-tagsinput .tag {
            background: #8950fc;
            padding: 4px;
            font-size: 14px;
            width: auto;
            border-radius: 0px;
        }
        .bootstrap-tagsinput {
            display: block !important;
        }
        .img-wraps {
            position: relative;
            display: inline-block;

            font-size: 0;
        }
        .img-wraps .closes {
            position: absolute;
            top: 5px;
            right: 8px;
            z-index: 100;
            background-color: #FFF;
            padding: 4px 3px;

            color: #000;
            font-weight: bold;
            cursor: pointer;

            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
            border:1px solid #f64e60;
        }
        .img-wraps:hover .closes {
            opacity: 1;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/image-uploader.min.css">

@endsection
@section('content')

    <form  method="Post" action="{{route('event.update',$event->id)}}" class="formAction" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$event->id}}">
        @method('Patch')

        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-custom">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title"> {{$page_title}} </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">

                        <div class="tab-content">
                            <!--begin::Tab-->
                            <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-xl-12 my-2">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <label class="col-3"></label>
                                            <div class="col-9">
                                                <h6 class="text-dark font-weight-bold mb-10"> {{$page_title}}</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Event Name  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$event->name}}" required name="name" placeholder="أدخل إسم المنتج"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Event Description")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <textarea type="text" name="description" class="form-control form-control-lg form-control-solid"  placeholder="أدخل تفاصيل المنتج">{{$event->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Location * ")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="fa fa-map-marker"></i>
																			</span>
                                                    </div>
                                                    <input type="text" name="location" value="{{$event->location}}"  required class="form-control form-control-lg form-control-solid"  placeholder="location ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Date  * ")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">

                                                    <input type="date" name="date"  required class="form-control form-control-lg form-control-solid"  value="{{$event->date}}" placeholder="Date * ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Time * ")}}</label>
                                            <div class="col-4">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend" style="padding:10px">
                                                        From
                                                    </div>
                                                    <input type="time" name="from" value="{{$event->from}}" required class="form-control form-control-lg form-control-solid"  placeholder="From * ">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend" style="padding: 10px">
                                                        To
                                                    </div>
                                                    <input type="time" name="to" value="{{$event->to}}" required class="form-control form-control-lg form-control-solid"  placeholder="Price * ">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->



                                        <!--end::Group-->


                                        <!--begin::Group-->

                                        <div class="form-group row" >
                                            <div class="col-3 text-lg-right text-left">
                                                <label class="col-form-label  text-lg-right text-left"> {{__("Images * ")}}</label>

                                            </div>
                                            <div class="col-9">
                                                <div class="input-images"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row" >
                                            <div class="col-3 text-lg-right text-left">
                                                <label class="col-form-label  text-lg-right text-left"> {{__("Location on map  ")}}</label>

                                            </div>
                                            <div class="col-9">
                                                <div id="map"></div>
                                                <input type="hidden" id="lng" name="lng">
                                                <input type="hidden" id="lat" name="lat">

                                            </div>
                                        </div>

                                        <!--end::Group-->
                                        <!--begin::Group-->


                                        <div class="card-footer pb-0">
                                            <div class="row">
                                                <div class="col-xl-2"></div>
                                                <div class="col-xl-7">
                                                    <div class="row">
                                                        <div class="col-3"></div>
                                                        <div class="col-9">
                                                            <a href="#" class="btn btn-light-primary btn-update font-weight-bold">{{__("Update")}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>


                        </div>
                    </div>
                </div>
            </div>




            <!--begin::Card body-->
        </div>
    </form>


    <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#customFile").change(function() {
            readURL(this);
        });
        $(document).ready(function(){
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();
        });
        $("#switch1").click(function(){
            var status = $(this).data('status'); //getter
            if($(this).is(':checked')){
                $(this).attr('value',1);
            }else{
                $(this).attr('value',0);
            }
        });
        $("#switch2").click(function(){
            var status = $(this).data('status'); //getter
            if($(this).is(':checked')){
                $(this).attr('value',1);
            }else{
                $(this).attr('value',0);
            }
        });

        $('#exampleSelect-2').change(function () {
            var id = $("#exampleSelect-2").val();
            $.ajax({
                type: 'GEt',
                url: '{{route('getSubCat')}}/'+ id,

                success: function (data) {
                    // the next thing you want to do
                    $('#exampleSelect23').html(data);
                }
            });
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            $("#clear").removeClass("hide");
        };
    </script>
    <script type="text/javascript" src="/image-uploader.min.js"></script>
    <script>
        let preloaded = [
                @foreach($event->images as $img)
            {id: {{$img->id}}, src: '{{$img->img()}}' },
            @endforeach
        ];

        $('.input-images').imageUploader({
            preloaded: preloaded,
        });

    </script>
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script>
        /// preview image befor upload
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img height="180">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#imgs').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });


        // Google
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker?
        var loc = {lat:{{$event->lat}},lng: {{$event->lng}}}
        //Function called to initialize / create the map.
        //This is called when the page has loaded.
        function initMap() {

            //The center location of our map.
            var centerOfMap = new google.maps.LatLng({{$event->lat}}, {{$event->lng}});

            //Map options.
            var options = {
                scaleControl: true,
                center: centerOfMap, //Set center.
                zoom: 7 //The zoom value.
            };

            //Create the map object.
            map = new google.maps.Map(document.getElementById('map'), options);
            var marker = new google.maps.Marker({
                position: loc,
                map: map,
                title: 'Hello World!'
            });
            //Listen for any clicks on the map.
            google.maps.event.addListener(map, 'click', function(event) {
                //Get the location that the user clicked.
                var clickedLocation = event.latLng;
                //If the marker hasn't been added.
                if(marker === false){
                    //Create the marker.
                    marker = new google.maps.Marker({
                        position: clickedLocation,
                        map: map,
                        draggable: true //make it draggable
                    });
                    //Listen for drag events!
                    google.maps.event.addListener(marker, 'dragend', function(event){
                        markerLocation();
                    });
                    // markerLocation();

                } else{
                    //Marker has already been added, so just change its location.

                    marker.setPosition(clickedLocation);
                    google.maps.event.addListener(marker, 'dragend', function(event){
                        markerLocation();
                    });

                }
                document.getElementById('lat').value = clickedLocation.lat(); //latitude
                document.getElementById('lng').value = clickedLocation.lng(); //longitude
                // alert(clickedLocation,document.getElementById('lat'));

                //Get the marker's location.
                markerLocation();
            });
        }

        //This function will get the marker's current location and then add the lat/long
        //values to our textfields so that we can save the location.
        function markerLocation(){
            //Get location.
            var currentLocation = marker.getPosition();
            //Add lat and lng values to a field that we can save.
            alert(currentLocation.lat(),currentLocation.lng());
            document.getElementById('lat').value = currentLocation.lat(); //latitude
            document.getElementById('lng').value = currentLocation.lng(); //longitude
        }


        //Load the map when the page has finished loading.
        google.maps.event.addDomListener(window, 'load', initMap);

    </script>
@endsection

