<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Circonscriptions</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Circonscriptions</strong>
            </li>
        </ol>
    </div>
</div>

<br/>

<?php include("Parametres/function.php"); ?>
      <!--========================================ajout===================================================-->
          <?php 
              if (isset($_POST['valider'])) {
                  $nom_circonscription=addslashes(htmlspecialchars($_POST['nom_circonscription']));
                  $responsable_circonscription=addslashes(htmlspecialchars($_POST['responsable_circonscription']));
                  $matricule_responsable=addslashes(htmlspecialchars($_POST['matricule_responsable']));
                  $contact_responsable=addslashes(htmlspecialchars($_POST['contact_responsable']));
                  $ville_circonscription=addslashes(htmlspecialchars($_POST['ville_circonscription']));

                   if (empty($nom_circonscription)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          ajout_circoncription($nom_circonscription,$responsable_circonscription,$matricule_responsable,$contact_responsable,$ville_circonscription);
                          ?>
                              <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Succès!</strong> Circonscription enregistrée avec succès.
                              </div>
                          <?php
                     }
                 }
          ?>
      <!--========================================fin=========================================================-->

      <!--========================================modif===================================================-->
          <?php 
              if (isset($_POST['modifier'])) {
                  $nom_circonscription=addslashes(htmlspecialchars($_POST['nom_circonscription']));
                  $responsable_circonscription=addslashes(htmlspecialchars($_POST['responsable_circonscription']));
                  $matricule_responsable=addslashes(htmlspecialchars($_POST['matricule_responsable']));
                  $contact_responsable=addslashes(htmlspecialchars($_POST['contact_responsable']));
                  $ville_circonscription=addslashes(htmlspecialchars($_POST['ville_circonscription']));
                  $id_circonscription=addslashes(htmlspecialchars($_POST['id_circonscription']));

                   if (empty($nom_circonscription)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          modifier_circonscription($id_circonscription,$nom_circonscription,$responsable_circonscription,$matricule_responsable,$contact_responsable,$ville_circonscription);
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
                  $id_circonscription=addslashes(htmlspecialchars($_POST['id_circonscription']));

                   if (empty($id_circonscription)) {
                      ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Tous les champs avec <b>(*)</b> sont obligatoires. <a class="alert-link" href="#">Alerte !!!</a>.
                            </div>
                      <?php
                   }else{
                          supprimer_circonscription($id_circonscription);
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
                      <li class=""><a data-toggle="tab" href="#tab-3"> <b><i class="fa fa-plus payment-icon-big text-success"></i></b></a></li>
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
                                    <li>Une fois tous les champs renseignés veuillez cliquez sur valider pour ajouter une <b>circonscription</b>.</li>
                                </ul>
                            </div>
                            <div class="row">
                              <div class="col-lg-2"></div>
                              <div class="col-lg-8">
                                <form role="form" method="POST" action="">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>NOM DE LA CIRCONSCRIPTION</label>
                                                <input type="text" name="nom_circonscription" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>VILLE</label>
                                                <input type="text" name="ville_circonscription" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>RESPONSABLE</label>
                                                <input type="text" name="responsable_circonscription" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>CONTACT</label>
                                                <input type="text" name="contact_responsable" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>MATRICULE</label>
                                                <input type="text" name="matricule_responsable" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous enregistrer cette circonscription?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
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
                                    <li><b>LISTE DES CIRCONSCRIPTION</b>.</li>
                                    <li>Veuillez cliquez sur les boutons à gauche du tableau pour <b>Supprimer, modifier.</b>.</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Liste de toutes les circonscriptions enregistrée</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                              <tr>
                                                  <th>NOM</th>
                                                  <th>VILLE</th>
                                                  <th>RESPONSABLE</th>
                                                  <th>CONTACT</th>
                                                  <th>MATRICULE</th>
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
                                                  $req = $conn ->query("SELECT * FROM circonscription ORDER BY id_circonscription DESC");
                                                  if ($req) {
                                                      while ($donnees =$req ->fetch()) {    
                                              ?>
                                              <tr class="gradeX">
                                                  <td style="text-align: center;color: #ea2d0c;"><b><?php echo $donnees['nom_circonscription']; ?></b></td>
                                                  <td><b><?php echo $donnees['ville_circonscription']; ?></b></td>
                                                  <td><b><?php echo $donnees['responsable_circonscription']; ?></b></td>
                                                  <td><b><?php echo $donnees['contact_responsable']; ?></b></td>
                                                  <td><b><?php echo $donnees['matricule_responsable']; ?></b></td>
                                                  <?php 
                                                    if ($_SESSION['profil'] == "Administrateur") {
                                                      ?>
                                                        <td class="center" style="text-align: center;">
                                                          <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick='document.location.href="#Visualiser"
                                                           document.recuperation1.id_circonscription.value="<?php echo $donnees['id_circonscription']?>"
                                                           document.recuperation1.nom_circonscription.value="<?php echo $donnees['nom_circonscription']?>"
                                                           document.recuperation1.responsable_circonscription.value="<?php echo $donnees['responsable_circonscription']?>"
                                                           document.recuperation1.matricule_responsable.value="<?php echo $donnees['matricule_responsable']?>"
                                                           document.recuperation1.contact_responsable.value="<?php echo $donnees['contact_responsable']?>"
                                                           document.recuperation1.ville_circonscription.value="<?php echo $donnees['ville_circonscription']?>"'>
                                                           <i class="fa fa-edit"></i>
                                                          </a>
                                                          <a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" onclick='document.location.href="#Visualiser"
                                                             document.recuperation2.id_circonscription.value="<?php echo $donnees['id_circonscription']?>"'>
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
                                                  <th>NOM</th>
                                                  <th>VILLE</th>
                                                  <th>RESPONSABLE</th>
                                                  <th>CONTACT</th>
                                                  <th>MATRICULE</th>
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

                    <input type="hidden" name="id_circonscription" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION DE LA CIRCONSCRIPTION</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement la circonscription</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer cette circonscription?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification de la <b>Circonscription</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_circonscription" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>NOM DE LA CIRCONSCRIPTION</label>
                                <input type="text" name="nom_circonscription" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>VILLE</label>
                                <input type="text" name="ville_circonscription" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>RESPONSABLE</label>
                                <input type="text" name="responsable_circonscription" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>CONTACT</label>
                                <input type="text" name="contact_responsable" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>MATRICULE</label>
                                <input type="text" name="matricule_responsable" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier cette circonscription?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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