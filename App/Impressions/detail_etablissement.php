<?php
/*
 *Générer un PDF à partir d'une base de données
*/
  require('../connexion_db.php');
  ob_start();
  ?>

  <page backtop="2%" backbottom="2%" width="100%" format="A4" >

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
                      ETABLISSEMENT : 
                      <?php 
                        $code=$_GET['code'];
                        if (isset($_GET["code"]))
                        {
                        $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch()) 
                            {
                              echo $donnees['nom_etablissement'];
                            }
                          }
                        }
                       ?>
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>

            <br/><br/>

            <table table border="1" align="center" cellspacing="0" cellpadding="5" style="width: 1040px;">
              <tbody>
                <tr style="text-align: center;color: while;border:1px solid #111;background: #f7f7f7;">
                  <td style="height: 30px;width: 350px;"><b>&nbsp;LIBELLES</b></td>
                  <td style="height: 30px;width: 350px;"><b>&nbsp;INFORMATIONS</b></td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;ETABLISSEMENT</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nom_etablissement'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;TYPE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['type_etablissement'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;CATEGORIE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['categorie_etablissement'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;DATE DE CREATION</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['dte_creation'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;RESPONSABLE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['responsable'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;TEL. RESPONSABLE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['num_responsable'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;CIRCONSCRIPTION</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nom_circonscription'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;PROVINCE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['nom_province'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;VILLE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['ville'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;LATITUDE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['lat_etablissement'];
                            }
                          }
                    ?>
                  </td>
                </tr>

                <tr style="text-align: center;color: while;border:0px solid #111;">
                  <th scope="row" style="text-align: left;">&nbsp;CATEGORIE</th>
                  <td style="height: 20px;text-align: left;">
                    <?php 
                      $req = $conn ->query("SELECT * FROM etablissement e, province p, circonscription c WHERE e.id_province=p.id_province AND e.id_circonscription=c.id_circonscription AND e.id_etablissement='$code'");
                        if ($req) {
                            while ($donnees =$req ->fetch())
                            {
                              echo $donnees['long_etablissement'];
                            }
                          }
                    ?>
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