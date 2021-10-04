@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Profile /</span> Change Password
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Change Password
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.profile.update', $user->id)}}" method = "post">
            @csrf
				@method('PUT')
				
				@role('school')
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" placeholder="First Name" value="{{ $user->userData->first_name }}" class="form-control" required>
					</div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ $user->userData->last_name }}" class="form-control">
					</div>
                </div>
				<div class="form-group row">
						<label class="col-form-label col-sm-2 text-sm-right">Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" id="email" placeholder="Email" value="{{ $user->email }}" class="form-control" required>
						</div>
				</div>
				@endrole
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" placeholder="Username" value="{{ $user->username }}" class="form-control" disabled>
					</div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Current Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="current_password"  id="current_password" placeholder="Current Password" class="form-control" autocomplete="off" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password"  id="password" placeholder="Password" class="form-control">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password Confirm</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirm" class="form-control">
                    </div>
                </div>
			<div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection