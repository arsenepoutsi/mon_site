<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<?php  

function ajout_province($code_province,$nom_province,$lat_province,$long_province)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO province VALUES('','".$code_province."','".$nom_province."','".$lat_province."','".$long_province."')");
	} 

function modifier_province($id_province,$code_province,$nom_province,$lat_province,$long_province)
	{
			global $conn;
		    $sql=$conn->query("UPDATE province SET code_province='$code_province',nom_province='$nom_province',lat_province='$lat_province',long_province='$long_province' WHERE id_province='".preg_quote($id_province, '/')."'");
	}

function supprimer_province($id_province)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM province WHERE id_province='".preg_quote($id_province, '/')."'");
	}



function ajout_circoncription($nom_circonscription,$responsable_circonscription,$matricule_responsable,$contact_responsable,$ville_circonscription)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO circonscription VALUES('','".$nom_circonscription."','".$responsable_circonscription."','".$matricule_responsable."','".$contact_responsable."','".$ville_circonscription."')");
	} 

function modifier_circonscription($id_circonscription,$nom_circonscription,$responsable_circonscription,$matricule_responsable,$contact_responsable,$ville_circonscription)
	{
			global $conn;
		    $sql=$conn->query("UPDATE circonscription SET nom_circonscription='$nom_circonscription',responsable_circonscription='$responsable_circonscription',matricule_responsable='$matricule_responsable',contact_responsable='$contact_responsable',ville_circonscription='$ville_circonscription' WHERE id_circonscription='".preg_quote($id_circonscription, '/')."'");
	}

function supprimer_circonscription($id_circonscription)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM circonscription WHERE id_circonscription='".preg_quote($id_circonscription, '/')."'");
	}


function ajout_type_besoin($libelle)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO type_besoin VALUES('','".$libelle."')");
	} 

function modifier_type_besoin($id_type_besoin,$libelle)
	{
			global $conn;
		    $sql=$conn->query("UPDATE type_besoin SET libelle='$libelle' WHERE id_type_besoin='".preg_quote($id_type_besoin, '/')."'");
	}

function supprimer_type_besoin($id_type_besoin)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM type_besoin WHERE id_type_besoin='".preg_quote($id_type_besoin, '/')."'");
	}


function ajout1($id_type_besoin,$description,$id_session,$id_etablissement)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO besoin VALUES('','".$id_type_besoin."','".$description."','".$id_session."','".$id_etablissement."')");
	} 

function modifier1($id_besoin,$id_type_besoin,$description)
	{
			global $conn;
		    $sql=$conn->query("UPDATE besoin SET id_type_besoin='$id_type_besoin',description='$description' WHERE id_besoin='".preg_quote($id_besoin, '/')."'");
	}

function supprimer1($id_besoin)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM besoin WHERE id_besoin='".preg_quote($id_besoin, '/')."'");
	}
 ?>