<?PHP
include "core/avisC.php";




$avisC=new avisC();
if (isset($_POST["num"])){
	$avisC->supprimeravis($_POST["num"]);
	header('Location: afficheravis.php');
}


?>
