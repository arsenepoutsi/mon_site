<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Utilisateurs</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Utilisateurs</strong>
            </li>
        </ol>
    </div>
</div>

<br/>

<?php include("Users/function.php"); ?>
      <!--========================================ajout===================================================-->
          <?php 
              if (isset($_POST['valider'])) {
                  $nom_users=addslashes(htmlspecialchars($_POST['nom_users']));
                  $prenom_users=addslashes(htmlspecialchars($_POST['prenom_users']));
                  $profil=addslashes(htmlspecialchars($_POST['profil']));
                  $login=addslashes(htmlspecialchars($_POST['login']));
                  $pwd=md5(addslashes(htmlspecialchars($_POST['pwd'])));
                  $permission=addslashes(htmlspecialchars($_POST['permission']));

                   if (empty($login)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          ajout_users($nom_users,$prenom_users,$profil,$login,$pwd,$permission);
                          ?>
                              <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Succès!</strong> Utilisateur enregistré avec succès.
                              </div>
                          <?php
                     }
                 }
          ?>
      <!--========================================fin=========================================================-->

      <!--========================================modif===================================================-->
          <?php 
              if (isset($_POST['modifier'])) {
                  $nom_users=addslashes(htmlspecialchars($_POST['nom_users']));
                  $prenom_users=addslashes(htmlspecialchars($_POST['prenom_users']));
                  $profil=addslashes(htmlspecialchars($_POST['profil']));
                  $login=addslashes(htmlspecialchars($_POST['login']));
                  $pwd=md5(addslashes(htmlspecialchars($_POST['pwd'])));
                  $permission=addslashes(htmlspecialchars($_POST['permission']));
                  $id_users=addslashes(htmlspecialchars($_POST['id_users']));

                   if (empty($login)) {
                      ?>
                          <div class="alert alert-danger" role="alert">
                            <i class="fa fa-times-circle"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Erreur!</strong> Veuillez renseigner tous les champs obligatoires du formulaire.
                        </div>
                      <?php
                   }else{
                          modifier_users($id_users,$nom_users,$prenom_users,$profil,$login,$pwd,$permission);
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
                  $id_users=addslashes(htmlspecialchars($_POST['id_users']));

                   if (empty($id_users)) {
                      ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Tous les champs avec <b>(*)</b> sont obligatoires. <a class="alert-link" href="#">Alerte !!!</a>.
                            </div>
                      <?php
                   }else{
                          supprimer_users($id_users);
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
                    <li class=""><a data-toggle="tab" href="#tab-3"> <b><i class="fa fa-user-plus payment-icon-big text-success"></i></b></a></li>
                    <li class="active"><a data-toggle="tab" href="#tab-4"><b><i class="fa fa-table payment-icon-big text-warning"></i></b></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body" style="margin-top: 15px;">
                            <div class="alert alert-warning">
                                <ul class="margin-bottom-none padding-left-lg">
                                    <li>Tous les champs du forulaire sont à remplir obligatoirement.</li>
                                    <li>Votre login ou identifiant doit avoir au plus 10 caractères <b>(Nb : juste les lettres et les chiffres)</b>.</li>
                                    <li>Une fois tous les champs renseignés veuillez cliquez sur valider pour créer le nouveau <b>utilisateur</b>.</li>
                                </ul>
                            </div>
                            <div class="row">
                              <div class="col-lg-2"></div>
                              <div class="col-lg-8">
                                <form role="form" method="POST" action="">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>NOMS</label>
                                                <input type="text" name="nom_users" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>PRENOMS</label>
                                                <input type="text" name="prenom_users" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>PROFIL</label>
                                                <select class="form-control m-b" name="profil" required="required">
                                                    <option value="Administrateur">Administrateur</option>
                                                    <option value="Statisticien">Statisticien</option>
                                                    <option value="Décideur">Décideur</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group has-success">
                                                <label>LOGIN</label>
                                                <input type="text" name="login" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 pull-right">
                                            <div class="form-group has-success">
                                                <label>MOT DE PASSE</label>
                                                <input type="password" name="pwd" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group has-warning">
                                                <label>PERMISSION</label>
                                                <select class="form-control m-b" name="permission" required="required">
                                                    <option value="1">Modification</option>
                                                    <option value="3">Suppression</option>
                                                    <option value="2">Modification + Suppression</option>
                                                    <option value="4">Lecture seule</option>
                                                    <option value="5">Lecture-écriture</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous enregistrer cet utilisateur?')" name="valider"><i class="fa fa-save"></i>&nbsp;&nbsp;Valider</button>
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
                                    <li><b>LISTE DES UTILISATEURS</b>.</li>
                                    <li>Veuillez cliquez sur les boutons à gauche du tableau pour <b>Supprimer, modifier, activer et bloquer l'utilisateur.</b>.</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Liste des utilisateurs de l'application</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                              <tr>
                                                  <th>NOMS</th>
                                                  <th>PRENOMS</th>
                                                  <th>PROFIL</th>
                                                  <th>LOGIN</th>
                                                  <th>PERMISSION</th>
                                                  <th>ACTIONS</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                  $req = $conn ->query("SELECT * FROM users ORDER BY id_users DESC");
                                                  if ($req) {
                                                      while ($donnees =$req ->fetch()) {    
                                              ?>
                                              <tr class="gradeX">
                                                  <td><b><?php echo $donnees['nom_users']; ?></b></td>
                                                  <td><b><?php echo $donnees['prenom_users']; ?></b></td>
                                                  <td style="color: #ea2d0c;"><?php echo $donnees['profil']; ?></td>
                                                  <td class="center"><b><?php echo $donnees['login']; ?></b></td>
                                                  <td class="center">
                                                    <?php
                                                      if($donnees['permission']==1)
                                                        {
                                                        echo '<b style="color:#9e0606;font-size:15px;">Modification</b>';
                                                        }
                                                      elseif($donnees['permission']==2){
                                                          echo '<b style="color:#9e0606;font-size:15px;">Modification + Suppression</b>';
                                                        }
                                                      elseif($donnees['permission']==3){
                                                          echo '<b style="color:#9e0606;font-size:15px;">Suppression</b>';
                                                        }
                                                      elseif($donnees['permission']==4){
                                                          echo '<b style="color:#9e0606;font-size:15px;">Lecture seule</b>';
                                                        }
                                                      else
                                                        {
                                                         echo '<b style="color:#9e0606;font-size:15px;">Lecture-Ecriture</b>';
                                                        }     
                                                    ?>
                                                  </td>
                                                  <td class="center" style="text-align: center;">
                                                    <a onclick="return confirm('Voulez-vous changer le statut de cet utilisateur?')" href="etat_users.php?code=<?php echo $donnees['id_users'];?>&&etat=<?php echo $donnees['etat_users'];?>">
                                                      <?php
                                                              if($donnees['etat_users']==0)
                                                          {
                                                          echo '<button class="btn btn-warning"><i class="fa fa-times"></i>&nbsp;&nbsp;Bloqué</button>';
                                                          }
                                                          else
                                                          {
                                                           echo '<button class="btn btn-success"><i class="fa fa-unlock"></i>&nbsp;&nbsp;Actif</button>';
                                                          }     
                                                     ?>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" onclick='document.location.href="#Visualiser"
                                                     document.recuperation1.id_users.value="<?php echo $donnees['id_users']?>"
                                                     document.recuperation1.nom_users.value="<?php echo $donnees['nom_users']?>"
                                                     document.recuperation1.prenom_users.value="<?php echo $donnees['prenom_users']?>"
                                                     document.recuperation1.profil.value="<?php echo $donnees['profil']?>"
                                                     document.recuperation1.login.value="<?php echo $donnees['login']?>"
                                                     document.recuperation1.permission.value="<?php echo $donnees['permission']?>"'>
                                                     <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" onclick='document.location.href="#Visualiser"
                                                       document.recuperation2.id_users.value="<?php echo $donnees['id_users']?>"'>
                                                       <i class="fa fa-trash"></i>
                                                    </a>
                                                  </td>
                                              </tr>
                                            <?php } } ?>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                  <th>NOMS</th>
                                                  <th>PRENOMS</th>
                                                  <th>PROFIL</th>
                                                  <th>LOGIN</th>
                                                  <th>PERMISSION</th>
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

                    <input type="hidden" name="id_users" class="form-control">
                    <div class="alert alert-warning">
                        <ul class="margin-bottom-none padding-left-lg">
                            <li><b>SUPPRESSION DE L'UTILISATEUR</b>.</li>
                            <li>SVP cliquez sur le bouton supprimer pour <b>éffacer définitivement l'utilisateur</b>.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous réellement supprimer cet utilisateur?')" name="supprimer"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</button>
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
                <small class="font-bold">Formulaire de modification des informations de l'<b>utilisateur</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST" name="recuperation1">

                    <input type="hidden" name="id_users" class="form-control">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>NOMS</label>
                                <input type="text" name="nom_users" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>PRENOMS</label>
                                <input type="text" name="prenom_users" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>PROFIL</label>
                                <select class="form-control m-b" name="profil" required="required">
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="Statisticien">Statisticien</option>
                                    <option value="Décideur">Décideur</option>ion>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group has-success">
                                <label>LOGIN</label>
                                <input type="text" name="login" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group has-success">
                                <label>MOT DE PASSE</label>
                                <input type="password" name="pwd" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group has-warning">
                                <label>PERMISSION</label>
                                <select class="form-control m-b" name="permission" required="required">
                                    <option value="1">Modification</option>
                                    <option value="3">Suppression</option>
                                    <option value="2">Modification + Suppression</option>
                                    <option value="4">Lecture seule</option>
                                    <option value="5">Lecture-écriture</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Voulez-vous réellement modifier cet utilisateur?')" name="modifier"><i class="fa fa-save"></i>&nbsp;&nbsp;Modifier</button>
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