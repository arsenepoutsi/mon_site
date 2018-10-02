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
                    Liste des établissements pour la Province : 
                            <b>
                            <?php 
                                $code=$_GET['dept'];
                                echo $code; 
                                ?>
                                    <a href="Impressions/page.php?code=<?php echo $code;?>" class="pull-right" target="_bank" data-toggle="tooltip" data-placement="top" title="Imprimer la liste des établissements">
                                        <button class="btn btn-primary dim btn-large-dim pull-right" type="button"><i class="fa fa-print"></i></button>
                                    </a>

                                    <a href="Impressions/page3.php?code=<?php echo $code;?>" class="pull-right" target="_bank" data-toggle="tooltip" data-placement="top" title="Imprimer la liste des responsables établissements">
                                        <button class="btn btn-warning dim btn-large-dim pull-right" type="button"><i class="fa fa-print"></i></button>
                                    </a>

                                    <a href="cartograpie_province.php?code=<?php echo $code;?>" class="pull-right" target="_bank" data-toggle="tooltip" data-placement="top" title="Cartographie des établissements pour la province">
                                        <button class="btn btn-success dim btn-large-dim pull-right" type="button"><i class="fa fa-map-marker"></i></button>
                                    </a>
                                <?php       
                            ?>
                            </b>
                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            <?php 
                                $code=$_GET['dept'];
                                echo $code;       
                            ?>
                        </strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
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
                                          <th>TELEPHONE</th>
                                          <th>CIRCONSCRIPTION</th>
                                          <th>VILLE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                            $i=1;
                                            $code=$_GET['dept'];
                                            if (isset($_GET["dept"]))
                                            {
                                            $req = $conn ->query("SELECT * FROM etablissement e, circonscription c, province p WHERE e.id_circonscription=c.id_circonscription AND e.id_province=p.id_province AND p.nom_province='$code' ORDER BY id_etablissement ASC");
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
                                          <td><?php echo $donnees['nom_etablissement']; ?></td>
                                          <td><?php echo $donnees['type_etablissement']; ?></td>
                                          <td><?php echo $donnees['categorie_etablissement']; ?></td>
                                          <td><?php echo $donnees['responsable']; ?></td>
                                          <td><?php echo $donnees['num_responsable']; ?></td>
                                          <td><?php echo $donnees['nom_circonscription']; ?></td>
                                          <td><?php echo $donnees['ville']; ?></td>
                                      </tr>
                                    <?php }}} ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                          <th>N°</th>
                                          <th>NOM</th>
                                          <th>TYPE</th>
                                          <th>CATEGORIE</th>
                                          <th>RESPONSABLE</th>
                                          <th>TELEPHONE</th>
                                          <th>CIRCONSCRIPTION</th>
                                          <th>VILLE</th>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
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
