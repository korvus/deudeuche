$(function(){

	$("#formConfig").submit(function(e){
		e.preventDefault();
		var ttl = $("#title").val();
		var desc = $("#desc").val();
		var ebps = $("#ebps").val();
		var ebmdp = $("#ebmdp").val();

		$.post(
			"../php/ajax-initBlog.php",
			{ttl:ttl,desc:desc,ebps:ebps,ebmdp:ebmdp},
			function(f){
				if(f=="1"){
					window.location.reload();
				}
				//Nothing to say here, it's automatic !
			}
		);
	})

})