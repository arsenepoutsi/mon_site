<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Total</span>
                    <h5>Total des établissements</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <?php 
                          $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement");
                            if ($req) {
                                while ($donnees =$req ->fetch())
                                {
                                  echo $donnees['nbre'];
                                }
                              }
                        ?>
                    </h1>
                    <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i></div>
                    <small></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Total</span>
                    <h5>Total des établissements publics</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <?php 
                          $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics'");
                            if ($req) {
                                while ($donnees =$req ->fetch())
                                {
                                  echo $donnees['nbre'];
                                }
                              }
                        ?>
                    </h1>
                    <div class="stat-percent font-bold text-info"><i class="fa fa-level-up"></i></div>
                    <small></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Total</span>
                    <h5>Total des enseignants</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <?php 
                          $dte=date("Y");
                          $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s WHERE e.id_session=s.id_session AND s.annee_session='$dte'");
                            if ($req) {
                                while ($donnees =$req ->fetch())
                                {
                                  echo $donnees['nbre'];
                                }
                              }
                        ?>
                    </h1>
                    <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i></div>
                    <small></small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Total</span>
                    <h5>Total des élèves</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <?php 
                          $dte=date("Y");
                          $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s WHERE e.id_session=s.id_session AND s.annee_session='$dte'");
                            if ($req) {
                                while ($donnees =$req ->fetch())
                                {
                                  echo $donnees['nbre'];
                                }
                              }
                        ?>
                    </h1>
                    <div class="stat-percent font-bold text-danger"><i class="fa fa-level-down"></i></div>
                    <small></small>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><b>Recherche sur la carte interactive</b></h5>
                    </div>
                    <div class="ibox-content">
                       <div style="height: 550px;">
                            <table id="TableContentBottom" cellspacing="0" cellpadding="0" style="width:400px;margin:auto">
                                <tr style="background-color:#fff">
                                    <td>
                                        <div  style="margin:auto" class="Map MapContainer">
                                            <div style="background-image:url(public/img/transparent.gif);margin:auto" class="Map" id="area_image">
                                                <img src="public/img/transparent.gif" alt="" usemap="#france_map" style="border:0px;margin:auto">   
                                            </div>  
                                        </div>

                                    </td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Liste des établissements</h5>
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