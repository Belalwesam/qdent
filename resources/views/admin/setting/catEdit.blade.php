@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> {{$page_title}}   </div>
                </div>
                <form  method="POST" action="{{route('setting.update',$setting->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$setting->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Facebook </label>
                            <input type="text" name="facebook" value="{{$setting->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>WhatsApp </label>
                            <input type="text" name="whatsapp" value="{{$setting->whatsapp}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Instagream </label>
                            <input type="text" name="instagram" value="{{$setting->instagram}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone </label>
                            <input type="text" name="phone" value="{{$setting->phone}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>email </label>
                            <input type="email" name="email" value="{{$setting->email}}" class="form-control">
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
<script>
    import Options from "../../../../node_modules2/bootstrap-switch/docs/options.html";
    export default {
        components: {Options}
    }


    var KTTinymce = function () {
        // Private functions
        var demos = function () {
            tinymce.init({
                selector: '#privacy',
                menubar: false,
                toolbar: ['styleselect fontselect fontsizeselect',
                    'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
                plugins : 'advlist autolink link image lists charmap print preview code'
            });
        }

        return {
            // public functions
            init: function() {
                demos();
            }
        };
    }();

    // Initialization
    jQuery(document).ready(function() {
        KTTinymce.init();
    });
</script>
@endsection

