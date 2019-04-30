<?PHP
include "C:/wamp64/www/back/pages/config.php";
class avisC 
{
	
	function ajouteravis($avis){
		$sql="insert into avis (num,type,commentaire) values (:num, :type , :commentaire)";
		$db = config::getConnexion();
		try{
		$num=$avis->getnum();
        $req=$db->prepare($sql);
        $type=$avis->gettype();
		$commentaire=$avis->getcommentaire();
      
       
       $req->bindValue(':num',$num);
		$req->bindValue(':type',$type);
		$req->bindValue(':commentaire',$commentaire);
		
		
		
            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }

	}


function afficheravis(){
		
		
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.cin= a.cin";
		$sql="SElECT * From avis  ";
		$db = config::getConnexion();

		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}


	function supprimeravis($num){
		$sql="DELETE FROM avis where num= :num";
		$db = config::getConnexion();
        $req=$db->prepare($sql);
		$req->bindValue(':num',$num);
		try{
            $req->execute();
           // header('Location: index.php');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	


	
	//// AFFICHAGE FRONT////
	/*
	function afficheravis1($mail_client){
		
		
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.cin= a.cin";
		$sql="SElECT * From avis where mail_client= '$mail_client' ";
		$db = config::getConnexion();

		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}*/
	function triercin(){
		$sql="SElECT * From avis ORDER BY num ";
		$db = config::getConnexion();
		try{
		$list=$db->query($sql);
		return $list;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	


	function modifieravis($avis,$num){
		$sql="UPDATE avis SET num=:con , type=:type, commentaire=:commentaire WHERE num=:num";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{		
        $req=$db->prepare($sql);
		$con=$avis->getnum();
		$type=$avis->gettype();
        $commentaire=$avis->getcommentaire();
        
       
		$datas = array(':con'=>$con, ':num'=>$num, ':commentaire'=>$commentaire,':type'=>$type);
		$req->bindValue(':con',$con);
		$req->bindValue(':num',$num);
		$req->bindValue(':type',$type);
		$req->bindValue(':commentaire',$commentaire);
				
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
	
	}


	
	function recupereravisc($num){
		$sql="SELECT * from avis where num=$num";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}

	
}

?>