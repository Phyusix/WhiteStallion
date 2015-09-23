<html>
	<body>
		<link rel="stylesheet" href="s_sheet.css" type="text/css">
		<style>
			body{
				font-family: georgia, verdana;
				text-align: center;
			}
			h1.head{
				color: #FF9900;
			}
			a:link{
				font-size: 10px;
				color: #000000;
			}
			a:visited{
				font-size: 10px;
				color: #000000;
			}
		</style>
		<div id="central">
			<h1 class="head">Registra la tua citt&#224;</h1>
		<?php
			require("connect.php");
			session_start();
			if ($_SERVER['REQUEST_METHOD'] != 'POST'){
		?>
		<form action="creacitta.php" method="post">
			<p><h4>Inserisci il nome della tua citt&#224;</h4>
			<input type=text name="citta"></p>
			<p><h4>Inserisci la provincia</h4>
			<input type=text name="prov"></p>
			<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" value="Invio">
			<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" value="Cancella">
		</form>
		<?php
			}else{
				$citta=$_POST['citta'];
				$prov=$_POST['prov'];
				if (!$citta or !$prov)
				{
		?>
		I campi sono obbligatori!
		<form action="creacitta.php" method="post">
			<p><h4>Inserisci il nome della tua citt&#224;</h4>
			<input type=text name="citta"></p>
			<p><h4>Inserisci la provincia</h4>
			<input type=text name="prov"></p>
			<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" value="Invio">
			<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" value="Cancella">
		</form>
		<?php
				} else {
					$s1="SELECT Nome, Provincia FROM Citta;";
					$result1=mysqli_query($conn,$s1);
					$trovato=false;
					while ($row1=mysqli_fetch_array($result1)){
						if (strtoupper($row1['Nome'])==strtoupper($citta) and strtoupper($row1['Provincia'])==strtoupper($prov)){
							$trovato=true;
						}
					}
					if (!$trovato){
						$s="INSERT INTO Citta (`Nome`,`Provincia`) VALUES ('".$citta."','".$prov."');";
						$r_s=mysqli_query($conn,$s);
						echo "La tua citt&agrave; &egrave; stata inserita corretamente";
					}else{
						echo "La citt&agrave; era gi&agrave; presente nell'elenco!";
					}
						if (!$_SESSION){
		?>
							<br><a href="registration.php">Torna alla registrazione!</a>
		<?php
						}else{
		?>
							<br><a href="modificaprofilo.php">Torna alla pagina di modifica del profilo!</a>
		<?php				
						}
				}
			}
		?>
		</div>
	</body>
</html>
