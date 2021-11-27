<div class="col-lg-4">
					<div class="user-dashboard-link">
						<ul class="p-0 m-0 list-unstyled">
							<li>
								<a href="{{route('frontend.profile')}}" class="{{ request()->is('profile') ? 'active-tab' : '' }}"><i class="far fa-user me-2"></i> My Profile</a>
							</li>
							
							<li>
								<a href="{{route('frontend.topics')}}" class="{{ request()->is('topics') ? 'active-tab' : '' }}"><i class="far fa-bookmark me-2"></i> Topics</a>
							</li>
							<li>
								<a href="{{route('frontend.videos')}}" class="{{ request()->is('videos') ? 'active-tab' : '' }}"><i class="far fa-bookmark me-2"></i> Videos</a>
							</li>
							<li>
								<a href="{{route('frontend.mylearningList')}}" class="{{ request()->is('my-mylearning-list') ? 'active-tab' : '' }}"><i class="far fa-bookmark me-2"></i> My Learning</a>
							</li>
							<li>
								<a href="{{route('frontend.myPayment')}}" class="{{ request()->is('my-payment') ? 'active-tab' : '' }}"><i class="fas fa-history me-2"></i> Payment History</a>
							</li>
						
							<li>
								<a href="{{route('frontend.changePassword')}}" class="{{ request()->is('change-password') ? 'active-tab' : '' }}"><i class="fa fa-lock me-2"></i> Change Password</a>
							</li>
							<li>
								<a  href="javascript:;" onclick="$('#logoutForm').submit()"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>