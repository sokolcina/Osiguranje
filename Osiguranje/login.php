
<?php 



if(isset($_SESSION['username'])!="")
{
	if($_SESSION['status']==0){
		header("Location: home.php");
	}
 else {header("Location: admin.php");}
}


if(isset($_POST['log']))
{

 $uuser = mysqli_real_escape_string($con,$_POST['username']);
 $upass = mysqli_real_escape_string($con,$_POST['pass']);
 $upit=$con->query("SELECT * FROM klijent WHERE korisnicko_ime='$uuser' AND password = '$upass'");
 $row=$upit->fetch_assoc();
 
 if(isset($row))
{
		
  $_SESSION['username'] = $row['korisnicko_ime'];
  $_SESSION['id_klijent']=$row['id_klijent'];
  $_SESSION['status']=$row['status'];
  if($row['status']==0)
	{
	  ?>
		<script>alert('Uspesno ste ulogovani postovani klijentu.');</script>
		<?php
		header("Location: home.php");
	}
	else {
		
		?>
		<script>alert('Admine uspesno si ulogovan.');</script>
		<?php
		header("Location: admin.php");
		}
 
}
 else
 {
  ?>
        <script>alert('Pogresni podaci');</script>
        <?php
		header("Location: index.php");
 }
  
}

if(isset($_POST['reg']))
{
	
 $uuser = mysqli_real_escape_string($con,$_POST['username1']);
 $uemail = mysqli_real_escape_string($con,$_POST['email']);
 $upass = mysqli_real_escape_string($con,$_POST['pass1']);
 $uime = mysqli_real_escape_string($con,$_POST['ime']);
 $uprezime = mysqli_real_escape_string($con,$_POST['prezime']);
 $umesto =mysqli_real_escape_string($con,$_POST['mesto']);
 $ustarost =$_POST['starost'];
 if(ifExists($uuser,$upass))
  { ?>
        <script>alert('Klijent vec postoji sa tim korisnickim imenom.');</script>
        <?php 
    } 
   else
   {
 if($con->query("INSERT INTO klijent(korisnicko_ime,password,ime,prezime,starost,mesto_rodjenja,email,status) 
	 VALUES('$uuser','$upass','$uime','$uprezime',$ustarost,'$umesto','$uemail',0)"))
 {
  ?>
        <script>alert('Uspesno ste se registrovali ');</script>
        <?php

 }
 else
 {
  ?>
        <script>alert('Greska pri registraciji');</script>
        <?php

 }
}
}
?>

<html>
	
	<body>
	
<div id="logovanje">

<h3> Prijava </h3>

<form  method="post" style="display: inline-block">
	<table>
	<tr> <td align=right> Username: </td> <td> <input type="text" name="username"> </td> </tr>
	<tr> <td align=right> Password: </td> <td> <input type="password", name="pass"> </td> </tr>
	<tr> <td colspan=2 align=center> <input type="submit" name="log" value="Prijavi" style="width: 100%;"> </td> </tr>
	</table>
</form>

<h3> Registracija klijenta </h3>

<form method="post" style="display: inline-block">
	<table>
	<tr> <td align=right> Username: </td> <td> <input type="text" name="username1"> </td> </tr>
	<tr> <td align=right> Password: </td> <td> <input type="password", name="pass1"> </td> </tr>
	<tr> <td align=right> Ime </td> <td> <input type="text", name="ime"> </td> </tr>	
	<tr> <td align=right> Prezime </td> <td> <input type="text", name="prezime"> </td> </tr>	
	<tr> <td align=right> Starost </td> <td> <input type="number", name="starost"> </td> </tr>	
	<tr> <td align=right> Mesto rodjenja </td> <td> <input type="text", name="mesto"> </td> </tr>	
	<tr> <td align=right> Email </td> <td> <input type="email", name="email"> </td> </tr>	
	<tr> <td align=center colspan=2> <input type="submit" name="reg" value="Registruj" style="width: 100%;"> </td> </tr>
	</table>
</form>

</div></body>
<br>
</html>

