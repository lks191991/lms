
@section('after-styles')
 
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.serializejson.js') }}"></script>
<script>
var studentCon = { 
    
    separator:'/', 
    strDouble:'"', 
    strSingle:"'", 
    parentUrl:'{{URL::to("/")}}',
   jsId : {
        historyRow          		: "#history-row-",
        favRow          	    	: "#fav-row-",
        btnRmHistory            	: "#btn-rm-history-",
        btnRmFav                 	: "#btn-rm-fav-",
        activeTabInput        		: "#activeTabInput",
        historyHtml        		    : "#historyHtml",
        favouritesHtml        		: "#favouritesHtml",
        historyMore        		    : "#historyMore",
        favouritesMore        		: "#favouritesMore",
        historyPage          		: "#historyPage",
        favouritesPage        		: "#favouritesPage",
        school_id        		    : "#school_id",
        course_id        		    : "#course_id",
        activetedTab           		: "#activetedTab"
       
    },
	status : {
        success     : 200
    },
    jsClass : {
        navItem 				: ".nav-item",
        favRowCount 		    : ".fav-row-count",
        historyRowCount 		: ".history-row-count"
        
    },
	jsData : {
        histories 				: "histories",
        favourites 				: "favourites"
    },
	jsNames : {
        noname 			: "",
    },
	jsValue : {
        user_id 			: "",
    },
    extra : { 
        jsSeparator:'-',
		url : {
			   histories     : '{{route("frontend.studentHistory")}}',
			   rmHistories   : '{{route("frontend.removeHtudentHistory")}}',
			   favourites     : '{{route("frontend.studentFavourites")}}'
				
		}
    },
	createUrl : function(set){ 
        return ( this.parentUrl+this.separator+set);
    },
	createId : function(arr){ 
        return ( arr.join(''));
    }
} 
/* 
import {Student} from "/js/student_history.js";
(function() {  window.studentObj = new Student(studentCon);  })();   */
</script> 
<script src="{{asset('js/student_history.js')}}"> </script> 
<script src="{{asset('js/update_profile_data.js')}}"> </script> 
@stop

