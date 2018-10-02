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

<body class="">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php include("menu.php"); ?>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <?php include("topbar.php"); ?>
        </div>

         <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>
                  Gestion Session 
                  <b>
                    Etablissement : 
                    <?php 
                        $code=$_GET['code'];
                        if (isset($_GET["code"]))
                        {
                            $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            while ($donnees =$req ->fetch())
                            { 
                              echo $donnees['nom_etablissement'];
                            } 
                        }         
                    ?>
                  </b>
                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>Enregistrement Année Académique</strong>
                    </li>
                </ol>
            </div>
        </div>

        <br/>

        <?php include("Etablissements/function_session.php"); ?>
            <!--========================================ajout===================================================-->

                <?php 
                    if (isset($_POST['valider'])) {
                        $annee_session=addslashes(htmlspecialchars($_POST['annee_session']));
                        $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));

                         if (empty($annee_session)) {
                            ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="icon fa fa-times-circle"></i>
                        <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                      </div>
                            <?php
                         }else{
                                ajout_session($annee_session,$id_etablissement);
                                ?>
                                    <div class="alert icon-alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <i class="icon fa fa-check-circle"></i>
                          <strong>Succès!</strong> Session enregistrée avec succès.
                        </div>
                                <?php
                           }
                    }
                ?>
            <!--========================================fin=========================================================-->

            <!--========================================modif===================================================-->
                <?php 
                    if (isset($_POST['modifier'])) {
                        $annee_session=addslashes(htmlspecialchars($_POST['annee_session']));
                        $id_session=addslashes(htmlspecialchars($_POST['id_session']));

                         if (empty($annee_session)) {
                            ?>
                                <div class="alert icon-alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="icon fa fa-times-circle"></i>
                        <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                      </div>
                            <?php
                         }else{
                                modifier_session($id_session,$annee_session);
                                ?>
                                    <div class="alert icon-alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <i class="icon fa fa-check-circle"></i>
                          <strong>Succès!</strong> Modification avec succès.
                        </div>
                                <?php
                           }
                       }
                ?>
            <!--========================================fin=========================================================-->

            <!--========================================suppression===================================================-->
                <?php 
                    if (isset($_POST['supprimer'])) {
                        $id_session=addslashes(htmlspecialchars($_POST['id_session']));

                         if (empty($id_session)) {
                            ?>
                                <div class="alert icon-alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="icon fa fa-times-circle"></i>
                        <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                      </div>
                            <?php
                         }else{
                                supprimer_session($id_session);
                                ?>
                                    <div class="alert icon-alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <i class="icon fa fa-check-circle"></i>
                          <strong>Succès!</strong> Suppression avec succès.
                        </div>
                                <?php
                           }
                       }
                ?>
            <!--========================================fin=========================================================-->
            
        <div class="wrapper wrapper-content  animated fadeInRight">

            <div class="row">
                <div class="col-md-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Formulaire d'enregistrement</h5>
                        </div>
                        <div class="ibox-content">
                            <?php 
                              $code=$_GET['code'];
                              if (isset($_GET["code"]))
                              {
                                  $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                                  while ($donnees =$req ->fetch())
                                  { 
                            ?>
                            <form role="form" method="POST" action="">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>ANNEE ACADEMIQUE</label>
                                            <input type="number" name="annee_session" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_etablissement" class="form-control" value="<?php echo $donnees['id_etablissement']; ?>" required="required">
                                <div class="hr-line-dashed"></div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous ajouter cette année académique?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
                                    </div>
                                </div>
                            </form>
                            <?php } } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Liste des Années Académiques enregistrées</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                  <tr>
                                      <th>N°</th>
                                      <th>ANNEE ACADEMIQUE</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i=1;
                                    $code=$_GET['code'];
                                          if (isset($_GET["code"]))
                                          {
                                                $req = $conn ->query("SELECT * FROM session s, etablissement e WHERE s.id_etablissement=e.id_etablissement AND e.id_etablissement='$code' ORDER BY annee_session DESC");
                                                if ($req) {
                                                    while ($donnees =$req ->fetch()) {    
                                  ?>
                                  <tr class="gradeX">
                                      <td style="text-align: center;">
                                        <b>
                                          <?php
                                            echo $i;
                                            $i++; 
                                           ?>
                                        </b>
                                      </td>
                                      <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['annee_session']; ?></b></td>
                                      <td class="center" style="text-align: center;">
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick='document.location.href="#Visualiser"
                                             document.recuperation1.id_session.value="<?php echo $donnees['id_session']?>"
                                             document.recuperation1.annee_session.value="<?php echo $donnees['annee_session']?>"'>
                                             <span><i class="fa fa-pencil"></i></span>
                                         </a>
                                         <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1" onclick='document.location.href="#Visualiser"
                                             document.recuperation2.id_session.value="<?php echo $donnees['id_session']?>"'>
                                             <span><i class="fa fa-trash"></i><i></i></span>
                                         </a>
                                         <a href="eleves.php?code1=<?php echo $donnees['id_etablissement'];?>&&code2=<?php echo $donnees['id_session'];?>" target="_bank" class="btn btn-success" type="button">
                                             <span><i class="fa fa-graduation-cap"></i></span>
                                        </a>
                                        <a href="enseignant.php?code1=<?php echo $donnees['id_etablissement'];?>&&code2=<?php echo $donnees['id_session'];?>"  target="_bank" class="btn btn-info" type="button" data-toggle="tooltip" data-placement="top" title="Données enseignants">
                                             <span><i class="fa fa-user"></i></span>
                                        </a>
                                        <a href="besoin.php?code1=<?php echo $donnees['id_etablissement'];?>&&code2=<?php echo $donnees['id_session'];?>" class="btn btn-default"  target="_bank" type="button" data-toggle="tooltip" data-placement="top" title="Besoins de l'établissement">
                                             <span><i class="fa fa-question-circle"></i></span>
                                        </a>
                                        <a href="Impressions/rapport.php?code1=<?php echo $donnees['id_etablissement'];?>&&code2=<?php echo $donnees['id_session'];?>" class="btn btn-primary"  target="_bank" type="button" data-toggle="tooltip" data-placement="top" title="Statistiques pour la session">
                                             <span><i class="fa fa-file"></i>&nbsp;&nbsp;<b><i>Rapport</i></b></span>
                                        </a>
                                      </td>
                                  </tr>
                                <?php } } } ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                      <th>N°</th>
                                      <th>ANNEE ACADEMIQUE</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </tfoot>
                              </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>  

        <?php include("footer.php"); ?>

        </div>
        </div>

    <!-- Mainly scripts -->
    <?php include("script.php"); ?>


</body>

</html>


<div class="modal inmodal fade" id="myModal1" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Suppression</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation2">

                    <input type="hidden" name="id_session" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION DE LA SESSION</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement cette session académique</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer cette session académique?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Annuler la suppression</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Modification</h4>
                <small class="font-bold">Formulaire de modification de la <b>Session académique</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_session" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>ANNEE ACADEMIQUE</label>
                                <input type="number" name="annee_session" class="form-control" required/>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier cette session académique?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
