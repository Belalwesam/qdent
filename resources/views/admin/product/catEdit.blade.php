@extends('layout.default')
@section('styles')
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
            border: 1px solid #f64e60;
        }

        .img-wraps:hover .closes {
            opacity: 1;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/image-uploader.min.css">

@endsection
@section('content')

    <form method="Post" action="{{route('product.update',$product->id)}}" class="formAction"
          enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$product->id}}">
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
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Product Name  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"
                                                       value="{{$product->name}}" required name="name"
                                                       placeholder="أدخل إسم المنتج" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Product ID Reference  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"
                                                       value="{{$product->ref_id}}" required name="ref_id"
                                                       placeholder="Product Reference" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Product Description")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <textarea type="text" name="description"
                                                              class="form-control form-control-lg form-control-solid"
                                                              rows="10"
                                                              placeholder="أدخل تفاصيل المنتج">{{$product->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Price * ")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																		<span class="input-group-text">
																				₪
																			</span>
                                                    </div>
                                                    <input type="number" name="price" value="{{$product->price}}"
                                                           required
                                                           class="form-control form-control-lg form-control-solid"
                                                           placeholder="Price ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Price Offer  ")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																		<span class="input-group-text">
																			₪
																			</span>
                                                    </div>
                                                    <input type="number" name="price_offer"
                                                           value="{{$product->price_offer}}" required
                                                           class="form-control form-control-lg form-control-solid"
                                                           placeholder="{{__("Price Offer  ")}}  ">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__("Product Stock  ")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <input type="number" name="stock" value="{{$product->stock}}"
                                                           class="form-control form-control-lg form-control-solid"
                                                           placeholder="How many Peices are there?">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Categoery ")}} </label>
                                            <div class="col-9">
                                                <select name="category_id" class="form-control" id="exampleSelect-2">
                                                    <option value="">Select Categoery</option>
                                                    @foreach($categories as $item)
                                                        <option value="{{$item->id}}"
                                                                @if($product->category_id == $item->id ) selected @endif> {{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("  Sub Categoey  ")}} </label>
                                            <div class="col-9">
                                                <select name="sub_category_id" class="form-control"
                                                        id="exampleSelect23">
                                                    <option value="">Select Sub Categoey</option>
                                                    @foreach($subCategories as $item)
                                                        <option value="{{$item->id}}"
                                                                @if($product->sub_category_id == $item->id ) selected @endif> {{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("  Brand  ")}} </label>
                                            <div class="col-9">
                                                <select name="brand_id" class="form-control" id="exampleSelect52">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $item)
                                                        <option value="{{$item->id}}"
                                                                @if($product->brand_id == $item->id ) selected @endif> {{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("BarCode ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid"
                                                       value="{{$product->barcode}}"
                                                       required name="barcode" placeholder="Product Name" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Vido  Url")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <input type="text" name="video"
                                                           value="{{$product->video}}"
                                                           required
                                                           class="form-control form-control-lg form-control-solid"
                                                           placeholder="Url of video">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <div class="form-group row" bis_skin_checked="1">
                                            <label class="col-xl-4 col-lg-3 text-right col-form-label"> {{__("Would you like to add Product to New Collections?")}}</label>
                                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox"
                                                                                   @if($product->is_new == 1 ) checked
                                                                                   @endif name="is_new">
																			<span></span>
																		</label>
																	</span>
                                            </div>
                                        </div>
                                        <div class="form-group row" bis_skin_checked="1">
                                            <label class="col-xl-4 col-lg-3 text-right col-form-label"> {{__("Would you like to add Product to an Offer?")}}</label>
                                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox"
                                                                                   @if($product->is_offer == 1 ) checked
                                                                                   @endif name="is_offer">
																			<span></span>
																		</label>
																	</span>
                                            </div>
                                        </div>
                                        <!--begin::Group-->

                                        <!--begin::Group-->
                                        @if(count($product->ProductAttrabiute) > 0)
                                            <div id="attrabiute">
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label  text-lg-right text-left" >{{@$product->sub_category->name}} </label>
                                                    <div class="col-9 col-form-label">
                                                        <div class="checkbox-inline">
                                                            @foreach($category_attr as $attr)
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="attr[{{$attr->id}}][{{$attr->id}}]" {{ in_array($attr->id, $product->ProductAttrabiute->pluck('attribute_id')->toArray()) ? 'checked' : '' }}>
                                                                    <span></span>{{$attr->name}}</label>
                                                            @endforeach
                                                        </div>
                                                        <span class="form-text text-muted">Seletct {{$attr->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div id="attrabiute">
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <div class="col-3 text-lg-right text-left">
                                                <label class="col-form-label  text-lg-right text-left"> {{__("Gallery * ")}}</label>

                                            </div>
                                            <div class="col-9">
                                                <div class="input-images"></div>
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
                                                            <a href="#"
                                                               class="btn btn-light-primary btn-update font-weight-bold">{{__("Update")}}</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
            integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
            crossorigin="anonymous"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#customFile").change(function () {
            readURL(this);
        });
        $(document).ready(function () {
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();
        });
        $("#switch1").click(function () {
            var status = $(this).data('status'); //getter
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
            } else {
                $(this).attr('value', 0);
            }
        });
        $("#switch2").click(function () {
            var status = $(this).data('status'); //getter
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
            } else {
                $(this).attr('value', 0);
            }
        });

        $('#exampleSelect-2').change(function () {
            var id = $("#exampleSelect-2").val();
            $.ajax({
                type: 'GEt',
                url: '{{route('getSubCat')}}/' + id,

                success: function (data) {
                    // the next thing you want to do
                    $('#exampleSelect23').html(data);
                }
            });
        });

        $('#exampleSelect23').change(function () {
            var id = $("#exampleSelect23").val();
            console.log(id)
            $.ajax({
                type: 'GEt',
                url: '{{route('product.getSub_attrabiute')}}/'+ id,

                success: function (data) {
                    // the next thing you want to do
                    $('#attrabiute').html(data);
                }
            });
        });

        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            $("#clear").removeClass("hide");
        };
    </script>
    <script type="text/javascript" src="/image-uploader.min.js"></script>
    <script>
        let preloaded = [
                @foreach($product->images as $img)
            {
                id: {{$img->id}}, src: '{{$img->img()}}'
            },
            @endforeach
        ];

        $('.input-images').imageUploader({
            preloaded: preloaded,
        });

    </script>
@endsection

