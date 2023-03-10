@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}   </div>
                </div>
                <form  method="POST" action="{{route('shippingmethod.update',$shippingMethod->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$shippingMethod->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$shippingMethod->name}}" class="form-control">
                        </div>
                         <div class="form-group">
                            <label>Price </label>
                            <input type="number" name="price" value="{{$shippingMethod->price}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Estimated time of arrival in days</label>
                            <input type="text" name="days" value="{{$shippingMethod->days}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description </label>
                            <textarea name="description" class="form-control">{{$shippingMethod->description}}</textarea>
                        </div>

                        <div class="form-group row" bis_skin_checked="1">
                            <label class="col-xl-4 col-lg-3  col-form-label">
                                {{__("Status !?")}}</label>
                            <div class="col-lg-8 col-xl-6" bis_skin_checked="1">
																	<span class="switch">
																		<label>
																			<input type="checkbox"@if($shippingMethod->status == 1 ) checked @endif name="status">
																			<span></span>
																		</label>
																	</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleTextarea" >Image :  </label>
                            <img id="blah"  height="90" src="{{asset('qdent/storage/app/'.$shippingMethod->img)}}" alt="your image" />

                            <input type="file" name="img"  id="imgInp" class="form-control">

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

