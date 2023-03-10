@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title"> تعديل الكوبون  </div>
                </div>
                <form  method="POST" action="{{route('coupon.update',$coupon)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$coupon->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>كود الخصم  مثل : (Funny2020)</label>
                            <input type="text" name="code"  class="form-control" value="{{$coupon->code}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >العقار التابع لهذا الكود</label>
                            <select class="form-control"   name="ads_id">
                                <option value="none">
                                    يرجى تحديد العقار الذي تريد تطبيق هذا الكود عليه
                                </option>

                                @foreach($ads as $ad)
                                    <option value="{{$ad->id}}" @if($coupon->ads->id == $ad->id) selected @endif > {{$ad->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" > نوع الخصم (مبلغ ثابت - نسبة مئوية من قيمة حجز العقار)</label>
                            <select class="form-control" id="type"    name="type">
                                <option value="none">
                                    يرجى تحديد نوع الخصم
                                </option>
                                <option value="amount" @if($coupon->type == 'amount') selected @endif >مبلغ ثابت</option>
                                <option value="percent" @if($coupon->type == 'percent') selected @endif>  نسبة مئوية من قيمة حجز العقار</option>
                            </select>
                        </div>

                        <div class="form-group" id="amount" style="display: none">
                            <label for="exampleTextarea" >قيمة الخصم </label>

                            <input type="number" name="amount" value="{{$coupon->amount}}"  class="form-control">

                        </div>
                        <div class="form-group" id="percent" style="display: none">
                            <label for="exampleTextarea" >النسبة المئوية للخصم </label>

                            <input type="number" name="percent" value="{{$coupon->percent}}"  class="form-control" placeholder="%">

                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >تاريخ الإنتهاء  </label>

                            <input type="date" name="expire_date"  value="{{$coupon->expire_date}}" class="form-control">

                        </div>


                        <div class="form-group">
                            <label for="exampleTextarea" > حالة الكوبون</label>
                            <select class="form-control" id="type"    name="type">

                                <option value="amount" @if($coupon->status == '1') selected @endif >
                                    <span class="label label-lg label-light-success label-inline">نشط </span>
                                </option>
                                <option value="percent" @if($coupon->status == '0') selected @endif>
                                    <span class="label label-lg label-light-warning label-inline">غير نشط </span>
                                </option>
                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary btn-update mr-2 w-lg-100px p-4 " >تعديل </button>
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
            <script>

                @if($coupon->amount == null && $coupon->percent != null)
                $('#percent').show();
                $('#amount').hide();
                @elseif($coupon->amount != null && $coupon->percent == null)
                $('#percent').hide();
                $('#amount').show();
                @endif
                $('#type').change(function(){
                    if($('#type').val() == 'amount') {
                        $('#percent').hide();
                        $('#amount').show();
                    }else {
                        $('#percent').show();
                        $('#amount').hide();
                    }

                });
            </script>

@endsection

