<?PHP
include "C:/wamp64/www/back/pages/core/reclamationC.php";




$reclamationC=new reclamationC();
if (isset($_POST["num"])){
	$reclamationC->supprimerrec($_POST["num"]);
	header('Location: chartjs.php');
}

?>