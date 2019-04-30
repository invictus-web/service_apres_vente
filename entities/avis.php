<?PHP
class avis{
	private $cinn;
	private $commentaire;
	private $type;
	private $date;
	private $mail_client;
	private $numero;
	
	
	function __construct($cinn,$commentaire,$type)
	{
		$this->cinn=$cinn;
		$this->commentaire=$commentaire;
		
		$this->type=$type;
		
	}

	function getcinn(){
		return $this->cinn;
	}
	function getNumero(){
		return $this->numero;
	}
	function setNumero($numero){
		$this->numero=$numero;
	}
	function getcommentaire(){
		return $this->commentaire;
	}
	function gettype(){
		return $this->type;
	}
	function getDate(){
		return $this->date;
	}
	function getmail_client(){
		return $this->mail_client;
	}
	
function setcinn($cinn){
		$this->cinn=$cinn;
	}
	function setcommentaire($commentaire){
		$this->commentaire=$commentaire;
	}
	function setDate($date){
		$this->date=$date;
	}
	function setnote($description){
		$this->type=$type;
	}
	function setmail_client($sujet){
		$this->mail_client=$mail_client;
	}
	
	
	
}

?>