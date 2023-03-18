@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}  </div>
                </div>
                <form  method="POST" action="{{route('subcategory.update',$sub_Category)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$sub_Category->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$sub_Category->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label> Parent Category}</label>
                            <select  name="category_id"  class="form-control">
                                <option value="{{$sub_Category->category->id}}">{{$sub_Category->category->name}}</option>

                            @foreach($categories as $item)
                                @if($item->id != $sub_Category->category->id)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row" bis_skin_checked="1">
                            <label class="col-xl-4 col-lg-3  col-form-label">
                                {{__("HighLight !?")}}</label>
                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox" @if($sub_Category->highlight == 1) checked @endif name="highlight">
                                                                            <span></span>
																		</label>
																	</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >Icon :  </label>
                            <img id="blah"  height="90" src="{{asset('qdent/storage/app/'.$sub_Category->icon)}}" alt="your image" />

                            <input type="file" name="icon"  id="imgInp" class="form-control">

                        </div>

                <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >update</button>
                <div class="toast-container">
                    <div class="alert alert-success d-none" role="alert"></div>
                    <br>
                </div>
            </div>

            </form>
            </div>
            </div>
    </div>




@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
@endsection

