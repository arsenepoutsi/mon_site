<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>
          Rapports
        </h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php?page=home">Home</a>
            </li>
            <li class="active">
                <strong>Rapports</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                $req = $conn ->query("SELECT * FROM session GROUP BY annee_session DESC");
                                if ($req) {
                                    while ($donnees =$req ->fetch()) {    
                            ?>
                            <div class="file-box">
                                <div class="file">
                                    <a href="<?php echo "Impressions/rapport_annee.php?annee=".$donnees["annee_session"]."" ?>" target='_bank'>
                                        <span class="corner"></span>

                                        <div class="icon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <div class="file-name">
                                            Rapport_<?php echo $donnees['annee_session']; ?>.doc
                                            <br/>
                                            <small>Générer depuis SIG-ECOLE</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php } } ?>

                        </div>
                    </div>
                    </div>
                </div>
                </div>