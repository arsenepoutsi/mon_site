<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<?php 

function ajout_etablissement($nom_etablissement,$type_etablissement,$categorie_etablissement,$dte_creation,$responsable,$num_responsable,$id_circonscription,$lat_etablissement,$long_etablissement,$id_province,$ville)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO etablissement VALUES('','".$nom_etablissement."','".$type_etablissement."','".$categorie_etablissement."','".$dte_creation."','".$responsable."','".$num_responsable."','".$id_circonscription."','".$lat_etablissement."','".$long_etablissement."','".$id_province."','".$ville."','1')");
	} 

function modifier_etablissement($id_etablissement,$nom_etablissement,$type_etablissement,$categorie_etablissement,$dte_creation,$responsable,$num_responsable,$id_circonscription,$lat_etablissement,$long_etablissement,$id_province,$ville)
	{
			global $conn;
		    $sql=$conn->query("UPDATE etablissement SET nom_etablissement='$nom_etablissement',type_etablissement='$type_etablissement',categorie_etablissement='$categorie_etablissement',dte_creation='$dte_creation',responsable='$responsable',num_responsable='$num_responsable',id_circonscription='$id_circonscription',lat_etablissement='$lat_etablissement',long_etablissement='$long_etablissement',id_province='$id_province',ville='$ville' WHERE id_etablissement='".preg_quote($id_etablissement, '/')."'");
	}

function supprimer_etablissement($id_etablissement)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM etablissement WHERE id_etablissement='".preg_quote($id_etablissement, '/')."'");
	}

 ?>