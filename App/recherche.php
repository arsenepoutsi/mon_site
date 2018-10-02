<?php 
    @ob_start();
    session_start(); // On relaye la session
    if (isset($_SESSION['login']) && isset($_SESSION['profil']) && isset($_SESSION['pwd'])) {
     }
    else {
        header("Location:../../index.php?erreur=intru"); // redirection en cas d'echec
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
            <div class="col-sm-4">
                <h2>
                  <b>
                  Recherche 
                  <?php 
                    $code1=$_GET['nom_essence'];
                    if (isset($_GET["nom_essence"]))
                    {
                    $req = $conn ->query("SELECT * FROM essence WHERE nom_essence='$code1'");
                      if ($req) {
                          $donnees =$req ->fetch();
                          echo $donnees['nom_essence'];
                        }
                    }
                  ?>
                  pour la date du 
                  <?php 
                    $code2=$_GET['dte'];
                    if (isset($_GET["dte"]))
                    {
                    $req = $conn ->query("SELECT * FROM essence WHERE dte='$code2'");
                      if ($req) {
                          $donnees =$req ->fetch();
                          echo $donnees['dte'];
                        }
                    }
                  ?>
                  </b>
                </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>Table de stock</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-5">
            </div>
            <div class="col-sm-3">
                <div class="title-action">
                    <a href="index.php?page=table_stock" class="btn btn-danger"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<b>Formulaire de recherche</b></a>
                </div>
            </div>
        </div>

        <br/>

<?php 
  if(isset($_GET['recherche']))
    {
      if($_GET['dte'] && $_GET['nom_essence'])
      {
        ?>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>
                              Table de stock 
                              <?php 
                                $code1=$_GET['nom_essence'];
                                if (isset($_GET["nom_essence"]))
                                {
                                $req = $conn ->query("SELECT * FROM essence WHERE nom_essence='$code1'");
                                  if ($req) {
                                      $donnees =$req ->fetch();
                                      echo $donnees['nom_essence'];
                                    }
                                }
                              ?>
                              pour la date du 
                              <?php 
                                $code2=$_GET['dte'];
                                if (isset($_GET["dte"]))
                                {
                                $req = $conn ->query("SELECT * FROM essence WHERE dte='$code2'");
                                  if ($req) {
                                      $donnees =$req ->fetch();
                                      echo $donnees['dte'];
                                    }
                                }
                              ?>
                            </h5>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date d'enregistrement</th>
                                    <th>Essence</th>
                                    <th>Nombre</th>
                                    <th>Diamètre</th>
                                    <th>Volume</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    $code1=$_GET['nom_essence'];
                                    $code2=$_GET['dte'];
                                    if (isset($_GET["nom_essence"]) && isset($_GET["dte"]))
                                    {
                                    $req = $conn ->query("SELECT * FROM essence e, cubage c WHERE e.nom_essence=c.nom AND e.nom_essence='$code1' AND e.dte='$code2' ORDER BY id_essence DESC");
                                    if ($req) {
                                        while ($donnees =$req ->fetch()) {    
                                ?>
                                <tr class="gradeX">
                                    <td>
                                      <?php
                                        echo $i;
                                        $i++; 
                                      ?>
                                    </td>
                                    <td><b style="color: #ec8606;"><?php echo $donnees['dte']; ?></b></td>
                                    <td><?php echo $donnees['nom_essence']; ?></td>
                                    <td><?php echo $donnees['nbre']; ?></td>
                                    <td><?php echo $donnees['diametre']; ?></td>
                                    <td style="text-align: right;">
                                      <b style="color: #ea2d0c;">
                                        <?php echo $donnees['volume']; ?>&nbsp;&nbsp;CM³
                                      </b>
                                    </td>
                                </tr>
                                <?php }}} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th>Date d'enregistrement</th>
                                    <th>Essence</th>
                                    <th>Nombre</th>
                                    <th>Diamètre</th>
                                    <th>Volume</th>
                                </tr>
                                </tfoot>
                            </table>

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Total de nombre d'essence:</strong></td>
                                    <td>
                                      <b>
                                          <?php 
                                            $code1=$_GET['nom_essence'];
                                            $code2=$_GET['dte'];
                                            if (isset($_GET["nom_essence"]) && isset($_GET["dte"]))
                                            {
                                            $req = $conn ->query("SELECT SUM(nbre) AS nbre FROM essence WHERE nom_essence='$code1' AND dte='$code2' ");
                                              if ($req) {
                                                  while ($donnees =$req ->fetch())
                                                  {
                                                    echo $donnees['nbre'];
                                                  }
                                                }
                                            }
                                          ?>
                                      </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL VOLUME :</strong></td>
                                    <td>
                                      <b style="color: #ea2d0c;">
                                          <?php 
                                            $code1=$_GET['nom_essence'];
                                            $code2=$_GET['dte'];
                                            if (isset($_GET["nom_essence"]) && isset($_GET["dte"]))
                                            {
                                            $req = $conn ->query("SELECT SUM(volume) AS somme FROM essence WHERE nom_essence='$code1' AND dte='$code2' ");
                                              if ($req) {
                                                  while ($donnees =$req ->fetch())
                                                  {
                                                    echo $donnees['somme'];
                                                  }
                                                }
                                            }
                                          ?>&nbsp;&nbsp;CM³
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
        <?php
      }else{
        
      }
    }
?>   

        <?php include("footer.php"); ?>

        </div>
        </div>

    <!-- Mainly scripts -->
    <?php include("script.php"); ?>


</body>

</html>
