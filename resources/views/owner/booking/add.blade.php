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
                    <div class="card-title">إضافةحجز لعقار -{{$ads->name}}- </div>
                </div>
                <form  method="POST" action="{{route('booking.store')}}" class="formAction">

                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            @if( session()->has('error'))
                                <div class="alert alert-danger" role="alert"> {!! session()->get('error') !!}</div>
                            @endif
                            @if( session()->has('success'))
                                <div class="alert alert-success" role="alert"> {!! session()->get('success') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>التاريخ</label>
                            <input type="date" name="date"  class="form-control" required>
                        </div>

                        @if($ads->type == 2 )
                            <div class="form-group">
                                <label>يبدأ من ساعة</label>
                                <input type="time" name="start_hour"  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>ينتهى في الساعة</label>
                                <input type="time" name="end_hour"  class="form-control" required>
                            </div>
                        @elseif($ads->type == 3)
                            <div class="form-group">
                                <label>الفترة</label>
                                <select class="form-control"  required name="type" required>


                                    <option value="1">
                                        فترة صباحية
                                    </option>
                                    <option value="2">
                                        مسائية
                                    </option>



                                </select>
                            </div>
                        @endif




                    </div>
                    <div class="card-body">
                            <div class="card-title">بيانات العميل</div>
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input type="text" name="name"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" name="phone"  class="form-control" required>
                        </div>




<input type="hidden" name="id" value="{{$ads->id}}">


                    <div class="card-body">

                    <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">إضافة</button>
                    </div>
                    </div>
                </form>
                <div class="toast-container">
                    <div class="alert alert-success d-none" role="alert"></div>
                </div>
            </div>
        </div>

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

