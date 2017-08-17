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
	<script type="text/javascript" src="js/projectData"></script>
	<script type="text/javascript" src="js/main.js"></script>


	<div id="project_content_table">
		<div id="project_content_tablecell">

			<h1>Créaphy</h1>
			<?php include("navigation.php") ?>
			<section id="content">
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

					<span><a target="_blank" href="https://www.instagram.com/b2utily_flareon/"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
					<span><a target="_blank" href="https://www.linkedin.com/in/kim-lan-phan-hoang-a457bb130/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></span>
				</div>

			</section>
		</div>
	</div>

	<script>
		// set lightboxes 
		var lightboxes = document.getElementsByClassName('lightgallery');
		[].forEach.call(lightboxes, function(e){
			lightGallery(e);
		});

	</script>

</body>

</html> 