@extends('layout.default')
@section('styles')
    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">إضافة سلايدر  جديد </div>
                </div>
                <form  method="POST" action="{{route('slider.store')}}" class="formAction">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>عنوان السلايدر</label>
                            <input type="text" name="name"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>رابط السلايدر  </label>
                            <input type="url" name="url"  class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >الصورة </label>
                            <img id="blah"  height="90" src="https://lunawood.com/wp-content/uploads/2018/02/placeholder-image.png" alt="your image" />

                            <input type="file" name="img"  id="imgInp" class="form-control" required>

                        </div>







                        <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">إضافة</button>
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
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {


        } )

    .catch( error => {
            console.error( error );
        } );
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

