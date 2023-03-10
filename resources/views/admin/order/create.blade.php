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
    <form  method="POST" action="{{route('orders.store')}}" class="formAction" enctype="multipart/form-data">
        @csrf
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">{{$page_title}}   </div>
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
                                            <h6 class="text-dark font-weight-bold mb-10">{{__("  Add Order")}}</h6>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <table class="table table-bordered table-hover" id="kt_datatable">
                                            <thead>
                                            <th>
                                                <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                    <input type="checkbox"  id="selectAll" name="check">
                                                    <span style="top: -22px;"></span>

                                                </label>
                                            </th>
                                                <th> #</th>
                                                <th>Name</th>
                                                <th>Qty </th>

                                                <th>Total</th>

                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr class="deleted-row-{{$product->id}}">
                                                    <td> <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                            <input type="checkbox" value="{{$product->id}}" id="select" name="check[{{$product->id}}][id]]">
                                                            <span></span>
                                                        </label></td>
                                                    <td>{{$product->id}}</td>
                                                    <td>{{$product->name}}
                                                    </td>
                                                    <td>
                                                        <input class="form-control qty form-control-lg form-control-solid"  value="0" required name="check[{{$product->id}}][qty]]" data-price="{{$product->price}}" id="qty" data-id="{{$product->id}}" type="number">
                                                        <input  name="check[{{$product->id}}][total]]"  value="{{$product->price}}"  id="total-val-{{$product->id}}" required   type="hidden">

                                                    </td>
                                                    <Td id="total-{{$product->id}}">
                                                        {{$product->price}}

                                                    </Td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                            <!--end::Row-->
                        </div>


                    </div>
                </div>
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
                                            <h6 class="text-dark font-weight-bold mb-10">{{__(" Add Order")}}</h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Name ")}}</label>
                                        <div class="col-3">
                                            <input class="form-control form-control-lg form-control-solid"  required name="firstName" placeholder="أدخل إسم الأول"  type="text">
                                        </div>
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Lastname ")}}</label>

                                        <div class="col-3">

                                        <input class="form-control form-control-lg form-control-solid"  required name="lastName" placeholder="أدخل إسم الأخير"  type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__("  Phone")}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"  required name="phone" \ type="text">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Email")}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"  required name="email" \ type="email">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Shipping Method ")}}</label>
                                        <div class="col-9">

                                            <select class="form-control"  name="shippingmethod_id" id="shippingmethod_id" required="">
                                                @foreach(\App\Model\ShippingMethod::all() as $item )
                                                <option value="{{$item->id}}" >{{$item->name}} -- {{$item->price}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" city")}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"  required name="city" \ type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" country")}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid"  required name="country" \ type="text">


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Zip  ")}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid" required name="zip" \ type="text">
                                        </div>
                                    </div>



                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__("  Status")}}</label>
                                        <div class="col-9">

                                            <select class="form-control" id="payment_status" name="payment_status" required="">
                                                <option value="paid"  >Paid</option>
                                                <option value="unpaid"  > UnPaid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{__(" Status ")}}</label>
                                        <div class="col-9">

                                            <select class="form-control" id="status" name="status" required="">
                                                <option value="pending"  > pending </option>
                                                <option value="dispatch"  > dispatch </option>
                                                <option value="dispatched"  > dispatched </option>
                                                <option value="complete"  >complete</option>
                                                <option value="canceled"  >canceled </option>
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
                                                        <a href="#" class="btn btn-light-primary btn-save font-weight-bold">{{__("Cerate")}}</a>
                                                        <a href="#" class="btn btn-clean font-weight-bold">{{__("Cancaled")}}</a>
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
        $('#selectAll').click(function (e) {
            $('input:checkbox').prop('checked', this.checked);
        });


        $('.qty').change(function (e) {
            elment =  $(this);
            id = elment.data('id');
            price = elment.data('price');
            qty = elment.val();
            $('#total-'+id).html(price * qty );
            $('#total-val-'+id).val(price * qty );
        });


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


        $('#exampleSelect2').change(function () {
            var id = $("#exampleSelect2").val();
            $.ajax({
                type: 'GEt',
                url: '{{route('getSubCat')}}/'+ id,

                success: function (data) {
                    // the next thing you want to do
                   $('#exampleSelect23').html(data);
                }
            });
        });

    </script>
    <script>
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker?
        @if(isset($order))
        var loc = {lat:{{$user->shipping->lat ?? ''}},lng: {{$user->shipping->lng ?? ''}}}
        @endif

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
                @if(isset($order))

                position: loc,
                @endif
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

