$(function(){

 	$(".all").sortable({
 		placeholder:"ui-state-highlight",
 		update: function(e,ui){
 			$(".all").sortable("disable");
 			var SA = "";
 			$(".all li").each(function(i){
 				SA = SA+(i+1)+":"+$(this).attr("data-rel")+";";
 			})
 			//console.log(SA);
			$.post(
				"../php/ajax-changeSort.php",
				{Toswitch:SA},
				function(d){
					$(".all li").each(function(i){
						$(this).attr("data-rel",i+1);//On met à jour les data-rel
						$(".all").sortable("enable");
					})
					//Nothing to say here, it's automatic !
				}
			);
 		},
 		stop:function(){
	    	// enable text select on inputs
	    	$(".all").find("input").bind('mousedown.ui-disableSelection selectstart.ui-disableSelection',function(e){
		      		e.stopImmediatePropagation();
	    		}
	    	);
	    }
 	}).disableSelection();

 	// enable text select on inputs
	$(".all").find("input").bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e){
		e.stopImmediatePropagation();
	});


	$("input.title").keyup(function(){
		toInput = $(this).val();
		initial = $(this).attr("data-initial");
		var numb = $(this).parent().attr("data-rel");
		if(toInput!=initial){
			$.post(
				"../php/ajax-putnewttl.php",
				{idblog:numb,neoValue:toInput},
				function(d){
					//Nothing to say here, it's automatic !
				}
			);
		};
	})

	$(".suppress").click(function(e){
		e.preventDefault();
		var elt = $(this).parent();
		var numb = elt.attr("data-rel");
		var numbElts = elt.parent().find("li:last-child").attr("data-rel");
		$.post(
			"../php/ajax-toSuppress.php",
			{idblog:numb,total:numbElts},
			function(){
				elt.slideUp("slow",function(){
					elt.remove();
					$(".all li").each(function(ind){
						$(this).attr("data-rel",ind+1);
					})
				});
			}
		);
	})



})