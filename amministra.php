<html>
	<body>
		<link rel="stylesheet" href="s_sheet.css" type="text/css">
		<style>
			body{
				font-family: italic, georgia, verdana;
				text-align: center;
			}
			h1.head{
				color: #FF9900;
			}
			a.centrale:link{
				font-size: 20px;
				color: #000000;
				text-decoration: none;
			}
			a.centrale:visited{
				font-size: 20px;
				color: #000000;
				text-decoration: none;
			}
		</style>
		<div id="central">
			<h1 class="head">Pagina di amministrazione</h1>
			<?php
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
			?>
					<a class="centrale" href="visualizza.php">Visualizza</a><br>
					<a class="centrale" href="richiesteamm.php">Le richieste</a><br>
					<a class="centrale" href="agg_rim dip.php">Aggiungi/rimuovi dipendente</a><br>
					<a class="centrale" href="agg_rim cavallo.php">Aggiungi/rimuovi cavallo</a><br>
					<a class="centrale" href="agg_rim concorso.php">Aggiungi/rimuovi concorso</a><br>
					<a class="centrale" href="vittoriaconcorso.php">Aggiungi vincitore concorso</a><br>
					<a class="centrale" href="assicurazioni.php">Visualizza assicurazioni</a><br>
			<?php
				}else{
			?>
					<h1 class="head"> Non hai i permessi per visualizzare questa pagina</h1>
			<?php
				}
			?>
		</div>
	</body>
</html>

