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
                                        $province=$_GET['province'];
                                        echo $province;
                                      ?>
                                </i>
                            </b>
                            &nbsp;&nbsp;&nbsp; 
                            <b>
                                Type :
                                <i style="color: #ea2d0c;">
                                    <?php 
                                        $type_etablissement=$_GET['type_etablissement'];
                                        echo $type_etablissement;
                                      ?>
                                </i>
                            </b>
                            &nbsp;&nbsp;&nbsp; 
                            <b>
                                Catégorie :
                                <i style="color: #ea2d0c;">
                                    <?php 
                                        $categorie_etablissement=$_GET['categorie_etablissement'];
                                        echo $categorie_etablissement;
                                      ?>
                                </i>
                            </b>                      
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-danger dim pull-right" style="margin-top: 30px;">
                   <a href="index.php?page=cartographie" style="color: #fff;">
                       <i class="fa fa-map-marker"></i>&nbsp;&nbsp; Retourner sur la rubrique cartographie
                   </a>
                </button>
            </div>
        </div>
        <?php 
          if(isset($_GET['rechercher']))
            {
              if($_GET['province'] && $_GET['type_etablissement'] == NULL && $_GET['categorie_etablissement'] == NULL)
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement e, province p WHERE e.lat_etablissement !='' AND e.long_etablissement !='' AND e.id_province=p.id_province AND p.nom_province='".$_GET['province']."'");

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
              }elseif ($_GET['province'] == NULL && $_GET['type_etablissement'] && $_GET['categorie_etablissement'] == NULL) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement WHERE lat_etablissement !='' AND long_etablissement !='' AND type_etablissement='".$_GET['type_etablissement']."'");

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
              }elseif ($_GET['province'] == NULL && $_GET['type_etablissement'] == NULL && $_GET['categorie_etablissement']) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement WHERE lat_etablissement !='' AND long_etablissement !='' AND categorie_etablissement='".$_GET['categorie_etablissement']."'");

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
              }elseif ($_GET['province'] && $_GET['type_etablissement'] && $_GET['categorie_etablissement'] == NULL) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement e, province p WHERE e.lat_etablissement !='' AND e.long_etablissement !='' AND e.id_province=p.id_province AND p.nom_province='".$_GET['province']."' AND e.type_etablissement='".$_GET['type_etablissement']."'");

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
              }elseif ($_GET['province'] && $_GET['type_etablissement'] == NULL && $_GET['categorie_etablissement']) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement e, province p WHERE e.lat_etablissement !='' AND e.long_etablissement !='' AND e.id_province=p.id_province AND p.nom_province='".$_GET['province']."' AND e.categorie_etablissement='".$_GET['categorie_etablissement']."'");

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
              }elseif ($_GET['province'] == NULL && $_GET['type_etablissement'] && $_GET['categorie_etablissement']) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement WHERE lat_etablissement !='' AND long_etablissement !='' AND categorie_etablissement='".$_GET['categorie_etablissement']."' AND type_etablissement='".$_GET['type_etablissement']."'");

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
              }elseif ($_GET['province'] && $_GET['type_etablissement'] && $_GET['categorie_etablissement']) {
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
                                                'center': new google.maps.LatLng(-0.038971062077048445,9.701890868359442),
                                                'zoom': 8,
                                                'mapTypeId': google.maps.MapTypeId.G_HYBRID_MAP
                                            });
                                        var infoWindow = new google.maps.InfoWindow;

                                    <?php
                                    $req = $conn ->query("SELECT * FROM etablissement e, province p WHERE e.lat_etablissement !='' AND e.long_etablissement !='' AND e.id_province=p.id_province AND p.nom_province='".$_GET['province']."' AND e.type_etablissement='".$_GET['type_etablissement']."' AND e.categorie_etablissement='".$_GET['categorie_etablissement']."'");

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
              }else{
                header('location:index.php?page=cartographie');
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
