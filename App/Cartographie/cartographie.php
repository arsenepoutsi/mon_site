<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Cartographie</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Cartographie des établissements</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
        <button type="button" class="btn btn-warning dim pull-right" data-toggle="modal" data-target="#myModal" style="margin-top: 30px;">
           <i class="fa fa-search"></i>&nbsp;&nbsp; Recherche sur la carte Map
        </button>
    </div>
</div>

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
                    $req = $conn ->query("SELECT * FROM etablissement WHERE lat_etablissement !='' AND long_etablissement !=''");

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


<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">FORMULAIRE DE RECHERCHE</h4>
                <small class="font-bold">Utilisez les trois critères pour faire votre <b style="color: #ea3d0c;">recherche</b>.</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="recherche_carte.php" method="GET">
                    
                    <div class="form-group has-warning"><label class="col-sm-4 control-label"><b>Province</b></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="province">
                                <option value="">-- Recherche province --</option>
                                <?php
                                    $arsene=$conn->query('SELECT * FROM province ORDER BY id_province ASC');
                                    while ($ap =$arsene->fetch())
                                        {
                                            echo "<option value='".$ap["nom_province"]."'> ".$ap["nom_province"]." </option>";
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-warning"><label class="col-sm-4 control-label"><b>Type d'établissemet</b></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="type_etablissement">
                                <option value="">-- Recherche type d'établissement --</option>
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
                    <div class="form-group has-warning"><label class="col-sm-4 control-label"><b>Catégorie d'établissemet</b></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="categorie_etablissement">
                                <option value="">-- Recherche catégorie d'établissement --</option>
                                <option value="PRE-PRIMAIRE">PRE-PRIMAIRE</option>
                                <option value="PRIMAIRE">PRIMAIRE</option>
                                <option value="SECONDAIRE GENERAL">SECONDAIRE GENERAL</option>
                                <option value="SECONDAIRE TECHNIQUE">SECONDAIRE TECHNIQUE</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button class="btn btn-primary" type="submit" name="rechercher"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Afficher la carte Map</button>
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