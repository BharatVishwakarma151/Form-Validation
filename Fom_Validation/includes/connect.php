<?php
// mysql_connect
//mysqli_connect
//PDO

$con=mysqli_connect('localhost','root','','crudoperation');
if(!$con){
    die("Connection Failed".mysqli_connect_error());
}

?>