<?php
	  include("connexion_db.php");

      $etat_users=addslashes(htmlspecialchars($_GET['etat']));
	  $code=addslashes(htmlspecialchars($_GET['code']));
 
      if($etat_users==0)
	       {
	       	 $sql1=$conn->query("UPDATE users SET etat_users=1 WHERE id_users='".mysql_real_escape_string($code)."'"); 
			  ?>
	            <SCRIPT LANGUAGE="Javascript">alert("Activation avec succes");</SCRIPT> 
	          <?php
		      echo '<meta http-equiv="refresh" content="0;URL=index.php?page=utilisateurs">';

	       }
	      else
		   {
		   	  $sql1=$conn->query("UPDATE users SET etat_users=0 WHERE id_users='".mysql_real_escape_string($code)."'");
			   ?>
	            <SCRIPT LANGUAGE="Javascript">alert("Desactivation avec succes");</SCRIPT> 
	          <?php
		        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=utilisateurs">';
		  
		   } 
 ?>