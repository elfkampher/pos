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
          
          <form role="form" method="post">

          <div class="box-body">            
              
              <div class="box">
                
                <!--===================================
                        ENTRADA DEL VENDEDOR
                =======================================-->
                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" name="nuevoVendedor" id="nuevoVendedor" value="Usuario Administrador" readonly>

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CODIGO DE LA VENTA
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control" name="nuevaVenta" id="nuevaVenta" value="10003215" readonly>

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CLIENTE
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select type="text" class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                      
                      <option value="">Seleccionar Cliente</option>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>

                  </div>

                </div>

                <!--===================================
                     ENTRADA PARA AGREGAR PRODUCTO 
                =======================================-->
                <div class="form-group row nuevoProducto">

                  <!--Descripcion del producto-->

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">
                      
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripcion del producto" required>  

                    </div>

                  </div>

                  <!--Cantidad del producto-->

                  <div class="col-xs-3">
                    
                    <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>

                  </div>

                  <!--Precio del producto-->

                  <div class="col-xs-3" style="padding-left: 0px">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                      <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="0000" readonly required>

                    </div>
                    
                  </div>

                </div>

                <!--BOTON PARA AGREGAR PRODUCTO-->                

                <button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>

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
                            
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              
                            </div>
                          
                          </td>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>    
                              
                              <input type="number" min="1" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>

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
                        <option value="efectivi">Efectivo</option>
                        <option value="tarjetaCredito">Tarjeta Credito</option>
                        <option value="TarjetaDebito">Tarjeta Debito</option>
                      </select>  

                    </div>

                  </div>

                  <div class="col-xs-6" style="padding-left: 0px">
                    
                    <div class="input-group">

                      <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código Transacción" required>

                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      
                    </div>

                  </div>

                </div>

                <br>
                
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
            
          </div>

          </form>

        </div>
         
       </div>

       <!--===================================
                  TABLA DE PRODUCTOS
      =======================================-->

       <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">
          
          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              
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

              <tbody>
                
                <tr>
                  <td>1.</td>
                  <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td>00123</td>
                  <td>Lorem impsun dolor sit amet</td>                  
                  <td>20</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-group">Agregar</button>                      
                    </div>
                  </td>
                </tr>

              </tbody>

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
 