<?php

class Notifcore

{		function check(){
	    $serv="localhost";
		$use="root";
		$pass="";
		$dbname="projet";
		$con=mysqli_connect($serv,$use,$pass,$dbname);
		$sql="SELECT COUNT(numero) AS total FROM reclamation where `notif`= 0";
		//$sql="SELECT COUNT(id) AS total FROM f_souscategories WHERE id_categorie=:id";
   		//$db = config::getConnexion();
   		$result=mysqli_query($con,$sql);
   		$values=mysqli_fetch_assoc($result);
   		$num=$values['total'];
   		echo $num;

   		return $num;
		
}
}