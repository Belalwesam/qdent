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
                        <h1>القسم الرابع (تحميل التطبيق) </h1>
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="section3_title" value="{{$front->section4_title}}" class="form-control">
                        </div>
                    <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="section3_sub_title" value="{{$front->section4_sub_title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الزر الأول </label>
                            <input type="text" name="section4_btn1_text" value="{{$front->section4_btn1_text}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الرابط للزر الأول </label>
                            <input type="text" name="section4_btn1_url" value="{{$front->section4_btn1_url}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الزر الثاني </label>
                            <input type="text" name="section4_btn2_text" value="{{$front->section4_btn2_text}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الرابط للزر الثاني </label>
                            <input type="text" name="section4_btn2_url" value="{{$front->section4_btn2_url}}" class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
            <h1> (اتصل بنا )القسم الثاني</h1>
                    <div class="form-group">
                            <label for="exampleTextarea" >العنوان</label>
                        <input type="text" name="contact_title" value="{{$front->contact_title}}" class="form-control">
                    </div>
                <div class="form-group">
                            <label for="exampleTextarea" >الوصف</label>
                        <input type="text" name="contact_sub_title" value="{{$front->contact_sub_title}}" class="form-control">
                    </div>
                <hr>
                 <div class="form-group">
                            <label for="exampleTextarea" >العنوان (المكان) </label>
                        <input type="text" name="contact_address_title" value="{{$front->contact_address_title}}" class="form-control">
                    </div>
                <div class="form-group">
                            <label for="exampleTextarea" >وصف النوان </label>
                        <input type="text" name="contact_address_sub_title" value="{{$front->contact_address_sub_title}}" class="form-control">
                    </div>
                <hr>
                        <div class="form-group">
                            <label for="exampleTextarea" >رقم الهاتف</label>
                            <input type="text" name="contact_phone" value="{{$front->contact_phone}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >البريد الإلكتروني </label>
                            <input type="text" name="contact_email" value="{{$front->contact_email}}" class="form-control">
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
                    </div>
                    <div class="card-body">
                    <h1>مواقع التواصل الاجتماعي</h1>
                        <div class="form-group">
                            <label>فيسبوك   </label>
                            <input type="text" name="facebook" value="{{$front->facebook}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>فيسبوك   </label>
                            <input type="text" name="instagram" value="{{$front->instagram}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>فيسبوك   </label>
                            <input type="text" name="whatsapp" value="{{$front->whatsapp}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>فيسبوك   </label>
                            <input type="text" name="snapchat" value="{{$front->snapchat}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>فيسبوك   </label>
                            <input type="text" name="twitter" value="{{$front->twitter}}" class="form-control">
                        </div>
                        </div>
                    <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>

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

