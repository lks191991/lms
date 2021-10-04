<form action="{{ route('registerStep3') }}" method="post" id="registerForm">
    {{ csrf_field() }}

    <div class="register-card-body">
        @if (session()->has('invalid_school'))
        <div class="alert alert-info error">
            {{ session('invalid_school') }}
        </div>
        @endif 

        @if($userRole == 'tutor')    
        <div class="form-group mb-3" id="tutorSubjectDiv">
            <input type="text" name="tutor_subject" id="tutor_subject" placeholder="Tutor Subject" class="form-control {{ $errors->has('tutor_subject') ? 'is-invalid' : '' }}" data-validation="required" value="{{old('tutor_subject')}}">

            @if ($errors->has('tutor_subject'))
            <div class="invalid-feedback">{!! $errors->first('tutor_subject') !!}</div>
            @endif
        </div>
        @endif
        <div class="form-group mb-3">
            <div class="custom-select-outer">
                <select name="school_cat" id="school_cat" class="custom-select {{ $errors->has('school_cat') ? 'is-invalid' : '' }}" data-validation="required">
                    <option class="d-none" value="">Institution </option>
                    @if(isset($schoolCat) && !empty($schoolCat))
                    @foreach($schoolCat as $cat)
                    <option value="{{ $cat->id }}" {{ ($cat->id == old('school_cat')) ? 'selected="selected"' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                    @endif
                </select>

                @if ($errors->has('school_cat'))
                <div class="invalid-feedback">{!! $errors->first('school_cat') !!}</div>
                @endif
            </div>
        </div>

        <div class="form-group mb-3 hide" id="rejSchoolDiv">

            <input type="text" name="school_name" id="search_school" placeholder="School name" class="form-control {{ $errors->has('school_name') ? 'is-invalid' : '' }}" data-validation="required" autocomplete="off">
            <div id="suggesstion-box"></div>


            @if ($errors->has('school_name'))
            <div class="invalid-feedback">{!! $errors->first('school_name') !!}</div>
            @endif

        </div>

        <div class="form-group mb-3 hide" id="rejDepartmentDiv">
            <div class="custom-select-outer">
                <select name="department" id="uni_department" onchange="getCourses('department', 'Program')" class="custom-select {{ $errors->has('department') ? 'is-invalid' : '' }}" data-validation="required">
                    <option class="d-none" value="">Department</option>
                </select>

                @if ($errors->has('course'))
                <div class="invalid-feedback">{!! $errors->first('department') !!}</div>
                @endif
            </div>
        </div>

        <div class="form-group mb-3 hide"  id="rejCourseDiv">
            <div class="custom-select-outer">
                <select name="course" id="school_course" onChange="getClasses('course')" class="custom-select {{ $errors->has('course') ? 'is-invalid' : '' }}" data-validation="required">
                    <option class="d-none" value="">Course</option>
                </select>

                @if ($errors->has('course'))
                <div class="invalid-feedback">{!! $errors->first('course') !!}</div>
                @endif
            </div>
        </div>

        <div class="form-group mb-3 hide" id="rejClassDiv">
            <div class="custom-select-outer">
                <select name="class_level" id="class_level" class="custom-select {{ $errors->has('class_level') ? 'is-invalid' : '' }}" data-validation="required">
                    <option class="d-none" value="">Class</option>
                    @if(!empty($classes))
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ ($class->id == old('class_level')) ? 'selected="selected"' : '' }}>{{ $class->class_name }}</option>
                    @endforeach
                    @endif
                </select>

                @if ($errors->has('class_level'))
                <div class="invalid-feedback">{!! $errors->first('class_level') !!}</div>
                @endif
            </div>
        </div>


    </div>
    <div class="register-card-footer">
        <button type="submit" class="btn btn-primary w-100">{{ __('SUBMIT') }}</button>
    </div>
    <ul class="register-card-step">
        <li class="complete"><span class="count">1</span></li>
        <li class="active"><span class="count">2</span></li>
        <li class="active"><span class="count">3</span></li>
    </ul>
<!--    <div class="register-card-skip">
        <a href="{{ route('registerStep', 4) }}" title="" class="btn-link">Skip</a>
    </div>-->
</form>
<input type="hidden" name="set_school_id" id="set_school_id" value="">