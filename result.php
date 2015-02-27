<?php 
	include "tournament.php"; 
	$T =new Tournament();
	header("Content-Type:application/json");
	
	if(isset($_POST['first']) && isset($_POST['second'])){
		$first = $_POST['first'];
		$second = $_POST['second'];
		$top= $T->getTop(2);
		if(empty($top)){
			deliver_response(505,"No Top",NULL);
		}else{
			if($top[0]==$first && $top[1]==$second){
				$response["status"] = 'success';
			}else{
				$response["status"] = 'error';
			}
			echo json_encode($response);
		}	
	}
	

?>