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
                    <div class="card-title"> تعديل سعر العقار  </div>
                </div>
                <form  method="POST" action="{{route('update.property.price',$ads)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$ads->id}}">
                    @method('Patch')
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
                            <label>اسم العقار</label>
                            <input type="text" name="name"  required class="form-control" value="{{$ads->name}}" disabled>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-6">
                            <label for="exampleTextarea" >آلية الحجز</label>
                            <select class="form-control"  required name="typesssss" disabled>


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
                        <div class="form-group col-6">
                            <label for="exampleTextarea" >السعر (ثابت - متغير)</label>
                            <select class="form-control" id="price_typess"  disabled name="priceTypess">


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
                        </div>
                        @if($ads->priceType == 'fix' && $ads->type != 3 && $ads->price != null)
                            <div class="form-group">
                                <label>السعر</label>
                                <input type="number" name="price" disabled value="{{$ads->price}}" class="form-control">
                            </div>
                            <div class="form-group">

                                <label>سعر العرض (ان لم يكن هناك عرض او خصم اتركه فارغاً )
                                    <br>
                                    (لو كان الحجز يومي السعر يكون لليوم الواحد , لو كان ساعات فالسعر ل ساعة , لو كان لفترات فالسعر لكل فترة)</label>
                                <input type="number" name="discount_price" disabled  class="form-control" value="{{$ads->discount_price}}">
                            </div>
                        @elseif($ads->priceType == 'fix' && $ads->type == 3)
                            <div class="form-row">

                            <div class="form-group col-6" id="pricePeriodDay12">
                                <label>سعر الفترة الصباحية
                                </label>
                                <input type="number"   disabled class="form-control" value="{{$ads->pricePeriod->day}}">
                            </div>
                            <div class="form-group col-6" id="pricePeriodDay112 " >

                                <label>سعر الفترة المسائية</label>
                                <input type="number"  disabled  class="form-control" value="{{$ads->pricePeriod->night}}">

                            </div>
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
                                        <tr id="dayPriceFix222">
                                            <td>السعر</td>
                                            <td><input type="number" class="form-control" disabled placeholder=" أضف السعر" value="{{$ads->priceDays->first()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر" value="{{$ads->priceDays->first()->Sun}}"  /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر" value="{{$ads->priceDays->first()->Tue}}"  /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Wed}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Thu}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder="أضف السعر"  value="{{$ads->priceDays->first()->Fri}}" /></td>
                                        </tr>
                                    @elseif($ads->type == 3 && $ads->priceType == 'change' )
                                        <tr id="dayPriceTo22w" >
                                            <td>الفترة الصباحية</td>

                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Sun}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية"  value="{{$ads->priceDays->first()->Tue}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Wed}}"  /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Thu}}"  /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة الصباحية" value="{{$ads->priceDays->first()->Fri}}"  /></td>
                                        </tr>

                                        <tr id="dayPriceThree22222" >
                                            <td>الفترة المسائية</td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->last()->Sat}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية"  value="{{$ads->priceDays->first()->Sun}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Mon}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Tue}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Wed}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية" value="{{$ads->priceDays->first()->Thu}}" /></td>
                                            <td><input type="number" class="form-control" disabled placeholder=" سعر الفترة المسائية"  value="{{$ads->priceDays->first()->Fri}}" /></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>


                        @endif

<hr>
                        <div class="form-group">
                        <h5>يرجى تحديد السعر الجديد</h5>
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





                        <div class="form-group priceT " id="priceT" style="display: none">
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

<div class="form-row">
                        <div class="form-group col-6" id="pricePeriodDay" style="display: none">
                            <label>سعر الفترة الصباحية
                               </label>
                            <input type="number" name="priceOnDay"  class="form-control" value="{{old('priceOnDay')}}">
                        </div>
                        <div class="form-group col-6" id="pricePeriodDay1" style="display: none">

                            <label>سعر الفترة المسائية</label>
                            <input type="number" name="priceOnNight"  class="form-control" value="{{old('priceOnNight')}}">
                        </div>
</div>



                        <div class="form-group" id="priceDay" style="display: none">

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
                                <tr id="dayPriceFix">
                                    <td>السعر</td>

                                    <td><input type="number" class="form-control" name="Sat" placeholder=" أضف السعر" /></td>
                                    <td><input type="number" class="form-control" name="Sun" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Mon" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Tue" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Wed" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Thu" placeholder="أضف السعر"  /></td>
                                    <td><input type="number" class="form-control" name="Fri" placeholder="أضف السعر"  /></td>
                                </tr>

                                <tr id="dayPriceTow" style="display: none">
                                    <td> الفترة الصباحية	</td>
                                    <td><input type="number" class="form-control" name="Sat2" placeholder=" سعر الفترة الصباحية" /></td>
                                    <td><input type="number" class="form-control" name="Sun2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Mon2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Tues2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Wed2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Thurs2" placeholder=" سعر الفترة الصباحية"  /></td>
                                    <td><input type="number" class="form-control" name="Fri2" placeholder=" سعر الفترة الصباحية"  /></td>
                                </tr>
                                <tr id="dayPriceThree" style="display:none;">
                                    <td>الفترة المسائية	</td>

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



                        <button type="submit" class="btn btn-primary btn-save1 mr-2 w-100px p-4 ">تعديل </button>
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
        $('#priceT').show();
        $('#priceTD').show();
        $('#priceDay').show();
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


</script>


@endsection

