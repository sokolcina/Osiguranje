<?php
// za logovanje i unistavanje sesije
function flogout()
{
session_destroy();
header("location: index.php");
?>
		<script>alert("Uspesno ste izlogovani."); </script><?php
}
//za korisnicko ime i pw
	function ifExists($u,$p)
{
	global $con;
	$upit=$con->query("SELECT * FROM klijent WHERE korisnicko_ime='$u' AND password = '$p'");
	if($row=$upit->fetch_assoc())
		{return true; }
	else {return false;}
}
// ubacuje u bazu i povecava platu agentu za 10%
function funkUgovor($k,$r,$o,$d)
{
	global $con;
	if($con->query("INSERT INTO ugovor (datum,id_osiguranja,id_radnik,id_klijent) values 
		('$d',$o,$r,$k)"))
	{ ?>
		<script>alert('Uspesno ste prihvatili ugovor');</script><?php
	
	}
	else
	{	?>
		<script>alert('Doslo je do greske');</script><?php
	}
	$con->query("UPDATE radnik SET plata = plata*1.1 WHERE id_radnik=$r;");
}
//zaposljavanje
function funkZaposli($i,$pr,$s,$pl,$r)
{
	global $con;
	if($con->query("INSERT INTO radnik (ime,prezime,staz,plata,radno_mesto) values
			('$i','$pr','$s','$pl','$r')"))
	{
		?>
		<script>alert("Uposlili ste jos jednog radnika!"); </script><?php
	}
	else { ?> <script>alert("Doslo je do greske."); </script> <?php }
}
function tabelaRadnik()
{
	global $con;
	$res=$con->query("SELECT * FROM radnik");
	while($row = mysqli_fetch_array($res))
	{  ?>
		<tr><td><?php echo $row['ime']." ".$row['prezime']; ?></td><td><?php echo $row['staz']; ?></td><td><?php echo $row['plata'];?></td><td> <?php echo $row['radno_mesto'];?></td>
		<td><button name="otpusti" type="submit" value="<?php echo $row['id_radnik'];?>">Otpusti</button></td></tr>
 
		<?php
	}
}

function tabelaUgovor ()
{
	global $con;
	$res=$con->query("SELECT ugovor.id_ugovor,osiguranja.ime, klijent.ime,klijent.prezime, radnik.ime, radnik.prezime FROM
	 osiguranja, radnik, ugovor , klijent WHERE ugovor.id_osiguranja=osiguranja.id_osiguranja and ugovor.id_radnik=radnik.id_radnik and klijent.id_klijent=ugovor.id_klijent");
	
	
	while($row = mysqli_fetch_array($res))
	{  ?>
		<tr><td><?php echo $row[2]." ".$row[3] ?></td><td><?php echo $row[4]." ".$row[5] ?></td><td><?php echo $row[1]; ?> </td>
		<td><button name="raskini" type="submit" value="<?php echo $row[0];?>">Raskini ugovor</button></td></tr>
 
		<?php
	}
}

function ispitaj($var)
{
	if(isset($var)){
        if(strlen($var) > 3)
        { 
        	if(ctype_alpha($var))
        	{ return true; } else { return false;}
        } else 
        {
        	return false;
        }
    }
}

?>