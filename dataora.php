<html>
	<body>
		<link rel="stylesheet" href="s_sheet.css" type="text/css">
		<meta http-equiv=refresh content="1; URL=dataora.php">
		<div id="dataora">
			<?php
			function aggiornaOra(){
				$dataora=date("d-m-y H:i:s");
				echo "<center><font color=#000000>$dataora</font></center>";
			}
			aggiornaOra();
			?>
		</div>
	</body>
</html>
