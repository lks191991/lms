<div class="col-lg-4">
					<div class="user-dashboard-link">
						<ul class="p-0 m-0 list-unstyled">
							<li>
								<a href="{{route('frontend.profile')}}" class="{{ request()->is('profile') ? 'active-tab' : '' }}"><i class="far fa-user me-2"></i> My Profile</a>
							</li>
						
							<li>
								<a href="{{route('frontend.changePassword')}}" class="{{ request()->is('change-password') ? 'active-tab' : '' }}"><i class="far fa-bookmark me-2"></i> Change Password</a>
							</li>
							<li>
								<a  href="javascript:;" onclick="$('#logoutForm').submit()"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>