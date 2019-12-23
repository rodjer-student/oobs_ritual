<!DOCTYPE html PUBLIC "//-W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 
		include_once "head.php";
	?>
</head>
<body>
	<div class = "all">
		<?php
			include_once "auth_button.php";
		?>	
		<div id="main">
			<div id="up">	
				<?php
					include_once "menu-up.php";
				?>
			</div>	
			<div id = "left">
				<?php
					include_once "menu.php";
				?>
			</div>
			<div id = "center">
				<div class = "sources">
					<?php
						include_once "sources/registers/near_east.php";
					?>
				</div>	
			</div>
		</div>
		<div id = "footer">
			<?php
				include_once "footer.php";
			?>
		</div>
	</div>
		<?php
			include_once "auth_poup.php";
		?>
</body>