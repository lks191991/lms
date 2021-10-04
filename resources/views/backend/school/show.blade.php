@extends('backend.layouts.layout-3')

@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">

        <div class="row mx-auto">
            <div class="col-md-10">
                <div class="media col-md-12 py-5 mx-auto">
                    

                    <div class="media-body ml-5">
                        <h4 class="font-weight-bold mb-4">{{$school->school_name}}</h4>
                    
                        <div class="text-muted mb-2">
                            <strong>School Category:</strong> {{$school->category->name}}
                        </div>
                      
                    </div>
                </div>
            </div>
            @role('admin|subadmin')
            <div class="col-md-1 ml-10 mt-5"><a href="{{ route('backend.schools') }}" class="btn btn-primary rounded-pill d-block detail-back-btn">Back</a></div>
            @endrole
        </div>      

        <hr class="m-0">
    </div>
    <!-- Header -->
    <div class="row">

       

        <div class="col-sm-4 col-xl">

            <div class="card mb-4">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Courses</div>
                            <div class="text-large">{{$courses_count}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-sm-4 col-xl">

            <div class="card mb-4">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-university"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Classes</div>
                            <div class="text-large">{{$classes_count}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        
        <div class="col-sm-4 col-xl">

            <div class="card mb-4">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="sidenav-icon fas fa-video"></i>
                        <div class="ml-3">
                            <div class="text-muted small">Videos</div>
                            <div class="text-large">{{$videos_count}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        


        <div class="col-sm-4 col-xl">

            <div class="card mb-4">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="lnr lnr-users display-4"></div>
                        <div class="ml-3">
                            <div class="text-muted small">Students</div>
                            <div class="text-large">{{$student_count}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-sm-4 col-xl">

            <div class="card mb-4">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="lnr lnr-users display-4"></div>
                        <div class="ml-3">
                            <div class="text-muted small">Tutors</div>
                            <div class="text-large">{{$tutor_count}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @includeif('backend.message')
  


</div>

	 
<!-- / Content -->
@endsection
@section('scripts')

<script>
   
</script>
@stop