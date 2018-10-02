<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>
          Etablissements
          <?php 
            if ($_SESSION['profil'] == "Administrateur" OR $_SESSION['profil'] == "Statisticien") {
            ?>
              <a href="Impressions/page1.php" target="_bank" data-toggle="tooltip" data-placement="top" title="Imprimer la liste des établissements">
                <button class="btn btn-primary dim btn-large-dim pull-right" type="button"><i class="fa fa-print"></i></button>
              </a>

              <a href="Impressions/page4.php" target="_bank" data-toggle="tooltip" data-placement="top" title="Imprimer la liste des responsables établissements">
                <button class="btn btn-success dim btn-large-dim pull-right" type="button"><i class="fa fa-print"></i></button>
              </a>
            <?php
            }else{

            }
           ?>
          

        </h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Etablissements</strong>
            </li>
        </ol>
    </div>
</div>

<br/>

<?php include("Etablissements/function.php"); ?>
      <!--========================================ajout===================================================-->
        <?php 
            if (isset($_POST['valider'])) {
                $nom_etablissement=addslashes(htmlspecialchars($_POST['nom_etablissement']));
                $type_etablissement=addslashes(htmlspecialchars($_POST['type_etablissement']));
                $categorie_etablissement=addslashes(htmlspecialchars($_POST['categorie_etablissement']));
                $dte_creation=addslashes(htmlspecialchars($_POST['dte_creation']));
                $responsable=addslashes(htmlspecialchars($_POST['responsable']));
                $num_responsable=addslashes(htmlspecialchars($_POST['num_responsable']));
                $id_circonscription=addslashes(htmlspecialchars($_POST['id_circonscription']));
                $id_province=addslashes(htmlspecialchars($_POST['id_province']));
                $ville=addslashes(htmlspecialchars($_POST['ville']));
                $lat_etablissement=addslashes(htmlspecialchars($_POST['lat_etablissement']));
                $long_etablissement=addslashes(htmlspecialchars($_POST['long_etablissement']));

                 if (empty($nom_etablissement)) {
                    ?>
                        <div class="alert icon-alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="icon fa fa-times-circle"></i>
                <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
              </div>
                    <?php
                 }else{
                        ajout_etablissement($nom_etablissement,$type_etablissement,$categorie_etablissement,$dte_creation,$responsable,$num_responsable,$id_circonscription,$lat_etablissement,$long_etablissement,$id_province,$ville);
                        ?>
                            <div class="alert icon-alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <i class="icon fa fa-check-circle"></i>
                  <strong>Succès!</strong> Etablissement enregistré avec succès.
                </div>
                        <?php
                   }
               }
        ?>
    <!--========================================fin=========================================================-->

      <!--========================================modif===================================================-->
          <?php 
              if (isset($_POST['modifier'])) {
                  $nom_etablissement=addslashes(htmlspecialchars($_POST['nom_etablissement']));
                  $type_etablissement=addslashes(htmlspecialchars($_POST['type_etablissement']));
                  $categorie_etablissement=addslashes(htmlspecialchars($_POST['categorie_etablissement']));
                  $dte_creation=addslashes(htmlspecialchars($_POST['dte_creation']));
                  $responsable=addslashes(htmlspecialchars($_POST['responsable']));
                  $num_responsable=addslashes(htmlspecialchars($_POST['num_responsable']));
                  $id_circonscription=addslashes(htmlspecialchars($_POST['id_circonscription']));
                  $id_province=addslashes(htmlspecialchars($_POST['id_province']));
                  $ville=addslashes(htmlspecialchars($_POST['ville']));
                  $lat_etablissement=addslashes(htmlspecialchars($_POST['lat_etablissement']));
                  $long_etablissement=addslashes(htmlspecialchars($_POST['long_etablissement']));
                  $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));

                   if (empty($nom_etablissement)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                         modifier_etablissement($id_etablissement,$nom_etablissement,$type_etablissement,$categorie_etablissement,$dte_creation,$responsable,$num_responsable,$id_circonscription,$lat_etablissement,$long_etablissement,$id_province,$ville);
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
                  $id_etablissement=addslashes(htmlspecialchars($_POST['id_etablissement']));

                   if (empty($id_etablissement)) {
                      ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Tous les champs avec <b>(*)</b> sont obligatoires. <a class="alert-link" href="#">Alerte !!!</a>.
                            </div>
                      <?php
                   }else{
                          supprimer_etablissement($id_etablissement);
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
                      if ($_SESSION['profil'] == "Administrateur" OR $_SESSION['profil'] == "Statisticien") {
                       ?>
                       <li class=""><a data-toggle="tab" href="#tab-3"> <b><i class="fa fa-plus payment-icon-big text-success"></i></b></a></li>
                       <?php
                       } 
                     ?>
                    <li class="active"><a data-toggle="tab" href="#tab-4"><b><i class="fa fa-table payment-icon-big text-warning"></i></b></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body" style="margin-top: 15px;">
                            <div class="alert alert-warning">
                                <ul class="margin-bottom-none padding-left-lg">
                                    <li>Tous les champs du forulaire sont à remplir obligatoirement.</li>
                                    <li>Une fois tous les champs renseignés veuillez cliquez sur valider pour créer un <b>établissement</b>.</li>
                                </ul>
                            </div>
                            <div class="row">
                              <div class="col-lg-2"></div>
                              <div class="col-lg-8">
                                <form role="form" method="POST" action="">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>NOM</label>
                                                <input type="text" name="nom_etablissement" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>TYPE</label>
                                                <select class="form-control m-b" name="type_etablissement" required="required">
                                                    <option value="Publics">Publics</option>
                                                    <option value="Privés Catholiques">Privés Catholiques</option>
                                                    <option value="Evangéliques">Evangéliques</option>
                                                    <option value="Alliance Chrétienne">Alliance Chrétienne</option>
                                                    <option value="Islamique">Islamique</option>
                                                    <option value="Privés reconnus utilité public">Privés reconnus d'utilité public</option>
                                                    <option value="Laïc">Laïc</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>CATEGORIE</label>
                                                <select class="form-control m-b" name="categorie_etablissement" required="required">
                                                    <option value="PRE-PRIMAIRE">PRE-PRIMAIRE</option>
                                                    <option value="PRIMAIRE">PRIMAIRE</option>
                                                    <option value="SECONDAIRE GENERAL">SECONDAIRE GENERAL</option>
                                                    <option value="SECONDAIRE TECHNIQUE">SECONDAIRE TECHNIQUE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>DATE DE CREATION</label>
                                                <input type="text" name="dte_creation" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>RESPONSABLE</label>
                                                <input type="text" name="responsable" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>TEL. RESPONSABLE</label>
                                                <input type="number" name="num_responsable" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>CIRCONSCRIPTION ADMINISTRATIVE</label>
                                                <select class="form-control m-b" name="id_circonscription" required="required">
                                                    <option>--Selectionner la circonscription--</option>
                                                    <?php
                                                        $arsene=$conn->query('SELECT * FROM circonscription ORDER BY nom_circonscription ASC');
                                                        while ($ap =$arsene->fetch())
                                                            {
                                                                echo "<option value='".$ap["id_circonscription"]."'> ".$ap["nom_circonscription"]." </option>";
                                                            }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>PROVINCE</label>
                                                <select class="form-control m-b" name="id_province" required="required">
                                                    <option>--Selectionner la province--</option>
                                                    <?php
                                                        $arsene=$conn->query('SELECT * FROM province ORDER BY nom_province ASC');
                                                        while ($ap =$arsene->fetch())
                                                            {
                                                                echo "<option value='".$ap["id_province"]."'> ".$ap["nom_province"]." </option>";
                                                            }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>VILLE</label>
                                                <input type="text" name="ville" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>LATITUDE</label>
                                                <input type="text" name="lat_etablissement" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>LONGITUDE</label>
                                                <input type="text" name="long_etablissement" class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous enregistrer cet etablissement?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
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
                                    <li><b>LISTE DES ETABLISSEMENTS</b>.</li>
                                    <li>Veuillez cliquez sur les boutons à gauche du tableau pour <b>Supprimer, modifier, activer et bloquer l'établisseent...</b>.</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Liste des établissements enregistré</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                              <tr>
                                                  <th>N°</th>
                                                  <th>NOM</th>
                                                  <th>TYPE</th>
                                                  <th>CATEGORIE</th>
                                                  <th>RESPONSABLE</th>
                                                  <th>CIRCONSCRIPTION</th>
                                                  <th>ACTIONS</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                  $i=1;
                                                  $req = $conn ->query("SELECT * FROM etablissement e, circonscription c WHERE e.id_circonscription=c.id_circonscription ORDER BY nom_etablissement ASC");
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
                                                  <td><b><?php echo $donnees['nom_etablissement']; ?></b></td>
                                                  <td><?php echo $donnees['type_etablissement']; ?></td>
                                                  <td class="center"><b><?php echo $donnees['categorie_etablissement']; ?></b></td>
                                                  <td class="center"><b><?php echo $donnees['responsable']; ?></b></td>
                                                  <td class="center"><b><?php echo $donnees['nom_circonscription']; ?></b></td>
                                                  <td class="center" style="text-align: center;">
                                                    <?php 
                                                    if ($_SESSION['profil'] == "Administrateur" OR $_SESSION['profil'] == "Statisticien") {
                                                     ?>
                                                        <a href="Impressions/detail_etablissement.php?code=<?php echo $donnees['id_etablissement'];?>" target="_bank" class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="top" title="Voir les détails de  l'établissement">
                                                             <span><i class="fa fa-eye"></i></span>
                                                        </a>
                                                    <?php
                                                      }
                                                     ?>
                                                     <?php 
                                                    if ($_SESSION['profil'] == "Décideur" OR $_SESSION['profil'] == "Statisticien") {
                                                     ?>
                                                        <a href="session.php?code=<?php echo $donnees['id_etablissement'];?>" class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="Enregistrer une session">
                                                             <span><i class="fa fa-calendar"></i></span>
                                                        </a>
                                                    <?php
                                                      }
                                                     ?>
                                                     <?php 
                                                    if ($_SESSION['profil'] == "Administrateur" OR $_SESSION['profil'] == "Statisticien") {
                                                     ?>
                                                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick='document.location.href="#Visualiser"
                                                         document.recuperation1.id_etablissement.value="<?php echo $donnees['id_etablissement']?>"
                                                         document.recuperation1.nom_etablissement.value="<?php echo $donnees['nom_etablissement']?>"
                                                         document.recuperation1.type_etablissement.value="<?php echo $donnees['type_etablissement']?>"
                                                         document.recuperation1.categorie_etablissement.value="<?php echo $donnees['categorie_etablissement']?>"
                                                         document.recuperation1.dte_creation.value="<?php echo $donnees['dte_creation']?>"
                                                         document.recuperation1.responsable.value="<?php echo $donnees['responsable']?>"
                                                         document.recuperation1.num_responsable.value="<?php echo $donnees['num_responsable']?>"
                                                         document.recuperation1.id_circonscription.value="<?php echo $donnees['id_circonscription']?>"
                                                         document.recuperation1.lat_etablissement.value="<?php echo $donnees['lat_etablissement']?>"
                                                         document.recuperation1.long_etablissement.value="<?php echo $donnees['long_etablissement']?>"
                                                         document.recuperation1.id_province.value="<?php echo $donnees['id_province']?>"
                                                         document.recuperation1.ville.value="<?php echo $donnees['ville']?>"'>
                                                         <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" onclick='document.location.href="#Visualiser"
                                                           document.recuperation2.id_etablissement.value="<?php echo $donnees['id_etablissement']?>"'>
                                                           <i class="fa fa-trash"></i>
                                                        </a>
                                                    <?php
                                                      }
                                                     ?>
                                                  </td>
                                              </tr>
                                            <?php } } ?>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                  <th>N°</th>
                                                  <th>NOM</th>
                                                  <th>TYPE</th>
                                                  <th>CATEGORIE</th>
                                                  <th>RESPONSABLE</th>
                                                  <th>CONTACT</th>
                                                  <th>ACTIONS</th>
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

                    <input type="hidden" name="id_etablissement" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION DE L'ETABLISSEMENT</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement l'établissement</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer cet etablissement?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification des informations de l'<b>établissement</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_etablissement" class="form-control">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>NOM</label>
                                <input type="text" name="nom_etablissement" class="form-control" required="required"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>TYPE</label>
                                <select class="form-control m-b" name="type_etablissement" required="required">
                                    <option value="Publics">Publics</option>
                                    <option value="Privés Catholiques">Privés Catholiques</option>
                                    <option value="Evangéliques">Evangéliques</option>
                                    <option value="Alliance Chrétienne">Alliance Chrétienne</option>
                                    <option value="Islamique">Islamique</option>
                                    <option value="Privés reconnus utilité public">Privés reconnus d'utilité public</option>
                                    <option value="Laïc">Laïc</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>CATEGORIE</label>
                                <select class="form-control m-b" name="categorie_etablissement" required="required">
                                    <option value="PRE-PRIMAIRE">PRE-PRIMAIRE</option>
                                    <option value="PRIMAIRE">PRIMAIRE</option>
                                    <option value="SECONDAIRE GENERAL">SECONDAIRE GENERAL</option>
                                    <option value="SECONDAIRE TECHNIQUE">SECONDAIRE TECHNIQUE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>DATE DE CREATION</label>
                                <input type="text" name="dte_creation" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>RESPONSABLE</label>
                                <input type="text" name="responsable" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>TEL. RESPONSABLE</label>
                                <input type="number" name="num_responsable" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>CIRCONSCRIPTION ADMINISTRATIVE</label>
                                <select class="form-control m-b" name="id_circonscription" required="required">
                                    <option>--Selectionner la circonscription--</option>
                                    <?php
                                        $arsene=$conn->query('SELECT * FROM circonscription ORDER BY nom_circonscription ASC');
                                        while ($ap =$arsene->fetch())
                                            {
                                                echo "<option value='".$ap["id_circonscription"]."'> ".$ap["nom_circonscription"]." </option>";
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>PROVINCE</label>
                                <select class="form-control m-b" name="id_province" required="required">
                                    <option>--Selectionner la province--</option>
                                    <?php
                                        $arsene=$conn->query('SELECT * FROM province ORDER BY nom_province ASC');
                                        while ($ap =$arsene->fetch())
                                            {
                                                echo "<option value='".$ap["id_province"]."'> ".$ap["nom_province"]." </option>";
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>VILLE</label>
                                <input type="text" name="ville" class="form-control" required="required"/>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>LATITUDE</label>
                                <input type="text" name="lat_etablissement" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>LONGITUDE</label>
                                <input type="text" name="long_etablissement" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier cet etablissement?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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