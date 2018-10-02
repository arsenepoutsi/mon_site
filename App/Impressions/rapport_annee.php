<?php
/*
 *Générer un PDF à partir d'une base de données
*/
  require('../connexion_db.php');
  ob_start();
  ?>

  <page backtop="2%" backbottom="2%" width="100%" orientation="landscape" format="A4" >

      <!-- <P>       
            <img src="logo.jpg" style="float:left;margin-left:10px;margin-top:25px;width:100px;height:100px">

            <h1>
                <b style="margin-top:15px;font-size:50px;color:black;font-family:Arial;float:left;margin-left:100px">MEFPPPI</b>
                 <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:30px">Ministère de l'Economie, des Finances,</b>
                <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:60px">du Plan, du Portefeuille Public</b>
                <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:120px">et de l'Intégration</b>

            </h1>
      </P> -->
            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #fff;">
                  <td style="width: 100%;text-align: center;">
                      <img src="logo.jpg" style="width:150px;height:100px">
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #fff;">
                  <td style="width: 100%;text-align: center;font-size: 15px;">Ministère de l'Education Nationale</td>
                </tr>
                <tr style="text-align: center;color: while;border:0px solid #fff;">
                  <td style="width: 100%;text-align: center;font-size: 15px;">Union-Travail-Justice</td>
                </tr>
              </tbody>
            </table>

            <br/><br/><br/>

            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #efefef;">
                  <td style="width: 100%;text-align: center;font-size: 23px;">
                    <b>
                      CAPACITE D'ACCUEIL (
                      ANNEE : <?php 
                          $code=$_GET['annee'];
                          echo $code;
                        ?>
                      )
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <!-- ======================================================= ESTUAIRE ================================================== -->
            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : ESTUAIRE
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='ESTUAIRE' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ HAUT-OGOOUE ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : HAUT-OGOOUE
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='HAUT-OGOOUE' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ MOYEN-OGOOUE ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : MOYEN-OGOOUE
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='MOYEN-OGOOUE' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ NGOUNIE ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : NGOUNIE
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='NGOUNIE' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ NYANGA ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : NYANGA
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='NYANGA' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ OGOOUE-IVINDO ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : OGOOUE-IVINDO
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='OGOOUE-IVINDO' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ OGOOUE-LOLO ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : OGOOUE-LOLO
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='OGOOUE-LOLO' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ OGOOUE-MARITIME ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : OGOOUE-MARITIME
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='OGOOUE-MARITIME' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/><br/><br/>

          <!-- ============================================================ WOLEU-NTEM ======================================= -->

          <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                    <b>
                      PROVINCE : WOLEU-NTEM
                        
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 90px;"><b>&nbsp;N°</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;Etablissement</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Places disponibles</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Effectifs</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Admis</b></td>
                  <td style="height: 30px;width: 150px;"><b>&nbsp;Redoublants</b></td>
                </tr>
                <?php
                  $i=1;
                  $code=$_GET['annee'];
                    $req1 = $conn ->query("SELECT * FROM etablissement ORDER BY nom_etablissement ASC");
                    while ($donnees1 =$req1 ->fetch()) {  
                      $req2 = $conn ->query("SELECT * FROM etablissement e, province p, session s, eleve el WHERE e.id_province=p.id_province AND e.id_etablissement=s.id_etablissement AND el.id_session=s.id_session AND el.id_etablissement=e.id_etablissement AND p.nom_province='WOLEU-NTEM' AND s.annee_session='$code' AND e.nom_etablissement='".$donnees1['nom_etablissement']."' GROUP BY nom_etablissement");
                        if ($req2) {
                        while ($donnees2 =$req2 ->fetch()) {  
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;
                    <?php
                        echo $i;
                        $i++;
                    ?>
                  </td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['nom_etablissement']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees2['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>



           <!-- ============================================== Nbre d'établissement ============================================== -->

           <br/><br/><br/><br/>

            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #efefef;">
                  <td style="width: 100%;text-align: center;font-size: 23px;">
                    <b>
                      NOMBRE D'ETABLISSEMENT
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 170px;"><b>&nbsp;Ordre d'enseignement</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Publics</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés Catholiques</b></td>
                  <td style="height: 30px;width: 130px;"><b>&nbsp;Evangéliques</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Alliance Chrétienne</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Islamique</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés reconnus d'utilité public</b></td>
                  <td style="height: 30px;width: 50px;"><b>&nbsp;Laïc</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Total d'étab.</b></td>
                </tr>
                
                <tr>
                  <th scope="row">&nbsp;Pré-primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés Catholiques' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Evangéliques' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Alliance Chrétienne' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Islamique' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés reconnus utilité public' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Laïc' AND categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE categorie_etablissement='PRE-PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés Catholiques' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Evangéliques' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Alliance Chrétienne' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Islamique' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés reconnus utilité public' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Laïc' AND categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE categorie_etablissement='PRIMAIRE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés Catholiques' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Evangéliques' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Alliance Chrétienne' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Islamique' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés reconnus utilité public' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Laïc' AND categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE categorie_etablissement='SECONDAIRE GENERAL'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Tehnique</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés Catholiques' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Evangéliques' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Alliance Chrétienne' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Islamique' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés reconnus utilité public' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Laïc' AND categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE categorie_etablissement='SECONDAIRE TECHNIQUE'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Total Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Publics'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés Catholiques'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Evangéliques'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Alliance Chrétienne'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Islamique'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Privés reconnus utilité public'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement WHERE type_etablissement='Laïc'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;background: #f7f7f7;">
                    <b>
                      <?php 
                        $req = $conn ->query("SELECT COUNT(id_etablissement) AS nbre FROM etablissement");
                          if ($req) {
                              while ($donnees =$req ->fetch())
                              {
                                echo $donnees['nbre'];
                              }
                            }
                      ?>
                    </b>
                  </td>
                </tr>
                
              </tbody>
            </table>

            <!-- ============================================== Nbre des enseignants ============================================== -->

           <br/><br/><br/><br/>

            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #efefef;">
                  <td style="width: 100%;text-align: center;font-size: 23px;">
                    <b>
                      NOMBRE DES ENSEIGNANTS
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 170px;"><b>&nbsp;Ordre d'enseignement</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Publics</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés Catholiques</b></td>
                  <td style="height: 30px;width: 130px;"><b>&nbsp;Evangéliques</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Alliance Chrétienne</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Islamique</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés reconnus d'utilité public</b></td>
                  <td style="height: 30px;width: 50px;"><b>&nbsp;Laïc</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Total d'ens.</b></td>
                </tr>
                
                <tr>
                  <th scope="row">&nbsp;Pré-primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Tehnique</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Total Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;background: #f7f7f7;">
                    <b>
                      <?php 
                        $code=$_GET['annee'];
                        if (isset($_GET["annee"]))
                        {
                        $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND s.annee_session='$code'");
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
                
              </tbody>
            </table>


            <!-- ============================================== Nbre des élèves ============================================== -->

           <br/><br/><br/><br/>

            <table table border="0" align="center" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="text-align: center;color: while;border:0px solid #efefef;">
                  <td style="width: 100%;text-align: center;font-size: 23px;">
                    <b>
                      NOMBRE DES ELEVES
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 170px;"><b>&nbsp;Ordre d'enseignement</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Publics</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés Catholiques</b></td>
                  <td style="height: 30px;width: 130px;"><b>&nbsp;Evangéliques</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Alliance Chrétienne</b></td>
                  <td style="height: 30px;width: 80px;"><b>&nbsp;Islamique</b></td>
                  <td style="height: 30px;width: 140px;"><b>&nbsp;Privés reconnus d'utilité public</b></td>
                  <td style="height: 30px;width: 50px;"><b>&nbsp;Laïc</b></td>
                  <td style="height: 30px;width: 100px;"><b>&nbsp;Total d'ele.</b></td>
                </tr>
                
                <tr>
                  <th scope="row">&nbsp;Pré-primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='PRE-PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Primaire</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='PRIMAIRE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='SECONDAIRE GENERAL' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Secondaire Tehnique</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.categorie_etablissement='SECONDAIRE TECHNIQUE' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">&nbsp;Total Général</th>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Publics' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés Catholiques' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Evangéliques' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Alliance Chrétienne' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Islamique' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Privés reconnus utilité public' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;">
                    <?php 
                      $code=$_GET['annee'];
                      if (isset($_GET["annee"]))
                      {
                      $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND t.type_etablissement='Laïc' AND s.annee_session='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nbre'];
                            }
                          }
                        }
                    ?>
                  </td>
                  <td style="height: 20px;text-align: center;background: #f7f7f7;">
                    <b>
                      <?php 
                        $code=$_GET['annee'];
                        if (isset($_GET["annee"]))
                        {
                        $req = $conn ->query("SELECT SUM(effectif) AS nbre FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND e.id_etablissement=t.id_etablissement AND s.annee_session='$code'");
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
                
              </tbody>
            </table>

            <page_footer>
              [[page_cu]]/[[page_nb]]
            </page_footer>
      
  </page>


<?php
   $content = ob_get_clean();
   require('html2pdf.class.php');

   $pdf=new HTML2PDF('P','A4','fr','true','UTF-8');
   $pdf->writeHTML($content); 
   $pdf->pdf->includeJS('print(true)');
   $pdf->output('liste.pdf');
?>