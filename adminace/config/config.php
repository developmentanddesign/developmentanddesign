<?php  
	$conn=mysqli_connect('localhost','root','');
	$db=mysqli_select_db($conn,'acedata')
	or die("Conncetion Error");	
?>