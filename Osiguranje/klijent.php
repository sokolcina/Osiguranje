
<?php 
	include_once"delovi/header.php";
	include_once"delovi/dbconnection.php";
	?>
<html>

<body>
<br>
<div id="glavni">
<form method="post">
	<div id="levi" >
	<center>
	<table>
	<tr><td><label>Imena osiguranja </label></td></tr>
	<?php
	$data=$con->query("SELECT * FROM osiguranja");
	while($res = mysqli_fetch_array($data))
{
		?>
	<tr><td><input type="radio" name="os" value="<?php echo $res['id_osiguranja'];?>" ><label><?php echo $res['ime'];?> </label></td></tr><?php
}
?>
	</table>
	</center>
	</div>
	<div id="desni">
	<center>
	<table>
	<tr><td><label>Imena i prezimena radnika </label></td></tr>
	<?php 
	$data=$con->query("SELECT * FROM radnik WHERE radno_mesto='agent prodaje'");

	while ($res=mysqli_fetch_array($data)) {
		?>
		<tr><td><input type="radio" name="ra" value="<?php echo $res['id_radnik'];?>" > <label><?php echo $res['ime']." ".$res['prezime'];?> </label></td></tr><?php

	}
	?>	
	</table>
	<br>
	<br>
	<br>
	</center>
	</div>
	<br> <br>
		<center><input type="date" name="datum"></center>
	<br> <br>
	<center><input type="submit" name="ugovor" value="Prihvati ugovor" ></center>
	<br>
	
</form>
<center><a href="home.php">
	<input type="submit" name="informacije" value="informacije"/>
	 </a></center>
</div>
</body>
</html>

	<?php 

if(isset($_POST['ugovor']))
{


	if(isset($_POST['os']) && isset($_POST['ra']) && isset($_POST['datum']))
		{
			$osiguranje=$_POST['os'];
			$radnik=$_POST['ra'];
			$datum=$_POST['datum'];
			$klijent=$_SESSION['id_klijent'];
			funkUgovor($klijent,$radnik,$osiguranje,$datum);
			
		}
	else {
		?>
		<script>alert("Morate odabrati datum,osiguranje kao i agenta prodaje."); </script><?php
	}
}

include "delovi/footer.php";
?>