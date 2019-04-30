<?PHP
include "entities/reclamation.php";
include "core/reclamationC.php";
 
 
if (isset($_POST['num']) and isset($_POST['datee']) and isset($_POST['sujet']) and isset($_POST['message']) ){
$reclamation1=new reclamation($_POST['num'],$_POST['datee'],$_POST['sujet'],$_POST['message'],"nahla.jemili@esprit.tn");

$reclamation1C=new reclamationC();
$reclamation1C->ajoutReclamation($reclamation1);

$message='votre reclamtion est prise en compte';
echo $message;
header('Location: afficherReclamation.php');	

}

else{

	$message='inserer vos données';
}
//*/

?>