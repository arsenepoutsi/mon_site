<?php
/*
 *Générer un PDF à partir d'une base de données
*/
  require('connexBD.PHP');
  ob_start();
  ?>

  <page backtop="2%" backbottom="2%" width="100%">

      <P>       
            <img src="bz.png" style="float:left;margin-left:10px;margin-top:25px;width:150px;height:150px">

            <h1>
                <b style="margin-top:15px;font-size:50px;color:black;font-family:Arial;float:left;margin-left:100px">MEFPPPI</b>
                 <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:30px">Ministère de l'Economie, des Finances,</b>
                <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:60px">du Plan, du Portefeuille Public</b>
                <br/>
                <b style="font-size:20px;color:black;font-family:Arial;float:left;margin-left:120px">et de l'Intégration</b>

            </h1>

            <img src="cg.gif" style="float:float;margin-left:600px;margin-top:-150px;width:150px;height:150px">
      </P>

            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

            <h1>
                <b style="font-size:29px;color:black;font-family:Arial;margin-left:150px;text-decoration:underline">LISTE DES MEMBRES DU SITE</b>
            </h1>

            <br/><br/><br/><br/><br/><br/>

            <table table border="1" align="center" bgcolor="silver" cellspacing="0" cellpadding="5" width="100%">
            <tr style="text-align: center;color: while;border:1px solid #134353">
                <td style="background:#C0C0C0;text-align:center"><b>NOM</b></td>
                <td style="background:#C0C0C0;text-align:center"><b>PRENOM</b></td>
                <td style="background:#C0C0C0;text-align:center"><b>TELEPHONE</b></td>
                <td style="background:#C0C0C0;text-align:center"><b>ADRESSE EMAIL</b></td>
                <td style="background:#C0C0C0;text-align:center"><b>PAYS</b></td>
                <td style="background:#C0C0C0;text-align:center"><b>VILLE</b></td>
            </tr>
            <?php
               $req=mysql_query('select * from client');

               while ($row=mysql_fetch_array($req)) {
            ?>

              <tr>
                  <td style="text-align: center;color:#134353"><?php echo $row['nom'];?></td>
                  <td style="text-align: center;color:#134353"><?php echo $row['prenom'];?></td>
                  <td style="text-align: center;color:#134353"><?php echo $row['telephone'];?></td>
                  <td style="text-align: center;color:#134353"><?php echo $row['email'];?></td>
                  <td style="text-align: center;color:#134353"><?php echo $row['pays'];?></td>
                  <td style="text-align: center;color:#134353"><?php echo $row['ville'];?></td>
              </tr>
              <?php
                }
               ?>

      </table>
      
  </page>


<?php
   $content = ob_get_clean();
   require('html2pdf.class.php');

   $pdf=new HTML2PDF('P','A4','fr','true','UTF-8');
   $pdf->writeHTML($content); 
   $pdf->pdf->includeJS('print(true)');
   $pdf->output('liste.pdf');
?>