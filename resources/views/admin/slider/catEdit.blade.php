@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل السلايدر  </div>
                </div>
                <form  method="POST" action="{{route('slider.update',$slider->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$slider->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="name" value="{{$slider->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الرابط </label>
                            <input type="url" name="url" value="{{$slider->url}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >الصورة </label>
                            <img id="blah"  height="90" src="{{$slider->img()}}" alt="your image" />

                            <input type="file" name="img"  id="imgInp" class="form-control">

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

    <script src="{{asset('/js/ajax.js')}}"></script>
@endsection

