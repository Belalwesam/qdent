@extends('layout.default')
@section('styles')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKAsrWNb6YR0muSYWnc-fqC69j7dY2EOg&callback=initMap&libraries=&v=weekly&language=ar&region=SA"
        defer
    ></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل الحجز  </div>
                </div>
                <form  method="POST" action="{{route('booking.update',$booking->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$booking->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label>اسم العقار</label>
                                <input type="text" name="name" value="{{$booking->property->name ?? null}}" disabled  class="form-control">
                            </div>
                            <div class="form-group">
                                <label>اسم العميل</label>
                                <input type="text" name="name" value="{{$booking->user->name ?? null}}"  disabled class="form-control">
                            </div>

                            <div class="form-group">
                                <label>تاريخ الحجز</label>
                                <input type="date" name="date" value="{{$booking->date}}"   class="form-control">
                                <span style="
    font-size: 8px;
">يرجى التأكد من طرفك من ان الموعد الذي تريد تعديله متاح </span>
                            </div>





                            @if($booking->type == 2)
                                <div class="form-group">
                                    <label>من </label>
                                    <input type="time" name="start_hour" value="{{$booking->start_hour}}"   class="form-control">
                                    <span style="
    font-size: 8px;
">يرجى التأكد من طرفك من ان الموعد الذي تريد تعديله متاح </span>

                                </div>
                                <div class="form-group">
                                    <label>إلى</label>
                                    <input type="time" name="end_hour" value="{{$booking->end_hour}}"   class="form-control">
                                    <span style="
    font-size: 8px;
">يرجى التأكد من طرفك من ان الموعد الذي تريد تعديله متاح </span>

                                </div>
                            @elseif($booking->type == 3)
                                <div class="form-group">
                                    <label for="exampleTextarea" >تغير الفترة</label>

                                    <select class="form-control"  required name="period">

                                        <option value="1" @if($booking->period ==1 ) selected @endif>
                                            فترة صباحية
                                        </option>
                                        <option value="2" @if($booking->period ==2  ) selected @endif>
                                            مسائية
                                        </option>

                                    </select>
                                    <span style="
    font-size: 8px;
">يرجى التأكد من طرفك من ان الموعد الذي تريد تعديله متاح </span>

                                </div>
                            @endif

                            <div class="form-group">
                                <label for="exampleTextarea" >تغير الحالة</label>
                                <span class="label label-lg label-light-{{$booking->span()}} label-inline">{{$booking->arabic()}}</span>

                                <select class="form-control"  required name="status">

                                    <option value="canceled" @if($booking->status == 'canceled' ) selected @endif>
                                        ملغاه
                                    </option>
                                    <option value="completed"  @if($booking->status == 'completed' ) selected @endif>
                                        مكتملة
                                    </option>

                                </select>

                            </div>




                            <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>

            </div>
                        </div>
                    </div>
            </form>

            </div>
    </div>



        <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
    <script>
        // Google
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker?
        var loc = {lat:{{$booking->property->lat}},lng: {{$booking->property->lng}}}
        //Function called to initialize / create the map.
        //This is called when the page has loaded.
        function initMap() {

            //The center location of our map.
            var centerOfMap = new google.maps.LatLng({{$booking->property->lat}}, {{$booking->property->lng}});

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

