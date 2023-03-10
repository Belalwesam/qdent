@extends('layout.default')
@section('styles')
    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
            text-align: right;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل   </div>
                </div>
                <form  method="POST" action="{{route('paymentMethod.update',$paymentMethod->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$paymentMethod->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>الإسم </label>
                            <input type="text" name="name" value="{{$paymentMethod->name}}" class="form-control">
                        </div>

                        <div class="form-group row" bis_skin_checked="1">
                            <label class="col-3 col-form-label">الحالة</label>
                            <div class="col-3" bis_skin_checked="1">
															<span class="switch switch-outline switch-icon switch-info">
																<label>
																	<input type="checkbox" @if($paymentMethod->status == 01 )checked @endif name="status">
																	<span></span>
																</label>
															</span>
                            </div>

                        </div>
                            <div class="form-group">
                                <label>المحتوى </label>
                                <textarea id="summernote" name="description">{{$paymentMethod->description}}</textarea>
                            </div>



                            <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >تعديل</button>

            </div>
            </form>

            </div>
    </div>



        <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

        @section('scripts')
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
            </script>
            <script src="{{asset('/js/ajax.js')}}"></script>
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

                $("#imgInp").change(function() {
                    readURL(this);
                });
            </script>
@endsection
