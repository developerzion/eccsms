<?php

class Connection{

	private $con;
	private $stmt;

	public function __construct(){
		try {
			$this->con = new PDO("mysql:server=localhost;dbname=smsencrption","root","");
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $ex) {
			die($ex->getMessage());
		}		
	}
	public function signup($query){

		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		$chkq = "SELECT * FROM tbl_client WHERE `username`='$username'";

		if($password !== $cpassword){
			return "<div class='danger'><span class='fa fa-times'></span>&nbsp; Passwords do not match</div>";
		}else{
			
			if($this->numRows($chkq) < 1){
				$this->stmt = $this->con->prepare($query);
				$response = $this->stmt->execute([$fullname,$_POST['username'],sha1($password)]);
				if($response)
				return "<div class='success'>Registration completed</div>";
			}
			else{
				return  "<div class='danger'><span class='fa fa-times'></span>&nbsp; Username is not available</div>";;
				
			}
		
		}

		
		
		
	}
	public function fetchAll($querystring){
		$this->stmt = $this->con->prepare($querystring);
		$this->stmt->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function msg($status, $msg){
		return "<div class='alert alert-$status'>$msg</div>";
	}
    public function checker_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }    
	public function login($query, $array){
		try{
			$this->stmt = $this->con->prepare($query);
			$this->stmt->execute($array);		
			if($this->stmt->rowCount() > 0){
				$data = $this->stmt->fetchAll();
				return $data;
			}else{
				return 0;
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}		
	}
	
	function numRows($query){
		$this->stmt = $this->con->prepare($query);
		$this->stmt->execute();		
		return $this->stmt->rowCount();
	}
	function rowcount($query, $array){
		$this->stmt = $this->con->prepare($query);
		$this->stmt->execute($array);		
		return $this->stmt->rowCount();
	}
	function randomNumber($length){
		$number = '';
		for ($i = 0; $i < $length; $i++){
			$number .= rand(0,9);
		}
		return (int)$number;
	}
	
}

$conn = new Connection;

?>