<?php
	include_once "delovi/dbconnection.php";
	include_once "delovi/header1.php";
	//zaposljavanje radnika

	if(isset($_POST['zaposli']))
	{
		if(ispitaj($_POST['ime']) && ispitaj($_POST['prezime']) && (($_POST['staz'])!=0) && (($_POST['plata'])!=0) && ispitaj($_POST['radno_mesto']))
		{
			$ime = mysqli_real_escape_string($con,$_POST['ime']);
 			$prezime = mysqli_real_escape_string($con,$_POST['prezime']);
 			$staz = mysqli_real_escape_string($con,$_POST['staz']);
			$plata=mysqli_real_escape_string($con,$_POST['plata']);
			$radno_mesto=mysqli_real_escape_string($con,$_POST['radno_mesto']);
			funkZaposli($ime,$prezime,$staz,$plata,$radno_mesto);
			header("Location: admin.php");
		}
		else {
			?>
		<script>alert('Morate uneti sve parametre.');</script><?php
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	
</head>
<body> 

<div id="levi">
<form method="post" style="display: inline-block">
	<table>
	<tr> <td align=right> Ime </td> <td> <input type="text", name="ime"> </td> </tr>	
	<tr> <td align=right> Prezime </td> <td> <input type="text", name="prezime"> </td> </tr>	
	<tr> <td align=right> Staz </td> <td> <input type="number", name="staz"> </td> </tr>	
	<tr> <td align=right> Radno mesto </td> <td> <input type="text", name="radno_mesto"> </td> </tr>	
	<tr> <td align=right> Plata </td> <td> <input type="number", name="plata"> </td> </tr>	
	<tr> <td align=center colspan=2> <input type="submit" name="zaposli" value="Zaposli" style="width: 100%;"> </td> </tr>
	</table>
<br> <br> <br>
<center> <input type="submit" name="troskovi" value="Troskovi zaposlenih" > <br> <br>
<?php if(isset($_POST['troskovi']))
{
	$res=$con->query("SELECT sum(radnik.plata) FROM radnik");
	$row=$res->fetch_array(MYSQLI_NUM);
	?> <label><?php echo $row[0];?> </label> </center> <?php
}
?>
<br> <br>
<center>
</form>
</div>

<div id="srednji">
<form method="post" style="display: inline-block">
<table>
<tr style="font-size: 19px; font-style: italic;font-weight:bold"><td>Ime i prezime radnika</td><td>Staz radnika</td><td>Plata radnika</td><td>Radno mesto</td></tr>
<?php
	//otpustanje
	tabelaRadnik();

	if(isset($_POST['otpusti']))
		{ 	$r=$_POST['otpusti'];
			if($con->query("DELETE FROM radnik WHERE id_radnik=$r"))
			{
			?>
			<script>alert('Otpustili ste datog radnika');</script>
			<?php
			header("Location: admin.php");
			tabelaRadnik();
			}
			else {
				?>
			<script>alert('Ovaj radnik poseduje neke ugovore i ne mozete ga otpustiti.');</script>
			<?php
			}
		}
 ?>
</table>
<br>
<br> <br>
<center>
<input type="submit" name="max" value="Najveca plata" > 
<br><br>
<?php if(isset($_POST['max']))
{
	// najveca plata
	$res=$con->query("SELECT max(radnik.plata) FROM radnik");
	$row=$res->fetch_array(MYSQLI_NUM);
	?> <label><?php echo $row[0];?> </label> <?php
}
?>
</center>
</form>
</div>
<div id="desni">
<form method="post" style="display: inline-block">
<table>
<tr style="font-size: 19px; font-style: italic;font-weight:bold"><td>Ime klijenta</td><td>Ime radnika</td><td>Naziv osiguranja</td></tr>
<?php
	// prikaz ugovora
	tabelaUgovor();
	if(isset($_POST['raskini']))
		{ 	$u=$_POST['raskini'];
			$con->query("DELETE FROM ugovor WHERE id_ugovor =$u"); 

			?>
		<script>alert('Raskinuli ste ugovor sa datim klijentom.');</script>
		<?php
		header("Location: admin.php");
		}
?>
</table>
</div>
</form>

</div>
<?php include "delovi/footer.php"; ?>
</body>
</html>



	