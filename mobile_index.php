<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Créaphy</title>
	<link rel="stylesheet" type="text/css" href="node_modules\lightgallery.js\dist\css\lightgallery.css">
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Arizonia" rel="stylesheet"> 
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta property="og:image" content="img/icon.png" />
	<link rel="stylesheet" href="css/build/css/mobile_styles.css">
</head>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-25554003-5', 'auto');
	ga('send', 'pageview');

</script>
<body>
<br><br>
	<?php 
	include("header.php");
	?>

	<div id="sns">
		<span><a target="_blank" href="https://www.facebook.com/creaphy?ref=hl"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></span>
		<span onclick="tumblrPrevent(this)"><!-- <a target="_blank" href="http://cyberoppa.tumblr.com/"> -->
			<i class="fa fa-tumblr-square" aria-hidden="true"></i><!-- </a> -->
		</span>

		<span id="arrowLeft"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
		<span id="arrowRight"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>

		<span><a target="_blank" href="https://www.instagram.com/b2utily_flareon/"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
		<span><a target="_blank" href="https://www.linkedin.com/in/kim-lan-phan-hoang-a457bb130/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></span>
	</div>

	<section id="content">
		<!-- first one -->
		<div class="project_wrapper">

			<div class="project" data-num="0">
				<div id="flareon_img" style="background-image: url(http://rs596.pbsrc.com/albums/tt46/Arashi_The_Glaceon/HGSS-Overworld-Flareon-Runn.gif~c200)"></div>
				<h2>pyphi(lia)</h2>
				<p id="perso_desc" class="desc">

				</p>
				<a href="mailto:pyphilia@gmail.com">pyphilia@gmail.com</a>
			</div>



		</div>

	</section>


	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="node_modules\lightgallery.js\dist\js\lightgallery.js"></script>
	<script type="text/javascript" src="lib/d3/d3.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/projectData.js"></script>


	<script type="text/javascript">

		var language = window.navigator.userLanguage || window.navigator.language;

		function tumblrPrevent(element){
			var properties = element.getBoundingClientRect();
			var top = properties.width + properties.top;
			var left = properties.left - 30; 
			d3.select("#sns").append("div")
			.attr("style","font-size:2em;font-family: 'Arizonia';position:fixed; left:" + left + "px;top:" + top + "px")
			.html("Coming soon!");
		}

//alert(window.innerWidth + "/" + window.innerHeight);

$(document).ready(function() {

	// apply init position

	displayProjects(data);


	function focusProject(direction) {

		/*console.log("current project : " + currentProject);*/

		switch(direction){
			case "left": 
			if (currentProject != 0) {
				/*console.log("left");*/
				marginLeft += widthProjectElement; 
				currentProject -= 1;
			}
			break;
			case "right": 
			if (currentProject != MAXSLIDE -1) {
				/*console.log("right");*/
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

// depends on language
function displayProjects(myData){

	displayPersoDesc();

	var wrapper = d3.select(".project_wrapper");
	var projects = wrapper.selectAll(".none").data(myData).enter().each(function(d,i){

		var desc = wrapper.append("div").attr("class","project ").attr("data-num",i+1);
		/*.attr("style","border:3px solid " + d.color + "; border-width: 3px 0;");*/
		desc.append("h2").text(d.title);
		desc.append("div").attr("class","desc").text(function(e){
			if(language=="fr") {
				return d.desc.fr;
			}
			else {
				return d.desc.eng;
			}
		});

		var lightGallery = desc.append("div").attr("class","lightgallery");
		d.img.forEach(function(e){
			lightGallery.append('a').attr("href",e.original)
			.append('img').attr("src",e.thumb); 
		});

	});
}

function displayPersoDesc(){

	document.getElementById("perso_desc").innerHTML = (language == "fr") ? perso_desc.fr : perso_desc.eng ;
}
</script>

<script>
		// set lightboxes 
		$(document).ready(function(){
			var lightboxes = document.getElementsByClassName('lightgallery');
			[].forEach.call(lightboxes, function(e){
				lightGallery(e);
			});
		});

	</script>

	<?php include("footer.php"); ?>
</body>

</html> 