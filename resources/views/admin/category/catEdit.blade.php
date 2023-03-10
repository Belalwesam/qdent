@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}   </div>
                </div>
                <form  method="POST" action="{{route('category.update',$category->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$category->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Type </label>
                            <select class="form-control"  required name="type">
                                <option value="dental" @if($category->type=='dental') selected @endif>Dental Products</option>

                                <option value="lab"@if($category->type=='lab') selected @endif>Lab technician</option>

                            </select>
                        </div>

                        <div class="form-group row" bis_skin_checked="1">
                            <label class="col-xl-4 col-lg-3  col-form-label">
                                {{__("HighLight !?")}}</label>
                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox"@if($category->highlight == 1 ) checked @endif name="highlight">
																			<span></span>
																		</label>
																	</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleTextarea" >Icon :  </label>
                            <img id="blah"  height="90" src="{{asset('qdent/storage/app/'.$category->icon)}}" alt="your image" />

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

<script>
    import Options from "../../../../node_modules2/bootstrap-switch/docs/options.html";
    export default {
        components: {Options}
    }
</script>
<script src="{{asset('/js/ajax.js')}}"></script>
@endsection

