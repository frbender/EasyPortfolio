<?php
include("easyportfolio.php");
$blog = new EasyPortfolio();
//$blog->createTable();
//$blog->delAllEnt();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100|Oswald:400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/global.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <title>Showcase</title>
    </head>
    <body>
    	<div id="header">Mein Showcase</div>
        	<?php
				//$posts = $blog->setNewEnt("First Image", "Thats my first image ever!!!", "img/portfolio.png");
				//$posts = $blog->setNewEnt("New Image", "It's just a simple image :D", "img/portfolio.png");
				$posts = $blog->getAllEnt();
				foreach ($posts as &$ent) {
					echo "<div class=\"eintrag ".$ent->getId()."\" tabindex=\"1\"><img src=\"".$ent->getImage()."\"/>
					<div class=\"desc\"><h1>".$ent->getSubject()."</h1><br/><p>".$ent->getBody()."</p></div>
					</div>";
				}
				$posts = $blog->closeDB();
			?>
    </body>
</html>