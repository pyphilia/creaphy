function tumblrPrevent(element){
	var properties = element.getBoundingClientRect();
	var top = properties.width + properties.top;
	var left = properties.left - 30; 
	d3.select("#sns").append("div")
	.attr("style","font-size:2em;font-family: 'Arizonia';position:fixed; left:" + left + "px;top:" + top + "px")
	.html("Coming soon!");
}

$(document).ready(function() {

	// apply init position

	displayProjects(data);

	var projectWidth = getCorrespondingWidth();
	var projectMargin = $(".project").css("marginLeft").replace(/[a-z]/g, '') * 2;
	var marginLeft = (window.innerWidth - projectWidth - projectMargin)/2;

	/*console.log(projectWidth + " > " + projectMargin + " > " + marginLeft );*/

	$(".project").css("width",projectWidth);
	$(".project_wrapper").css("margin-left",marginLeft);
	$("#blank").css("height", getCorrespondingHeight() + "px");


	var MAXSLIDE = data.length + 1; 
	var widthProjectElement = projectWidth + projectMargin; 
	var currentProject = 0;

	focusProject(currentProject, "none");


	$("#arrowRight").on("click",function(){

		focusProject("right");

	});

	$("#arrowLeft").click(function(){
		focusProject("left");

	});


	function focusProject(direction) {

		console.log("current project : " + currentProject);

		switch(direction){
			case "left": 
			if (currentProject != 0) {
				console.log("left");
				marginLeft += widthProjectElement; 
				currentProject -= 1;
			}
			break;
			case "right": 
			if (currentProject != MAXSLIDE -1) {
				console.log("right");
				marginLeft -= widthProjectElement; 
				currentProject += 1;
			}
			break;
			case "none": 
			break;
			
		}

		$(".project").addClass("blurred");
		$(".project[data-num='"+(currentProject)+"']").removeClass("blurred");


		$(".project_wrapper").animate({"marginLeft": (marginLeft) + "px" },700);
	}
});


function displayProjects(myData){
	var wrapper = d3.select(".project_wrapper");
	var projects = wrapper.selectAll(".none").data(myData).enter().each(function(d,i){

		var desc = wrapper.append("div").attr("class","project ").attr("data-num",i+1);
		/*.attr("style","border:3px solid " + d.color + "; border-width: 3px 0;");*/
		desc.append("h2").text(d.title);
		desc.append("div").attr("class","desc").text(d.desc.fr);

		var lightGallery = desc.append("div").attr("class","lightgallery");
		d.img.forEach(function(e){
			lightGallery.append('a').attr("href",e.original)
			.append('img').attr("src",e.thumb); 
		});

	});
}