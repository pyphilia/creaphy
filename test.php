<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Créaphy</title>
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="node_modules\lightgallery.js\dist\css\lightgallery.css">
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Petit+Formal+Script" rel="stylesheet"> 
	<link rel="stylesheet" href="css/build/css/styles_1.css">
</head>

<body>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="node_modules\lightgallery.js\dist\js\lightgallery.js"></script>
	<script type="text/javascript" src="lib/d3/d3.js"></script>
	<script type="text/javascript" src="js/main.js"></script>



	<div class="blank">
	</div>

	<h1>Créaphy</h1>
	<?php include("navigation.php") ?>
	<section id="content">
		<div class="intro">
			<!-- first one -->
			<div class="project_wrapper">
				
				<div class="project" data-num="0">
					<h2>pyphi(lia)</h2>
					<p>
						graphist, developer and programmer<br/>Computer Science Master student<br/>Switzerland<br/>
					</p>
					<a href="mailto:pyphilia@gmail.com">pyphilia@gmail.com</a>
					<div class="lightgallery">
						<a href="http://i.imgur.com/6xnX76f.png">
							<img src="http://i.imgur.com/6xnX76f.png"/>
						</a>
					</div>
				</div>



			</div>

			<div id="sns">
				<span><a target="_blank" href="https://www.facebook.com/creaphy?ref=hl"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></span>
				<span><a target="_blank" href="http://cyberoppa.tumblr.com/"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></span>

				<span id="arrowLeft"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
				<span id="arrowRight"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>

				<span><a target="_blank" href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
				<span><a target="_blank" href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></span>
			</div>

		</div>

		<!-- <div class="nextProjects">

	</div> -->
</section>

<script>

		// project contents
		var data = [
		{

			"img":["http://i.imgur.com/Tv0d3y0.png","http://i.imgur.com/Tv0d3y0.png"],
			"title": "mnemosyne",
			"desc":  "dwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbgdwp w fwmf lwe fomwe fe gre ger gerg erg erg er gerg 5h j 5j hergdfv  rhter ghrbg"
		},
		{
			"img":["http://i.imgur.com/pBZ3msW.png"],
			"title": "creaphy",
			"desc":  "dwp w fwmf lwe fomwe fe"
		},
		{
			"img":["http://i.imgur.com/pBZ3msW.png"],
			"title": "creaphy",
			"desc":  "dwp w fwmf lwe fomwe fe"
		}
		];


		displayProjects(data);


/*

		var projectWidth = window.innerWidth * 1/1.5;

< 871

		var projectWidth = window.innerWidth * 1/2;

< 860_1292

> 
		var projectWidth = window.innerWidth * 1/2.7;
		marginleft : 30%

		*/

		// apply init position
		var projectWidth = window.innerWidth * 1/1.3;
		var projectMargin = $(".project").css("marginLeft").replace(/[a-z]/g, '') * 2;
		var marginLeft = (window.innerWidth - projectWidth - projectMargin)/2;
		alert(projectWidth +">"+ projectMargin + " > " + marginLeft);

		$(".project").css("width",projectWidth);
		$(".project_wrapper").css("margin-left",marginLeft);


		function displayProjects(myData){
			console.log("displayprojects");
			var wrapper = d3.select(".project_wrapper");
			var projects = wrapper.selectAll(".none").data(myData).enter().each(function(d,i){

				var desc = wrapper.append("div").attr("class","project ").attr("data-num",i+1);
				desc.append("h2").text(d.title);
				desc.append("div").attr("class","desc").text(d.desc);

				var lightGallery = desc.append("div").attr("class","lightgallery");
				console.log(d.img);
				d.img.forEach(function(e){
					lightGallery.append('a').attr("href",function(p){return p})
					.append('img').attr("src",function(p){return e}); 
				});

			});
		}

		// get random number which will be inside the screen and not overlap content
		function getPossibleRandom(screenSize, isWidth){

			var topMargin = screenSize*0.07;
			var rightMargin = screenSize - screenSize*0.07;
			var bottomMargin = screenSize - screenSize*0.15;
			var leftMargin = screenSize*0.15;

			var innerMargin = (isWidth) ? screenSize*0.2 : screenSize;
			var outerMargin = (isWidth) ? screenSize - screenSize*0.3 : 0;

			var r = 0;
			do {
				r = Math.random()*screenSize;
			}
			while(r < topMargin || r < leftMargin || r > rightMargin || r > bottomMargin || (r > innerMargin && r < outerMargin));

			return r;
		}


		$(document).ready(function(){
			// random sns position
			/*var randomX = getPossibleRandom(window.innerWidth, true);
			var randomY = getPossibleRandom(window.innerHeight, false);

			console.log(randomX);
			console.log(randomY);

			var sns = document.getElementById("sns");

			sns.style.left = randomX + "px";
			sns.style.top = randomY + "px";

			sns = $("#sns");

			sns.fadeIn("slow");*/

		});


	</script>


	<script>
		// set lightboxes 
		var lightboxes = document.getElementsByClassName('lightgallery');
		[].forEach.call(lightboxes, function(e){
			lightGallery(e);
		});

	</script>

</body>

</html> 