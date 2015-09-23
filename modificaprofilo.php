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
	</style>
	<div id="central">
	<?php
		require("connect.php");
		session_start();
		$codfiscale=$_SESSION['utente'];
		$permessi=$_SESSION['permessi'];
		if($permessi){
			$sp="SELECT Password FROM UtentiRegistrati WHERE CodiceFiscale='".$codfiscale."';";
			$res=mysqli_query($conn, $sp);
			$row1=mysqli_fetch_array($res);
			$pasu=$row1['Password'];
			$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
			$r_city=mysqli_query($conn,$city);
			if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	?>
				<h1 class="head">Modifica profilo</h1>
				<form action="modificaprofilo.php" method="post">
					<p><h4>Password attuale<span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
					<input type="password" name="pswv"></p>
					<p>Inserisci solo i campi che desideri modificare</p>
					<p><h4>Risiedo a </h4>
					<select name="risiede">
						<option value="non_agg">Modifica</option>
	<?php
						while ($row=mysqli_fetch_array($r_city)){
	?>
							<option value="<?php echo $row['CodCitta'];?>">
	<?php
							echo $row['Nome'].", (".$row['Provincia'].")";
						}
	?>
					</select>
					<p>Se la tua citt&#224 non &egrave; presente clicca <a href="creacitta.php">qui</a></p>
					<p><h4>Indirizzo </h4>
					<input type="text" name="ind"></p>
					<p><h4>CAP </h4>
					<input type="text" name="CAP" ></p>
					<p><h4>E-mail </h4>
					<input type="text" name="email"></p>
					<p><h4>Telefono</h4>
					<input type="text" name="tel"></p>
					<p><h4>Nuova password </h4>
					<input type="password" name="psw"></p>
					<p><h4>Conferma nuova password </h4>
					<input type="password" name="psw2"></p>
					<p>
					<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
					<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
				</form>
	<?php
			}else{
				$pswv=$_POST['pswv'];
				$risiede=$_POST['risiede'];
				$ind=$_POST['ind'];
				$cap=$_POST['CAP'];
				$email=$_POST['email'];
				$tel=$_POST['tel'];
				$psw=$_POST['psw'];
				$psw2=$_POST['psw2'];
				$enc_pswv=md5($pswv);
				if($enc_pswv!=$pasu){
	?>
					<h1 class="head">Modifica profilo</h1>
					<form action="modificaprofilo.php" method="post">
	<?php
					echo "Controlla di aver inserito la password attuale correttamente!";
	?>
						<p><h4>Password attuale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
						<input type="password" name="pswv"></p>
						<p>Inserisci solo i campi che desideri modificare</p>
						<p><h4>Risiedo a </h4>
						<select name="risiede">
							<option value="non_agg">Modifica</option>
	<?php
							$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
							$r_city=mysqli_query($conn,$city);
							while ($row=mysqli_fetch_array($r_city)){
	?>
								<option value="<?php echo $row['CodCitta'];?>">
	<?php
								echo $row['Nome'].", (".$row['Provincia'].")";
							}
	?>
						</select>
						<p>Se la tua citt&#224 non &egrave; presente clicca <a href="creacitta.php">qui</a></p>
						<p><h4>Indirizzo </h4>
						<input type="text" name="ind"></p>
						<p><h4>CAP </h4>
						<input type="text" name="CAP" ></p>
						<p><h4>E-mail </h4>
						<input type="text" name="email"></p>
						<p><h4>Telefono </h4>
						<input type="text" name="tel"></p>
						<p><h4>Nuova password </h4>
						<input type="password" name="psw"></p>
						<p><h4>Conferma nuova password </h4>
						<input type="password" name="psw2"></p>
						<p>
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p></form>
	<?php
				}else{
					 if ((($risiede=="non_agg") and !$cap and !$ind and !$email and !$tel and !$psw and !$psw2)){
	?>
					<h1 class="head">Modifica profilo</h1>
					<form action="modificaprofilo.php" method="post">
						Controlla di aver inserito almeno un campo
						<p><h4>Password attuale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
						<input type="password" name="pswv"></p>
						<p>Inserisci solo i campi che desideri modificare</p>
						<p><h4>Risiedo a </h4>
						<select name="risiede">
							<option value="non_agg">Modifica</option>
	<?php
							$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
							$r_city=mysqli_query($conn,$city);
							while ($row=mysqli_fetch_array($r_city)){
	?>
								<option value="<?php echo $row['CodCitta'];?>">
	<?php
								echo $row['Nome'].", (".$row['Provincia'].")";
							}
	?>
						</select>
						<p>Se la tua citt&#224 non &egrave; presente clicca <a href="creacitta.php">qui</a></p>
						<p><h4>Indirizzo </h4>
						<input type="text" name="ind"></p>
						<p><h4>CAP </h4>
						<input type="text" name="CAP" ></p>
						<p><h4>E-mail </h4>
						<input type="text" name="email"></p>
						<p><h4>Telefono </h4>
						<input type="text" name="tel"></p>
						<p><h4>Nuova password </h4>
						<input type="password" name="psw"></p>
						<p><h4>Conferma nuova password </h4>
						<input type="password" name="psw2"></p>
						<p>
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p></form>
	<?php
					}else{
						if ($psw and $psw!=$psw2){
	?>
						<h1 class="head">Modifica profilo</h1>
						<form action="modificaprofilo.php" method="post">
						Controlla di aver inserito almeno un campo
						<p><h4>Password attuale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
						<input type="password" name="pswv"></p>
						<p>Inserisci solo i campi che desideri modificare</p>
						<p><h4>Risiedo a </h4>
						<select name="risiede">
							<option value="non_agg">Modifica</option>
	<?php
							$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
							$r_city=mysqli_query($conn,$city);
							while ($row=mysqli_fetch_array($r_city)){
	?>
								<option value="<?php echo $row['CodCitta'];?>">
	<?php
								echo $row['Nome'].", (".$row['Provincia'].")";
							}
	?>
						</select>
						<p>Se la tua citt&#224 non &egrave; presente clicca <a href="creacitta.php">qui</a></p>
						<p><h4>Indirizzo </h4>
						<input type="text" name="ind"></p>
						<p><h4>CAP </h4>
						<input type="text" name="CAP" ></p>
						<p><h4>E-mail </h4>
						<input type="text" name="email"></p>
						<p><h4>Telefono </h4>
						<input type="text" name="tel"></p>
	<?php
						echo "Le password inserite devono essere uguali!";
	?>
						<p><h4>Nuova password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
						<input type="password" name="psw"></p>
						<p><h4>Conferma nuova password<span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
						<input type="password" name="psw2"></p>
						<p>
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p></form>
	<?php
						}else{
							$s1="UPDATE UtentiRegistrati SET ";
							if($risiede!="non_agg"){
								$s1=$s1."Risiede=".$risiede.", ";
							}
							if($cap){
								$s1=$s1."CAP='".$cap."', ";
							}
							if($ind){
								$s1=$s1."Indirizzo='".$ind."', ";
							}
							if($email){
								$s1=$s1."Email='".$email."', ";
							}
							if($tel){
								$s1=$s1."NumTel='".$tel."', ";
							}
							if($psw){
								$s1=$s1."Password=MD5('".$psw."'), ";
							}
							$s1=$s1.",";
							$s1 = str_replace(", ,", ' ', $s1);
							$s1=$s1."WHERE CodiceFiscale='".$codfiscale."';";
							$resup=mysqli_query($conn, $s1);
							if (mysqli_affected_rows($conn)>0){
								echo "La modifica del profilo &egrave; andata a buon fine. I dati sono stati aggiornati correttamente.";
							}else if (mysqli_affected_rows($conn)==0){
								echo "La modifica non &egrave; andata a buon fine.";
							}
						}
					}
				}
			}
		}else{
	?>
				<h1 class="head">Devi aver fatto il login per accedere a questa pagina</h1>
	<?php
		}
	?>
		</div>
	</body>
</html>
