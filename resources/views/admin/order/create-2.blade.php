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

    <form  method="POST" action="{{route('order.store')}}" class="formAction" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-custom">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">اضافة طلب  </div>
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
                                                <h6 class="text-dark font-weight-bold mb-10">{{__(" اضافة الطلب")}}</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("إسم صاحب الطلب ")}}</label>
                                            <div class="col-3">
                                                <input class="form-control form-control-lg form-control-solid"  required name="firstName" placeholder="أدخل إسم الأول"  type="text">
                                            </div>
                                            <div class="col-3">

                                                <input class="form-control form-control-lg form-control-solid"  required name="lastName" placeholder="أدخل إسم الأخير"  type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("رقم صاحب الطلب")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"  required name="phone" \ type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("البريد الإلكتروني")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"  required name="email" \ type="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" العنوان")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"  required name="address" \ type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" العنوان على الخريطة")}}</label>
                                            <div class="col-9">
                                                <div class="map" id="map" bis_skin_checked="1">
                                                </div>
                                                <input type="hidden"  name="lat" id="lat">
                                                <input type="hidden" name="lng" id="lng">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" المدينة")}}</label>
                                            <div class="col-9">

                                                <select class="form-control"  name="shippingmethod_id" id="shippingmethod_id" required="">
                                                    @foreach(\App\Model\ShippingMethod::all() as $item )
                                                        <option value="{{$item->id}}" >{{$item->name}} -- {{$item->price()}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" المدينة")}}</label>
                                            <div class="col-9">

                                                <select class="form-control"  name="city_id" id="city_id" required="">
                                                    @foreach(\App\Model\City::all() as $item)
                                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" المنطقة")}}</label>
                                            <div class="col-9">

                                                <select class="form-control" id="region_id" name="region_id" required="">
                                                    <option value="">يرجى تحديد المنطقة</option>
                                                    @foreach( \App\Model\Region::all() as $item)
                                                        <option value="1"  value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" الرمز البريدي ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" required name="zip" \ type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" تاريخ توصيل الطلب ")}}</label>
                                            <div class="col-9">
                                                <input type="date" class="form-control"  name="day"  id="day" placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("الفترة ")}}</label>
                                            <div class="col-9">
                                                <select class="form-control"  id="exampleSelect-2"  onchange="periodChange()" name="period_id" required="">
                                                    <option value=""> فترة التوصيل</option>
                                                    @foreach( \App\Model\Period::all() as $item)
                                                        <option value="{{$item->id}}"  >{{$item->name}}
                                                            (تبدأ من
                                                            {{$item->from}}
                                                            إلى
                                                            {{$item->to}}
                                                            )

                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("الساعة ")}}</label>
                                            <div class="col-9">

                                                <input type="time" min="07:59:00"  max="23:59:00"  class="form-control form-control-lg form-control-solid" name="time" id="time_pick" placeholder="" required="">
                                            </div>
                                        </div>





                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" حالة الدفع")}}</label>
                                            <div class="col-9">

                                                <select class="form-control" id="payment_status" name="payment_status" required="">
                                                    <option value="paid"  >مدفوعة</option>
                                                    <option value="unpaid"  >غير مدفوعة</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" حالة الطلب")}}</label>
                                            <div class="col-9">

                                                <select class="form-control" id="status" name="status" required="">
                                                    <option value="pending"  >بإنتظار القبول </option>
                                                    <option value="accepted"  >مقبولة بإنتظار التنفيذ</option>
                                                    <option value="complete"  >مكتملة</option>
                                                    <option value="canceled"  >ملغاة </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" حالة توصيل الطلب")}}</label>
                                            <div class="col-9">

                                                <select class="form-control" id="status" name="delivery_status" required="">
                                                    <option value="placed" >استلام الطلب  </option>
                                                    <option value="accepted">الطلب مقبول  </option>
                                                    <option value="packed" >الطلب جاهز للشحن</option>
                                                    <option value="shipped" >الطلب مشحون </option>
                                                    <option value="delivered" >الطلب واصل  </option>
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
                                                            <a href="#" class="btn btn-light-primary btn-update font-weight-bold">{{__("حفظ")}}</a>
                                                            <a href="#" class="btn btn-clean font-weight-bold">{{__("إلغاء")}}</a>
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

