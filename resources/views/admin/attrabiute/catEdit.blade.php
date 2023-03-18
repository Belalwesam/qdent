@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}   </div>
                </div>
                <form  method="POST" action="{{route('attrabiuteValue.update',$attrabiutValue->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$attrabiutValue->id}}">
@method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$attrabiutValue->name}}" class="form-control">
                        </div>

{{--                         select category--}}
                        <div class="form-group">
                            <label>Category</label>
                            <select name="attribute_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $attrabiutValue->attribute_id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>


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

