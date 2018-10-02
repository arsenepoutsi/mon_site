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
            <div class="col-lg-8">
                <h2>
                  Gestion des Besoins 
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
                        <strong>Enregistrement des Besoins</strong>
                    </li>
                </ol>
            </div>

            <div class="col-sm-4">
              <button type="button" class="btn btn-warning dim pull-right" data-toggle="modal" data-target="#enregistrement1" style="margin-top: 30px;">
                 <i class="fa fa-plus"></i>&nbsp;&nbsp; Ajouter les besoins
              </button>
            </div>

        </div>

        <br/>

        <?php include("Parametres/function.php"); ?>
            <!--========================================ajout===================================================-->

                <?php 
                  if (isset($_POST['valider1'])) {
                      $id_type_besoin=addslashes(htmlspecialchars($_POST['id_type_besoin']));
                      $description=addslashes(htmlspecialchars($_POST['description']));
                      $id_session=addslashes(htmlspecialchars($_POST['id_session']));
                      $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));

                       if (empty($id_type_besoin)) {
                          ?>
                            <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              ajout1($id_type_besoin,$description,$id_session,$id_etablissement);
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
                        $id_type_besoin=addslashes(htmlspecialchars($_POST['id_type_besoin']));
                        $description=addslashes(htmlspecialchars($_POST['description']));
                        $id_session=addslashes(htmlspecialchars($_POST['id_session']));
                        $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));
                        $id_besoin=addslashes(htmlspecialchars($_POST['id_besoin']));

                       if (empty($id_type_besoin)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              modifier1($id_besoin,$id_type_besoin,$description);
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
                      $id_besoin=addslashes(htmlspecialchars($_POST['id_besoin']));

                       if (empty($id_besoin)) {
                          ?>
                              <div class="alert icon-alert alert-danger" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="icon fa fa-times-circle"></i>
                      <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                    </div>
                          <?php
                       }else{
                              supprimer1($id_besoin);
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
                <div class="col-md-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>
                              Liste des Besoins
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
                                      <th>N°</th>
                                      <th>TYPE</th>
                                      <th>DESCRIPTION</th>
                                      <th>ACTIONS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $code1=$_GET['code1'];
                                    $code2=$_GET['code2'];
                                    if (isset($_GET["code1"]) && isset($_GET["code2"]))
                                    {
                                          $i=1;
                                          $req = $conn ->query("SELECT * FROM type_besoin t, besoin b, session s, etablissement e WHERE t.id_type_besoin=b.id_type_besoin AND b.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' ORDER BY id_besoin DESC");
                                          if ($req) {
                                              while ($donnees =$req ->fetch()) {    
                                      ?>
                                  <tr class="gradeX">
                                      <td style="color: #ea2d0c;text-align: center;">
                                        <b>
                                          <?php
                                            echo $i;
                                            $i++; 
                                           ?>
                                        </b>
                                      </td>
                                      <td style="text-align: center;"><b><?php echo $donnees['libelle']; ?></b></td>
                                      <td style="text-align: center;"><b><?php echo $donnees['description']; ?></b></td>
                                      <td class="center" style="text-align: center;">
                                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifier1" onclick='document.location.href="#Visualiser"
                                           document.recuperation1.id_besoin.value="<?php echo $donnees['id_besoin']?>"
                                           document.recuperation1.id_type_besoin.value="<?php echo $donnees['id_type_besoin']?>"
                                           document.recuperation1.description.value="<?php echo $donnees['description']?>"
                                           document.recuperation1.id_session.value="<?php echo $donnees['id_session']?>"
                                           document.recuperation1.id_etablissement.value="<?php echo $donnees['id_etablissement']?>"'>
                                           <span><i class="fa fa-pencil"></i></span>
                                       </a>
                                       <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppression1" onclick='document.location.href="#Visualiser"
                                           document.recuperation2.id_besoin.value="<?php echo $donnees['id_besoin']?>"'>
                                           <span><i class="fa fa-trash"></i><i></i></span>
                                       </a>
                                      </td>
                                  </tr>
                                <?php } } } ?>
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
                            <label for="inputState" class="col-form-label">TYPE DE BESOIN</label>
                            <select class="form-control m-b" name="id_type_besoin" required="required">
                                <option>--Selectionner le type de besoin--</option>
                                <?php
                                    $arsene=$conn->query('SELECT * FROM type_besoin ORDER BY libelle ASC');
                                    while ($ap =$arsene->fetch())
                                        {
                                            echo "<option value='".$ap["id_type_besoin"]."'> ".$ap["libelle"]." </option>";
                                        }
                                ?>
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="inputState" class="col-form-label">DESCRIPTION DU BESOIN</label>
                            <textarea type="text" class="form-control" name="description" rows="15" required="required"></textarea>
                          </div>
                          <div class="form-group col-md-12">

                            <input type="hidden" name="id_etablissement" class="form-control" value="<?php echo $donnees['id_etablissement']; ?>" required="required">
                            <input type="hidden" name="id_session" class="form-control" value="<?php echo $donnees['id_session']; ?>" required="required">
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
                <input type="hidden" name="id_besoin">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">TYPE DE BESOIN</label>
                    <select class="form-control m-b" name="id_type_besoin" required="required">
                        <option>--Selectionner le type de besoin--</option>
                        <?php
                            $arsene=$conn->query('SELECT * FROM type_besoin ORDER BY libelle ASC');
                            while ($ap =$arsene->fetch())
                                {
                                    echo "<option value='".$ap["id_type_besoin"]."'> ".$ap["libelle"]." </option>";
                                }
                        ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputState" class="col-form-label">DESCRIPTION DU BESOIN</label>
                    <textarea type="text" class="form-control" name="description" rows="15" required="required"></textarea>
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
          <input type="hidden" name="id_besoin">
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