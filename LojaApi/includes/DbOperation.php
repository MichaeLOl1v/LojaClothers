<?php 

	class DbOperation
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createroupa($nome, $marca, $tipo, $avaliacao){
		$stmt = $this->con->prepare("INSERT INTO roupa (nome, marca, tipo, avaliacao) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("sssi", $nome, $marca, $tipo, $avaliacao);
		if($stmt->execute())
			return true; 
		return false; 
	}
		
	function getroupas(){
		$stmt = $this->con->prepare("SELECT id, nome, marca, tipo, avaliacao FROM roupa");
		$stmt->execute();
		$stmt->bind_result($id, $nome, $marca, $tipo, $avaliacao);
		
		$roupas = array(); 
		
		while($stmt->fetch()){
			$roupa  = array();
			$roupa['id'] = $id; 
			$roupa['nome'] = $nome; 
			$roupa['marca'] = $marca; 
			$roupa['tipo'] = $tipo; 
			$roupa['avaliacao'] = $avaliacao; 
			
			array_push($roupas, $roupa); 
		}
		
		return $roupas; 
	}
	
	
	function updateroupa($id, $nome, $marca, $tipo, $avaliacao){
		$stmt = $this->con->prepare("UPDATE roupa SET nome = ?, marca = ?, tipo = ?, avaliacao = ? WHERE id = ?");
		$stmt->bind_param("sssii", $nome, $marca, $tipo, $avaliacao, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteroupa($id){
		$stmt = $this->con->prepare("DELETE FROM roupa WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}

 ?>