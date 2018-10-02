<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Provinces</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Provinces</strong>
            </li>
        </ol>
    </div>
</div>

<br/>

<?php include("Parametres/function.php"); ?>
      <!--========================================ajout===================================================-->
          <?php 
              if (isset($_POST['valider'])) {
                  $code_province=addslashes(htmlspecialchars($_POST['code_province']));
                  $nom_province=addslashes(htmlspecialchars($_POST['nom_province']));
                  $lat_province=addslashes(htmlspecialchars($_POST['lat_province']));
                  $long_province=addslashes(htmlspecialchars($_POST['long_province']));

                   if (empty($code_province)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          ajout_province($code_province,$nom_province,$lat_province,$long_province);
                          ?>
                              <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Succès!</strong> Province enregistrée avec succès.
                              </div>
                          <?php
                     }
                 }
          ?>
      <!--========================================fin=========================================================-->

      <!--========================================modif===================================================-->
          <?php 
              if (isset($_POST['modifier'])) {
                  $code_province=addslashes(htmlspecialchars($_POST['code_province']));
                  $nom_province=addslashes(htmlspecialchars($_POST['nom_province']));
                  $lat_province=addslashes(htmlspecialchars($_POST['lat_province']));
                  $long_province=addslashes(htmlspecialchars($_POST['long_province']));
                  $id_province=addslashes(htmlspecialchars($_POST['id_province']));

                   if (empty($code_province)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          modifier_province($id_province,$code_province,$nom_province,$lat_province,$long_province);
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
                  $id_province=addslashes(htmlspecialchars($_POST['id_province']));

                   if (empty($id_province)) {
                      ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Tous les champs avec <b>(*)</b> sont obligatoires. <a class="alert-link" href="#">Alerte !!!</a>.
                            </div>
                      <?php
                   }else{
                          supprimer_province($id_province);
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
                      if ($_SESSION['profil'] == "Administrateur") {
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
                                                <label>CODE DE LA PROVINCE</label>
                                                <input type="text" name="code_province" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>NOM DE LA PROVINCE</label>
                                                <input type="text" name="nom_province" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>LATITUDE</label>
                                                <input type="text" name="lat_province" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>LONGITUDE</label>
                                                <input type="text" name="long_province" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous enregistrer cette province?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
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
                                    <li><b>LISTE DES PROVINCES</b>.</li>
                                    <li>Veuillez cliquez sur les boutons à gauche du tableau pour <b>Supprimer, modifier.</b>.</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Liste de toutes les provinces enregistrée</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                              <tr>
                                                  <th>CODE</th>
                                                  <th>NOM DE LA PROVINCE</th>
                                                  <th>LATITUDE</th>
                                                  <th>LONGITUDE</th>
                                                  <?php
                                                    if ($_SESSION['profil'] == "Administrateur") {
                                                    ?>
                                                      <th>ACTIONS</th>
                                                    <?php
                                                     }else{}
                                                   ?>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                  $req = $conn ->query("SELECT * FROM province ORDER BY id_province DESC");
                                                  if ($req) {
                                                      while ($donnees =$req ->fetch()) {    
                                              ?>
                                              <tr class="gradeX">
                                                  <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['code_province']; ?></b></td>
                                                  <td><b><?php echo $donnees['nom_province']; ?></b></td>
                                                  <td><b><?php echo $donnees['lat_province']; ?></b></td>
                                                  <td><b><?php echo $donnees['long_province']; ?></b></td>
                                                  <?php 
                                                    if ($_SESSION['profil'] == "Administrateur") {
                                                     ?>
                                                      <td class="center" style="text-align: center;">
                                                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick='document.location.href="#Visualiser"
                                                         document.recuperation1.id_province.value="<?php echo $donnees['id_province']?>"
                                                         document.recuperation1.code_province.value="<?php echo $donnees['code_province']?>"
                                                         document.recuperation1.nom_province.value="<?php echo $donnees['nom_province']?>"
                                                         document.recuperation1.lat_province.value="<?php echo $donnees['lat_province']?>"
                                                         document.recuperation1.long_province.value="<?php echo $donnees['long_province']?>"'>
                                                         <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" onclick='document.location.href="#Visualiser"
                                                           document.recuperation2.id_province.value="<?php echo $donnees['id_province']?>"'>
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
                                                  <th>CODE</th>
                                                  <th>NOM DE LA PROVINCE</th>
                                                  <th>LATITUDE</th>
                                                  <th>LONGITUDE</th>
                                                  <?php
                                                    if ($_SESSION['profil'] == "Administrateur") {
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

                    <input type="hidden" name="id_province" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION DE LA PROVINCE</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement la province</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer cette province?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification de la <b>Province</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_province" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>CODE DE LA PROVINCE</label>
                                <input type="text" name="code_province" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>NOM DE LA PROVINCE</label>
                                <input type="text" name="nom_province" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>LATITUDE</label>
                                <input type="text" name="lat_province" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>LONGITUDE</label>
                                <input type="text" name="long_province" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier cette province?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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