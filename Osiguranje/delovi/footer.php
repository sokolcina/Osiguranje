<html>


<footer>
<br>
<?php if(isset($_SESSION['username']))
{
?>
	<p>Trenutno korisnicko ime jeste "<?php echo $_SESSION['username']; ?>"</p> <?php
}

?>
<a href="https://www.linkedin.com/in/stefan-sokolovi%C4%87-606974104?trk=nav_responsive_tab_profile_pic" target="blank" >
<img src="slike/linkedin.jpg" width="200" height="100" style="float:right;"/>
</a>

</footer>

</body>
</html>