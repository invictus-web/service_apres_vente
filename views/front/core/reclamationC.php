<?PHP
include "config.php";
class reclamationC {
function afficherrec (){
		echo "num: ".$reclamation->getnum()."<br>";
		echo "datee: ".$reclamation-> getdatee()."<br>";
		echo "sujet: ".$reclamation->getsujet()."<br>";
		echo "msg: ".$reclamation->getmessage()."<br>";
		
	}

	function afficherreclam($num){
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.num= a.num";
		$sql="SElECT * From reclamation  where num= :num";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		$liste->bindValue(':num',$num);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}
	
	function ajoutReclamation($reclamation){
		$sql="insert into reclamation (num,datee,sujet,message,mail) values (:num, :datee,:sujet,:message,:mail)";
		$db = config::getConnexion();
		try{
        $req=$db->prepare($sql);
		
        $num=$reclamation->getnum();
        $datee=$reclamation->getdatee();
        $sujet=$reclamation->getsujet();
        $message=$reclamation->getmessage();
        $mail=$reclamation->getmail(); 

        
		$req->bindValue(':num',$num);
		$req->bindValue(':datee',$datee);
		$req->bindValue(':sujet',$sujet);
		$req->bindValue(':message',$message);
		$req->bindValue(':mail',$mail);
		
		
            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
		
	}


		public function listReclamation()
	{

		$db =config::getConnexion();
		$sql = "SELECT * FROM reclamation";
		$result = $db->query($sql);
		return $result;

	}
	
	function afficherreclamation(){
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.num= a.num";
		$sql="SElECT * From reclamation";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}
	function supprimerrec($num){
		$sql="DELETE FROM reclamation where num= :num";
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
	function modifierrec($reclamation,$num){
		$sql="UPDATE reclamation SET num=:numn, datee=:datee,sujet=:sujet,message=:message WHERE num=:num";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{		
        $req=$db->prepare($sql);
		$numn=$reclamation->getnum();
        $datee=$reclamation->getdatee();
        $sujet=$reclamation->getsujet();
        $message=$reclamation->getmessage();
       
		$datas = array(':numn'=>$numn, ':num'=>$num, ':datee'=>$datee,':sujet'=>$sujet,':message'=>$message);
		$req->bindValue(':numn',$numn);
		$req->bindValue(':num',$num);
		$req->bindValue(':datee',$datee);
		$req->bindValue(':sujet',$sujet);
		$req->bindValue(':message',$message);
		
		
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
		
	}
	
	function recupererrec($num){
		$sql="SELECT * from reclamation where num=$num";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	
/*	function rechercherListerec($tarif){
		$sql="SELECT * from employe where tarifHoraire=$tarif";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}*/

	/* public function chercherrec($num)
        {
            $sql="SELECT * from reclamation where num=$num";
           // $req=$this->db->prepare($query);
            $liste=$this->db->query($query);
            return $liste;
        }*/


function triernum(){
		$sql="SElECT * From reclamation ORDER BY num ";
		$db = config::getConnexion();
		try{
		$list=$db->query($sql);
		return $list;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}


function trier(){
		$sql="SElECT * From reclamation ORDER BY sujet ";
		$db = config::getConnexion();
		try{
		$list=$db->query($sql);
		return $list;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}


function rechercherListeReclamation($num){
		$sql="SELECT * from reclamation where num=$num";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	public function rechercher($num)
    {
        $sql="SELECT * from reclamation where num='$num'";
         //connexion bd
        $db = config::getConnexion();
        //reqt sql
        //fetch data
        try
        {
        	$liste=$db->query($sql);
        	return $liste;
        }
        catch (Exception $e)
        {
        	die('Erreur:'.$e->getMessage());
        }
    }

}

?>