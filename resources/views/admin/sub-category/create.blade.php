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
                    <div class="card-title">{{$page_title}} </div>
                </div>
                <form  method="POST" action="{{route('subcategory.store')}}" class="formAction">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select  name="category_id"  class="form-control">
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group row" bis_skin_checked="1">
                            <label class="col-xl-4 col-lg-3  col-form-label">
                                {{__("HighLight !?")}}</label>
                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox" name="highlight">
																			<span></span>
																		</label>
																	</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleTextarea" >Icon </label>
                            <img id="blah"  height="90" src="https://lunawood.com/wp-content/uploads/2018/02/placeholder-image.png" alt="your image" />

                            <input type="file" name="icon"  id="imgInp" class="form-control">

                        </div>


                        <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">Add</button>
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

