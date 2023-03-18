<div class="table-responsive" id="kt_advance_table_widget_4" >
    <table class="table table-bordered table-hover" id="table_data">
        <thead>
        <tr>
            <th>
                <label class="checkbox checkbox-lg checkbox-inline mr-2">
                <input type="checkbox"  id="selectAll" name="check[]">
                    <span style="top: -22px;"></span>

                </label>
            </th>
            <th> Id</th>
            <th>{{__("إسم صاحب الطلب")}}</th>
            <th>{{__("رقم  صاحب الطلب")}}</th>
            <th>{{__(" وقت تسليم الطلب")}}</th>
            <th>{{__("الإجمالي    ")}}</th>
            <th>{{__("حالة الدفع  ")}}</th>
            <th>{{__("حالة التوصيل ")}}</th>
            <th>{{__("الحالة")}} </th>
            <th>{{__("تاريخ الطلب")}} </th>

            <th>خيارات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr class="deleted-row-{{$order->id}}">
                <td> <label class="checkbox checkbox-lg checkbox-inline mr-2">
                        <input type="checkbox" value="{{$order->id}}" id="select" name="check[]">
                        <span></span>
                    </label></td>
                <td>{{$order->id}}</td>
                <td>
                    {{$order->name}}
                </td>
                <td >
                    {{$order->phone ?? null}}
                </td>
                <td >
                    الفترة :
                    {{$order->period->name ?? '' }}
                    <br>
                    <span class="text-muted">
                        االتاريخ والوقت
                        {{$order->date}} -- {{$order->time}}
                    </span>
                </td>
                <td>{{$order->total}}</td>
{{--                 حالة الدفع--}}
                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-{{$order->spanPayment()}}" style="font-size:10px">{{$order->payment()}}</button>
                        <button type="button" class="btn btn-{{$order->spanPayment()}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" bis_skin_checked="1" style="">
                            <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="payment_status" data-value="paid" href="#">مدفوعة
                                @if($order->status =='paid') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                            <a class="dropdown-item btn-change-status" href="#" data-token="{{csrf_token()}}" data-key="payment_status" data-id="{{$order->id}}" data-value="unpaid">
                                غير مدفوعة
                                @if($order->status =='unpaid') <i class="text-success fa fa-check"> </i>@endif

                            </a>

                        </div>
                    </div>

                </td>
{{--                حالة التوصيل--}}
                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-info" style="font-size:10px">{{$order->delviery()}}</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" bis_skin_checked="1" style="">
                            <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="delivery_status" data-value="placed" href="#">
                                استلام الطلب
                                @if($order->delivery_status =='placed') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                            <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="delivery_status" data-value="accepted" href="#">
                                الطلب مقبول
                                @if($order->delivery_status =='accepted') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                            <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="delivery_status" data-value="packed" href="#">
                                الطلب جاهز للشحن
                                @if($order->delivery_status =='packed') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                               <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="delivery_status" data-value="shipped" href="#">
                                   الطلب مشحون
                               @if($order->delivery_status =='shipped') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                              <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="delivery_status" data-value="delivered" href="#">
                                  الطلب واصل
                                @if($order->delivery_status =='delivered') <i class="text-success fa fa-check"> </i>@endif

                            </a>

                        </div>
                    </div>

                </td>



                <td>
{{--                    <span class="label label-lg label-light-{{$order->span()}} label-inline" style="color:black;">{{$order->statusAr()}}</span>--}}

                    <div class="btn-group">
                        <button type="button" class="btn btn-{{$order->span()}}">{{$order->statusAr()}}</button>
                        <button type="button" class="btn btn-{{$order->span()}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" bis_skin_checked="1" style="">
                            <a class="dropdown-item btn-change-status" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="status" data-value="accepted" href="#">مقبولة
                                @if($order->status =='accepted') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                            <a class="dropdown-item btn-change-status" href="#" data-token="{{csrf_token()}}"  data-key="status" data-id="{{$order->id}}" data-value="pending">
                                بإنتظار التأكيد
                                @if($order->status =='pending') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                            <a class="dropdown-item btn-change-status" href="#" data-token="{{csrf_token()}}" data-key="status" data-id="{{$order->id}}" data-value="complete">
                                مكتملة
                            @if($order->status =='complete') <i class="text-success fa fa-check"> </i>@endif
                            </a>
                            <div class="dropdown-divider" bis_skin_checked="1"></div>
                            <a class="dropdown-item btn-change-status" href="#" data-token="{{csrf_token()}}" data-id="{{$order->id}}" data-key="status" data-value="canceled">مرفوضة
                                @if($order->status =='canceled') <i class="text-success fa fa-check"> </i>@endif

                            </a>
                        </div>
                    </div>
                </td>
                <td> {{$order->created_at}}</td>

                <Td>
                    <a href="{{route('orders.show',$order->id)}};" data-href="{{route('orders.show',$order->id)}}" data-entity_id="{{$order->id}}"class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="عرض">

                        {{ Metronic::getSVG("media/svg/icons/General/Settings-1.svg", "svg-icon-md svg-icon-primary") }}

                    </a>
                    <a href="{{route('order.edit',$order->id)}}" data-href="{{route('order.edit',$order->id)}}" data-entity_id="{{$order->id}}"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}

                    </a>

                    <a href="javascript:;" data-href="{{route('order.delete',$order->id)}}" data-entity_id="{{$order->id}}" data-token="{{csrf_token()}}" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                        {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                    </a>


                </Td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$orders->links()}}
</div>


