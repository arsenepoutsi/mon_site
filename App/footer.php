<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<div class="footer">
    <div class="pull-right">
        (+241) 04 64 68 58 / <strong>05 70 79 30</strong>
    </div>
    <div>
        <strong>Copyright</strong> SIG-ECOLE &copy; 2017-2018
    </div>
</div>