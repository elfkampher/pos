<?php

if($_SESSION["id_perfil"]==2){

  echo '<script>
    
   window.location = "inicio";

  </script>';

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Administrar Clientes
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Administrar Clientes</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

            Agregar Clientes

          </button>       

          
        
        </div>
        
        <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablas" >
              
              <thead>
                <tr>

                  <th style="width: 10px">#</th>
                  <th>Cliente</th>
                  <th>Documento ID</th>                  
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Dirección</th>
                  <th>Fecha nacimiento</th>
                  <th>Total compras</th>
                  <th>Última compra</th>
                  <th>Ingreso al sistema</th>
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>

                <?php/*
                  $item = null;
                  $valor = null;
                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                  
                  foreach ($clientes as $key => $value) {

                    echo '<tr>
                  <td>'.($key+1).'</td>
                  
                  <td>'.$value["nombre"].'</td>

                  <td>'.$value["documento_id"].'</td>

                  <td>'.$value["e_mail"].'</td>

                  <td>'.$value["telefono"].'</td>

                  <td>'.$value["direccion"].'</td>

                  <td>'.$value["fecha_nacimiento"].'</td>

                  <td>'.$value["compras"].'</td>

                  <td>'.$value["ultima_compra"].'</td>
                  
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarCategoria" data-toggle="modal" data-target="#modalEditarCategoria" idCategoria="'.$value["id_categoria"].'" ><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id_categoria"].'" ><i class="fa fa-times"></i></button>
                    </div>
                  </td>

                </tr>';
                  }*/
                ?>

                
                  
                
              </tbody>

            </table>



        </div>
        
      </div>

    </section>

</div>


  <!--=====================================
      =     MODAL AGREGAR CLIENTE            =
      =====================================-->


<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Cliente</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA NOMBRE -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA DOCUMENTO ID -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar Documento">

              </div>

            </div>

            <!-- ENTRADA PARA EMAIL -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-99-99'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

            

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Cliente</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>
        <?php

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

        ?>
        

    </form>
    
    </div>

  </div>

</div>

<!--=====================================
        =     MODAL EDITAR CATEGORIA            =
        =====================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Categoria</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA CATEGORIA -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value="" required>

                <input type="hidden" class="form-control input-lg" id="idCategoria" name="idCategoria" value="">

              </div>

            </div>                      
            

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Cambios</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>

        <?php
            $editarCategoria = new ControladorCategorias();
            $editarCategoria -> ctrEditarCategoria();

        ?>

    </form>
    
    </div>

  </div>

</div>


<?php
  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>
