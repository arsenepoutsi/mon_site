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

<body class="" onload="load()">

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
                <h2>Cartographie des établissements</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php?page=home">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            <b>
                                Province :
                                <i style="color: #ea2d0c;">
                                    <?php 
                                        $code=$_GET['code'];
                                        echo $code;
                                      ?>
                                </i>
                            </b>                     
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
        <?php 
            $code=$_GET['code'];
            if (isset($_GET["code"]))
            {
                $req1 = $conn ->query("SELECT * FROM province WHERE nom_province='$code'");
                if ($req) {
                    while ($donnees1 =$req1 ->fetch()) 
                    {
                    ?>
                        <div class="wrapper wrapper-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content" id="map" style="height: 900px;">
                                            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                                            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBem82sa1M1mEhvjySADdftwoeWrtBn2zI&callback=initMap"></script>

                                            <script type="text/javascript">
                                                function initCarte() {
                                                    // création de la carte
                                                    var oMap = new google.maps.Map(document.getElementById('map'), {
                                                        'center': new google.maps.LatLng(<?php echo $donnees1['lat_province']; ?>,<?php echo $donnees1['long_province']; ?>),
                                                        'zoom': 8,
                                                        'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                                    });
                                                var infoWindow = new google.maps.InfoWindow;

                                            <?php
                                            $req = $conn ->query("SELECT * FROM etablissement e, province p WHERE e.lat_etablissement !='' AND e.long_etablissement !='' AND e.id_province=p.id_province AND p.nom_province='$code'");

                                            while ($donnees =$req ->fetch()) {
                                                $nom = $donnees['nom_etablissement'];
                                                $type = $donnees['type_etablissement'];
                                                $categorie = $donnees['categorie_etablissement'];
                                                $tel = $donnees['num_responsable'];
                                                ?>
                                                       var contentString = '<div id="content">' +
                                                                '<div id="siteNotice">' +
                                                                '</div>' +
                                                                '<p><b style="color:#ec7819;margin-left:50px;margin-right:50px;"><?php echo $nom; ?></b></p>' +
                                                                '<p><b>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $type; ?></p>' +
                                                                '<p><b>Catégorie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $categorie; ?></p>' +
                                                                '<p><b>Téléphone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $tel; ?></p>' +
                                                                '</div>' +
                                                                '</div>';
                                                        
                                                        <?php 
                                                            if($type == "Publics"){
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/red-dot.png";
                                                                <?php
                                                            }elseif($type == "Privés Catholiques"){
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/blue-dot.png";
                                                                <?php
                                                            }elseif($type == "Evangéliques"){
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
                                                                <?php
                                                            }elseif($type == "Alliance Chrétienne"){
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/orange-dot.png";
                                                                <?php
                                                            }elseif($type == "Islamique"){
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/brown-dot.png";
                                                                <?php
                                                            }else{
                                                                ?>
                                                                var icone = "http://maps.google.com/mapfiles/ms/micons/green-dot.png";
                                                                <?php
                                                            }
                                                        ?>
                                              
                                               

                                                        var myLatLng = new google.maps.LatLng(<?php echo $donnees['lat_etablissement']; ?>, <?php echo$donnees['long_etablissement']; ?>);
                                                  
                                                        var marker = new google.maps.Marker({
                                                            position: myLatLng,
                                                            map: oMap,
                                                            icon: icone,
                                                            title: ' '
                                                        });
                                                      bindInfoWindow(marker, oMap, infoWindow, contentString);
                                                
                                                        
                                            <?php } ?>
                                                }
                                               function bindInfoWindow(marker, map, infoWindow, contentString) {
                                                  google.maps.event.addListener(marker, 'click', function() {
                                                    infoWindow.setContent(contentString);
                                                    infoWindow.open(map, marker);
                                                  });
                                                }

                                                // init lorsque la page est chargée
                                                google.maps.event.addDomListener(window, 'load', initCarte);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
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
