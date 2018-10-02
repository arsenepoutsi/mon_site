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
                <h2>Statistiques Type des Besoins</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            <b>
                                Type de Besoin :
                                <i style="color: #ea2d0c;">
                                    <?php
                                        $type_besoin=$_GET['type_besoin'];
                                        if (isset($_GET["type_besoin"]))
                                        {
                                            $req=$conn->query("SELECT * FROM type_besoin WHERE id_type_besoin='$type_besoin'");
                                            while ($donnees =$req ->fetch())
                                            { 
                                              echo $donnees['libelle'];
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
          if(isset($_GET['rechercher12']))
            {
              if($_GET['type_besoin'])
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
                                                           $code=$_GET['type_besoin'];
                                                            if (isset($_GET["type_besoin"]))
                                                            {
                                                           $req1 = $conn ->query("SELECT DISTINCT nom_etablissement FROM type_besoin t, besoin b, etablissement e WHERE t.id_type_besoin=b.id_type_besoin AND b.id_etablissement=e.id_etablissement AND t.id_type_besoin='$code' GROUP BY nom_etablissement");
                                                           while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                       ?>
                                                    '<?php echo $donnees1['nom_etablissement']; ?>',
                                                    <?php } } ?>
                                                    ]
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                series: [{
                                                    name: 'Nombre des Types de Besoins par établissement',
                                                    color: '#0d2433',
                                                    data: [
                                                    <?php 
                                                           $code=$_GET['type_besoin'];
                                                            if (isset($_GET["type_besoin"]))
                                                            {
                                                           $req1 = $conn ->query("SELECT DISTINCT * FROM type_besoin t, besoin b, etablissement e WHERE t.id_type_besoin=b.id_type_besoin AND b.id_etablissement=e.id_etablissement AND t.id_type_besoin='$code' GROUP BY nom_etablissement");
                                                           while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                             $req=$conn->query("SELECT nom_etablissement, COUNT(id_besoin) AS nbre FROM besoin b, etablissement e WHERE b.id_etablissement=e.id_etablissement AND b.id_type_besoin='$code' AND b.id_etablissement='".$donnees1['id_etablissement']."' GROUP BY nom_etablissement");
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
