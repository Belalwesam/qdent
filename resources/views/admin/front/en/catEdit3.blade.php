@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل الواجهة الرئيسية  </div>
                </div>

                <form  method="POST" action="{{route('ar.post')}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$front->id}}">
@method('Patch')
                    <div class="card-body">
                        <h1>الأسئلة الشائعة </h1>
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="section3_title" value="{{$front->section3_title}}" class="form-control">
                        </div>
                    <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="section3_sub_title" value="{{$front->section3_sub_title}}" class="form-control">
                        </div>


                    </div>
                    <div class="toast-container">
                        <div class="alert alert-success d-none" role="alert"></div>
                    </div>
                </form>
                <hr>
                <form  method="POST" action="{{route('ar.question.create')}}" class="formAction">
                    @csrf

                    <div class="card-body">
                        <h2>
                            اضافة سؤال
                        </h2>
                        <div class="form-group">
                            <label>السؤال </label>
                            <input type="text" name="title"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="sub_title"  class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-save1 mr-2 w-100px p-4 " >حفظ</button>
                        </div>
                    </div>

                </form>

                <hr>
                <h1>
                    الأسئلة
                </h1>
                @foreach($questions as $question)
                <form  method="POST" action="{{route('ar.question',$question)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$question->id}}">

                    @method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>السؤال </label>
                            <input type="text" name="title" value="{{$question->title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="sub_title" value="{{$question->sub_title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-update2 mr-2 w-100px p-4 " >حفظ</button>
                        </div>
                    </div>

                </form>

                    <hr>
                @endforeach
            </div>

    </div>




@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
@endsection

