<?php
$host="basidati.studenti.math.unipd.it";
$user="mboseggi";
$pwd="o6iuoM2G";
$conn=mysqli_connect($host , $user , $pwd)
or die($_SERVER[’PHP_SELF’] . "connessione fallita");
mysqli_select_db($conn, "mboseggi-PR");
?>
