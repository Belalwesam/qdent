<div class="table-responsive">
    <table class="table table-bordered table-hover" id="kt_datatable">
        <thead>
        <tr>
            <th> #</th>
            <th>البريد</th>
            <th>الخيارات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emails as $email)
            <tr class="deleted-row-{{$email->id}}">
                <td>{{$email->id}}</td>

                <td>{{$email->email}}
                </td>

                <Td>


                    <a href="{{route('email.edit',$email->id)}}" data-href="{{route('email.edit',$email->id)}}" data-entity_id="{{$email->id}}" data-token="{{csrf_token()}}" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="إرسال ">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Send.svg", "svg-icon-md svg-icon-primary") }}
                    </a>

                    {{--                  --}}


                </Td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$emails->links()}}
</div>
