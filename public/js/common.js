class Common{
	
		constructor(external = ''){
            
			
			//this.messages("success","Are you the six fingered man?");
		
		} 
		test(){
			
		}
		messages(type,message){
			toastr[type](message)
			toastr.options = {
			  "closeButton": true,
			  "debug": true,
			  "newestOnTop": true,
			  "progressBar": true,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": true,
			  "showDuration": "200",
			  "hideDuration": "2000",
			  "timeOut": "6000",
			  "extendedTimeOut": "2000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			} 
		}
		catchErr(err){
			
			/* this.messages('warning',err); */
		}
		flyToElement(flyer, flyingTo, ncits) {
			
			
			
			/* 
			 *
			 *
			 How to call 
			    var ncits    = 1;
				var itemImg = "#imageId";
				//this.flyToElement($(itemImg ), $('#flyIn'), ncits);
			 */
		
			var $func = $(this);
			var divider = 5;
			var flyerClone = $(flyer).clone();
			$(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
			$('body').append($(flyerClone));
			var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
			var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
			 
			$(flyerClone).animate({
				opacity: 0.4,
				left: gotoX,
				top: gotoY,
				width: $(flyer).width()/divider,
				height: $(flyer).height()/divider
			}, 700,
			function () {
				$(flyingTo).fadeOut('fast', function () {
					$(flyingTo).fadeIn('fast', function () {
						$(flyerClone).fadeOut('fast', function () {
							$(flyerClone).remove();
							//$('#noItemText').text('');
							//$('#ItemInCart').text(ncits);
						});
					});
				});
			});
		}
		isHidden(id,chain = false){
		  if($(id).is(':hidden')) {
				return true;
			} else return false;
		}
		isVisible(id){ 
		  if($(id).is(':visible')) {
				return true;
			} else return false; 
		}
		iconView(){
			 return `<i class="fas fa-eye text-default" aria-hidden="true"></i>`;
		}
		iconPlay(){
			 return `<i class="fas fa-play  text-success" aria-hidden="true"></i>`;
		}
		iconLoder(){
			
			 return `<i class="fas fa-spinner fa-pulse  black-text" aria-hidden="true"></i>`;
			 
		}
		iconLoderMini(){
			 return `<i class="fas fa-spinner fa-pulse  black-text" aria-hidden="true"></i>`;
			 
		}
		angleDown(){
			 return `<i class="fas fa-angle-down rotate-icon  angle-class" aria-hidden="true"></i>`;
		}
		angleUp(){
			 return `<i class="fas fa-angle-up rotate-icon angle-class" aria-hidden="true"></i>`;
		}
		effectShow(hideId,showId = false , hideTrue = false ,hideSpeed = 'slow',showSpeed = 'slow'){
		 
		  if(showId == false) 
			showId = hideId;
		 
		  if(!this.isVisible(showId) || hideTrue == true) {
			$(hideId).hide(hideSpeed);
		  }
			$(showId).show(showSpeed);
		}
		bootLoder()
		{
			var loder = `<div class="col-12" id="loderId" style="text-align: center; margin: 0px; padding: 24px;"> <div class="spinner-border text-info" role="status"> <span class="sr-only">Loading...</span> </div> </div>`;
			
			return loder;
		}
		createOptions(objData,selectedVal,firstOptionName)
		{
            
			var options = '';
			if(firstOptionName != "")
			 options = `<option value="" class="d-none"> ${firstOptionName} </option>`;
		 
			if(Object.keys(objData).length != 0){
				
				$.each(objData,function(key,data){
				  var selectedVar = '';
				  if (key === selectedVal){
					  selectedVar = "selected";
                    }
				   options += `<option value="${key}" ${selectedVar} >${data}</option>`; 
				});
			}
		
			
			return options;
		}
		rowCount(atr)
		{
			var i = 0;
			$(atr).each(function(){
				i++;
			});
			return i;
		}
		playIframVideo(videoUrl,autoplay = true){
			
			var videoHtml = `<iframe class="bg-dark" src="${videoUrl}?&autoplay=1" id="videoPlayer" width="" height="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
			
			return videoHtml;
		}
		btnDesEnb(id, btnText ="POST", action = 'enb'){
			
			if(action == 'des')
			{
			  $(id).prop('disabled', true);
			  $(id).html(this.iconLoderMini());
			}else{
			  $(id).prop('disabled',false);
			  $(id).html(btnText);
			}
		}
		clearId( str, cnt =1 ) {
			return str.substring(cnt);
		}
		clearClass( str , cnt =1) {
			return str.substring(cnt);
		}
		redirect(url){
			return window.location.href = url;
		}
		paceRestart(fromCall = ''){
			Pace.restart();
		}
		openLoginModel(){
            
            try {
			loginObj.openPopup();	
			}
			catch(err) {
                this.messages('warning','session expired please reload your page then login again.');
				/* this.catchErr('session expired please reload your page then login again.'); */
			}
        }
		setMeta(title = "title", description = "description", keywords = "keywords"){
            
            try {
			 $('meta[name=title]').attr('content', title);
			 $('meta[name=description]').attr('content', description);
			 $('meta[name=keywords]').attr('content', keywords);	
			}
			catch(err) {
                
				
			}
        }
        
}


export {Common}