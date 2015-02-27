<?php 
	include "tournament.php"; 
	$T =new Tournament();
	$message="";
	if(isset($_FILES['uploaded_file'])){
		$path = $_FILES['uploaded_file']['tmp_name']; //donde queda guardado temporalmente
		$message =$T->play($path);
	}
	$T->getTop(10);
	
	
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Rock-Papper-Scissors</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script src="js/jquery-2.1.3.min.js"></script>
  <script>
	$(document).ready(function(){
		$('#top').click(function(){
			$.ajax({ url: 'top.php',
					 data: {count: '10'},
					 success: function(output) {
						 var str = JSON.stringify(output, null, 2)
						 str.replace("  \"players\": [","");
						$('#list').val(str);
					}
			})
			
			
		});//click
		$('#reset').click(function(){
			$.ajax({ url: 'reset.php',
					 success: function(output) {
						 alert(output);
					}
			})
			
			
		});//click
	});
</script>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1>Rock<span class="logo_colour">papper</span>Scissors</h1>
          <h2>Alcides Solano Mata</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="index.html">Home</a></li>
         
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h1>Justification</h1>
        <p>PHP is one of the most powerful programming languages to develop web applications, giving the scenario, kind of application 
        plus deadline to complete it. PHP was the most natural option to develop this website.</p>
        <p>After researching about the RESTAPI and how to develop it, confirmed that PHP was the best option at the moment, additionally,
        it covers perfectly with all the needs of the project</p>
        <h1>Short Description</h1>
        <p>I try to take the most of every minute, enjoy challenges, big FC Barcelona fan. Programming has been always a passion, really
         enjoy developing and learning about new technologies and possibilities.</p>
      </div>
      <div id="content">
        <h2>Rules</h2>
		<p>
        	In a game of rock-paper-scissors, each player chooses to play Rock (R), Paper (P), or Scissors (S). The rules are: Rock beats Scissors, 
            Scissors beats Paper, but Paper beats Rock. A rock-paper-scissors game is encoded as a list, where the elements are 2-element lists that 
            encode a player’s name and a player’s strategy.
        </p>
        <p>
        	[[ "Armando", "P" ], [ "Dave", "S" ]] => returns the list ["Dave", "S"] wins since S>P
        </p>
        <h2>Options</h2>
        
       <form method="post" action="index.php" enctype="multipart/form-data"> 
       		Load File: <input type="file" name="uploaded_file" id="uploaded_file"/><br><br>
   		 <input  type="submit" value="Play Tournament">
       </form>
       Winner:<br>
       <?php echo "<textarea rows='1' cols='30'>".$message."</textarea><a href='resultTest.php'>  Validar Primero y segundo (API POST)</a><br><br>"; ?>
       
       <button id="top">Top 10</button><br>
       <textarea rows="10" cols="30" id="list"></textarea><br><br>
       <button id="reset">Reset Database</button>
       <br>
       <p>Download Files for Championships
       <a href="championships.zip" target="_blank">Championships</a></p>
       <p>API Documentation
       <a href="APIDocumentation.docx" target="_blank">API Documentation</a></p>
      </div>
      
    </div>
    <div id="footer">
      
    </div>
  </div>
</body>
</html>
