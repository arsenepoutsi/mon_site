<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Profil</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>
                    Utilisateur : 
                    <?php 
                        $req=$conn->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
                        if($req)
                        {
                            $donnees =$req ->fetch();
                            echo '<b>'.$donnees['login'].'</b>';
                        }
                    ?>
                </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRightBig">
    <!-- =============================================== Ajout professeur ======================================================== -->
    <?php include("Users/function.php"); ?>
    <?php 
          if (isset($_POST['modifier'])) {
              $anc_pwd=md5(addslashes(htmlspecialchars($_POST['anc_pwd'])));
              $pwd=md5(addslashes(htmlspecialchars($_POST['pwd'])));
              $pwd1=md5(addslashes(htmlspecialchars($_POST['pwd1'])));
              $id_users=addslashes(htmlspecialchars($_POST['id_users']));

               if($anc_pwd != $_SESSION['pwd']){
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Votre ancien <b>Mot de passe</b> est incorrect. <a class="alert-link" href="#">Alerte !!!</a>.
                        </div>
                    <?php
               }elseif($pwd != $pwd1){
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            Vos deux nouveaux <b>Mots de passes</b> ne sont pas identiques. <a class="alert-link" href="#">Alerte !!!</a>.
                        </div>
                    <?php
               }else{
                      modifier_users_pwd($id_users,$pwd);
                      ?>
                          <SCRIPT LANGUAGE="Javascript">alert("Modification avec succès. Veuillez vous déconnecter en cliquant sur le bouton Déconnexion et vous reconnectez avec les nouvels identifiants. Vous allez être déconnecter");</SCRIPT>
                      <?php
                       echo '<meta http-equiv="refresh" content="0;URL=../index.php?erreur=logout">';
                 }
          }
      ?>
    <!-- =============================================== Fin Ajout professeur ======================================================== -->
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>MODIFIER VOTRE MOT DE PASSE</h5>
                    <h5 class="pull-right">Tous les champs avec <b style="color: #ea3d0c;">(*)</b> sont obligatoires.</h5>
                </div>
                <div class="ibox-content">
                    <?php

                        $req = $conn ->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
                        if($req){
                        while ($donnees =$req ->fetch()) {
                    ?>
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id_users" value="<?php echo($donnees['id_users']) ;?>">
                        <div class="form-group has-warning"><label class="col-sm-4 control-label">Ancien mot de passe <b style="color: #ea3d0c;">(*)</b></label>
                            <div class="col-sm-8"><input type="password" name="anc_pwd" required="required" class="form-control"></div>
                        </div>
                        <div class="form-group has-warning"><label class="col-sm-4 control-label">Nouveau mot de passe <b style="color: #ea3d0c;">(*)</b></label>
                            <div class="col-sm-8"><input type="password" name="pwd" required="required" class="form-control"></div>
                        </div>
                        <div class="form-group has-warning"><label class="col-sm-4 control-label">Comfirmer mot de passe <b style="color: #ea3d0c;">(*)</b></label>
                            <div class="col-sm-8"><input type="password" name="pwd1" required="required" class="form-control"></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-8">
                                <button class="btn btn-default dim" type="reset">Cancel</button>
                                <button class="btn btn-primary dim" type="submit" onclick="return confirm('Voulez-vous modifier votre mot de passe?')" name="modifier"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Modifier le Mot de passe</button>
                            </div>
                        </div>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
</div>