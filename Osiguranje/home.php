<html>
<link rel="stylesheet" type="text/css" href="style/style1.css">
<?php 
		include_once "delovi/header.php";
		include_once "delovi/dbconnection.php";
?>
<body>

<div id="home">
<img src="slike/kuca.jpg" style="float: right;"/>
<dl id="lista">
<?php
	$data=$con->query("SELECT * FROM osiguranja");
	while($res = mysqli_fetch_array($data))
{
		?>
	
  <dt><label><?php echo $res['ime'];?> </label></dt><dd><p> - <?php
  echo $res['informacije']; ?> Mesecna rata ovog osiguranja iznosi  <?php echo $res['mesecna_rata']; ?> dinara. </p></dd> <?php
}
?>
</dl>
<center>
<br>
<a href="klijent.php">
<input type="submit" name="ugovor1" value="Odabir ugovora"/>
</a>
</center>
</div>
<?php include_once "delovi/footer.php"; ?>
</body>
</html>