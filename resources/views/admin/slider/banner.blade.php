@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}} </div>
                </div>
                <form  method="POST" action="{{route('banner.update',$type )}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$slider->id ?? null}}">
                    <input type="hidden" name="type" value="{{$type}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>الرابط </label>
                            <input type="url" name="url" value="{{$slider->url ?? null}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >الصورة </label>
                            <img id="blah"  height="90" src="{{asset('/storage/app/'.($slider->icon ?? null))}}" alt="your image" />

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

