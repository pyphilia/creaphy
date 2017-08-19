
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<link rel="stylesheet" type="text/css" href="lib/chosen-1.4.2/chosen.css">
<body>

	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="lib/chosen-1.4.2/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="node_modules\lightgallery.js\dist\js\lightgallery.min.js"></script>
	<script type="text/javascript" src="js/graphism.js"></script>

	<section id="graphism">

		<div id="sidebar" class="col-sm-3">
			<?php 
			include("header.php");
			include("navigation.php");  ?>

		<!-- 	<div id="sublinks">
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
			</div>
 -->

		</div>

		<div id="creation_content" class="col-sm-9">

			<?php include("gallery.php"); ?>

			<div id="sublinks">
				<?php 
				global $CATEGORIES;
				foreach ($CATEGORIES as $key => $value) {
					echo '<a href="graphism.php?search[]=' . $key . '"><span>' . $key . '</span></a>';
				}
				 ?>
			</div>

		</div>


	</section>

</body>
</html>