<?php 

	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
	
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
		
			echo json_encode($response);
			
		
			die();
		}
	}
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createroupa':
				
				isTheseParametersAvailable(array('nome','marca','tipo','avaliacao'));
				
				$db = new DbOperation();
				
				$result = $db->createroupa(
					$_POST['nome'],
					$_POST['marca'],
					$_POST['tipo'],
					$_POST['avaliacao']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Conjunto adicionado com sucesso';

					
					$response['heroes'] = $db->getroupas();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getroupas':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['roupas'] = $db->getroupass();
			break; 
			
			
		
			case 'updateroupa':
				isTheseParametersAvailable(array('id','nome','marca','tipo','avaliacao'));
				$db = new DbOperation();
				$result = $db->updateroupa(
					$_POST['id'],
					$_POST['nome'],
					$_POST['marca'],
					$_POST['tipo'],
					$_POST['avaliacao']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Conjunto atualizado com sucesso';
					$response['roupas'] = $db->getroupas();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteroupa':

				
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->deleteroupa($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Roupa excluída com sucesso';
						$response['roupas'] = $db->getroupas();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	

	echo json_encode($response);



 ?>