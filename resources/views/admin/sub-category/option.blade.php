<option>Select Sub Category</option>
@foreach($subCategories as $sub )
    <option value="{{$sub->id}}">{{$sub->name}}</option>
@endforeach
