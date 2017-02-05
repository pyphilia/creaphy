<div id="content">
	<div class="row">
		<section id="aboutme">
			<div class="col col-md-4">	
				<div class="content">
					<div>
						<?php include("header.php"); ?>
						<?php include("navigation.php"); ?>
					</div>
				</div>

				<div class="imageGridContainer grid1">
					<?php 
					$imgUrl = array(
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16473080_1238356782917930_4597893354968339240_n.png?oh=c88da77d8a33f1d5dd25786d0219b71a&oe=590726B2",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16473080_1238356782917930_4597893354968339240_n.png?oh=c88da77d8a33f1d5dd25786d0219b71a&oe=590726B2",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16473080_1238356782917930_4597893354968339240_n.png?oh=c88da77d8a33f1d5dd25786d0219b71a&oe=590726B2",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16473080_1238356782917930_4597893354968339240_n.png?oh=c88da77d8a33f1d5dd25786d0219b71a&oe=590726B2"
						);
					displayGridImages($imgUrl);
					?>
				</div>
			</div>
		</section>

		<section id="aboutme">
			<div class="col col-md-4" style="background:#fafafa">	
				<div class="mainContent">
					<?php include("aboutme.php"); ?>
				</div>
			</div>
		</section>

		<section id="partners">
			<div class="col col-md-4">	
				<div class="top-right">
				<div class="imageGridContainer grid2">
						<?php 
						$imgUrl = array("https://scontent.xx.fbcdn.net/v/t1.0-9/16406787_1238356862917922_5035877735357193008_n.png?oh=70d54b2104e8689ac6ebdeb3d1df87e9&oe=590438F6",
							"https://scontent.xx.fbcdn.net/v/t1.0-9/16406787_1238356862917922_5035877735357193008_n.png?oh=70d54b2104e8689ac6ebdeb3d1df87e9&oe=590438F6",
							"https://scontent.xx.fbcdn.net/v/t1.0-9/16406787_1238356862917922_5035877735357193008_n.png?oh=70d54b2104e8689ac6ebdeb3d1df87e9&oe=590438F6",
							"https://scontent.xx.fbcdn.net/v/t1.0-9/16406787_1238356862917922_5035877735357193008_n.png?oh=70d54b2104e8689ac6ebdeb3d1df87e9&oe=590438F6");
						displayGridImages($imgUrl);
						?>
						
					</div>
				</div>
				<div class="imageGridContainer grid3">
					<?php 
					$imgUrl = array(
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16427629_1238356936251248_1026602133727008768_n.jpg?oh=093eb17b4962e594f516485283ad0c87&oe=5944A138",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16427629_1238356936251248_1026602133727008768_n.jpg?oh=093eb17b4962e594f516485283ad0c87&oe=5944A138",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16427629_1238356936251248_1026602133727008768_n.jpg?oh=093eb17b4962e594f516485283ad0c87&oe=5944A138",
						"https://scontent.xx.fbcdn.net/v/t1.0-9/16427629_1238356936251248_1026602133727008768_n.jpg?oh=093eb17b4962e594f516485283ad0c87&oe=5944A138",
						);
					displayGridImages($imgUrl);
					?>
				</div>
			</div>
		</section>
	</div>
</div>