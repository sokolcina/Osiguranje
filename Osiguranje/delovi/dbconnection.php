<?php
//povezivanje na sql server i pravljenje objekta
$con = new mysqli("localhost", "root","", "osiguranje");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}

?>