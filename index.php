
<?php
   @ob_start(); 
   session_start();
   include("App/connexion_db.php");
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>SIG-ECOLE | Login</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container" style="margin-top:px">

      <form class="login-form" action="" method="POST" enctype="multipart/form-data" role="form" > 
      <?php 
                if (isset($_POST['valider'])){ 
                        $login = addslashes(htmlspecialchars($_POST['login'])); 
                        $pwd = md5(addslashes(htmlspecialchars($_POST['pwd']))); 
                     
                        $requete_search=$conn->query(sprintf("SELECT * FROM users WHERE login='$login' AND pwd='$pwd' LIMIT 1"));
                        $data =$requete_search ->fetch();

                      
                        if ($data) { 
                            
                            // déclaration des variables de session
                            $_SESSION['profil'] = $data['profil']; 
                            $_SESSION['login'] = $data['login'];
                            $_SESSION['permission'] = $data['permission'];
                            $_SESSION['pwd'] = $data['pwd'];

                            if ($data['etat_users']==1)
                                {
                                    echo '<meta http-equiv="refresh" content="0;URL=App/index.php?page=home">';
                                    //header('location:App/index.php?page=home');
                                }
                            else{
                                ?>
                                    <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                                        <strong>Alerte!</strong> Ce compte est desactivé, Veuillez vous rapprocher de l'administrateur de la plate-forme pour plus d'explication.
                                    </div>
                                <?php
                            }
                        }else 
                        {
                            echo '<meta http-equiv="refresh" content="0;URL=index.php?erreur=permission">';
                            //header("Location:index.php?erreur=num_u"); // redirection si utilisateur non reconnu
                        }
                    }


                    // Gestion de la  déconnexion
                    if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout')
                    {
                        session_unset("profil");
                        session_unset("permission");
                        session_unset("login");
                        session_unset("pwd");
                        echo '<meta http-equiv="refresh" content="0;URL=index.php?erreur=delog&permission">';
                        //header("Location:index.php?erreur=delog&permission=$permission");
                    }
             ?>

            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "permission"))
                {
                    ?>
                        <div class="alert alert-danger alert-dismissible text-center" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                             <strong>Alerte!</strong> Echec d'authentification !!!  Login ou mot de passe incorrect.
                        </div>
                    <?php 
                 }
            ?>

            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) 
                { 
                    ?>
                        <div class="alert alert-danger alert-dismissible text-center" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                             <strong></strong> D&eacute;connexion r&eacute;ussie... A bient&ocirc;t!
                        </div>
                    <?php
                } 
            ?>

            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru"))
                {
                    ?>
                        <div class="alert alert-danger alert-dismissible text-center" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                             <strong>Alerte!</strong> Echec d'authentification !!!  Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page
                        </div>
                    <?php
                } 
            ?>     
        <div class="login-wrap">
            <p class="login-img"> <img alt="" src="img/logo.png" class="img-circle" width="200px" height="175px"></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" name="login" class="form-control" placeholder="Login">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="pwd" class="form-control" placeholder="votre Mot de passe">
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="valider">Connexion</button>
            <button class="btn btn-default btn-lg btn-block" type="reset">Annuler</button>
            <hr/>                
        </div>
      </form>
         
    </div>


  </body>
</html>
