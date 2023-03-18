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
        #formdiv {
            text-align: center;
        }
        #file {
            color: green;
            padding: 5px;
            border: 1px dashed #123456;
            background-color: #f9ffe5;
        }
        #img {
            width: 17px;
            border: none;
            height: 17px;
            margin-left: -20px;
            margin-bottom: 191px;
        }
        .upload {
            width: 100%;
            height: 30px;
        }
        .previewBox {
            text-align: center;
            position: inherit;
            width: 150px;
            height: 150px;
            margin-right: 10px;
            margin-bottom: 20px;
            float: right;
        }
        .previewBox img {
            height: 150px;
            width: 150px;
            padding: 5px;
            border: 1px solid rgb(232, 222, 189);
        }
        .delete {
            color: red;
            font-weight: bold;
            position: absolute;
            top: 0;
            cursor: pointer;
            width: 20px;
            height:  20px;
            border-radius: 50%;
            background: #ccc;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Material Design Iconic Font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Image Uploader CSS -->
    <link rel="stylesheet" href="{{asset('imageJ/dist/image-uploader.min.css')}}">

    <!-- Image Uploader Js -->
    <script type="text/javascript" src="{{asset('imageJ/dist/image-uploader.min.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">إضافة عقار جديد </div>
                </div>
                <form  method="POST" action="{{route('ads.store')}}" class="formAction" enctype="multipart/form-data"  class="dropzone"
      id="my-amazing-dropzone">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            @if( session()->has('error'))

                                <div class="alert alert-danger" role="alert"> {!! session()->get('error') !!}</div>
                            @endif
                            @if( session()->has('success'))
                                <div class="alert alert-success" role="alert"> {!! session()->get('success') !!}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>الإسم</label>
                            <input type="text" name="name"  required class="form-control" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >الوصف</label>
                            <textarea class="form-control"  required name="description"  rows="3">{{old('description')}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >سياسة المالك</label>
                            <textarea class="form-control"  required name="policy"  rows="3">{{old('policy')}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >نوع العقار</label>
                            <select class="form-control"  required name="category_id">

                                @foreach($categorey as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->name .'( العمولة '.$item->tax .'%)'}}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >المدينة</label>
                            <select class="form-control"  required name="city_id">

                                @foreach($cities as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->name}}
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        <div class="form-group">
                            <label>الحي</label>
                            <input type="text" name="address"  required class="form-control" value="{{old('address')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >آلية الحجز</label>
                            <select class="form-control" id="typeBook" required name="type">


                                <option value="1">
                                    يومي
                                </option>
                                <option value="2">
                                    ساعات
                                </option>


                                <option value="3">
                                    فترات
                                </option>

                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >السعر (ثابت - متغير)</label>
                            <select class="form-control" id="price_type"   name="priceType">


                                <option value="none">
                                    يرجى تحديد آلية السعر
                                </option> <option value="fix">
                                    ثابت
                                </option>
                                <option value="change">
                                    متغير
                                </option>



                            </select>

                        </div>

                        <div class="form-group priceT" id="priceT" style="display: none">
                            <label>السعر
                                <br>
                                (لو كان الحجز يومي السعر يكون لليوم الواحد , لو كان ساعات فالسعر ل ساعة , لو كان لفترات فالسعر لكل فترة)</label>
                            <input type="number" name="price"  class="form-control" value="{{old('price')}}">
                        </div>
                        <div class="form-group priceTD" id="priceTD" style="display: none">

                        <label>سعر العرض (ان لم يكن هناك عرض او خصم اتركه فارغاً )
                                <br>
                                (لو كان الحجز يومي السعر يكون لليوم الواحد , لو كان ساعات فالسعر ل ساعة , لو كان لفترات فالسعر لكل فترة)</label>
                            <input type="number" name="discount_price"  class="form-control" value="{{old('discount_price')}}">
                        </div>



                        <div class="form-group" id="pricePeriodDay" style="display: none">
                            <label>سعر الفترة الصباحية
                               </label>
                            <input type="number" name="priceOnDay"  class="form-control" value="{{old('priceOnDay')}}">
                        </div>
                        <div class="form-group" id="pricePeriodDay1" style="display: none">

                            <label>سعر الفترة المسائية</label>
                            <input type="number" name="priceOnNight"  class="form-control" value="{{old('priceOnNight')}}">
                        </div>




                        <div class="form-group" id="priceDay" style="display: none">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-highlight">
                                <thead>
                                <th>السبت</th>
                                <th>الأحد</th>
                                <th>الإثنين</th>
                                <th>الثلاثاء</th>
                                <th>الاربعاء</th>
                                <th>الخميس</th>
                                <th>الجمعة</th>

                                </thead>
                                <tbody>
                                <tr id="dayPriceFix">
                                    <td><input type="number" class="form-control" name="Sat" placeholder=" أضف السعر" /></td>
                                    <td><input type="number" class="form-control" name="Sun" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Mon" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Tue" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Wed" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Thu" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Fri" placeholder="أضف السعر"  /></td>
                                </tr>

                                <tr id="dayPriceTow" style="display: none">
                                    <td><input type="number" class="form-control" name="Sat2" placeholder=" سعر الفترة الصباحية" /></td>
                                    <td><input type="number" class="form-control" name="Sun2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Mon2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Tues2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Wed2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Thurs2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Fri2" placeholder=" سعر الفترة الصباحية"  /></td>
                                </tr>
                                <tr id="dayPriceThree" style="display:none;">
                                    <td><input type="number" class="form-control" name="Sat3" placeholder=" سعر الفترة المسائية" /></td>
                                    <td><input type="number" class="form-control" name="Sun3" placeholder=" سعر الفترة المسائية"  /></td>
                                    <td><input type="number" class="form-control" name="Mon3" placeholder=" سعر الفترة المسائية"  /></td>
                                    <td><input type="number" class="form-control" name="Tues3" placeholder=" سعر الفترة المسائية"  /></td>
                                    <td><input type="number" class="form-control" name="Wed3" placeholder=" سعر الفترة المسائية"  /></td>
                                    <td><input type="number" class="form-control" name="Thurs3" placeholder=" سعر الفترة المسائية"  /></td>
                                    <td><input type="number" class="form-control" name="Fri3" placeholder=" سعر الفترة المسائية"  /></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>


                        <div class="form-group">
                            <label>العربون</label>
                            <input type="number" name="deposit"  required class="form-control" value="{{old('deposit')}}">
                        </div>
                        <div class="form-group">
                            <label>المساحة (بالمتر)</label>
                            <input type="number" name="space" required class="form-control" value="{{old('space')}}">
                        </div>


                        <div class="form-group">
                            <label for="exampleTextarea" >الصور </label>
{{--                           <input type="file"  class="form-control" required multiple id="imgs" name="imgs[]"  >--}}
{{--                     <input id="file" name="file" type="file" >--}}
                            <div id="formdiv">
                                <div id="filediv">
                                    <input type="file" id="file" name="imgs[]" multiple="multiple" accept="image/*" title="Select Images To Be Uploaded">
                                    <br>
                                </div>
                            </div>
                            <div class="gallery" id="gallary"></div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="exampleTextarea" >العنوان على الخريطة </label>

                            <input type="hidden" id="lng" name="lng" required >
                            <input type="hidden" id="lat" name="lat" required>
                            <div id="map"></div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-save1 mr-2 w-100px p-4 ">إضافة</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
        <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')


    <script src="{{asset('/js/ajax.js')}}"></script>
<script>
    $(function() {
        $('#priceT').hide();
        $('#priceTD').hide();
        $('#priceDay').hide();
        $('#typeBook').change(function() {
            $('#priceT').hide();
            $('#priceTD').hide();
            $('#priceDay').hide();
            $('#pricePeriodDay').hide();
            $('#pricePeriodDay1').hide();
            $("#price_type").prop("selectedIndex", 0);

        });
            $('#price_type').change(function(){
            if($('#typeBook').val() == '3') {
                if ($('#price_type').val() == 'fix') {
                    $('#priceT').hide();
                    $('#priceTD').hide();
                    $('#priceDay').hide();
                    $('#dayPriceTow').hide();
                    $('#dayPriceThree').hide();
                    $('#pricePeriodDay').show();
                    $('#pricePeriodDay1').show();
                    document.getElementsByClassName("priceTD").style.display = "none";
                    document.getElementsByClassName("priceT").style.display = "none";

                } else if ($('#price_type').val() == 'change') {
                    $('#priceT').hide();
                    $('#priceTD').hide();
                    $('#priceDay').show();
                    $('#pricePeriodDay').hide();
                    $('#pricePeriodDay1').hide();
                    $('#dayPriceTow').show();
                    $('#dayPriceThree').show();
                    $('#dayPriceFix').hide();
                }
            }else {
                if ($('#price_type').val() == 'fix') {
                    $('#priceT').show();
                    $('#priceTD').show();
                    $('#priceDay').hide();
                } else if ($('#price_type').val() == 'change') {
                    $('#priceT').hide();
                    $('#priceTD').hide();
                    $('#priceDay').show();
                    $('#dayPriceFix').show();
                    $('#dayPriceTow').hide();
                    $('#dayPriceThree').hide();

                }
            }
        });
    });

    $(function() {
        $('#priceT').hide();
        $('#priceTD').hide();
        $('#priceDay').hide();
        $('#price_type').change(function(){
            if($('#price_type').val() == 'fix') {
                $('#priceT').show();
                $('#priceTD').show();
                $('#priceDay').hide();
            } else if($('#price_type').val() == 'change') {
                $('#priceT').hide();
                $('#priceTD').hide();
                $('#priceDay').show();
            }
        });
    });

    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img height="70">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#file').on('change', function() {
            // $('#gallary').empty()
            $('input[type="file"]').on('change', function() { $(this).append('<input type="file" name="file[]"/>') });

            imagesPreview(this, '#gallary');
        });
    });
</script>
    <script>
        $(function(){
            $("input[type='submit']").click(function(){
                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length)>7){
                    alert("غير مسموح لك برفع أكثر من 7 صور");
                }
            });
        });
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker?

        //Function called to initialize / create the map.
        //This is called when the page has loaded.
        function initMap() {

            //The center location of our map.
            var centerOfMap = new google.maps.LatLng(23.8859, 45.0792);

            //Map options.
            var options = {
                scaleControl: true,
                center: centerOfMap, //Set center.
                zoom: 7 //The zoom value.
            };

            //Create the map object.
            map = new google.maps.Map(document.getElementById('map'), options);

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
                }
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
            // alert(currentLocation.lat(),currentLocation.lng());
            document.getElementById('lat').value = currentLocation.lat(); //latitude
            document.getElementById('lng').value = currentLocation.lng(); //longitude
        }


        //Load the map when the page has finished loading.
        google.maps.event.addDomListener(window, 'load', initMap);

    </script>


@endsection

