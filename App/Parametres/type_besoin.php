<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Type des besoins</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Type des besoins</strong>
            </li>
        </ol>
    </div>
</div>

<br/>

<?php include("Parametres/function.php"); ?>
      <!--========================================ajout===================================================-->
          <?php 
              if (isset($_POST['valider'])) {
                  $libelle=addslashes(htmlspecialchars($_POST['libelle']));

                   if (empty($libelle)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          ajout_type_besoin($libelle);
                          ?>
                              <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                  $libelle=addslashes(htmlspecialchars($_POST['libelle']));
                  $id_type_besoin=addslashes(htmlspecialchars($_POST['id_type_besoin']));

                   if (empty($libelle)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          modifier_type_besoin($id_type_besoin,$libelle);
                          ?>
                              <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Succès!</strong> Modification avec succès.
                              </div>
                          <?php
                     }
                 }
          ?>

          <?php 
              if (isset($_POST['supprimer'])) {
                  $id_type_besoin=addslashes(htmlspecialchars($_POST['id_type_besoin']));

                   if (empty($id_type_besoin)) {
                      ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Tous les champs avec <b>(*)</b> sont obligatoires. <a class="alert-link" href="#">Alerte !!!</a>.
                            </div>
                      <?php
                   }else{
                          supprimer_type_besoin($id_type_besoin);
                          ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Suppression avec succès. <a class="alert-link" href="#">Succès !!!</a>.
                                </div>
                          <?php
                     }
                 }
          ?>
      <!--========================================fin=========================================================-->

<div class="wrapper wrapper-content animated fadeInRightBig">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <?php 
                      if ($_SESSION['profil'] == "Statisticien") {
                       ?>
                        <li class=""><a data-toggle="tab" href="#tab-3"> <b><i class="fa fa-map-marker payment-icon-big text-success"></i></b></a></li>
                       <?php
                      }else{}
                     ?>
                    <li class="active"><a data-toggle="tab" href="#tab-4"><b><i class="fa fa-table payment-icon-big text-warning"></i></b></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body" style="margin-top: 15px;">
                            <div class="alert alert-warning">
                                <ul class="margin-bottom-none padding-left-lg">
                                    <li>Tous les champs du forulaire sont à remplir obligatoirement.</li>
                                    <li>Une fois tous les champs renseignés veuillez cliquez sur valider pour ajouter une <b>utilisateur</b>.</li>
                                </ul>
                            </div>
                            <div class="row">
                              <div class="col-lg-2"></div>
                              <div class="col-lg-8">
                                <form role="form" method="POST" action="">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>LIBELLE TYPE BESOIN</label>
                                                <input type="text" name="libelle" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous continuer l\'enregistrement?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                              <div class="col-lg-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane active">
                        <div class="panel-body" style="margin-top: 15px;">
                            <div class="alert alert-warning">
                                <ul class="margin-bottom-none padding-left-lg">
                                    <li><b>TYPES DES BESOINS PRIS EN CHARGE</b>.</li>
                                    <li>Veuillez cliquez sur les boutons à gauche du tableau pour <b>Supprimer, modifier.</b>.</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Type des besoins enregistrés</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                              <tr>
                                                  <th>N°</th>
                                                  <th>LIBELLE</th>
                                                  <?php
                                                    if ($_SESSION['profil'] == "Statisticien") {
                                                    ?>
                                                      <th>ACTIONS</th>
                                                    <?php
                                                     }else{}
                                                   ?>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                  $i=1;
                                                  $req = $conn ->query("SELECT * FROM type_besoin ORDER BY id_type_besoin DESC");
                                                  if ($req) {
                                                      while ($donnees =$req ->fetch()) {    
                                              ?>
                                              <tr class="gradeX">
                                                  <td style="color: #ea2d0c;">
                                                    <b>
                                                      <?php
                                                        echo $i;
                                                        $i++; 
                                                       ?>
                                                    </b>
                                                  </td>
                                                  <td><b style="font-size: 19px;"><?php echo $donnees['libelle']; ?></b></td>
                                                  <?php 
                                                    if ($_SESSION['profil'] == "Statisticien") {
                                                     ?>
                                                      <td class="center" style="text-align: center;">
                                                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick='document.location.href="#Visualiser"
                                                         document.recuperation1.id_type_besoin.value="<?php echo $donnees['id_type_besoin']?>"
                                                         document.recuperation1.libelle.value="<?php echo $donnees['libelle']?>"'>
                                                         <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" onclick='document.location.href="#Visualiser"
                                                           document.recuperation2.id_type_besoin.value="<?php echo $donnees['id_type_besoin']?>"'>
                                                           <i class="fa fa-trash"></i>
                                                        </a>
                                                      </td>
                                                     <?php
                                                    }
                                                   ?>
                                              </tr>
                                            <?php } } ?>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                  <th>N°</th>
                                                  <th>LIBELLE</th>
                                                  <?php
                                                    if ($_SESSION['profil'] == "Statisticien") {
                                                    ?>
                                                      <th>ACTIONS</th>
                                                    <?php
                                                     }else{}
                                                   ?>
                                              </tr>
                                            </tfoot>
                                          </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal inmodal fade" id="myModal1" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Suppression</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation2">

                    <input type="hidden" name="id_type_besoin" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION TYPE DE BESOIN</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement ce type de besoin</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer ce type de besoin?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_type_besoin" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>LIBELLE TYPE DE BESOIN</label>
                                <input type="text" name="libelle" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier ce type de besoin?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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