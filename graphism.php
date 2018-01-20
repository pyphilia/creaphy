
<!DOCTYPE html>
<html>
<?php 
include("head.php");
require("token.php");
include("functions.php");
 ?>
	<link rel="stylesheet" href="css/build/css/desktop_styles.css">
<body>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="lib/chosen-1.4.2/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="node_modules\lightgallery.js\dist\js\lightgallery.min.js"></script>
	<script type="text/javascript" src="js/graphism.js"></script>

	<section id="graphism">

		<div id="sidebar" class="col-md-3">
			<?php 
			include("header.php");
			include("navigation.php");  ?>
			<nav><ul><li>
			<a style="color:red" href="http://essay.forumgratuit.ch" id="code_link">Code</a>
			</li></ul></nav>
		<!-- 	<div id="sublinks">
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
				<span>Avatars &amp; icons</span>
			</div>
 -->

			<div class="sublinks">
				<?php 
					printSublinks();
				 ?>
			</div>

		</div>

		<div id="creation_content" class="col-md-9">

			<?php include("gallery.php"); ?>

			<div class="sublinks">
				<?php 
					printSublinks();
				 ?>
			</div>

		</div>


	</section>

<?php include("footer.php"); ?>
</body>
</html>