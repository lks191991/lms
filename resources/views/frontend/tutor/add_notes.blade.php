<div class="modal fade custom-modal" id="myModalAddNotes">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-header">       
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>     
            <div class="modal-body">
                <div class="register-card">
                    <div class="register-card-header">
                        <h1 class="heading">Upload note</h1>				
                    </div>
                    <div class="register-card-footer">    
                        <form id="dropzone" action="{{route('frontend.uploadNotes')}}" class="dropzone" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="dz-message" data-dz-message><span>Drop file here or click to upload</span></div>	
                            <input type="hidden" name="notes">
                            <input type="hidden" name="video_id" id="video_id" value="">

                        </form>	
                    </div>	   		

                    <div class="register-card-footer">
                        <small class="form-text mb-4">
                            You can only upload PDF or MS-Word, PPT,JPEG,JPG,PNG & EXCEL files, but preferable files are PDFs.  
                        </small>

                    </div>	

                </div>
            </div>
        </div>
    </div>
</div>