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

    <form  method="Post" action="{{route('feed.update',$feed->id)}}" class="formAction" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$feed->id}}">
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
                                                <h6 class="text-dark font-weight-bold mb-10">{{__(" Detail Feed ")}}</h6>
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Group-->
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Feed Name  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$feed->name}}" required name="name" placeholder="Feed Name"  type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left">{{__("Feed Sub Title  * ")}}</label>
                                            <div class="col-9">
                                                <input class="form-control form-control-lg form-control-solid" value="{{$feed->sub_title}}" required name="sub_title" placeholder="Feed Sub Title"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3 text-lg-right text-left"> {{__(" Feed description")}}</label>
                                            <div class="col-9">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <textarea type="text" name="text" rows="6" class="form-control form-control-lg form-control-solid"  placeholder="Feed Description">{{$feed->text}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" bis_skin_checked="1">
                                            <label class="col-xl-4 col-lg-3 text-right col-form-label">
                                                {{__("This is  Ads ?")}}</label>
                                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox"@if($feed->is_ads == 1 ) checked @endif name="is_ads">
																			<span></span>
																		</label>
																	</span>
                                            </div>
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
                                                            <a href="#" class="btn btn-light-primary btn-update font-weight-bold">{{__("Save")}}</a>
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
            @foreach($feed->images as $img)
            {id: {{$img->id}}, src: '{{$img->img()}}' },
          @endforeach
        ];

        $('.input-images').imageUploader({
            preloaded: preloaded,
        });

    </script>
@endsection

