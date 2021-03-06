<?php
  $id = $_GET['id'];
?>
<!DOCTYPE html>  
<html lang="fr">  
	<head>  
    <meta charset="utf-8">
	  <title>L'heure, un compte à rebours et un compteur à la façon Apple</title>  
	  <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
		<style type="text/css"> 
			.coutdown-heure {list-style-type:none;width:366px;height:100px;margin:30px auto;color:#000}
			.coutdown-heure li{float:left;background:url(filmstrip.png) 0 0 no-repeat;width:53px;height:103px}
			.coutdown-heure li.mid{background:url(filmstrip_time.png) 0 0 no-repeat;}
			.coutdown-heure li.short{background:url(filmstrip_time_tiny.png) 0 0 no-repeat;}
			.coutdown-heure li.seperator{background:none;width:24px;font-size:80px;line-height:65px}
			
			#countdown-blog {padding-left:250px;color:#000;height:200px}
			#countdown-blog div.set{float:left}
			#countdown-blog h2{text-align:center; font-size:18px}
			#countdown-blog ul{list-style-type:none;height:103px;padding:20px 0px 5px}
			#countdown-blog li{float:left;background:url(filmstrip_countdown_9-0.png) 0 0 no-repeat;width:53px;height:103px}
			#countdown-blog li#s0, li#m0{background:url(filmstrip_countdown_5-0.png) 0 0 no-repeat}
			#countdown-blog li#h0{background:url(filmstrip_countdown_2-0.png) 0 0 no-repeat}
			#countdown-blog li.comma{background:url(comma.png) 2px 75px no-repeat;width:12px}
			#countdown-blog div.separator{float:left; font:80px Arial,sans-serif; height:103px; padding:25px 0 0;}
			
			#countdown-pad {list-style-type:none;margin:30px auto;padding-left:205px;height:100px}
			#countdown-pad li{float:left;background:url(filmstrip-red.png) 0 0 no-repeat;width:53px;height:103px}
			#countdown-pad li.seperator{background:url(comma.png) 2px 75px no-repeat;width:12px;}
			
			#countdown-visits {list-style-type:none;margin:30px auto;padding-left:380px;height:100px}
			#countdown-visits li{float:left;background:url(filmstrip.png) 0 0 no-repeat;width:53px;height:103px}
			#countdown-visits li.seperator{background:url(comma.png) 2px 75px no-repeat;width:12px;}
		</style> 
  </head> 
	 
	<body>  
		<div class="logo">
			<a href="http://www.blog-nouvelles-technologies.fr">
				<img class="logo-image" alt="logo" src="http://www.blog-nouvelles-technologies.fr/wp-content/themes/Design-folio/images/logo.png" original="http://www.blog-nouvelles-technologies.fr/wp-content/themes/Design-folio/images/logo.png">
			</a>
			<div class="slogan">
				Démos & téléchargements - PHP, JavaScript, HTML5, AJAX, CSS, ...
			</div>
		</div>
		
		<div class="exhead">
			<div class="center">
				<strong>Exemple pour :</strong> 
				<a href="http://www.blog-nouvelles-technologies.fr/archives/1126/lheure-un-compte-a-rebours-et-un-compteur-a-la-facon-apple/">
					L'heure, un compte à rebours et un compteur à la façon Apple  
				</a>.
				<a href="../">Cliquez ici</a> pour voir d'autres démos!
			</div>
		</div>				

		<div class="center">
		
			<h1 style="margin-top: 20px;">L'heure, un compte à rebours et un compteur à la façon Apple</h1>
			
			<p class="intro">Voici un premier exemple démontrant comment faire une horloge en utilisant la technique décrit dans l'article.</p>	
			
			<ul class="coutdown-heure"> 
				<li id="hours5" class="short"></li> 
				<li id="hours4"></li> 
				<li class="seperator">:</li> 
				<li id="hours3" class="mid"></li> 
				<li id="hours2"></li> 
				<li class="seperator">:</li> 
				<li id="hours1" class="mid"></li> 
				<li id="hours0"></li>
			</ul>

			<script type="text/javascript" src="countdown_hours.js"></script> 
			
			<p class="intro">Ce deuxième exemple démontre comment faire un compte à rebours (initialisé à la date d'anniversaire du blog).</p>	
			
			<div id="countdown-blog"></div>
			
			<script type="text/javascript" src="countdown.js"></script> 
			
			<p class="intro">Cet exemple démontre comment faire un compteur à partir de 0.</p>
			
			<ul id="countdown-pad"></ul>
			
			<script type="text/javascript" src="countdown_pad.js"></script>
			
			<p class="intro">Enfin ce dernier exemple démontre comment faire un compteur de visites par exemple (pour cela on passe un paramètre au fichier PHP). Dans cet exemple j'utilise un random</p>
			
			<ul id="countdown-visits"></ul>
			
			<script type="text/javascript" src="countdown_visits.js"></script>
		</div>
		
		<?php include("../footer_demos.php"); ?>
  </body>  
</html>  