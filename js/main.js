$(document).ready(function() {




	alert(window.innerHeight + "_" + window.innerWidth);

	var widthProjectElement = projectWidth + projectMargin; // @TODO

	var currentProject = 0;

	focusProject(currentProject, "none");

	$("#arrowRight").on("click",function(){


		var num = $(this).parent(".circle").data("num");
		console.log(num);

		focusProject("right");

	});

	$("#arrowLeft").on("click",function(){
		var num = $(this).parent(".circle").data("num");
		console.log(num);

		focusProject("left");

	});

	function focusProject(direction) {

		var margin = parseFloat($(".project_wrapper").css("marginLeft").replace(/[a-z]/g, ''));
		var newMargin = margin;
		var MAXSLIDE = 6; // @TODO

		console.log(currentProject);

		switch(direction){
			case "left": 
			if (currentProject != 0) {
				newMargin += widthProjectElement; 
				currentProject -= 1;
			}
			break;
			case "right": 
			if (currentProject != MAXSLIDE) {
				newMargin -= widthProjectElement; 
				currentProject += 1;
			}
			break;
			case "none": 
			newMargin = 0; 
			break;
			default: console.log("ERROR"); break;
		}

		$(".project").addClass("blurred");
		$(".project[data-num='"+(currentProject)+"']").removeClass("blurred");


		$(".project_wrapper").animate({"marginLeft": (newMargin) + "px" },500,"swing");
	}
});

