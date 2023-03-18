@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل مستخدم  </div>
                </div>
                <form  method="POST" action="{{route('user.update',$user)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>الإسم </label>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>البريد الإلكتروني </label>
                            <input type="email" name="email" value="{{$user->email}}" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف </label>
                            <input type="text" name="phone" value="{{$user->phone}}" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label> المدينة</label>
                            <select  name="city"  class="form-control">
                                {{--                                @dd($user->city1)--}}
                                @if($user->city != null)
                                    <option value="{{$user->city1->id}}">{{$user->city1->name}}</option>
                                @endif
                                @foreach($cities as $item)
                                    @if($item->id != $user->city)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="address" value="{{$user->address}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>كلمة المرور الجديدة </label>
                            <input type="password" name="password" class="form-control">
                        </div>


                <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>
                <div class="toast-container">
                    <div class="alert alert-success d-none" role="alert"></div>
                    <br>
                </div>
            </div>
                </form>
            </div>
        </div>
    </div>


{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--        <div class="card card-custom  gutter-b example example-compact">--}}
{{--            <div class="card-header">--}}
{{--                <div class="card-title"> تغيير كلمة المرور  </div>--}}
{{--            </div>--}}
{{--            <form  method="POST" action="{{route('update1',$user->id)}}" class="formAction">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="id" value="{{$user->id}}">--}}
{{--                @method('Patch')--}}
{{--                <div class="card-body">--}}
{{--                   --}}




{{--                    <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>--}}
{{--                    <div class="toast-container">--}}
{{--                        <div class="alert alert-success d-none" role="alert"></div>--}}
{{--                        <br>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--            </div>--}}



{{--        <div class="toast-container">--}}
{{--        <div class="alert alert-success d-none" role="alert"></div>--}}
{{--    </div>--}}
@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
@endsection

