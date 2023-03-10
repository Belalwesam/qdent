<style>
    .checkbox.checkbox-success > input:checked ~ span {
        background-color: #1BC5BD !important;
        margin: -9px;
    }</style>



    <div class="form-group row">
{{--        <label class="col-3 col-form-label  text-lg-right text-left" >{{$sub->name}} </label>--}}
        <div class="col-9 col-form-label">
            <div class="checkbox-inline">
                @foreach($attrabiutes as $attr)
                <label class="checkbox">
                    <input type="checkbox" name="attr[{{$attr->id}}][{{$attr->id}}]">
                    <span></span>{{$attr->name}}</label>
                    @endforeach
            </div>
{{--            <span class="form-text text-muted">Seletct {{$attr->name }}</span>--}}
        </div>
    </div>



