<?php 
	class Tournament{
		private $textFromFile;
		private $playersAndstrategy;
		private $message = "";
			
		public function readFile($path){
			$this->textFromFile = file_get_contents($path, FILE_USE_INCLUDE_PATH);
		}
		
		public function playTournament(){
			$tempPlayersAndstrategy	= $this->playersAndstrategy;
			while(count($tempPlayersAndstrategy) > 1){
				for($i = 0,$y=0; $i < count($tempPlayersAndstrategy);$i+=2,$y++){
					if($this->getWinner($tempPlayersAndstrategy[$i][1],$tempPlayersAndstrategy[$i+1][1])){
						if(count($tempPlayersAndstrategy)==2){
							$this->addPoints($tempPlayersAndstrategy[$i][0],$tempPlayersAndstrategy[$i+1][0]);
						}
						$winnersPerRound[$y] = $tempPlayersAndstrategy[$i];
					}else{
						$winnersPerRound[$y] = $tempPlayersAndstrategy[$i+1];
					}
				}
				$tempPlayersAndstrategy	= $winnersPerRound;
				unset($winnersPerRound);
			}
			$this->message = "Winner ".$tempPlayersAndstrategy[0][0]." Strategy ".$tempPlayersAndstrategy[0][1];		
		}
	
		private function getWinner($player1, $player2){
			$winner = true;
			switch ($player1) {
				case 'R':
					if($player2 == 'P' ){
						$winner = false;
					}
					break;
				case 'P':
					if($player2 == 'S' ){
						$winner = false;
					}
					break;
				case 'S':
					if($player2 == 'R' ){
						$winner = false;
					}
					break;
				default:
					break;
			}
			return $winner;
		}
		
		private function addPoints($firstPlace,$secondPlace){
			$server = "localhost";
			$username = "admin";
			$password = "admin";
			$dbname = "championship";
			$DB=new MySQLi($server, $username, $password, $dbname);
			
			$r = $DB->query("SELECT * FROM SCORE WHERE NAME = '".$firstPlace."'");
			$row =$r->fetch_assoc() ;
			
			if($row==NULL){
				$DB->query("INSERT INTO SCORE (NAME,POINTS) VALUES ('".$firstPlace."',3)");		
			}else{
				$DB->query("UPDATE SCORE SET POINTS = POINTS+3 WHERE NAME = '".$firstPlace."'");
			}
			$r->close();
			
			$r =$DB->query("SELECT * FROM SCORE WHERE NAME = '".$secondPlace."'");
			$row=$r->fetch_assoc();
			
			if($row==NULL){
				$DB->query("INSERT INTO SCORE (NAME,POINTS) VALUES ('".$secondPlace."',1)");				
			}else{
				$DB->query("UPDATE SCORE SET POINTS = POINTS+1 WHERE NAME = '".$secondPlace."'");
			}
			$r->close();
		}
				
		public function play($path){
			
			$this->textFromFile = file_get_contents($path, FILE_USE_INCLUDE_PATH);
			
			$textFromFileClean = str_replace('[','',$this->textFromFile);
			$textFromFileClean = str_replace(']','',$textFromFileClean);	
			$textFromFileClean = str_replace(',','',$textFromFileClean);
			$tempPlayersAndStrategy = explode('"', $textFromFileClean);
			
			if(count($tempPlayersAndStrategy) >= 9){
				
				for($i = 1,$y=0;$i < count($tempPlayersAndStrategy);$i+=4,$y++){
						if (strtoupper($tempPlayersAndStrategy[$i+2]) == 'S' || strtoupper($tempPlayersAndStrategy[$i+2]) == 'R' || strtoupper($tempPlayersAndStrategy[$i+2]) == 'P'){
							$this->playersAndstrategy[$y] = array ( $tempPlayersAndStrategy[$i],strtoupper($tempPlayersAndStrategy[$i+2]));
						}else{
							$i = count($tempPlayersAndStrategy);
							$this->message = "Invalid Strategy Found!";
						}
				}
				if($this->message == ""){
					$this->playTournament();
				}
			}else{
				$this->message = "Minimum number of players is not reached!";
			}
			return $this->message;
		}
		
		public function getTop($count){
			$server = "localhost";
			$username = "admin";
			$password = "admin";
			$dbname = "championship";
			$top10;
			$DB=new MySQLi($server, $username, $password, $dbname);
			
			$r = $DB->query("SELECT * FROM SCORE ORDER BY POINTS DESC LIMIT ".$count);
			
			while($row = $r->fetch_assoc()){
				$top[] = $row['name'];
			}
			return $top;
		}
		
		public function resetDatabase(){
			$server = "localhost";
			$username = "admin";
			$password = "admin";
			$dbname = "championship";
			$DB=new MySQLi($server, $username, $password, $dbname);
			
			$r = $DB->query("DELETE FROM SCORE");
		}
	}
?>