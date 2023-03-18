@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل مستخدم  </div>
                </div>
                <form  method="POST" action="{{route('email.store')}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$email->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>البريد الإلكتروني </label>
                            <input type="email" disabled   value="{{$email->email}}"  class="form-control">
                            <input type="hidden"   name="email" value="{{$email->email}}"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label>العنوان  </label>
                            <input type="text"  name="title"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label>الموضوع  </label>
                            <textarea type="text"  name="msg"  row="5" class="form-control"></textarea>
                        </div>







                        <button type="submit" class="btn btn-primary  btn-save mr-2 w-100px p-4 " >إرسال</button>

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

