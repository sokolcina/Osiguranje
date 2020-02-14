<html>
<?php session_start(); 

include "funkcije/funkcije.php"; ?>
<head><link rel="stylesheet" type="text/css" href="style/style.css"></head>
<div id="hed">
<h4>Osiguranje
  <form method="post"><input name="logout" type="submit"  style="float: right;" value="Izloguj se"></form>
<?php if(@isset($_POST['logout']))
{
	flogout();
}?>
</h4>
</div>
</html>