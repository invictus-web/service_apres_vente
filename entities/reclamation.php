<?PHP
class reclamation{
	private $num;
	private $datee;
	private $sujet;
	private $message;
	private $mail;
	
	function __construct($num,$datee,$sujet,$message,$mail){
		$this->num=$num;
		$this->datee=$datee;
		$this->sujet=$sujet;
		$this->message=$message;
		$this->mail=$mail;
		
	}
	
	function getnum(){
		return $this->num;
	}
	function getdatee(){
		return $this->datee;
	}
	function getsujet(){
		return $this->sujet;
	}
	function getmessage(){
		return $this->message;
	}
	function getmail(){
		return $this->mail;
	}
	
function setnum($num){
		$this->datee=$datee;
	}
	function setdatee($datee){
		$this->datee=$datee;
	}
	function setsujet($sujet){
		$this->sujet;
	}
	function setmessage($message){
		$this->message=$message;
	}
	function setmail($mail){
		$this->mail=$mail;
	}
	
	
}

?>