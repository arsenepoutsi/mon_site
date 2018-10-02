<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Statistiques</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Statistiques</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Pourcentage des établissements par type
                    </h5>
                </div>
                <div class="ibox-content">
                    <script src="js/jquery-2.1.1.js"></script>
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene1').highcharts({
                                    chart: {
                                        type: 'pie',
                                        options3d: {
                                            enabled: true,
                                            alpha: 45,
                                            beta: 0
                                        }
                                    },
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 35,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            }
                                        }
                                    },
                                    series: [{
                                        type: 'pie',
                                        name: 'pourcentage',
                                        data: [
                                          <?php 
                                               /*$date=date("Y");*/
                                               $req1 = $conn ->query("SELECT DISTINCT type_etablissement FROM etablissement");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                    $reque=$conn->query("SELECT COUNT(*) AS id_etablissement FROM etablissement WHERE type_etablissement='".$donnees1['type_etablissement']."' GROUP BY type_etablissement");
                                                    while ($donnees =$reque ->fetch()) {
                                           ?>
                                            { name: '<?php echo $donnees1['type_etablissement']; ?>', y: <?php echo $donnees['id_etablissement']; ?> },
                                            <?php }} ?>
                                        ]
                                    }]
                                });
                            });
                    </script>
                    <div id="arsene1" style="height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Pourcentage des établissements par catégorie
                    </h5>
                </div>
                <div class="ibox-content">
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene2').highcharts({
                                    chart: {
                                        type: 'pie',
                                        options3d: {
                                            enabled: true,
                                            alpha: 45,
                                            beta: 0
                                        }
                                    },
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 35,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            }
                                        }
                                    },
                                    series: [{
                                        type: 'pie',
                                        name: 'pourcentage',
                                        data: [
                                          <?php 
                                               /*$date=date("Y");*/
                                               $req1 = $conn ->query("SELECT DISTINCT categorie_etablissement FROM etablissement");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                    $reque=$conn->query("SELECT COUNT(*) AS id_etablissement FROM etablissement WHERE categorie_etablissement='".$donnees1['categorie_etablissement']."' GROUP BY categorie_etablissement");
                                                    while ($donnees =$reque ->fetch()) {
                                           ?>
                                            { name: '<?php echo $donnees1['categorie_etablissement']; ?>', y: <?php echo $donnees['id_etablissement']; ?> },
                                            <?php }} ?>
                                        ]
                                    }]
                                });
                            });
                    </script>
                    <div id="arsene2" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Nombre des enseignants Nationaux et Expatriés par année
                    </h5>
                </div>
                <div class="ibox-content">
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene3').highcharts({
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    xAxis: {
                                        categories: [
                                         <?php 
                                               $req1 = $conn ->query("SELECT DISTINCT annee_session FROM session");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                           ?>
                                        '<?php echo $donnees1['annee_session']; ?>',
                                        <?php } ?>
                                        ]
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Total d\'enseignants nationaux',
                                        color: '#1caf9a',
                                        data: [
                                        <?php 
                                               $date=date("Y");
                                               $req1 = $conn ->query("SELECT DISTINCT annee_session FROM session");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                 $req=$conn->query("SELECT SUM(total) AS nbre1 FROM enseignant e, session s WHERE e.id_session=s.id_session AND e.type_enseignant='Nationaux' AND s.annee_session='".$donnees1['annee_session']."' GROUP BY annee_session");
                                                  while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <?php echo $donnees['nbre1']; ?>,
                                        <?php } } ?>
                                        ]
                                    }, {
                                        name: 'Total d\'enseignants expatriés',
                                        color: '#ab393e',
                                        data: [
                                         <?php 
                                               $date=date("Y");
                                               $req1 = $conn ->query("SELECT DISTINCT annee_session FROM session");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                 $req=$conn->query("SELECT SUM(total) AS nbre2 FROM enseignant e, session s WHERE e.id_session=s.id_session AND e.type_enseignant='Expatries' AND s.annee_session='".$donnees1['annee_session']."' GROUP BY annee_session");
                                                  while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <?php echo $donnees['nbre2']; ?>,
                                        <?php } } ?>
                                        ]
                                    }]
                                });
                            });
                      </script>
                    <div id="arsene3" style="height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Nombre des établissements par circonscription
                    </h5>
                </div>
                <div class="ibox-content">
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene4').highcharts({
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    xAxis: {
                                        categories: [
                                         <?php
                                               $req1 = $conn ->query("SELECT DISTINCT nom_circonscription FROM circonscription");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                           ?>
                                        '<?php echo $donnees1['nom_circonscription']; ?>',
                                        <?php } ?>
                                        ]
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Total d\'établissements',
                                        color: '#563d7c',
                                        data: [
                                        <?php 
                                               $req1 = $conn ->query("SELECT DISTINCT nom_circonscription FROM circonscription");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                 $req=$conn->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement e, circonscription c WHERE e.id_circonscription=c.id_circonscription AND c.nom_circonscription='".$donnees1['nom_circonscription']."' GROUP BY nom_circonscription");
                                                  while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <?php echo $donnees['nbre']; ?>,
                                        <?php } } ?>
                                        ]
                                    }]
                                });
                            });
                    </script>
                    <div id="arsene4" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Nombre des établissements par catégorie
                    </h5>
                </div>
                <div class="ibox-content">
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene5').highcharts({
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    xAxis: {
                                        categories: [
                                         <?php
                                               $req1 = $conn ->query("SELECT DISTINCT categorie_etablissement FROM etablissement");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                           ?>
                                        '<?php echo $donnees1['categorie_etablissement']; ?>',
                                        <?php } ?>
                                        ]
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Total d\'établissements',
                                        color: '#779ab3',
                                        data: [
                                        <?php 
                                               $req1 = $conn ->query("SELECT DISTINCT categorie_etablissement FROM etablissement");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                 $req=$conn->query("SELECT COUNT(id_etablissement) AS nbre3 FROM etablissement e WHERE categorie_etablissement='".$donnees1['categorie_etablissement']."' GROUP BY categorie_etablissement");
                                                  while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <?php echo $donnees['nbre3']; ?>,
                                        <?php } } ?>
                                        ]
                                    }]
                                });
                            });
                    </script>
                    <div id="arsene5" style="height: 400px;"></div>>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Nombre des élèves par année
                    </h5>
                </div>
                <div class="ibox-content">
                    <script type="text/javascript">
                            $(function () {
                                $('#arsene6').highcharts({
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    xAxis: {
                                        categories: [
                                         <?php
                                               $req1 = $conn ->query("SELECT DISTINCT annee_session FROM session");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                           ?>
                                        '<?php echo $donnees1['annee_session']; ?>',
                                        <?php } ?>
                                        ]
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Total des élèves',
                                        color: '#b3a177',
                                        data: [
                                        <?php 
                                               $req1 = $conn ->query("SELECT DISTINCT annee_session FROM session");
                                               while($donnees1 = $req1 ->fetch(PDO::FETCH_ASSOC)){
                                                 $req=$conn->query("SELECT SUM(effectif) AS nbre4 FROM eleve e, session s WHERE e.id_session=s.id_session AND s.annee_session='".$donnees1['annee_session']."' GROUP BY annee_session");
                                                  while($donnees = $req ->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <?php echo $donnees['nbre4']; ?>,
                                        <?php } } ?>
                                        ]
                                    }]
                                });
                            });
                    </script>
                    <div id="arsene6" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>