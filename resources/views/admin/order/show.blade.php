@extends('layout.default')
@section('content')
    <div class="d-flex flex-row" bis_skin_checked="1" id="invoice">
        <!--begin::Aside-->
        <!--end::Aside-->
        <!--begin::Layout-->
        <div class="flex-row-fluid ml-lg-8" bis_skin_checked="1">
            <!--begin::Card-->
            <div class="card card-custom gutter-b" bis_skin_checked="1">
                <div class="card-body p-0" bis_skin_checked="1">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 pb-4 px-md-0" bis_skin_checked="1">
                        <div class="col-md-10" bis_skin_checked="1">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row"
                                bis_skin_checked="1">
                                <h1 class="display-4 font-weight-boldest mb-10"> Order Details</h1>
                                <div class="d-flex flex-column align-items-md-end px-0" bis_skin_checked="1">
                                    <!--begin::Logo-->
                                    <a href="#" class="mb-5">
                                        <img src="/front/img/LogoRoz.png" alt="">
                                    </a>
                                    <!--end::Logo-->
                                    <span class="d-flex flex-column align-items-md-end opacity-70">
                                        <span>{{ $order->zip }} -- {{ $order->address() }}</span>

                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100" bis_skin_checked="1"></div>
                            <div class="row pt-6" bis_skin_checked="1">
                                <div class="col-4 d-flex flex-column flex-root" bis_skin_checked="1">
                                    <span class="font-weight-bolder mb-2"> Deliver To: -</span>
                                    <span class="opacity-90" style="font-size:14px; font-weight:bold; color:#000;">
                                        Name :
                                        {{ $order->name }}
                                        {{ '( ' . $order->adderss . ',' . $order->city ?? ' Deleted  ' . ')' }}
                                        <br>Phone : {{ $order->phone }}
                                    </span>
                                    <br>Email : {{ $order->email }}</span>
                                    <span class="text-muetd">
                                        <span class="opacity-70">

                                            <span class="opacity-80" style="font-size:14px; font-weight:bold; color:#000;">
                                                Date :
                                                {{ $order->date_human($order->created_at) }}
                                                {{ '( ' . $order->created_date() }}
                                            </span>
                                        </span>
                                    </span>
                                </div>
                                <div class="col-4 d-flex flex-column flex-root" bis_skin_checked="1">
                                    <span class="font-weight-bolder mb-2"> Created At</span>
                                    <span class="opacity-70">
                                        {{ $order->created_at->format('d-m-Y : H:i:s') }}
                                    </span>
                                </div>
                                <div class="col-4 d-flex flex-column flex-root" bis_skin_checked="1">
                                    <span class="font-weight-bolder mb-2"
                                        style="font-size:14px; font-weight:bold; color:#000;"> Order No..</span>
                                    <span class="opacity-70">{{ $order->id }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0" bis_skin_checked="1">
                        <div class="col-md-10" bis_skin_checked="1">
                            <div class="table-responsive" bis_skin_checked="1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Products</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Reference ID</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase"> Unit Price
                                            </th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->carts->items as $cart)
                                            <tr class="font-weight-boldest">
                                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light"
                                                        bis_skin_checked="1">

                                                        <div class="symbol-label"
                                                            style="background-image: url('{{ asset($cart->product != null ? $cart->product->images->first()->img() : 'Deleted ') }}')"
                                                            bis_skin_checked="1"></div>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    {{ $cart->product->name ?? 'Product Deleted ' }}
                                                </td>
                                                <td class="text-right pt-7 align-middle">
                                                    @if ($cart->product)
                                                        {{$cart->product->ref_id}}
                                                    @endif
                                                </td>
                                                <td class="text-right pt-7 align-middle">{{ $cart->qty }}</td>
                                                <td class="text-right pt-7 align-middle">
                                                    {{ $cart->price }}
                                                    <smal>$</smal>
                                                </td>
                                                <td class="text-primary pr-0 pt-7 text-right align-middle">
                                                    {{ $cart->total }}
                                                    <smal>$</smal>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0"
                        bis_skin_checked="1">
                        <div class="col-md-10" bis_skin_checked="1">
                            <div class="table-responsive" bis_skin_checked="1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">Stauts </th>
                                            <th class="font-weight-bold text-muted text-uppercase"> Payment Status</th>
                                            <th class="font-weight-bold text-muted text-uppercase">Shipping Method </th>
                                            <th class="font-weight-bold text-muted text-uppercase text-right"> Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bolder">

                                            <td>
                                                <span
                                                    class="label label-lg label-light-{{ $order->span() }} label-inline">{{ $order->payment_status }}</span>
                                            </td>
                                            <td>{{ $order->Payment() }}</td>
                                            <td>{{ $order->shippingmethod->name ?? 'None' }} -
                                                {{ $order->shippingmethod->price ?? 'Free' }} </td>
                                            <td class="text-primary font-size-h3 font-weight-boldest text-right">
                                                {{ $order->total_price() }}
                                                <smal>$</smal>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0" bis_skin_checked="1">
                        <div class="col-md-10" bis_skin_checked="1">
                            <div class="d-flex justify-content-between" bis_skin_checked="1">
                                <button type="button" class="btn btn-light-primary font-weight-bold"
                                    onclick="(function(){
                  var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
                })()
                ;return false">
                                    Download order </button>
                                {{--                                <button type="button" class="btn btn-primary font-weight-bold" onclick="print();">Print Order  </button> --}}
                            </div>
                        </div>

                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Layout-->
    </div>
@endsection
