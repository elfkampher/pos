<?php

if($_SESSION["id_perfil"]==2 || $_SESSION["id_perfil"]==3){

  echo '<script>
    
   window.location = "inicio";

  </script>';

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Reportes 
        
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        
        <li class="active">Reporte de ventas </li>
      </ol>

    </section>

    
    <section class="content">

      <div class="box">
        
        <div class="box-header with-border">

          <div class="input-group">
          
            <button type="button" class="btn btn-default" id="daterange-btn2">
                
              <span>                
                  <i class="fa fa-calendar"></i> Rango de fecha
              </span>

              <i class="fa fa-caret-down"></i>

            </button>

          </div>       

          <div class="box-tools pull-right">
             
            <?php

            if(isset($_GET["fechaInicial"])){

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

            }else{

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

            } 

            ?>  

            
              
              <button class="success btn-success" style="margin-top:5px">Descargar Reporte en Excel</button>            
  
            </a>            
            
          </div>

        </div>

        <div class="box-body">

          <div class="col-xs-12">

             <?php

                include "reportes/graficos-ventas.php";

             ?>           

          </div>

          <div class="col-md-6 col-xs-12">
            
            <?php

              include "reportes/productos-mas-vendidos.php";

            ?>


          </div>

          <div class="col-md-6 col-xs-12">
            
            <?php

              include "reportes/vendedores.php";

            ?>


          </div>

          <div class="col-md-6 col-xs-12">
            
            <?php

              include "reportes/compradores.php";

            ?>


          </div>
          
        </div>
        
                
      </div>      

    </section>
    
</div>
  