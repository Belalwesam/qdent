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
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/image-uploader.min.css">
@endsection
@section('content')

    <form  method="POST" action="{{route('product.store')}}" class="formAction" enctype="multipart/form-data">
        @csrf
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">Detail Product</div>
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
                                                <h6 class="text-dark font-weight-bold mb-10">{{__(" Detail Product ")}}</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Product Name  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" required name="name" placeholder="Product Name"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Product ID Reference  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" required name="ref_id" placeholder="Product Reference"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Product Description")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <textarea type="text" required name="description" class="form-control form-control-lg form-control-solid"  placeholder="Product Description"></textarea>
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
                                                    <input type="number" name="price"   required class="form-control form-control-lg form-control-solid"  placeholder="Price * ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Price Offer")}}</label>
                                            <div class="col-9">
                                                <span class="text-muted">(optional)</span>

                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
																			<span class="input-group-text">
																				₪
																			</span>
                                                    </div>
                                                    <input type="number" name="price_offer"   class="form-control form-control-lg form-control-solid"  placeholder="Price Offer ">
                                                </div>
                                            </div>
                                        </div>


                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("BarCode ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" required name="barcode" placeholder="Product Name"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Vido  Url")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <input type="text" name="video" required class="form-control form-control-lg form-control-solid"  placeholder="Url of video"></input>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__("Product Stock  ")}}</label>
                                            <div class="col-9">
                                                <span class="text-muted">How many Peices are there?</span>

                                                <div class="input-group input-group-lg input-group-solid">
                                                    <input type="number" required name="stock" class="form-control form-control-lg form-control-solid"  placeholder="How many Peices are there?   ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Category ")}} </label>
                                            <div class="col-9">
                                                <select  name="category_id" required class="form-control" id="exampleSelect2">
                                                        <option  value="">  Category </option>
                                                    @foreach($categories as $item)
                                                        <option  value="{{$item->id}}"> {{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Sub Category  ")}} </label>
                                            <div class="col-9">
                                                <select  name="sub_category_id" required class="form-control" id="exampleSelect23">
                                                        <option value="" > Sub Category </option>
                                                    @include('admin.sub-category.option')
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__(" Brand  ")}} </label>
                                            <div class="col-9">
                                                <select  name="brand_id" class="form-control" id="exampleSelect52">
                                                    <option value="" >  Enter Brand  </option>
                                                    @foreach($brands as $item)
                                                        <option  value="{{$item->id}}"> {{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <!--end::Group-->
                                        <div class="form-group row" bis_skin_checked="1">
                                            <label class="col-xl-4 col-lg-3 text-right col-form-label"> {{__("Would you like to add Product to New Collections?")}}</label>
                                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox" name="is_new">
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
																			<input type="checkbox" name="is_offer">
																			<span></span>
																		</label>
																	</span>
                                            </div>
                                        </div>
                                        <!--begin::Group-->
                                        <div id="attrabiute">
                                        </div>
                                        <div class="form-group row" >
                                            <div class="col-3 text-lg-right text-left">
                                                <label class="col-form-label  text-lg-right text-left"> {{__("Images * ")}}</label>

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
                                                            <a href="#" class="btn btn-light-primary btn-save font-weight-bold">{{__("Save")}}</a>
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
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.my-dropzone", { url: "/file/post" });
    </script>
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

        $('#exampleSelect23').change(function () {
            var id = $("#exampleSelect23").val();
            $.ajax({
                type: 'GEt',
                url: '{{route('product.getSub_attrabiute')}}/'+ id,

                success: function (data) {
                    // the next thing you want to do
                   $('#attrabiute').html(data);
                }
            });
        });

    </script>
    <script type="text/javascript" src="/image-uploader.min.js"></script>
    <script>
        $('.input-images').imageUploader();
    </script>
@endsection

