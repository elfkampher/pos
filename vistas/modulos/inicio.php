<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Tablero
        <small>panel de control</small>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        
        <li class="active">Tablero</li>
      </ol>

    </section>

    
    <section class="content">

      <div class="row">

        <?php

          if($_SESSION["id_perfil"]==1){

            include "inicio/cajas-superiores.php";

          }

        ?>        

      </div>

      <div class="row">
        
        <div>
          
          <?php

          print FALSE;

            if($_SESSION["id_perfil"]==1){

              include "reportes/graficos-ventas.php";

            }
          ?>

        </div>

        <div class="col-lg-6">
        
          <div>
            
            <?php

              if($_SESSION["id_perfil"]==1){

                include "reportes/productos-mas-vendidos.php";

              }

            ?>

          </div>

        </div>      

        <div class="col-lg-6">
        
          <div>
            
            <?php

              if($_SESSION["id_perfil"]==1){

              include "inicio/productos-recientes.php";

              }

            ?>

          </div>          

        </div>

        <div class="col-lg-12">
            
          <?php

            if($_SESSION["id_perfil"]==2 || $_SESSION["id_perfil"]==3){

              echo '<div class="box box-success">

                      <div class="box-header">

                        <h1>Bienvenid@ '.$_SESSION["nombre"].'</h1>

                      </div>

                    </div>';

            }

          ?>

          </div>      

      </div>      

      

    </section>
    
</div>
  