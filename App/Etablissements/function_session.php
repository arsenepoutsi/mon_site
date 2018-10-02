<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<?php 

function ajout_session($annee_session,$id_etablissement)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO session VALUES('','".$annee_session."','".$id_etablissement."')");
	} 

function modifier_session($id_session,$annee_session)
	{
			global $conn;
		    $sql=$conn->query("UPDATE session SET annee_session='$annee_session' WHERE id_session='".preg_quote($id_session, '/')."'");
	}

function supprimer_session($id_session)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM session WHERE id_session='".preg_quote($id_session, '/')."'");
	}


function ajout1($discipline,$homme,$femme,$type_enseignant,$id_session,$id_etablissement,$total)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO enseignant VALUES('','".$discipline."','".$homme."','".$femme."','".$type_enseignant."','".$id_session."','".$id_etablissement."','".$total."')");
	} 

function modifier1($id_enseignant,$discipline,$homme,$femme,$total)
	{
			global $conn;
		    $sql=$conn->query("UPDATE enseignant SET discipline='$discipline',homme='$homme',femme='$femme',total='$total' WHERE id_enseignant='".preg_quote($id_enseignant, '/')."'");
	}

function supprimer1($id_enseignant)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM enseignant WHERE id_enseignant='".preg_quote($id_enseignant, '/')."'");
	}

function ajout2($discipline,$homme,$femme,$type_enseignant,$id_session,$id_etablissement,$total)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO enseignant VALUES('','".$discipline."','".$homme."','".$femme."','".$type_enseignant."','".$id_session."','".$id_etablissement."','".$total."')");
	} 

function modifier2($id_enseignant,$discipline,$homme,$femme,$total)
	{
			global $conn;
		    $sql=$conn->query("UPDATE enseignant SET discipline='$discipline',homme='$homme',femme='$femme',total='$total' WHERE id_enseignant='".preg_quote($id_enseignant, '/')."'");
	}

function supprimer2($id_enseignant)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM enseignant WHERE id_enseignant='".preg_quote($id_enseignant, '/')."'");
	}


function ajout_eleve($place_dispo,$effectif,$admis,$redoublant,$obs,$id_session,$id_etablissement)
	{
		global $conn;
	 	$donnees=$conn->query("INSERT INTO eleve VALUES('','".$place_dispo."','".$effectif."','".$admis."','".$redoublant."','".$obs."','".$id_session."','".$id_etablissement."')");
	} 

function modifier_eleve($id_eleve,$place_dispo,$effectif,$admis,$redoublant,$obs)
	{
			global $conn;
		    $sql=$conn->query("UPDATE eleve SET place_dispo='$place_dispo',effectif='$effectif',admis='$admis',redoublant='$redoublant',obs='$obs' WHERE id_eleve='".preg_quote($id_eleve, '/')."'");
	}

function supprimer_eleve($id_eleve)
	{
			global $conn;
		    $sql=$conn->query("DELETE FROM eleve WHERE id_eleve='".preg_quote($id_eleve, '/')."'");
	}

 ?>