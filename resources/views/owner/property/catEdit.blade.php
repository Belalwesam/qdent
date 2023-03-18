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
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}  </div>
                </div>
                <form  method="POST" action="{{route('ads.update',$ads->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$ads->id}}">
                    @method('Patch')
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label>الإسم</label>
                                <input type="text" name="name" value="{{$ads->name}}"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea" >الوصف</label>
                                <textarea class="form-control"  required name="description"   rows="3">{{$ads->description}}</textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" >سياسة المالك</label>
                                <textarea class="form-control"  required name="policy"  rows="3"> {{$ads->policy}}</textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" >نوع العقار</label>
                                <select class="form-control"  required name="category_id">
                                    <option value="{{$ads->category->id}}" selected>
                                        {{$ads->category->name}}
                                    </option>
                                    @foreach($categorey as $item)
                                            @if($item->id != $ads->category->id )
                                                <option value="{{$item->id}}">
                                                    {{$item->name}}
                                                </option>
                                            @endif

                                        @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea" >المدينة  </label>
                                <select class="form-control"  required name="city_id">
                                    <option value="{{$ads->city->id}}" selected>
                                        {{$ads->city->name}}
                                    </option>
                                    @foreach($cities as $item)
                                        @if($item->id != $ads->city_id )
                                        <option value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>العنوان</label>
                                <input type="text" name="address"  class="form-control" value="{{$ads->policy}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" >آلية الحجز</label>
                                <select class="form-control"  required name="type" disabled>


                                    <option value="1" @if($ads->type == 1) selected @endif>
                                        يومي
                                    </option>
                                    <option value="2" @if($ads->type == 2) selected @endif>
                                        ساعات
                                    </option>


                                    <option value="3" @if($ads->type == 3) selected @endif>
                                        فترات
                                    </option>

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" >السعر (ثابت - متغير)</label>
                                <select class="form-control" id="price_type"  disabled name="priceType">


                                    <option value="none">
                                        يرجى تحديد آلية السعر
                                    </option> <option value="fix"  @if($ads->priceType == 'fix') selected @endif>
                                        ثابت
                                    </option>
                                    <option value="change"  @if($ads->priceType == 'change') selected @endif>
                                        متغير
                                    </option>



                                </select>


                            </div>
                            <div class="form-group">
                                <span><a href="{{route('edit.ads.price',$ads)}}">لتغيير آلية الحجز ونوع السعر اضغط هنا </a></span>

                            </div>
                            @if($ads->priceType == 'fix' && $ads->type != 3 && $ads->price != null)
                            <div class="form-group">
                                <label>السعر</label>
                                <input type="number" name="price" value="{{$ads->price}}" class="form-control">
                            </div>
                            <div class="form-group">

                                <label>سعر العرض (ان لم يكن هناك عرض او خصم اتركه فارغاً )
                                    <br>
                                    (لو كان الحجز يومي السعر يكون لليوم الواحد , لو كان ساعات فالسعر ل ساعة , لو كان لفترات فالسعر لكل فترة)</label>
                                <input type="number" name="discount_price"  class="form-control" value="{{$ads->discount_price}}">
                            </div>
                        @elseif($ads->priceType == 'fix' && $ads->type == 3 )
                                <div class="form-group" id="pricePeriodDay">
                                    <label>سعر الفترة الصباحية
                                    </label>
                                    <input type="number" name="priceOnDay"  class="form-control" value="{{$ads->pricePeriod->day}}">
                                </div>
                                <div class="form-group" id="pricePeriodDay1" >

                                    <label>سعر الفترة المسائية</label>
                                    <input type="number" name="priceOnNight"  class="form-control" value="{{$ads->pricePeriod->night}}">
                                    <span><a href="{{route('edit.ads.price',$ads)}}">لتغيير آلية الحجز ونوع السعر اضغط هنا </a></span>

                                </div>
                            @elseif($ads->priceType == 'change' && $ads->price == null)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-highlight">
                                        <thead>
                                        <th>#</th>
                                        <th>السبت</th>
                                        <th>الأحد</th>
                                        <th>الإثنين</th>
                                        <th>الثلاثاء</th>
                                        <th>الاربعاء</th>
                                        <th>الخميس</th>
                                        <th>الجمعة</th>

                                        </thead>
                                        <tbody>
                                        @if($ads->type != 3 && $ads->priceType == 'change' && $ads->price == null)
                                        <tr id="dayPriceFix">
                                            <td>السعر</td>
                                            <td><input type="number" class="form-control" name="Sat" placeholder=" أضف السعر" value="{{$ads->priceDays->first()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" name="Sun" placeholder="أضف السعر" value="{{$ads->priceDays->first()->Sun}}"  /></td>
                                            <td><input type="number" class="form-control" name="Mon" placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" name="Tue" placeholder="أضف السعر" value="{{$ads->priceDays->first()->Tue}}"  /></td>
                                            <td><input type="number" class="form-control" name="Wed" placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Wed}}" /></td>
                                            <td><input type="number" class="form-control" name="Thu" placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Thu}}" /></td>
                                            <td><input type="number" class="form-control" name="Fri" placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Fri}}" /></td>
                                        </tr>
                                    @elseif($ads->type == 3)
                                        <tr id="dayPriceTow" >
                                            <td>الفترة الصباحية</td>

                                            <td><input type="number" class="form-control" name="Sat2" placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" name="Sun2" placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Sun}}" /></td>
                                            <td><input type="number" class="form-control" name="Mon2" placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" name="Tues2" placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Tue}}" /></td>
                                            <td><input type="number" class="form-control" name="Wed2" placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Wed}}"  /></td>
                                            <td><input type="number" class="form-control" name="Thurs2" placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Thu}}"  /></td>
                                            <td><input type="number" class="form-control" name="Fri2" placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Fri}}"  /></td>
                                        </tr>

                                        <tr id="dayPriceThree" >
                                            <td>الفترة المسائية</td>
                                            <td><input type="number" class="form-control" name="Sat3" placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->last()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" name="Sun3" placeholder=" سعر الفترة المسائية"  value="{{$ads->priceDays->first()->Sun}}" /></td>
                                            <td><input type="number" class="form-control" name="Mon3" placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" name="Tues3" placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Tue}}" /></td>
                                            <td><input type="number" class="form-control" name="Wed3" placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Wed}}" /></td>
                                            <td><input type="number" class="form-control" name="Thurs3" placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Thu}}" /></td>
                                            <td><input type="number" class="form-control" name="Fri3" placeholder=" سعر الفترة المسائية"  value="{{$ads->priceDays->first()->Fri}}" /></td>
                                        </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>


                        @endif
                                <div class="form-group">
                                <label>العربون</label>
                                <input type="number" name="deposit"  value="{{$ads->deposit}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>المساحة (بالمتر)</label>
                                <input type="number" name="space" value="{{$ads->space}}" class="form-control">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>عدد ايام الحجز (يوم - يومان)</label>--}}
{{--                                <input type="number" name="duration" value=" {{$ads->duration}}" class="form-control">--}}
{{--                            </div>--}}


                            <div class="form-group">
                                <label for="exampleTextarea" >الصور   (إضافة صور) </label>
                                <input type="file"  class="form-control" id="imgs" multiple name="imgs[]"  >
                                <br>
                                <input type="hidden" name="id" value="{{$ads->id}}">
                                <div class="gallery">

                                    @foreach($ads->imgs as $key => $img)

                                        <img height="180" src="{{asset('funny/storage/app/'.$img)}}">
                                    @endforeach
                                </div>

                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="exampleTextarea" >العنوان على الخريطة </label>

                                <input type="hidden" id="lng" name="lng" value="{{$ads->lng}}">
                                <input type="hidden" id="lat" name="lat" value="{{$ads->lat}}">
                                <div id="map"></div>

<br>                                <hr>

                                <div class="form-group">

                                <button type="submit" class="btn btn-primary btn-update mr-2 w-lg-100px p-4 " >تعديل </button>
                                </div>
                                <div class="toast-container">
                                    <div class="alert alert-success d-none" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
                <div class="row">
                    <div class="col-lg-12">

                        <br>
                        <form  method="POST" action="{{route('image.del',$ads->id)}}" class="formAction">
                            @csrf
                            <input type="hidden" name="id" value="{{$ads->id}}">
                            @method('Patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleTextarea" >حذف الصور   (حذف صور) </label>
                                    <br>
                                    <input type="hidden" name="id" value="{{$ads->id}}">
                                    <div class="gallery">

                                        @foreach($ads->imgs as $key => $img)

                                            <img height="180" src="{{asset('funny/storage/app/'.$img)}}">
                                            <input type="checkbox" name="{{$key}}" value="{{$key}}"  >
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-update3 mr-2 w-100px p-4 " >حذف </button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

        @endsection

        @section('scripts')

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
                var loc = {lat:{{$ads->lat}},lng: {{$ads->lng}}}
                //Function called to initialize / create the map.
                //This is called when the page has loaded.
                function initMap() {

                    //The center location of our map.
                    var centerOfMap = new google.maps.LatLng({{$ads->lat}}, {{$ads->lng}});

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

