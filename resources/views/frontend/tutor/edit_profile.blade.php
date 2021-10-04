<div class="modal fade custom-modal" id="editProfile">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-header">       
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>     
            <div class="modal-body">
                <div class="register-card">
                    <div class="register-card-header">
                        <h1 class="heading">Update profile</h1>				
                    </div>
					
                    <div class="register-card-body">    
                        <form  action="" id="updateForm" class="" method="post" enctype="multipart/form-data">
                            @csrf
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="text" class="form-control" name="first_name" id="first_name" value="{{ $tutor->userData->first_name }}"  placeholder="First name" data-validation-length="2-255" >
						
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="text" class="form-control" name="last_name" id="last_name" value="{{ $tutor->userData->last_name }}"  placeholder="First name" data-validation-length="2-255" >
						
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="email" class="form-control" name="email" id="email" value="{{ $tutor->userData->email }}"  placeholder="Email" data-validation-length="2-255" >
						
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="form-group ">
								<input type="text" class="form-control" name="subject" id="subject" value="{{ $tutor->userData->tutor_subject }}"  placeholder="Subject" data-validation-length="2-255" >
						
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
						<button type="button" class="btn btn-primary w-100 join_button2" onclick="updateProfileDataObj.updateTutor()" id="updateBtn">UPDATE</button>
                   
						</div>
				    </div>

                        </form>	
                    </div>	   		

                    <div class="register-card-footer">
                       

                    </div>	

                </div>
            </div>
        </div>
    </div>
</div>