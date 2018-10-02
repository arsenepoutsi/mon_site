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
                  <td style="width: 100%;text-align: center;font-size: 23px;text-decoration: underline;">
                    <b>
                      <i>
                          RAPPORT
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                      <i>
                        Année Académique : 
                        <b>
                        <?php 
                            $code=$_GET['code2'];
                            $req = $conn ->query("SELECT * FROM session WHERE id_session='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['annee_session'];
                              }
                            }
                        ?>
                        </b>
                      </i>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                      Etablissement &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                      <b>
                      <?php 
                            $code=$_GET['code1'];
                            $req = $conn ->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nom_etablissement'];
                              }
                            }
                        ?>
                        </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                      Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                      <b>
                      <?php 
                            $code=$_GET['code1'];
                            $req = $conn ->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['type_etablissement'];
                              }
                            }
                        ?>
                        </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                      Catégorie &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                      <b>
                      <?php 
                            $code=$_GET['code1'];
                            $req = $conn ->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['categorie_etablissement'];
                              }
                            }
                        ?>
                        </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                      Responsable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                      <b>
                      <?php 
                            $code=$_GET['code1'];
                            $req = $conn ->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['responsable'];
                              }
                            }
                        ?>
                        </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;">
                      Téléphone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                      <b>
                      <?php 
                            $code=$_GET['code1'];
                            $req = $conn ->query("SELECT * FROM etablissement WHERE id_etablissement='$code'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['num_responsable'];
                              }
                            }
                        ?>
                        </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        I- &nbsp;&nbsp;CAPACITE D'ACCUEIL
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 240px;"><b>&nbsp;PLACE DISPO</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;EFFECTIF</b></td>
                  <td style="height: 30px;width: 200px;"><b>&nbsp;ADMIS</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;REDOUBLANT</b></td>
                </tr>
                <?php
                    $code2=$_GET['code2'];
                    $code1=$_GET['code1'];
                    if (isset($_GET["code2"]) && isset($_GET["code1"]))
                    {
                    $req = $conn ->query("SELECT * FROM eleve e, session s, etablissement t WHERE e.id_session=s.id_session AND s.id_etablissement=t.id_etablissement AND s.id_session='$code2' AND t.id_etablissement='$code1'");
                    if ($req) {
                        while ($donnees =$req ->fetch()) {    
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['place_dispo']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['effectif']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['admis']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['redoublant']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        II- &nbsp;&nbsp;NOMBRE D'ENSEIGNANT
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        1) &nbsp;&nbsp;Enseigants Nationaux
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 240px;"><b>&nbsp;DISCIPLINE</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;HOMME</b></td>
                  <td style="height: 30px;width: 200px;"><b>&nbsp;FEMME</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;TOTAL</b></td>
                </tr>
                <?php
                    $code2=$_GET['code2'];
                    $code1=$_GET['code1'];
                    if (isset($_GET["code2"]) && isset($_GET["code1"]))
                    {
                    $req = $conn ->query("SELECT * FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Nationaux'");
                    if ($req) {
                        while ($donnees =$req ->fetch()) {    
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['discipline']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['homme']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['femme']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['total']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>
            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        Total Homme : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(homme) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Nationaux'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
                    </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        Total Femme : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(femme) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Nationaux'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
                    </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        TOTAL : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Nationaux'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        1) &nbsp;&nbsp;Enseigants Expatriés
                      </i>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 240px;"><b>&nbsp;DISCIPLINE</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;HOMME</b></td>
                  <td style="height: 30px;width: 200px;"><b>&nbsp;FEMME</b></td>
                  <td style="height: 30px;width: 300px;"><b>&nbsp;TOTAL</b></td>
                </tr>
                <?php
                    $code2=$_GET['code2'];
                    $code1=$_GET['code1'];
                    if (isset($_GET["code2"]) && isset($_GET["code1"]))
                    {
                    $req = $conn ->query("SELECT * FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Expatries'");
                    if ($req) {
                        while ($donnees =$req ->fetch()) {    
                ?>
                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['discipline']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['homme']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['femme']; ?></td>
                  <td style="height: 20px;">&nbsp;<?php echo $donnees['total']; ?></td>
                </tr>
                <?php } } } ?>
              </tbody>
            </table>
            <table table border="0" align="left" cellspacing="0" cellpadding="5" width="100%">
              <tbody>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        Total Homme : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(homme) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Expatries'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
                    </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        Total Femme : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(femme) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Expatries'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
                    </b>
                  </td>
                </tr>
                <tr style="color: while;border:0px solid #efefef;margin-left: 20px;float: left;">
                  <td style="width: 100%;font-size: 14px;float: left;">
                    <b>
                      <i>
                        TOTAL : 
                        <?php 
                            $code2=$_GET['code2'];
                            $code1=$_GET['code1'];
                            if (isset($_GET["code2"]) && isset($_GET["code1"]))
                            {
                            $req = $conn ->query("SELECT SUM(total) AS nbre FROM enseignant n, session s, etablissement e WHERE n.id_session=s.id_session AND s.id_etablissement=e.id_etablissement AND s.id_session='$code2' AND e.id_etablissement='$code1' AND n.type_enseignant='Expatries'");
                            if ($req) {
                                while ($donnees =$req ->fetch()) { 
                                echo $donnees['nbre'];
                              }
                            }
                            }
                        ?>
                      </i>
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