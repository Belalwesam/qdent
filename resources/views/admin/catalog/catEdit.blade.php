@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}   </div>
                </div>
                <form method="POST" action="{{route('catalog.update',$catalog->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$catalog->id}}">
                    @method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" name="name" value="{{$catalog->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">File : </label>
                            <br>
                            <a id="blah" height="90" class="btn btn-outline-secondary"
                               href="{{asset('qdent/storage/app/'.$catalog->src)}}" alt="your image">
                                <i class="fa fa-file-pdf"></i>
                                DownLoad
                            </a>

                            <br>

                            <input type="file" name="src" id="imgInp" accept=".pdf,.doc" class="form-control">

                        </div>


                        <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 ">Update</button>

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

    {{--    ajax file--}}
    <script src="{{asset('/js/ajax.js')}}"></script>
    <script>
        import Options from "../../../../node_modules2/bootstrap-switch/docs/options.html";

        export default {
            components: {Options}
        }
    </script>
@endsection

