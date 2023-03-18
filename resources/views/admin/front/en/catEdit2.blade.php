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
                        <h1>القسم الثاني </h1>
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="section2_title" value="{{$front->section2_title}}" class="form-control">
                        </div>
                    <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="section2_sub_title" value="{{$front->section2_sub_title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>رابط الفيديو  </label>
                            <input type="text" name="video_url" value="{{$front->video_url}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>
                        </div>
                    </div>
                    <div class="toast-container">
                        <div class="alert alert-success d-none" role="alert"></div>
                    </div>
                </form>
                <hr>
                @foreach($services as $service)
                <form  method="POST" action="{{route('ar.service',$service)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$front->id}}">

                    @method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="title" value="{{$service->title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>الوصف </label>
                            <input type="text" name="sub_title" value="{{$service->sub_title}}" class="form-control">
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

