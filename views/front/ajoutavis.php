
<?PHP
include "entities/avis.php";
include "core/avisC.php";

if (isset($_POST['num']) and isset($_POST['type'])and isset($_POST['commentaire']) )
{
$avis1=new avis($_POST['num'],$_POST['type'],$_POST['commentaire']);
$avis1C=new avisC();
$avis1C->ajouteravis($avis1);

$message='votre avis est publié ';
echo $message;
header('Location:afficheravis.php');
}
else
{
	echo "vérifier les champs";
}
?>
