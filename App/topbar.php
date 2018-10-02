<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <h2 style="margin-left: 25px;">
        <b>Bienvenue sur SIG-ECOLE</b>
    </h2>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <span class="m-r-sm text-muted welcome-message"><b>Utilisateur connecté : 
            <strong class="font-bold" style="font-size: 15px;color: #ec8606;">
                <?php 
                    $req=$conn->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
                    if($req)
                    {
                        $donnees =$req ->fetch();
                        echo $donnees['nom_users'].'&nbsp;&nbsp;'.$donnees['prenom_users']; 
                    }
                 ?>
            </strong>
        </b></span>
    </li>
    <li>
        <a href="../index.php?erreur=logout">
            <i class="fa fa-sign-out" style="color: #ea2d0c;"></i> <b style="color: #ea2d0c;">Déconnexion</b>
        </a>
    </li>
</ul>

</nav>