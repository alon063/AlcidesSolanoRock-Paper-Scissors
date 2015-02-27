<?php 

	include "tournament.php";
	$T =new Tournament();
	$default=10;
	header("Content-Type:application/json");
	
	if(!empty($_GET['count'])){
		$count = $_GET['count'];
		$top = $T->getTop($count);
		$response['players']=$top;
	}else{		
		$top = $T->getTop($default);
		$response['players']=$top;
		
	}
	deliver_response($response);
	
	function deliver_response($response){
		header("HTTP/1.1 200 OK");
		
		$json_response=json_encode($response);
		
		echo $json_response; 
	}

?>