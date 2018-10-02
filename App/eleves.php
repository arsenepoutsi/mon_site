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
                  Gestion des élèves 
                  <b>
                    Etablissement : 
                    <?php 
                        $code=$_GET['code1'];
                        if (isset($_GET["code1"]))
                        {
                            $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            while ($donnees =$req ->fetch())
                            { 
                              echo $donnees['nom_etablissement'];
                            } 
                        }         
                    ?>
                    &nbsp;&nbsp;
                    (
                    <?php 
                        $code=$_GET['code2'];
                        if (isset($_GET["code2"]))
                        {
                            $req=$conn->query("SELECT * FROM session WHERE id_session='$code'");
                            while ($donnees =$req ->fetch())
                            { 
                              echo $donnees['annee_session'];
                            } 
                        }         
                    ?>
                    )
                  </b>
                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>Enregistrement des Effectifs des Elèves</strong>
                    </li>
                </ol>
            </div>
        </div>

        <br/>

        <?php include("Etablissements/function_session.php"); ?>
            <!--========================================ajout===================================================-->

                <?php 
                  if (isset($_POST['valider'])) {
                      $place_dispo=addslashes(htmlspecialchars($_POST['place_dispo']));
                      $effectif=addslashes(htmlspecialchars($_POST['effectif']));
                      $admis=addslashes(htmlspecialchars($_POST['admis']));
                      $redoublant=addslashes(htmlspecialchars($_POST['redoublant']));
                      $obs=addslashes(htmlspecialchars($_POST['obs']));
                      $id_session=addslashes(htmlspecialchars($_POST['id_session']));
                      $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));

                       if (empty($place_dispo)) {
                          ?>
                            <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              ajout_eleve($place_dispo,$effectif,$admis,$redoublant,$obs,$id_session,$id_etablissement);
                              ?>
                                  <div class="alert icon-alert alert-success" role="alert">
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="icon fa fa-check-circle"></i>
                        <strong>Succès!</strong> Enregistrement avec succès.
                      </div>
                              <?php
                         }
                  }
              ?>
          <!--========================================fin=========================================================-->

          <!--========================================modif===================================================-->
              <?php 
                  if (isset($_POST['modifier'])) {
                        $place_dispo=addslashes(htmlspecialchars($_POST['place_dispo']));
                        $effectif=addslashes(htmlspecialchars($_POST['effectif']));
                        $admis=addslashes(htmlspecialchars($_POST['admis']));
                        $redoublant=addslashes(htmlspecialchars($_POST['redoublant']));
                        $obs=addslashes(htmlspecialchars($_POST['obs']));
                        $id_eleve=addslashes(htmlspecialchars($_POST['id_eleve']));
                       if (empty($place_dispo)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              modifier_eleve($id_eleve,$place_dispo,$effectif,$admis,$redoublant,$obs);
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
                      $id_eleve=addslashes(htmlspecialchars($_POST['id_eleve']));

                       if (empty($id_eleve)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              supprimer_eleve($id_eleve);
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
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Formulaire d'enregistrement</h5>
                        </div>
                        <div class="ibox-content">
                            <?php 
                              $code1=$_GET['code1'];
                              $code2=$_GET['code2'];
                              if (isset($_GET["code1"]) && isset($_GET["code2"]))
                              {
                                  $req=$conn->query("SELECT * FROM etablissement e, session s WHERE e.id_etablissement=s.id_etablissement AND e.id_etablissement='$code1' AND s.id_session='$code2'");
                                  while ($donnees =$req ->fetch())
                                  { 
                            ?>
                            <form role="form" method="POST" action="">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>PLACE DISPONIBLE</label>
                                            <input type="number" name="place_dispo" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>EFFECTIF</label>
                                            <input type="number" name="effectif" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>ADMIS</label>
                                            <input type="number" name="admis" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>REDOUBLANT</label>
                                            <input type="number" name="redoublant" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group has-success">
                                            <label>OBSERVATION</label>
                                            <input type="text" name="obs" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_etablissement" class="form-control" value="<?php echo $donnees['id_etablissement']; ?>" required="required">
                                <input type="hidden" name="id_session" class="form-control" value="<?php echo $donnees['id_session']; ?>" required="required">
                                <div class="hr-line-dashed"></div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous valider cette requête?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
                                    </div>
                                </div>
                            </form>
                            <?php } } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Capacité d'accueil</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                  <tr>
                                      <th>PLACE DISPO</th>
                                      <th>EFFECTIF</th>
                                      <th>ADMIS</th>
                                      <th>REDOUBLANT</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $code2=$_GET['code2'];
                                  if (isset($_GET["code2"]))
                                  {
                                        $req = $conn ->query("SELECT * FROM eleve e, session s WHERE e.id_session=s.id_session AND s.id_session='$code2' ORDER BY id_eleve DESC");
                                        if ($req) {
                                            while ($donnees =$req ->fetch()) {    
                                    ?>
                                  <tr class="gradeX">
                                      <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['place_dispo']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['effectif']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['admis']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['redoublant']; ?></b></td>
                                      <td class="center" style="text-align: center;">
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick='document.location.href="#Visualiser"
                                           document.recuperation1.id_eleve.value="<?php echo $donnees['id_eleve']?>"
                                           document.recuperation1.place_dispo.value="<?php echo $donnees['place_dispo']?>"
                                           document.recuperation1.effectif.value="<?php echo $donnees['effectif']?>"
                                           document.recuperation1.admis.value="<?php echo $donnees['admis']?>"
                                           document.recuperation1.redoublant.value="<?php echo $donnees['redoublant']?>"
                                           document.recuperation1.obs.value="<?php echo $donnees['obs']?>"'>
                                           <span><i class="fa fa-pencil"></i></span>
                                        </a>
                                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1" onclick='document.location.href="#Visualiser"
                                           document.recuperation2.id_eleve.value="<?php echo $donnees['id_eleve']?>"'>
                                           <span><i class="fa fa-trash"></i><i></i></span>
                                        </a>
                                      </td>
                                  </tr>
                                <?php } } } ?>
                                </tbody>
                              </table>

                              <table class="table invoice-total">
                                  <tbody>
                                  <tr>
                                      <td><strong>Total places disponible :</strong></td>
                                      <td>
                                        <b>
                                          <i style="color: #c72b05;">
                                            <?php 
                                              $code2=$_GET['code2'];
                                                    if (isset($_GET["code2"]))
                                                    {
                                                  $req = $conn ->query("SELECT SUM(place_dispo) AS nbre FROM eleve e, session s WHERE e.id_session=s.id_session AND s.id_session='$code2'");
                                                    if ($req) {
                                                        while ($donnees =$req ->fetch())
                                                        {
                                                          echo $donnees['nbre'];
                                                        }
                                                      }
                                                    }
                                                ?>
                                          </i>
                                        </b>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total Effectifs :</strong></td>
                                      <td>
                                        <b>
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s WHERE e.id_session=s.id_session AND s.id_session='$code2'");
                                                      if ($req) {
                                                          while ($donnees =$req ->fetch())
                                                          {
                                                            echo $donnees['nbre'];
                                                          }
                                                        }
                                                      }
                                                  ?>
                                            </i>
                                          </b>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total admis :</strong></td>
                                      <td>
                                        <b >
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(admis) AS nbre FROM eleve e, session s WHERE e.id_session=s.id_session AND s.id_session='$code2'");
                                                      if ($req) {
                                                          while ($donnees =$req ->fetch())
                                                          {
                                                            echo $donnees['nbre'];
                                                          }
                                                        }
                                                      }
                                                  ?>
                                            </i>
                                          </b>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total redoublants :</strong></td>
                                      <td>
                                        <b >
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(redoublant) AS nbre FROM eleve e, session s WHERE e.id_session=s.id_session AND s.id_session='$code2'");
                                                      if ($req) {
                                                          while ($donnees =$req ->fetch())
                                                          {
                                                            echo $donnees['nbre'];
                                                          }
                                                        }
                                                      }
                                                  ?>
                                            </i>
                                          </b>
                                      </td>
                                  </tr>
                                  </tbody>
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

                    <input type="hidden" name="id_eleve" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement ces effectifs</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer ces effectifs?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification des <b>Effectifs</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_eleve" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>PLACE DISPONIBLE</label>
                                <input type="number" name="place_dispo" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>EFFECTIF</label>
                                <input type="number" name="effectif" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>ADMIS</label>
                                <input type="number" name="admis" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>REDOUBLANT</label>
                                <input type="number" name="redoublant" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-success">
                                <label>OBSERVATION</label>
                                <input type="text" name="obs" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier ces effectifs?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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
