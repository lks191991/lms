<div class="modal fade custom-modal" id="myModalFlagVideo">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-header">       
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>     
            <div class="modal-body">
                <div class="register-card">
                    <div class="register-card-header">
                        <h1 class="heading">Report this video</h1>				
                    </div>
                    <div class="register-card-footer">    
                        <form id="dropzone" action="{{route('frontend.uploadNotes')}}" class="" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="flegStatus" value="0">
                         <div class="form-group"> 
                            <textarea class="form-control" id="flegVideoInputId" placeholder="describe your reason here...."></textarea>
                        </div>
                        <div class="form-group m-0">
                            <div class="row">
                                 <div class="col-12">
                                    <button type="button" id="setFlegBtnId" onclick="classroomObj.setFleg()" class="btn btn-primary w-100">POST</button>
                                </div>
                            </div>
                        </div>
                        </form>	
                    </div>	   		


                </div>
            </div>
        </div>
    </div>
</div>