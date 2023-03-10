@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}  </div>
                </div>
                <form  method="POST" action="{{route('brand.update',$brand->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$brand->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >Image </label>
                            <img id="blah"  height="90" src="{{asset('qdent/storage/app/'.$brand->img)}}" alt="your image" />

                            <input type="file" name="icon"  id="imgInp" class="form-control">

                        </div>


                <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >Update</button>

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
@endsection

