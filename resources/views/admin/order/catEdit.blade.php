@extends('layout.default')
@section('styles')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKAsrWNb6YR0muSYWnc-fqC69j7dY2EOg&callback=initMap&libraries=&v=weekly&language=ar&region=SA"
        defer
    ></script>
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
        #map{ width:auto; height: 350px; }

    </style>
@endsection
@section('content')

    <form  method="Post" action="{{route('orders.update',$order->id)}}" class="formAction" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$order->id}}">
        @method('Patch')

        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-custom">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title"> Order Details </div>
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
                                                <h6 class="text-dark font-weight-bold mb-10">{{__("  Edit Order")}}</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Name   ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->name}}" required name="name" placeholder="أدخل إسم المنتج"  type="text">
                                                <input type="hidden" name="firstName" value="{{$order->name}}">
                                                <input type="hidden" name="lastName" value="{{$order->name}}">
                                            </div>
                                        </div>
                                             <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" Phone ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->phone}}" required name="phone" \ type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" Email")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->email}}" required name="email" \ type="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" Address")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->street_address}}" required name="street_address" \ type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" address line2")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->address_line2}}" required name="address_line2" \ type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" city")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->city}}" required name="city" \ type="text">
                                            </div>
                                        </div>
                                 <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" state")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->state}}" required name="state" \ type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" country")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->country}}" required name="country" \ type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" ZIP  ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->zip}}" required name="zip" \ type="text">
                                            </div>
                                        </div> <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" nearby  ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$order->nearby}}" required name="nearby" \ type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" Created At ")}}</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control"  disabled name="day" value="{{$order->created_at->format('d-m-Y')}}" id="day" placeholder="" required="">
                                            </div>
                                        </div>


                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Payment Status")}}</label>
                                            <div class="col-9">

                                            <select class="form-control" id="payment_status" name="payment_status" required="">
                                        <option value="paid" @if($order->payment_status == 'paid') selected @endif >Paid</option>
                                        <option value="unpaid" @if($order->payment_status == 'unpaid') selected @endif > UNPAID</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("  Status")}}</label>
                                            <div class="col-9">

                                            <select class="form-control" id="status" name="status" required="">
                                                <option value="pending" @if($order->status == 'pending') selected @endif >pending </option>
                                                <option value="processing" @if($order->status == 'processing') selected @endif >processing</option>
                                                <option value="delivered" @if($order->status == 'delivered') selected @endif >delivered</option>
                                                <option value="completed" @if($order->status == 'completed') selected @endif >completed</option>
                                                <option value="canceled" @if($order->status == 'canceled') selected @endif >canceled </option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="card-footer pb-0">
                                            <div class="row">
                                                <div class="col-xl-2"></div>
                                                <div class="col-xl-7">
                                                    <div class="row">
                                                        <div class="col-3"></div>
                                                        <div class="col-9">
                                                            <a href="#" class="btn btn-light-primary btn-update font-weight-bold">{{__("Update")}}</a>
                                                            <a href="#" class="btn btn-clean font-weight-bold">{{__("cancele")}}</a>
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

    <div class="row " style="margin-top: 20px">
    <div class="col-lg-12">

        <div class="card card-custom">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title"> Order Details </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body">
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0" bis_skin_checked="1">
                    <div class="col-md-10" bis_skin_checked="1">
                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase"> Products</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Quntaity</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">  Unit price</th>
                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->carts->items as $cart)
                                    <tr class="font-weight-boldest">
                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light" bis_skin_checked="1">

                                            </div>
                                            <!--end::Symbol-->
                                            {{$cart->product->name ?? ' Product deleted'}}</td>
                                        <td class="text-right pt-7 align-middle">{{$cart->qty}}</td>
                                        <td class="text-right pt-7 align-middle">
                                            {{$cart->price}}
                                            <smal>	₪</smal>
                                        </td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">
                                            {{$cart->total}}
                                            <smal>	₪</smal>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0" bis_skin_checked="1">
                    <div class="col-md-10" bis_skin_checked="1">
                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase"> Status</th>
                                    <th class="font-weight-bold text-muted text-uppercase"> Shipping</th>
                                    <th class="font-weight-bold text-muted text-uppercase"> Created at </th>
                                    <th class="font-weight-bold text-muted text-uppercase text-right">Total </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="font-weight-bolder">
                                    <td>{{$order->payment()}}</td>

                                    <td>
                                        @if($order->shipping_method != null)
                                            {{$order->shipping_method->name ??  'n'}}

                                        @endif
                                    </td>
                                    <td>{{$order->created_date()}}</td>
                                    <td class="text-primary font-size-h3 font-weight-boldest text-right">
                                        {{$order->total}}
                                        <smal>	₪</smal>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
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
    </script>
    <script>
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker?
        var lat = {{$order->user_lat}};
        var lng = {{$order->user_lng}};
        var loc = {lat:lat,lng: lng}

        //Function called to initialize / create the map.
        //This is called when the page has loaded.
        function initMap() {

            //The center location of our map.
            var centerOfMap = new google.maps.LatLng({{$user->shipping->lat ?? '24.774265'}}, {{$user->shipping->lng ?? '46.738586'}});

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
                } else{
                    //Marker has already been added, so just change its location.
                    marker.setPosition(clickedLocation);
                    google.maps.event.addListener(marker, 'dragend', function(event){
                        markerLocation();
                    });
                }
                //Get the marker's location.
                document.getElementById('lat').value = clickedLocation.lat(); //latitude
                document.getElementById('lng').value = clickedLocation.lng(); //longitude
                markerLocation();
            });
        }

        //This function will get the marker's current location and then add the lat/long
        //values to our textfields so that we can save the location.
        function markerLocation(){
            //Get location.
            var currentLocation = marker.getPosition();
            //Add lat and lng values to a field that we can save.
            // alert(currentLocation.lat(),currentLocation.lng());
            document.getElementById('lat').value = currentLocation.lat(); //latitude
            document.getElementById('lng').value = currentLocation.lng(); //longitude
        }


        //Load the map when the page has finished loading.
        google.maps.event.addDomListener(window, 'load', initMap);




        $(document).ready(function() {
            $('#Date').datepicker({
                onSelect: function(dateText, inst) {
                    //Get today's date at midnight
                    var today = new Date();
                    today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
                    //Get the selected date (also at midnight)
                    var selDate = Date.parse(dateText);

                    if(selDate < today) {
                        //If the selected date was before today, continue to show the datepicker
                        $('#Date').val('');
                        $(inst).datepicker('show');
                    }
                }
            });
        });

        function periodChange(){
            var id = $("#period").val();
            $.ajax({
                type: 'GEt',
                url: '/period/get/'+ id,

                success: function (data) {
                    // the next thing you want to do
                    $('#time_pick').attr('min',data.from);
                    $('#time_pick').attr('max',data.to);
                }
            });


        }



    </script>

@endsection

