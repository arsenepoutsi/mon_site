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
            <div class="col-sm-8">
                <h2>Statistiques des besoins par établissement</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            <b>
                                Etablissement :
                                <i style="color: #ea2d0c;">
                                    <?php
                                        $etablissement=$_GET['etablissement'];
                                        if (isset($_GET["etablissement"]))
                                        {
                                            $req=$conn->query("SELECT * FROM etablissement WHERE id_etablissement='$etablissement'");
                                            while ($donnees =$req ->fetch())
                                            { 
                                              echo $donnees['nom_etablissement'];
                                            } 
                                        } 
                                      ?>
                                </i>
                            </b>                      
                        </strong>
                    </li>
                </ol>
            </div>
        </div>
        <?php 
          if(isset($_GET['rechercher11']))
            {
              if($_GET['etablissement'])
              {
                ?>
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content" id="arsene" style="height: 700px;">
                                    <script src="js/jquery-2.1.1.js"></script>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#arsene').highcharts({
                                                chart: {
                                                    type: 'column'
                                                },
                                                title: {
                                                    text: ''
                                                },
                                                xAxis: {
                                                    categories: [
                                                     <?php
                                                           $code=$_GET['etablissement'];
                                                            if (isset($_GET["etablissement"]))
                                                            {
                                                           $req1 = $conn ->query("SELECT DISTINCT libelle FROM type_besoin t, besoin b WHERE t.id_type_besoin=b.id_type_besoin AND b.id_etablissement='$code' GROUP BY libelle");
                                                           while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                       ?>
                                                    '<?php echo $donnees1['libelle']; ?>',
                                                    <?php } } ?>
                                                    ]
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                series: [{
                                                    name: 'Nombre des Types de Besoins',
                                                    color: '#0d2433',
                                                    data: [
                                                    <?php 
                                                           $code=$_GET['etablissement'];
                                                            if (isset($_GET["etablissement"]))
                                                            {
                                                           $req1 = $conn ->query("SELECT DISTINCT * FROM type_besoin t, besoin b WHERE t.id_type_besoin=b.id_type_besoin AND b.id_etablissement='$code' GROUP BY libelle");
                                                           while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                             $req=$conn->query("SELECT libelle, COUNT(id_besoin) AS nbre FROM type_besoin t, besoin b WHERE t.id_type_besoin=b.id_type_besoin AND b.id_etablissement='$code' AND b.id_type_besoin='".$donnees1['id_type_besoin']."' GROUP BY libelle");
                                                              while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <?php echo $donnees['nbre']; ?>,
                                                    <?php } } } ?>
                                                    ]
                                                }]
                                            });
                                        });
                                </script>
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
