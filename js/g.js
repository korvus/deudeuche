$(function(){
	$(document).keypress(function(e){
	    if(e.keyCode == 37){
	    	if(!$(".prev").hasClass("inactive")){
	    		document.location.href = $(".prev:not(.inactive)").attr("href");
	    	}
	    }else if(e.keyCode == 39){
	    	if($(".next:not(.inactive)").length>0){
	    		document.location.href = $("a.next:not(.inactive)").attr("href");
	    	}
	    }
	});
})