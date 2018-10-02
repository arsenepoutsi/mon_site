<?php 
  if (isset($_SESSION['login']) && isset($_SESSION['permission']) && isset($_SESSION['pwd']) && isset($_SESSION['profil'])) {
     }
    else {
        header("Location:../index.php?erreur=intru"); // redirection en cas d'echec
     }
 ?>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- Select2 -->
<script src="js/plugins/select2/select2.full.min.js"></script>
<script>
    $(document).ready(function(){

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            placeholder: "Select a state",
            allowClear: true
        });


    });
</script>

<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Document Excel'},
                    {extend: 'pdf', title: 'Document PDF'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<map name="france_map">

 <?php echo '<area alt="Estuaire" onmouseout="hide_image(1)" onmouseover="change_image(1)" href="recherche_dept.php?dept='."ESTUAIRE".'" coords="94,93,121,92,119,116,162,108,151,140,119,172,96,187,81,185,62,198,46,184,35,90" title="Estuaire" shape="poly">'; ?>

  <?php echo '<area alt="Haut-Ogooue" onmouseout="hide_image(2)" onmouseover="change_image(2)" href="recherche_dept.php?dept='."HAUT-OGOOUE".'" coords="319,159,360,167,406,204,403,290,373,335,303,326,284,291,309,240,339,216,314,173,319,161" title="haut-ogooue" shape="poly">'; ?>

  <?php echo '<area alt="Moyen-Ogooue" onmouseout="hide_image(3)" onmouseover="change_image(3)" href="recherche_dept.php?dept='."MOYEN-OGOOUE".'" coords="140,148,200,149,185,167,200,212,174,200,138,204,120,238,99,247,87,241,92,227,69,218,64,193,93,184,98,191,133,167,143,147" title="Moyen-Ogooue" shape="poly">'; ?>

  <?php echo '<area alt="Ngounie" onmouseout="hide_image(4)" onmouseover="change_image(4)" href="recherche_dept.php?dept='."NGOUNIE".'" coords="200,215,198,235,213,238,235,269,234,279,262,294,267,325,199,355,165,314,135,319,122,297,86,276,100,253,115,240,141,206,176,200,199,214" title="Ngounie" shape="poly">'; ?>

  <?php echo '<area alt="Nyanga" onmouseout="hide_image(5)" onmouseover="change_image(5)" href="recherche_dept.php?dept='."NYANGA".'" coords="96,349,117,342,134,319,166,316,200,354,238,380,224,421,166,431,96,349" title="Nyanga" shape="poly">'; ?>

  <?php echo '<area alt="Ogooue-Ivindo" onmouseout="hide_image(6)" onmouseover="change_image(6)" href="recherche_dept.php?dept='."OGOOUE-IVINDO".'" coords="255,78,322,76,378,54,402,101,366,169,312,160,275,140,264,189,200,209,182,165,203,153,198,138,252,104,254,78" title="Ogooue-Ivindo" shape="poly">'; ?>

  <?php echo '<area alt="Ogooue-Lolo" onmouseout="hide_image(7)" onmouseover="change_image(7)" href="recherche_dept.php?dept='."OGOOUE-LOLO".'" coords="264,295,234,276,233,259,214,238,201,239,200,215,262,193,273,142,304,148,316,162,316,171,340,217,283,290,264,296" title="Ogooue-Lolo" shape="poly">'; ?>

  <?php echo '<area alt="Ogooue-Maritime" onmouseout="hide_image(8)" onmouseover="change_image(8)" href="recherche_dept.php?dept='."OGOOUE-MARITIME".'" coords="3,199,44,183,62,199,68,221,91,228,98,248,94,271,82,274,124,295,133,317,114,343,93,349,19,262,5,200" title="Ogooue-Maritime" shape="poly">'; ?>

  <?php echo '<area alt="Woleu-Ntem" onmouseout="hide_image(9)" onmouseover="change_image(9)" href="recherche_dept.php?dept='."WOLEU-NTEM".'" coords="189,5,322,10,316,77,256,81,247,102,198,138,201,145,145,148,160,107,125,119,122,94,187,94,188,5" title="Woleu-Ntem" shape="poly">'; ?>
</map>

<script type="text/javascript" language="JavaScript">
      <!--
      preload_image('public/img/map_1.gif'); 
      preload_image('public/img/map_2.gif'); 
      preload_image('public/img/map_3.gif'); 
      preload_image('public/img/map_4.gif'); 
      preload_image('public/img/map_5.gif'); 
      preload_image('public/img/map_6.gif'); 
      preload_image('public/img/map_7.gif'); 
      preload_image('public/img/map_8.gif'); 
      preload_image('public/img/map_9.gif'); 
      //-->
 </script>