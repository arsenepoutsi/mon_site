<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="sidebar-collapse">
<ul class="nav metismenu" id="side-menu">
    <li class="nav-header" style="text-align: center;">
        <div class="dropdown profile-element" style="margin-top: -20px;">
            <!-- <span>
                <img alt="image" class="img-circle" src="logo.png" style="width: 100px;height: 100px;" />
            </span> -->
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="margin-top: 50px;">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                    <b>
                       <?php 
                            $req=$conn->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
                            if($req)
                            {
                                $donnees =$req ->fetch();
                                echo $donnees['login']; 
                            }
                         ?> 
                    </b>
                </strong>
                </span> <span class="text-muted text-xs block" style="margin-top: 15px;">
                    <b>
                       <?php 
                            $req=$conn->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
                            if($req)
                            {
                                $donnees =$req ->fetch();
                                echo $donnees['profil']; 
                            }
                         ?> 
                    </b>
                 <b class="caret"></b></span> </span> 
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li><a href="index.php?page=profil"><b>Profil</b></a></li>
                <li class="divider"></li>
                <li><a href="../index.php?erreur=logout"><b style="color: #ea2d0c;">Déconnexion</b></a></li>
            </ul>
        </div>
    </li>
    <li>
        <a href="index.php?page=home"><i class="fa fa-home"></i> <span class="nav-label">Tableau de Bord</span></a>
    </li>
    <?php 
        if($_SESSION['profil'] == "Administrateur")
        {
        ?>
            <li>
                <a href="index.php?page=etablissements"><i class="fa fa-university"></i> <span class="nav-label">Etablissements</span></a>
            </li>

            <li>
                <a href="index.php?page=cartographie"><i class="fa fa-map-marker"></i> <span class="nav-label">Cartographie</span></a>
            </li>

            <li>
                <a href="index.php?page=rapports"><i class="fa fa-files-o"></i> <span class="nav-label">Rapports</span></a>
            </li>

            <li>
                <a href="index.php?page=statistiques"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistiques</span></a>
            </li>

            <li>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="index.php?page=provinces">Provinces</a></li>
                    <li><a href="index.php?page=circonscriptions">Circonscriptions</a></li>
                    <li><a href="index.php?page=utilisateurs">Utilisateurs</a></li>
                </ul>
            </li>
        <?php
        }else{
        ?>
            <li>
                <a href="index.php?page=etablissements"><i class="fa fa-university"></i> <span class="nav-label">Etablissements</span></a>
            </li>

            <li>
                <a href="index.php?page=cartographie"><i class="fa fa-map-marker"></i> <span class="nav-label">Cartographie</span></a>
            </li>

            <li>
                <a href="index.php?page=rapports"><i class="fa fa-files-o"></i> <span class="nav-label">Rapports</span></a>
            </li>

            <li>
                <a href="index.php?page=statistiques"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistiques</span></a>
            </li>

            <li>
                <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Stat. Besoins</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="" data-toggle="modal" data-target="#myModal11">Etablissement</a></li>
                    <li><a href="" data-toggle="modal" data-target="#myModal12">Type de besoin</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="index.php?page=provinces">Provinces</a></li>
                    <li><a href="index.php?page=circonscriptions">Circonscriptions</a></li>
                    <li><a href="index.php?page=type_besoin">Type des besoins</a></li>
                </ul>
            </li>
        <?php  
        }
     ?>

</ul>

</div>

<!-- ========================================================= Modal 11 ============================================================= -->

<div class="modal inmodal fade" id="myModal11" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">FORMULAIRE DE RECHERCHE</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="recherche_stat_besoin11.php" method="GET">
                    
                    <div class="form-group has-warning"><label class="col-sm-4 control-label"><b>Etablissement</b></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="etablissement" required="required">
                                <option value="">-- Choisir l'établissement --</option>
                                <?php
                                    $arsene=$conn->query('SELECT * FROM etablissement ORDER BY id_etablissement ASC');
                                    while ($ap =$arsene->fetch())
                                        {
                                            echo "<option value='".$ap["id_etablissement"]."'> ".$ap["nom_etablissement"]." </option>";
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button class="btn btn-primary" type="submit" name="rechercher11"><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Afficher les statistiques</button>
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

<!-- ========================================================= Modal 12 ============================================================= -->

<div class="modal inmodal fade" id="myModal12" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">FORMULAIRE DE RECHERCHE</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="recherche_stat_besoin12.php" method="GET">
                    
                    <div class="form-group has-warning"><label class="col-sm-4 control-label"><b>Type de besoin</b></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="type_besoin" required="required">
                                <option value="">-- Choisir le type de besoin --</option>
                                <?php
                                    $arsene=$conn->query('SELECT * FROM type_besoin ORDER BY id_type_besoin ASC');
                                    while ($ap =$arsene->fetch())
                                        {
                                            echo "<option value='".$ap["id_type_besoin"]."'> ".$ap["libelle"]." </option>";
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button class="btn btn-primary" type="submit" name="rechercher12"><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Afficher les statistiques</button>
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