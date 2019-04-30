<?PHP
class avis{
	private $num;
	private $type;
	private $commentaire;
	//private $date;
	//private $mail_client;
	//private $numero;
	
	
	function __construct($num,$type,$commentaire)
	{
		$this->num=$num;
		$this->type=$type;
		$this->commentaire=$commentaire;
		
		
	}

	function getnum(){
		return $this->num;
	}
	/*function getNumero(){
		return $this->numero;
	}
	function setNumero($numero){
		$this->numero=$numero;
	}*/
	function getcommentaire(){
		return $this->commentaire;
	}
	function gettype(){
		return $this->type;
	}
	/*function getDate(){
		return $this->date;
	}
	function getmail_client(){
		return $this->mail_client;
	}*/
	
function setnum($num){
		$this->num=$num;
	}
	function setcommentaire($commentaire){
		$this->commentaire=$commentaire;
	}
	/*function setDate($date){
		$this->date=$date;
	}
	function setnote($description){
		$this->type=$type;
	}
	function setmail_client($sujet){
		$this->mail_client=$mail_client;
	}*/
	
	
	
}

?>