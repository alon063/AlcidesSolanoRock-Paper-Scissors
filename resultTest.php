<?php 
	include "tournament.php"; 
	$T =new Tournament();
	$top = $T->getTop(2);
	$response['players']=$top;
	
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Test Post API</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
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
          <li class="selected"><a href="#">Result</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h1>&nbsp;</h1>
        
      </div>
      <div id="content">
        <h1>Enter names of first and second place</h1>
        <form action="api/championship/result" method="post">
          <div class="form_settings">
            <p><span>First Place</span><input class="contact" type="text" name="first" id="first" value="" /></p>
            <p><span>Second Place</span><input class="contact" type="text" name="second" id="second" value="" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit"  value="Validate" /></p>
          </div>
        </form>
        <p><br>Current fist places</p>
        <?php echo "<textarea rows='1' cols='30'>".$json_response=json_encode($response)."</textarea>"; ?>
      </div>
      <a href="index.php">Return</a>
    </div>
    <div id="footer">
      <p><a href="index.html">Home</a> | <a href="examples.html">Examples</a> | <a href="page.html">A Page</a> | <a href="another_page.html">Another Page</a> | <a href="contact.html">Contact Us</a></p>
      <p>Copyright &copy; simplestyle_5 | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.html5webtemplates.co.uk">Simple web templates by HTML5</a></p>
    </div>
  </div>
</body>
</html>
