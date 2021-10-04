<option class="d-none" value="">Class</option>
@foreach($schoolclasses as $schoolclass)
<option value="{{$schoolclass->id}}">{{$schoolclass->class_name}}</option>
@endforeach
