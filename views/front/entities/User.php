<?php 
include '../config.php';
class User{
	private $login;
    private $pwd;
	private $role;
   	

	public function __construct($login,$pwd)
	{
		$this->login=$login;
		$this->pwd=$pwd;
		
		
	}
	function getLog()
	{
		return $this->login;
	}
    function getPWD()
	{
		return $this->pwd;
		
	}
	 function getRole()
	{
		return $this->role;
		
	}

	public function Logedin($login,$pwd)
	{
		$db=config::getConnexion();
		$req="select * from user where login='$login' && pwd='$pwd'";
		$rep=$db->query($req);
		return $rep->fetchAll();
	}

	}
	
	

	?>