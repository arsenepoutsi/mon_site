<?php
    @ob_start();
    session_start(); // On relaye la session
    if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
    include("connexion_db.php");
?>
<!DOCTYPE html>
<html>

<head>

    <?php include("header.php"); ?>

</head>

<body onload="load()">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php include("menu.php"); ?>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <?php include("topbar.php"); ?>
        </div>

         <?php
          if (isset($_GET['page']))
          {
              $page = $_GET['page'];
          }else{
              $page = "";
          }

          switch ($page) {
                case 'home':
                    include 'home.php';
                    break;
                case 'utilisateurs':
                    include 'Users/utilisateurs.php';
                    break;
                case 'provinces':
                    include 'Parametres/provinces.php';
                    break;
                case 'type_besoin':
                    include 'Parametres/type_besoin.php';
                    break;
                case 'circonscriptions':
                    include 'Parametres/circonscriptions.php';
                    break;
                case 'etablissements':
                    include 'Etablissements/etablissements.php';
                    break;
                case 'rapports':
                    include 'Etablissements/rapports.php';
                    break;
                case 'statistiques':
                    include 'Statistiques/statistiques.php';
                    break;
                case 'cartographie':
                    include 'Cartographie/cartographie.php';
                    break;
                case 'profil':
                    include 'Users/profil.php';
                    break;

                default:
                    include 'home.php';
                    break;
          }
        ?>   

        <?php include("footer.php"); ?>

        </div>
        </div>

    <!-- Mainly scripts -->
    <?php include("script.php"); ?>


</body>

</html>
