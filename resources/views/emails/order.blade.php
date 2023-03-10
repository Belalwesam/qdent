@component('mail::message')

    <style>
        .height {
            min-height: 200px;
        }

        .icon {
            font-size: 47px;
            color: #5CB85C;
        }

        .iconbig {
            font-size: 77px;
            color: #5CB85C;
        }

        .table > tbody > tr > .emptyrow {
            border-top: none;
        }

        .table > thead > tr > .emptyrow {
            border-bottom: none;
        }

        .table > tbody > tr > .highrow {
            border-top: 3px solid;
        }
        .card-block {
            padding: 10px;
        }
    </style>
    <div class="d-flex flex-row" bis_skin_checked="1"> <!--begin::Aside--> <!--end::Aside--> <!--begin::Layout--> <div class="flex-row-fluid ml-lg-8" bis_skin_checked="1"> <!--begin::Card--> <div class="card card-custom gutter-b" bis_skin_checked="1"> <div class="card-body p-0" bis_skin_checked="1"> <!-- begin: Invoice--> <!-- begin: Invoice header--> <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0" bis_skin_checked="1"> <div class="col-md-10" bis_skin_checked="1"> <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row" bis_skin_checked="1"> <h1 class="display-4 font-weight-boldest mb-10">تفاصيل الطلب</h1> <div class="d-flex flex-column align-items-md-end px-0" bis_skin_checked="1"> <!--begin::Logo--> <a href="#" class="mb-5"> <img src="/front/img/LogoRoz.png" alt=""> </a> <!--end::Logo--> <span class="d-flex flex-column align-items-md-end opacity-70"> <span>{{$order->city->name ?? ''}} -- {{$order->region->name ?? ''}}</span> <span>{{$order->zip}} -- {{$order->address}}</span> </span> </div> </div> <div class="border-bottom w-100" bis_skin_checked="1"></div> <div class="d-flex justify-content-between pt-6" bis_skin_checked="1"> <div class="d-flex flex-column flex-root" bis_skin_checked="1"> <span class="font-weight-bolder mb-2">تاريخ الطلب</span> <span class="opacity-70">{{$order->date_human($order->created_at)}} -- {{$order->created_date()}}</span> </div> <div class="d-flex flex-column flex-root" bis_skin_checked="1"> <span class="font-weight-bolder mb-2">رقم الطلب.</span> <span class="opacity-70">{{$order->id}}</span> </div> <div class="d-flex flex-column flex-root" bis_skin_checked="1"> <span class="font-weight-bolder mb-2">التوصيل ل -</span> <span class="opacity-70"> الإسم : {{$order->name}} {{'( '.$order->adderss.','.$order->city->name.')'}} <br>الهاتف : {{$order->phone}}</span> <span class="text-muetd"> <span class="opacity-70"> الفترة : </span> {{$order->period->name}} <span class="opacity-70"> التاريخ : </span> {{$order->date}} -- {{$order->time}} </span> </div> </div> </div> </div> <!-- end: Invoice header--> <!-- begin: Invoice body--> <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0" bis_skin_checked="1"> <div class="col-md-10" bis_skin_checked="1"> <div class="table-responsive" bis_skin_checked="1"> <table class="table"> <thead> <tr> <th class="pl-0 font-weight-bold text-muted text-uppercase">المنتجات المطلوبة</th> <th class="text-right font-weight-bold text-muted text-uppercase">الكمية</th> <th class="text-right font-weight-bold text-muted text-uppercase"> سعر الوحدة</th> <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">الإجماي</th> </tr> </thead> <tbody> @foreach($order->carts as $cart) <tr class="font-weight-boldest"> <td class="border-0 pl-0 pt-7 d-flex align-items-center"> <!--begin::Symbol--> <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light" bis_skin_checked="1"> <div class="symbol-label" style="background-image: url('{{asset($cart->product->img())}}')" bis_skin_checked="1"></div> </div> <!--end::Symbol--> {{$cart->product->name}}</td> <td class="text-right pt-7 align-middle">{{$cart->qty}}</td> <td class="text-right pt-7 align-middle"> {{$cart->price}} <smal>ر.س</smal> </td> <td class="text-primary pr-0 pt-7 text-right align-middle"> {{$cart->total}} <smal>ر.س</smal> </td> </tr> @endforeach </tbody> </table> </div> </div> </div> <!-- end: Invoice body--> <!-- begin: Invoice footer--> <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0" bis_skin_checked="1"> <div class="col-md-10" bis_skin_checked="1"> <div class="table-responsive" bis_skin_checked="1"> <table class="table"> <thead> <tr> <th class="font-weight-bold text-muted text-uppercase">قيمة خصم الكوبون</th> <th class="font-weight-bold text-muted text-uppercase">قيمة الضريبة المضافة  </th> <th class="font-weight-bold text-muted text-uppercase">حالة الدفع</th> <th class="font-weight-bold text-muted text-uppercase">تاريخ الطلب </th> <th class="font-weight-bold text-muted text-uppercase text-right">إجمالي المدفوع</th> </tr> </thead> <tbody> <tr class="font-weight-bolder"> <td> @if($order->discoung != null) <span class="opacity-70"> {{$order->discount}} </span> {{$order->discount_value}} @else لا يوجد خصم @endif </td> <td> @if($order->vat != null) {{$order->vat}} @endif </td> <td>{{$order->payment()}}</td> <td>{{$order->created_date()}}</td> <td class="text-primary font-size-h3 font-weight-boldest text-right"> {{$order->total}} <smal>ر.س</smal> </td> </tr> </tbody> </table> </div> </div> </div> <!-- end: Invoice footer--> <!-- begin: Invoice action--> <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0" bis_skin_checked="1"> <div class="col-md-10" bis_skin_checked="1"> <div class="d-flex justify-content-between" bis_skin_checked="1">  </div> </div> </div> <!-- end: Invoice action--> <!-- end: Invoice--> </div> </div> <!--end::Card--> </div> <!--end::Layout--> </div>
    @component('mail::button', ['url' => route('order.user',$order->id)])
        عرض الطلب
    @endcomponent
<br>

    شكراً,
    {{ config('app.name') }}
@endcomponent
