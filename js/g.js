$(function(){
	$(document).keypress(function(e){
	    if(e.keyCode == 37){
	    	document.location.href = $("a.prev:not(.inactive)").attr("href");
	    }else if(e.keyCode == 39){
	    	if($("a.next:not(.inactive)").length>0){
	    		document.location.href = $("a.next:not(.inactive)").attr("href");
	    	}
	    }
	});
})