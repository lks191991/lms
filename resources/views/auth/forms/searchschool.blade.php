<ul id="school-list">
	@foreach($schools as $school)
	<li data-school-id="{{$school->id}}" data-school-name="{{$school->school_name}}" class="select-school">{{$school->school_name}}</li>
	@endforeach
</ul>
