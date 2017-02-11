$(document).ready(function(){


	// DEFINE HEIGHTS
	$windowHeight = $(window).height();
	$padding = 3*($(window).height()/100);
	defineHeight();

	function defineHeight() {
		$(".content").css("height",$windowHeight/2);
		$(".mainContent").css("height",$windowHeight);
		$(".imageGridContainer").css("height",$windowHeight/2);
	}


	// PARTNERS TRANSITION
	$(".partners").click(function(){
		$(".grid2").load("partners.php").hide().fadeIn('slow');
		$(".grid2").removeClass("grid2").removeClass("imageGridContainer").addClass("content");
		defineHeight();
	});

	// CAROUSEL
	$duration = 1000;
	$grids = $(".imageGridContainer img:last-child");
	console.log($grids);
	$grids.delay(1000).fadeOut($duration);

}); 