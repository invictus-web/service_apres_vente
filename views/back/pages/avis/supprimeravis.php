<?PHP
include "C:/wamp64/www/back/pages/core/avisC.php";

$avisC=new avisC();
if (isset($_POST["num"])){
	$avisC->supprimeravis($_POST["num"]);
	header('Location: avisBack.php');
}

?>