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
                  Gestion des enseignants 
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

                  <button class="btn btn-primary btn-rounded pull-right" type="button" data-toggle="modal" data-target="#enregistrement2"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>NATIONAUX</b></button>

                  <button class="btn btn-success btn-rounded pull-right" type="button" data-toggle="modal" data-target="#enregistrement1"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>EXPATRIES</b></button>

                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>Enregistrement des Effectifs des Enseignants</strong>
                    </li>
                </ol>
            </div>
        </div>

        <br/>

        <?php include("Etablissements/function_session.php"); ?>
            <!--========================================ajout===================================================-->

                <?php 
                  if (isset($_POST['valider1'])) {
                      $discipline=addslashes(htmlspecialchars($_POST['discipline']));
                      $homme=addslashes(htmlspecialchars($_POST['homme']));
                      $femme=addslashes(htmlspecialchars($_POST['femme']));
                      $type_enseignant=addslashes(htmlspecialchars($_POST['type_enseignant']));
                      $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));
                      $id_session=addslashes(htmlspecialchars($_POST['id_session']));
                      $total=($homme + $femme);

                       if (empty($discipline)) {
                          ?>
                            <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              ajout1($discipline,$homme,$femme,$type_enseignant,$id_session,$id_etablissement,$total);
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
                  if (isset($_POST['modifier1'])) {
                        $discipline=addslashes(htmlspecialchars($_POST['discipline']));
                        $homme=addslashes(htmlspecialchars($_POST['homme']));
                        $femme=addslashes(htmlspecialchars($_POST['femme']));
                        $id_enseignant=addslashes(htmlspecialchars($_POST['id_enseignant']));
                        $total=($homme + $femme);

                       if (empty($discipline)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              modifier1($id_enseignant,$discipline,$homme,$femme,$total);
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
                  if (isset($_POST['supprimer1'])) {
                      $id_enseignant=addslashes(htmlspecialchars($_POST['id_enseignant']));

                       if (empty($id_enseignant)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              supprimer1($id_enseignant);
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

          <!--========================================EXPATRIES=========================================================-->

          <?php 
                  if (isset($_POST['valider2'])) {
                      $discipline=addslashes(htmlspecialchars($_POST['discipline']));
                      $homme=addslashes(htmlspecialchars($_POST['homme']));
                      $femme=addslashes(htmlspecialchars($_POST['femme']));
                      $type_enseignant=addslashes(htmlspecialchars($_POST['0']));
                      $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));
                      $id_session=addslashes(htmlspecialchars($_POST['id_session']));
                      $total=($homme + $femme);

                       if (empty($discipline)) {
                          ?>
                            <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              ajout2($discipline,$homme,$femme,$type_enseignant,$id_session,$id_etablissement,$total);
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
                  if (isset($_POST['modifier2'])) {
                        $discipline=addslashes(htmlspecialchars($_POST['discipline']));
                        $homme=addslashes(htmlspecialchars($_POST['homme']));
                        $femme=addslashes(htmlspecialchars($_POST['femme']));
                        $id_enseignant=addslashes(htmlspecialchars($_POST['id_enseignant']));
                        $total=($homme + $femme);

                       if (empty($discipline)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              modifier2($id_enseignant,$discipline,$homme,$femme,$total);
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
                  if (isset($_POST['supprimer2'])) {
                      $id_enseignant=addslashes(htmlspecialchars($_POST['id_enseignant']));

                       if (empty($id_enseignant)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              supprimer2($id_enseignant);
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
                            <h5>
                              Enseignants <b>NATIONAUX</b> 
                              <b><?php 
                                      $code=$_GET['code1'];
                                      if (isset($_GET["code1"]))
                                      {
                                          $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                                          while ($donnees =$req ->fetch())
                                          { 
                                            echo $donnees['nom_etablissement'];
                                          } 
                                      }         
                                  ?></b>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                  <tr>
                                      <th>DISCIPLINE</th>
                                      <th>HOMME</th>
                                      <th>FEMME</th>
                                      <th>TOTAL</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $code1=$_GET['code1'];
                                    $code2=$_GET['code2'];
                                    if (isset($_GET["code1"]) && isset($_GET["code2"]))
                                    {
                                          $req = $conn ->query("SELECT * FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Nationaux' ORDER BY id_enseignant DESC");
                                          if ($req) {
                                              while ($donnees =$req ->fetch()) {    
                                      ?>
                                  <tr class="gradeX">
                                      <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['discipline']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['homme']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['femme']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['total']; ?></b></td>
                                      <td class="center" style="text-align: center;">
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifier1" onclick='document.location.href="#Visualiser"
                                           document.recuperation1.id_enseignant.value="<?php echo $donnees['id_enseignant']?>"
                                           document.recuperation1.discipline.value="<?php echo $donnees['discipline']?>"
                                           document.recuperation1.homme.value="<?php echo $donnees['homme']?>"
                                           document.recuperation1.femme.value="<?php echo $donnees['femme']?>"
                                           document.recuperation1.total.value="<?php echo $donnees['total']?>"'>
                                           <span><i class="fa fa-pencil"></i></span>
                                       </a>
                                       <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppression1" onclick='document.location.href="#Visualiser"
                                           document.recuperation2.id_enseignant.value="<?php echo $donnees['id_enseignant']?>"'>
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
                                      <td><strong>Total Homme :</strong></td>
                                      <td>
                                          <i style="color: #c72b05;">
                                            <?php 
                                              $code2=$_GET['code2'];
                                                    if (isset($_GET["code2"]))
                                                    {
                                                  $req = $conn ->query("SELECT SUM(homme) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Nationaux'");
                                                    if ($req) {
                                                        while ($donnees =$req ->fetch())
                                                        {
                                                          echo $donnees['nbre'];
                                                        }
                                                      }
                                                    }
                                                ?>
                                          </i>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total Femme :</strong></td>
                                      <td>
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(femme) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Nationaux'");
                                                      if ($req) {
                                                          while ($donnees =$req ->fetch())
                                                          {
                                                            echo $donnees['nbre'];
                                                          }
                                                        }
                                                      }
                                                  ?>
                                            </i>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>TOTAL :</strong></td>
                                      <td>
                                        <b >
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Nationaux'");
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

                <div class="col-md-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>
                              Enseignants <b>EXPATRI&Eacute;S</b> 
                              <b><?php 
                                      $code=$_GET['code1'];
                                      if (isset($_GET["code1"]))
                                      {
                                          $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                                          while ($donnees =$req ->fetch())
                                          { 
                                            echo $donnees['nom_etablissement'];
                                          } 
                                      }         
                                  ?></b>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                  <tr>
                                      <th>DISCIPLINE</th>
                                      <th>HOMME</th>
                                      <th>FEMME</th>
                                      <th>TOTAL</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $code1=$_GET['code1'];
                                    $code2=$_GET['code2'];
                                    if (isset($_GET["code1"]) && isset($_GET["code2"]))
                                    {
                                          $req = $conn ->query("SELECT * FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Expatries' ORDER BY id_enseignant DESC");
                                          if ($req) {
                                              while ($donnees =$req ->fetch()) {    
                                      ?>
                                  <tr class="gradeX">
                                      <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['discipline']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['homme']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['femme']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['total']; ?></b></td>
                                      <td class="center" style="text-align: center;">
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifier2" onclick='document.location.href="#Visualiser"
                                           document.recuperation3.id_enseignant.value="<?php echo $donnees['id_enseignant']?>"
                                           document.recuperation3.discipline.value="<?php echo $donnees['discipline']?>"
                                           document.recuperation3.homme.value="<?php echo $donnees['homme']?>"
                                           document.recuperation3.femme.value="<?php echo $donnees['femme']?>"
                                           document.recuperation3.total.value="<?php echo $donnees['total']?>"'>
                                           <span><i class="fa fa-pencil"></i></span>
                                       </a>
                                       <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppression2" onclick='document.location.href="#Visualiser"
                                           document.recuperation4.id_enseignant.value="<?php echo $donnees['id_enseignant']?>"'>
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
                                      <td><strong>Total Homme :</strong></td>
                                      <td>
                                          <i style="color: #c72b05;">
                                            <?php 
                                              $code2=$_GET['code2'];
                                                    if (isset($_GET["code2"]))
                                                    {
                                                  $req = $conn ->query("SELECT SUM(homme) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Expatries'");
                                                    if ($req) {
                                                        while ($donnees =$req ->fetch())
                                                        {
                                                          echo $donnees['nbre'];
                                                        }
                                                      }
                                                    }
                                                ?>
                                          </i>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total Femme :</strong></td>
                                      <td>
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(femme) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Expatries'");
                                                      if ($req) {
                                                          while ($donnees =$req ->fetch())
                                                          {
                                                            echo $donnees['nbre'];
                                                          }
                                                        }
                                                      }
                                                  ?>
                                            </i>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td><strong>TOTAL :</strong></td>
                                      <td>
                                        <b >
                                            <i style="color: #c72b05;">
                                              <?php 
                                                $code2=$_GET['code2'];
                                                      if (isset($_GET["code2"]))
                                                      {
                                                    $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant n, session s WHERE n.id_session=s.id_session AND s.id_session='$code2' AND n.type_enseignant='Expatries'");
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


<!-- ==================================================== NATINAUX ====================================================== -->

<div class="modal inmodal fade" id="enregistrement1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Formulaire d'enregistrement</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
                $code1=$_GET['code1'];
                $code2=$_GET['code2'];
                if (isset($_GET["code1"]) && isset($_GET["code2"]))
                {
                    $req=$conn->query("SELECT * FROM etablissement e, session s WHERE e.id_etablissement=s.id_etablissement AND e.id_etablissement='$code1' AND s.id_session='$code2'");
                    while ($donnees =$req ->fetch())
                    { 
                      ?>
                      <form action="" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Discipline</label>
                    <input type="text" name="discipline" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Homme</label>
                    <input type="number" name="homme" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Femme</label>
                    <input type="number" name="femme" class="form-control" id="inputCity" required="required">

                    <input type="hidden" name="id_etablissement" class="form-control" value="<?php echo $donnees['id_etablissement']; ?>" required="required">
                    <input type="hidden" name="id_session" class="form-control" value="<?php echo $donnees['id_session']; ?>" required="required">
                    <input type="hidden" name="type_enseignant" class="form-control" value="Expatries" required="required">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" name="valider1" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
                      <?php
                    } 
                }         
            ?>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>


<!-- ===================================================== form modif ========================================================= -->

<div class="modal inmodal fade" id="modifier1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Formulaire de modification</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
                $code1=$_GET['code1'];
                $code2=$_GET['code2'];
                if (isset($_GET["code1"]) && isset($_GET["code2"]))
                {
                    $req=$conn->query("SELECT * FROM etablissement e, session s WHERE e.id_etablissement=s.id_etablissement AND e.id_etablissement='$code1' AND s.id_session='$code2'");
                    while ($donnees =$req ->fetch())
                    { 
                      ?>
                      <form action="" method="POST" name="recuperation1">
                <input type="hidden" name="id_enseignant">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Discipline</label>
                    <input type="text" name="discipline" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Homme</label>
                    <input type="number" name="homme" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Femme</label>
                    <input type="number" name="femme" class="form-control" id="inputCity" required="required">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" name="modifier1" class="btn btn-primary">Mettre à jour</button>
                </div>
              </form>
                      <?php
                    } 
                }         
            ?>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>

<div class="modal inmodal fade" id="suppression1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Suppression</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" name="recuperation2">
          <input type="hidden" name="id_enseignant">
            <div class="alert icon-alert alert-danger" role="alert">
              <i class="icon fa fa-times-circle"></i>
              <strong>Suppression!</strong> Voulez-vous rélémment supprimer?.
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="submit" name="supprimer1" class="btn btn-primary">Oui</button>
          </div>
        </form>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>

<!-- ==================================================== FIN ====================================================== -->


<!-- ==================================================== EXPATRIES ====================================================== -->

<div class="modal inmodal fade" id="enregistrement2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Formulaire d'enregistrement</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
                $code1=$_GET['code1'];
                $code2=$_GET['code2'];
                if (isset($_GET["code1"]) && isset($_GET["code2"]))
                {
                    $req=$conn->query("SELECT * FROM etablissement e, session s WHERE e.id_etablissement=s.id_etablissement AND e.id_etablissement='$code1' AND s.id_session='$code2'");
                    while ($donnees =$req ->fetch())
                    { 
                      ?>
                      <form action="" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Discipline</label>
                    <input type="text" name="discipline" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Homme</label>
                    <input type="number" name="homme" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Femme</label>
                    <input type="number" name="femme" class="form-control" id="inputCity" required="required">

                    <input type="hidden" name="id_etablissement" class="form-control" value="<?php echo $donnees['id_etablissement']; ?>" required="required">
                    <input type="hidden" name="id_session" class="form-control" value="<?php echo $donnees['id_session']; ?>" required="required">
                    <input type="hidden" name="type_enseignant" class="form-control" value="Nationaux" required="required">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" name="valider2" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
                      <?php
                    } 
                }         
            ?>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>


<!-- ===================================================== form modif ========================================================= -->

<div class="modal inmodal fade" id="modifier2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Formulaire de modification</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
                $code1=$_GET['code1'];
                $code2=$_GET['code2'];
                if (isset($_GET["code1"]) && isset($_GET["code2"]))
                {
                    $req=$conn->query("SELECT * FROM etablissement e, session s WHERE e.id_etablissement=s.id_etablissement AND e.id_etablissement='$code1' AND s.id_session='$code2'");
                    while ($donnees =$req ->fetch())
                    { 
                      ?>
                      <form action="" method="POST" name="recuperation3">
                <input type="hidden" name="id_enseignant">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Discipline</label>
                    <input type="text" name="discipline" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Homme</label>
                    <input type="number" name="homme" class="form-control" id="inputCity" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">Nbre Femme</label>
                    <input type="number" name="femme" class="form-control" id="inputCity" required="required">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" name="modifier2" class="btn btn-primary">Mettre à jour</button>
                </div>
              </form>
                      <?php
                    } 
                }         
            ?>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>

<div class="modal inmodal fade" id="suppression2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Suppression</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" name="recuperation4">
          <input type="hidden" name="id_enseignant">
            <div class="alert icon-alert alert-danger" role="alert">
              <i class="icon fa fa-times-circle"></i>
              <strong>Suppression!</strong> Voulez-vous rélémment supprimer?.
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="submit" name="supprimer2" class="btn btn-primary">Oui</button>
          </div>
        </form>
      </div>
    </div><!-- .modal-content -->
  </div><!-- .modal-dialog .modal-lg -->
</div>

<!-- ==================================================== FIN ====================================================== -->