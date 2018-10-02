<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<?php  

function ajout_users($nom_users,$prenom_users,$profil,$login,$pwd,$permission)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO users VALUES('','".$nom_users."','".$prenom_users."','".$profil."','".$login."','".$pwd."','".$permission."','1')");
	} 

function modifier_users($id_users,$nom_users,$prenom_users,$profil,$login,$pwd,$permission)
	{
			global $conn;
		    $sql=$conn->query("UPDATE users SET nom_users='$nom_users',prenom_users='$prenom_users',profil='$profil',login='$login',pwd='$pwd',permission='$permission' WHERE id_users='".preg_quote($id_users, '/')."'");
	}

function modifier_users_pwd($id_users,$pwd)
	{
			global $conn;
		    $sql=$conn->query("UPDATE users SET pwd='$pwd' WHERE id_users='".preg_quote($id_users, '/')."'");
	}

function supprimer_users($id_users)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM users WHERE id_users='".preg_quote($id_users, '/')."'");
	}

 ?>