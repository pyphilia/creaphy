<!DOCTYPE html>
<html>
<?php include("head.php"); ?>

<body>
	<div id="blank"></div>
	<?php 
	include("header.php");
	include("navigation.php"); 
	?>

	<section id="partners">
		<div class="partners_content">
			<div class="desc">
				<?php include("partners_link.php"); ?>
			</div>
			<a href="mailto:pyphilia@gmail.com">Wish a partnership? Contact me!</a>

<!-- 
			<p id="sources">
				<?php include("sources.php"); ?>
			</p> -->
		</div>
	</section>

	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript">
		$("#blank").css("height", getCorrespondingHeight() + "px");
		$(".partners_content").css("width",getCorrespondingWidth()+"px");
	</script>

<?php include("footer.php"); ?>

</body>
</html>