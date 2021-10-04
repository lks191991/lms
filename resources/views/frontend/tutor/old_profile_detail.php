<section class="content-top-wrapper bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @if(!empty($student->image))
                <img class="profile-user-img img-fluid img-circle" src="{{ url($student->image) }}" alt="User profile picture">
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{ url('images/student/profile/default.jpg') }}" alt="User profile picture">
                @endif
            </div>
            <div class="col-sm-8">
                <h3 class="profile-username">
                    {{ $student->first_name.' '.$student->last_name }}
                </h3>
                <p class="text small text-muted pb-2 border-bottom">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ $student->school }} <br/>

                    <i class="fa fa-codiepie" aria-hidden="true"></i> {{ $student->course }}
                </p>
                <div class="row">
                    <div class="col-sm-12 col-md-6 pl-0">
                        <ul class="profileUl">
                            <li><i class="fa fa-eye text-primary"></i> 200 Classes watched</li>
                            <li><i class="fa fa-book text-primary"></i> 150 Lecture notes downloaded</li>
                            <li><i class="fa fa-question-circle text-primary"></i> 20 Questions asked</li>
                            <li><i class="fa fa-check-circle text-primary"></i> 50 Answers contributed</li>
                            <li><i class="fa fa-users text-primary"></i> 5 Groups joined</li>
                            <li><i class="fa fa-user-plus text-primary"></i> 10 Friends added</li>
                            <li><i class="fa fa-envelope text-primary"></i> <strong>Email : </strong> {{ (!empty($student->contact_email)) ? $student->contact_email : 'Not Enter' }}</li>
                            <li><i class="fa fa-phone-square text-primary"></i> <strong>Telephone : </strong> {{ (!empty($student->telephone)) ? $student->telephone : 'Not Enter' }}</li>
                            <li><i class="fa fa-mobile text-primary"></i> <strong>Mobile : </strong> {{ (!empty($student->mobile)) ? $student->mobile : 'Not Enter' }}</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <span class="text-small text-muted">Profile Completed {{ $student->profilePercentage($student->user_id) }}%</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:{{ $student->profilePercentage($student->user_id) }}%"></div>
                        </div>
                        <span class="text-small text-muted">Achievement</span>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>

        </div>	
    </div>
</section>