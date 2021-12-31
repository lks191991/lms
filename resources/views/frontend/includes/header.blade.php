<!-- Header -->
@php 
$menus=GLB::getAllCourse();

 @endphp
	<header class="header-main">
		<div class="top-strip border-bottom py-2">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<ul class="m-0 p-0 list-unstyled social-icon d-flex list-gap flex-wrap">
							<li>
								<a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
							</li>
							<li>
								<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
							</li>
							<li>
								<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
							</li>
							<li>
								<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
							</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="p-0 m-0 d-flex justify-content-md-end list-unstyled list-gap contact-list flex-wrap">
							<li>
								<a href="tel:1234567890"><i class="fas fa-phone-alt ms-md-2 me-1"></i> 1234567890</a>
							</li>
							<li>
								<a href="mailto:info@mail.com"><i class="fas fa-envelope ms-md-2 me-1"></i>
									info@mail.com</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg custom-navbar py-lg-0">
			<div class="container">
				<a class="navbar-brand" href="/">
					<img src="{{ asset('images/logo.png')}}" alt="Logo" />
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
						</li>
						 <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Courses
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								@foreach($menus as $menu)
                                <li class="mega-menu-tree">
                                    <a class="dropdown-item" href="{{route('course-list',['CourseId'=>$menu->id])}}">{{$menu->class_name}} <i
                                            class="fas fa-caret-down d-lg-none"></i></a>
                                    <ul class="mega-menu-tree-list p-0 list-unstyled">
									@foreach($menu->subject as $sub)
                                        <li><a class="dropdown-item" href="{{route('course-details',['subjectId'=>$sub->id])}}">{{$sub->subject_name}}</a></li>
                                      @endforeach  
                                    </ul>
                                </li>
								 @endforeach  
                            </ul>
                        </li>
						<li class="nav-item">
							<a class="nav-link" href="#">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('frontend.contactUs')}}">Contact</a>
						</li>
						
						@if(isset(Auth::user()->id))
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								<i class="far fa-user me-2"></i> Hi, <span class="user_name">{{Auth::user()->userData['first_name']}}</span>
							</a>
							<ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item p-2" href="{{route('frontend.profile')}}"><i class="far fa-user me-2"></i> Profile</a>
								</li>
								<li><a class="dropdown-item p-2" href="{{route('frontend.mylearningList')}}"><i class="far fa-bookmark me-2"></i> My Learning</a>
								</li>
								<li>
									<hr class="dropdown-divider my-1">
								</li>
								<li><a class="dropdown-item p-2" href="{{route('frontend.changePassword')}}"><i class="fa fa-lock me-2"></i> Change Password</a>
								</li>
								<li>
									<hr class="dropdown-divider my-1">
								</li>
								<li>
								<form method="POST" style="display:none" id="logoutForm" action="{{ route('logout') }}">
                  @csrf
				  
              </form>
								<a class="dropdown-item p-2" href="javascript:;" onclick="$('#logoutForm').submit()"><i class="fas fa-sign-out-alt me-2"></i>
										Logout</a>
								</li>
							</ul>
						</li> 
						@else
							<li class="nav-item show-before-login">
							<a class="btn btn-primary ms-lg-4" href="{{route('login')}}">Login</a>
						</li>
						<li class="nav-item show-before-login">
							<a class="btn btn-outline-primary" href="{{route('register')}}">Sign up</a>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- Header Ends-->

    
				