@extends('backend.layouts.layout-2')

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    
    <script src="{{ mix('/assets/js/dashboards_dashboard-1.js') }}"></script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Dashboard
        <div class="text-muted text-tiny mt-1"><small class="font-weight-normal">Today is {{date('l, jS F Y')}}</small></div>
    </h4>

    <!-- Counters -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
               <a href="{{ route('backend.categories.index') }}"> <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Institutions</div>
                            <div class="text-large">{{$institute_count}}</div>
                        </div>
                    </div>
                </div> </a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
                <a href="{{ route('backend.schools') }}"><div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-school"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Schools</div>
                            <div class="text-large">{{$school_count}}</div>
                        </div>
                    </div>
                </div></a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
               <a href="{{ route('backend.departments.index') }}"> <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Departments</div>
                            <div class="text-large">{{$department_count}}</div>
                        </div>
                    </div>
                </div></a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
                <a href="{{ route('backend.courses') }}">
				<div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Courses</div>
                            <div class="text-large">{{$courses_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.classes.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-university"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Classes</div>
                            <div class="text-large">{{$classes_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.periods.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="sidenav-icon fas fa-clock"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Periods</div>
                            <div class="text-large">{{$periods_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.subjects.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="sidenav-icon fas fa-book"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Subjects</div>
                            <div class="text-large">{{$subject_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.topics.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="sidenav-icon fas fa-tags"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Topics</div>
                            <div class="text-large">{{$topic_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.videos.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="sidenav-icon fas fa-video"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Videos</div>
                            <div class="text-large">{{$videos_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.students.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="lnr lnr-users display-4"></div>
                        <div class="ml-3">
                            <div class="text-muted small">Students</div>
                            <div class="text-large">{{$student_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.tutors.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="lnr lnr-users display-4"></div>
                        <div class="ml-3">
                            <div class="text-muted small">Tutors</div>
                            <div class="text-large">{{$tutor_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
        <div class="col-sm-6 col-xl-3">

            <div class="card mb-4">
			<a href="{{ route('backend.managers.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="lnr lnr-users display-4"></div>
                        <div class="ml-3">
                            <div class="text-muted small">School Managers</div>
                            <div class="text-large">{{$schoolmanager_count}}</div>
                        </div>
                    </div>
                </div>
				</a>
            </div>

        </div>
    </div>
    <!-- / Counters -->

@endsection