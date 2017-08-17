<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Créaphy</title>
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="node_modules\lightgallery.js\dist\css\lightgallery.css">
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Petit+Formal+Script" rel="stylesheet"> 
	<link rel="stylesheet" href="css/build/css/styles.css">
</head>

<body>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="node_modules\lightgallery.js\dist\js\lightgallery.js"></script>
	<script type="text/javascript" src="lib/d3/d3.js"></script>
	<script type="text/javascript" src="js/main.js"></script>


	<div id="sns">
		<a target="_blank" href="https://www.facebook.com/creaphy?ref=hl"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
		<a target="_blank" href="http://cyberoppa.tumblr.com/"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a>
		<a target="_blank" href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
		<a target="_blank" href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
	</div>

	<div class="blank">
	</div>

	<h1>Créaphy</h1>
	<?php include("navigation.php") ?>
	<section id="content">
		<div class="intro">
			<!-- first one -->
			<div class="project">
				
				<div class="lightgallery">
					<a href="http://i.imgur.com/6xnX76f.png">
						<img src="http://i.imgur.com/6xnX76f.png"/>
					</a>
				</div>
				<div class="desc">
					<h2>pyphi(lia)</h2>
					<p>
						graphist, developer and programmer<br/>Computer Science Master student<br/>Switzerland<br/><a href="mailto:pyphilia@gmail.com">pyphilia@gmail.com</a>
					</p>
				</div>
				<div class="circle"></div>
				<div class="rect"></div>
			</div>

		</div>

		<div class="nextProjects">

		</div>
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


		function displayProjects(myData){
			console.log("displayprojects");
			var projects = d3.select(".nextProjects").selectAll("div").data(myData).enter().append("div").attr("class","project");

			console.log(projects);

			var lightbox = projects.append("div").attr("class","lightgallery")
			.each(function(d){
				d3.select(this).selectAll('img').data(function(p){return p.img}).enter()
				.append('a').attr("href",function(p){return p})
				.append('img').attr("src",function(p){return p});
			});


			var bloc = projects.append("div").attr("class","desc");
			bloc.append("h2").text(function(d){return d.title});
			bloc.append("p").html(function(d){return d.desc});

			projects.append("div").attr("class","circle");
			projects/*.filter(function(d,i){return i!=(myData.length-1)})*/.append("div").attr("class","rect");
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
			var randomX = getPossibleRandom(window.innerWidth, true);
			var randomY = getPossibleRandom(window.innerHeight, false);

			console.log(randomX);
			console.log(randomY);

			var sns = document.getElementById("sns");

			sns.style.left = randomX + "px";
			sns.style.top = randomY + "px";

			sns = $("#sns");

			sns.fadeIn("slow");

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