<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Nueva Venta
        
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>        
        <li class="active">Nueva Venta</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

     <div class="row">
       
       <!--===================================
                  EL FORMULARIO
      =======================================-->

       <div class="col-lg-5 col-xs-12">

        <div class="box box-success">
          
          <div class="box-header with-border"></div>
          
          <form role="form" method="post" class="formularioVenta">

          <div class="box-body">            
              
              <div class="box">

              <?php
                  
                  $item = "id_venta";
                  $valor = $_GET["idVenta"];

                  $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                  $itemUsuario = "id_usuarios";
                  $valorUsuario = $venta["id_vendedor"];
                  
                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  $itemCliente = "id_cliente";
                  $valorCliente = $venta["id_cliente"];
                  
                  $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  $porcentajeImpuesto = $venta["impuesto"]*100/$venta["neto"];
              ?>  
                
                <!--===================================
                        ENTRADA DEL VENDEDOR
                =======================================-->
                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $venta["id_vendedor"];?>" >

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CÓDIGO
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="forma-control" id="editarVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
                   

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CLIENTE
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                      
                      <option value="<?php echo $cliente["id_cliente"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                      <?php

                      $item = null;
                      $valor =null;

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {

                        echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                        
                      }

                    ?>

                    </select>
          


                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>

                  </div>

                </div>

                <!--===================================
                     ENTRADA PARA AGREGAR PRODUCTO 
                =======================================-->
                <div class="form-group row nuevoProducto">

                <?php

                $listaProducto = json_decode($venta["productos"], true);

                

                foreach ($listaProducto as $key => $value) {

                  $item = "id_producto";
                  $valor = $value["id"];

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

                  $stockAntiguo = $respuesta["stock"]+$value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">                    
                  
                          <div class="col-xs-6" style="padding-right:0px">

                            <div class="input-group">
                              
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                            </div>

                          </div>
                          
                          
                          
                          <div class="col-xs-3 ingresoCantidad">
                            
                            <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" nuevoStock="'.$value["stock"].'" stock="'.$stockAntiguo.'" required>

                          </div>
                          
                          
                          
                          <div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'.$value["total"].'" precioReal="'.$respuesta["precio_venta"].'" readonly required>

                            </div>

                           </div>
                            
                         </div>';
                }

                ?>
                  
                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--BOTON PARA AGREGAR PRODUCTO-->                

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Producto</button>

                <hr>

                <div class="row">
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">
                      
                      <thead>
                        
                        <tr>                            
                            <th>impuestos</th>
                            <th>total</th>
                        </tr>

                        <tbody>

                          <td style="width:50%">
                            
                            <div class="input-group">
                            
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>

                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              
                            </div>
                          
                          </td>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>    
                              
                              <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>" value="<?php echo $venta["neto"]; ?>" readonly required>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["neto"]; ?>" id="totalVenta">


                            </div>                            

                          </td>

                        </tbody>

                      </thead>

                    </table>

                  </div>  

                </div>

                <hr>
                <!--METODO DE PAGO-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right: 0px">

                    <div class="input-group">
                      
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Credito</option>
                        <option value="TD">Tarjeta Debito</option>
                      </select>  

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
                
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
            
          </div>

          </form>

          <?php

            $editarVenta = new ControladorVentas;
            $editarVenta -> ctrEditarVenta();

          ?>

        </div>
         
       </div>

       <!--===================================
                  TABLA DE PRODUCTOS
      =======================================-->

       <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">
          
          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>                  
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
                
              </thead>              

            </table>

          </div>

        </div>
         
       </div>

     </div>

    </section>
    <!-- /.content -->
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
 