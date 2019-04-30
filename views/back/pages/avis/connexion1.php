<html>
<head>
<meta charset="utf8">
</head>
<body>
<?php 
include 'C:/wamp64/www/back/pages/entities/User.php';
//$log="admin";
//$pwd="admin";
/*$servername="localhost";
	$username="root";
	$password="";
	$dbname="dblogin";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", 
	$username, $password);
	$req="select * from users where user_name='$login' && user_pass='$pwd'";
	$rep=$conn->query($req);
	$res=$rep->fetchAll();
	*/
$conn= config::getConnexion();
$user=new User($_POST['Email'],$_POST['Password'],$conn);
$u=$user->Logedin($conn,$_POST['Email'],$_POST['Password']);

	//var_dump($u);
//$logR=$_POST['login'];
//$pwdR=$_POST['pwd'];
$vide=false;

if (!empty($_POST['Email']) && !empty($_POST['Password'])){
	
	foreach($u as $t){
		$vide=true;
	if ($t['user_email']==$_POST['Email'] && $t['user_pass']==$_POST['Password']) {
		
		session_start();
		$_SESSION['l']=$_POST['Email'];
		$_SESSION['p']=$_POST['Password'];
		/*Recuperation de la base de donnees */
		$_SESSION['n']=$t['user_name'];
		$_SESSION['role']="admin";

		header("location:avisBack.php");




		}
		


	
}
if ($vide==false) { 
         // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
         echo '<body onLoad="alert(\'Membre non reconnu...\')">'; 

         // puis on le redirige vers la page d'accueil
         echo '<meta http-equiv="refresh" content="0;URL=loginnahla.php">'; 
      } 
}	  
 
else { 
      echo "Les variables du formulaire ne sont pas déclarées.<br> Vous devez remplir le formulaire"; 
     ?> <a href="location:loginnahla.php">Retour au formulaire</a>	 <?php 
}  

?> 
</body>
</html>