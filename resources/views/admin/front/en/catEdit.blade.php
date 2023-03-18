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
                        <h1>القسم الأول </h1>
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="header_Title" value="{{$front->header_Title}}" class="form-control">
                        </div>
                    <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="header_subTitle" value="{{$front->header_subTitle}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الزر الأول </label>
                            <input type="text" name="header_btn1" value="{{$front->header_btn1}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الرابط للزر الأول </label>
                            <input type="text" name="header_btn1_url" value="{{$front->header_btn1_url}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الزر الثاني </label>
                            <input type="text" name="header_btn2" value="{{$front->header_btn2}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الرابط للزر الثاني </label>
                            <input type="text" name="header_btn2_url" value="{{$front->header_btn2_url}}" class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
            <h1>القسم الثاني</h1>
                    <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  1 | (العنوان) </label>
                        <input type="text" name="icon_1_icon" value="{{$front->icon_1_icon}}" class="form-control">
                    </div>
                <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  1 | (الوصف) </label>
                        <input type="text" name="icon_1_icon" value="{{$front->icon_1_text}}" class="form-control">
                    </div>
                <hr>
                 <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  2 | (العنوان) </label>
                        <input type="text" name="icon_2_icon" value="{{$front->icon_2_icon}}" class="form-control">
                    </div>
                <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  2 | (الوصف) </label>
                        <input type="text" name="icon_2_icon" value="{{$front->icon_2_text}}" class="form-control">
                    </div>
                <hr>
                        <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  3 | (العنوان) </label>
                            <input type="text" name="icon_3_icon" value="{{$front->icon_3_icon}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >ايقونة 2 | (الوصف) </label>
                            <input type="text" name="icon_3_icon" value="{{$front->icon_3_text}}" class="form-control">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="exampleTextarea" >ايقونة  4 | (العنوان) </label>
                            <input type="text" name="icon_4_icon" value="{{$front->icon_4_icon}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >ايقونة 4 | (الوصف) </label>
                            <input type="text" name="icon_4_icon" value="{{$front->icon_4_text}}" class="form-control">
                        </div>
                        <hr>

                <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>

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

