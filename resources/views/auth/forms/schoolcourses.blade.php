<option class="d-none" value="">{{$optionName}}</option>
@foreach($schoolcourses as $schoolcourse)
<option value="{{$schoolcourse->id}}">{{$schoolcourse->name}}</option>
@endforeach
