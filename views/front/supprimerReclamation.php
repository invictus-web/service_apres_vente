<?PHP
include "core/reclamationC.php";




$reclamationC=new reclamationC();
if (isset($_POST["num"])){
	$reclamationC->supprimerrec($_POST["num"]);
	header('Location: afficherReclamation.php');
}

?>