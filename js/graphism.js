$(document).ready(function(){
	$("#creation_content").css("height", window.innerHeight + "px"); 
	$("#creation_content .list").css("height", (window.innerHeight-200) + "px"); 

	if(window.innerWidth <= 600) {
		$("#creation_content .sublinks").html("");
	}
	else {
		$("#sidebar .sublinks").html("");

	}
});