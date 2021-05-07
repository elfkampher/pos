<?php

if($_SESSION["id_perfil"]==3){

  echo '<script>
    
   window.location = "inicio";

  </script>';

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Administrar Productos
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Administrar Productos</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

            Agregar Producto

          </button>       

          
        
        </div>
        
        <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
              
              <thead>
                <tr>

                  <th style="width:10px">#</th>
                  <th>imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Categoria</th>
                  <th>Stock</th>
                  <th>Precio de compra</th>
                  <th>Precio de venta</th>
                  <th>Agregado</th>
                  <th>Acciones</th>

                </tr>

              </thead>

              

            </table>

          <input type="hidden" value="<?php echo $_SESSION['id_perfil'];?>" class="perfilOculto">

        </div>
        
      </div>

    </section>

</div>


  <!--=====================================
      =     MODAL AGREGAR PRODUCTO            =
      =====================================-->


<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Producto</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">
            
            <!-- ENTRADA PARA SELECCIONAR CATEGORIA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Seleccionar Categoria</option>
                  <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    
                    foreach ($categorias as $key => $value) {
                      echo '<option value="'.$value["id_categoria"].'">'.$value["categoria"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>

            <!-- ENTRADA LA DESCRIPCION -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripción" required>

              </div>

            </div>           
            
            

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group">

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio Compra" required>

                </div>

              </div>
           

            <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio Venta" required>

                </div>

                <br>
                
                <!-- CHECK BOX PARA PORCENTAJE -->                
                <div class="col-xs-6">
                    
                  <div class="form-group">
                    
                    <label>                    
                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar Porcentaje                    
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" name="nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen" id="nuevaFoto">

              <p class="help-block">peso maximo 200 MB </p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Producto</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>

    </form>

    <?php
      $crearProducto = new controladorProductos();
      $crearProducto -> ctrCrearProducto();
    ?>
    
    </div>

  </div>

</div>

  <!--=====================================
      =     MODAL EDITAR PRODUCTO            =
      =====================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Producto</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">
            <!-- ENTRADA PARA SELECCIONAR CATEGORIA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editarCategoria"  readonly>
                  
                  <option id="editarCategoria">Selecionar Categoria</option>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA LA DESCRIPCION -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>           
            
            

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="editarStock" min="0" id="editarStock" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group">

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" name="editarPrecioCompra" min="0" id="editarPrecioCompra" required>

                </div>

              </div>
           

            <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta"  min="0" readonly required>

                </div>

                <br>
                
                <!-- CHECK BOX PARA PORCENTAJE -->                
                <div class="col-xs-6">
                    
                  <div class="form-group">
                    
                    <label>                    
                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar Porcentaje                    
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" name="nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen" id="nuevaFoto">

              <p class="help-block">peso maximo 2 MB </p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>
            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn bg-primary">Guardar Cambios</button>
        
        </div>

    </form>

    <?php

      $editarProducto = new controladorProductos();
      $editarProducto -> ctrEditarProducto();

    ?>
    
    </div>

  </div>

</div>

<?php

  $eliminarProducto = new controladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>