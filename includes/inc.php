<?php

class Connection{

	private $con;
	private $stmt;

	public function __construct(){
		try {
			$this->con = new PDO("mysql:server=localhost;dbname=shikini","root","");
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $ex) {
			die($ex->getMessage());
		}		
	}
	public function exec($query, $data){
		$this->stmt = $this->con->prepare($query);
		$response = $this->stmt->execute($data);
		return $response;
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
	function uploadFiles($files){
		$append = date("dmyhis");
		$returnedfiles = "";
		for($i=0 ; $i < count($files['name']); $i++){
			$eachfile = $files['name'][$i];
			$tmpFilePath = $files['tmp_name'][$i];	
			$ext = pathinfo($eachfile, PATHINFO_EXTENSION);
			$accept = array("png","jpg","jpeg");
			if(!in_array($ext, $accept)) continue;
			else{
				$filename = $append."_".$files['name'][$i];
				$newFilePath = "../../uploaded/" . $filename;
				move_uploaded_file($tmpFilePath, $newFilePath);
				$returnedfiles .= $filename . "|";
			}
		}
		return $returnedfiles;	
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
	function addProperty($data){
		try{
			$date = date("d-F-Y h:i:s");
			
			$query = "SELECT * FROM tbl_property WHERE  propertyType=? AND propertyDeal=? AND propertyDescription=?";
			$count = $this->rowcount($query, [$data['propstype'],$data['propsdeal'],$data['propsdesc']]);	
			if($count < 1){
				$uploadresponse =  $this->uploadFiles($data["propsimage"]);		
				$this->stmt = $this->con->prepare("INSERT INTO `tbl_property`(`propertyCode`,`propertyType`,`propertyDeal`, `propertyDescription`,`propertyAddress`, `propertyLocation`, `propertyPrice`, `propertyImages`,`propertyDate`) VALUES (?,?,?,?,?,?,?,?,?)");
				$res = $this->stmt->execute([$data['random'], $data['propstype'],$data['propsdeal'],$data['propsdesc'],$data['propsadd'],$data['propslocation'],$data['propsprice'],$uploadresponse,$date]);
				return $res;
			}else{
				return 2;
			}
		}catch (Exception $ex) {
			die($ex->getMessage());
		}		
	}
}

$conn = new Connection;

?>