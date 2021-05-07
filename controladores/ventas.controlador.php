<?php

class ControladorVentas{

	/*===================================
	=            MOSTRAR VENTA            =
	===================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;
		
	}

	static public function ctrMostrarVentasVendedor($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentasVendedor($tabla, $item, $valor);

		return $respuesta;
		
	}

	static public function ctrMostrarVentasComprador($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentasComprador($tabla, $item, $valor);

		return $respuesta;
		
	}

	/*===================================
	=            CREAR VENTA            =
	===================================*/
	
	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*=============================================================================
			=            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK, AUMENTAR LAS VENTAS DE LOS PRODUCTOS            =
			=============================================================================*/
			
			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id_producto";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor); 

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor); 
				
			}

			$tablaClientes = "clientes";

			$item = "id_cliente";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados)+$traerCliente["compras"];
			
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";
			$fecha = date('y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;			
			
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);
			/*=====  End of ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK  ======*/

			/*=========================================
			=            GUARDAR LA COMPRA            =
			=========================================*/
			
			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
							"id_cliente"=>$_POST["seleccionarCliente"],
							"codigo"=>$_POST["nuevaVenta"],
							"productos"=>$_POST["listaProductos"],
							"impuesto"=>$_POST["nuevoPrecioImpuesto"],
							"neto"=>$_POST["nuevoPrecioNeto"],
							"total"=>$_POST["totalVenta"],
							"metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>
					localStorage.removeItem("rango");

					swal ({
							type:"success",
							title:"la venta ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar"}).then((result)=> {
								if(result.value){
									window.location = "ventas";
								}
							})
				</script>';
			}
			
			/*=====  End of GUARDAR LA COMPRA  ======*/
			
			
		}

	}
	
	/*=====  End of CREAR VENTA  ======*/

	/*===================================
	=            CREAR VENTA            =
	===================================*/
	
	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){


			/*=============================================================================
			=            FORMATEAR TABLA PRODUCTOS Y TABLA CLIENTES            =
			=============================================================================*/
			$tabla="ventas";
			
			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*============================================================
			=            REVISAR SI VIENE PRODUCTOS EDITADOS            =
			=============================================================*/
			
			$cambioProducto = false;

			if($_POST["listaProductos"]==""){
				
				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;

			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;

			}

			if($cambioProducto){

				$productos = json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";
					$item ="id_producto";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor); 

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				}

				$tablaClientes = "clientes";

				$itemCliente = "id_cliente";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				
				/*=============================================================================
				=            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK, AUMENTAR LAS VENTAS DE LOS PRODUCTOS            =
				=============================================================================*/
				
				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id_producto";
					$valor_2 = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto["ventas"];

					$nuevasVentas_2 = ModeloProductos::MdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2); 

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::MdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2); 
					
				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id_cliente";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2)+$traerCliente_2["compras"];

				
				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);



				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');

				$fecha_2 = date('y-m-d');
				$hora_2 = date('H:i:s');
				$valor1b_2 = $fecha_2.' '.$hora_2;			
				
				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}
			
			/*=====  End of ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK  ======*/

			/*=========================================
			=            GUARDAR CAMBIOS DE LA COMPRA            =
			=========================================*/

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
							"id_cliente"=>$_POST["seleccionarCliente"],
							"codigo"=>$_POST["editarVenta"],
							"productos"=>$listaProductos,
							"impuesto"=>$_POST["nuevoPrecioImpuesto"],
							"neto"=>$_POST["nuevoPrecioNeto"],
							"total"=>$_POST["totalVenta"],
							"metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>
					localStorage.removeItem("rango");

					swal ({
							type:"success",
							title:"la venta ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar"}).then((result)=> {
								if(result.value){
									window.location = "ventas";
								}
							})
				</script>';
			}
			
			/*=====  End of GUARDAR LA COMPRA  ======*/
			
			
		}

	}
	
	/*=====  End of CREAR VENTA  ======*/

	/*======================================
	=            ELIMINAR VENTA            =
	======================================*/
	
	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";
			$item = "id_venta";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*================================================
			=            ACTUALIZAR ULTIMA COMPRA            =
			================================================*/

			$tablaClientes = "clientes";
			
			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();
						
			foreach ($traerVentas as $key => $value){

				if($value["id_cliente"]==$traerVenta["id_cliente"]){
					array_push($guardarFechas, $value["fecha"]);
				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"]> $guardarFechas[count($guardarFechas)-2]){
					$item = "utlima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
				}else{
					$item = "utlima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
				}

			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*===============================================================
						=            FORMATEAR TABLA DE PRODUCTOS Y CLIENTES            =
			===============================================================*/
						
				$productos = json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";
					$item ="id_producto";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor); 

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				}

				$tablaClientes = "clientes";

				$itemCliente = "id_cliente";
				$valorCliente = $traerVenta["id_cliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);		
						
				/*=====  End of FORMATEAR TABLA DE PRODUCTOS Y CLIENTES  ======*/

				$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

				if($respuesta == "ok"){
					echo '<script>
						
						swal({
							type: "success",
							title: "La venta ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=> {
								if(result.value){
									window.location = "ventas";
								}
							})
					</script>';
				}
									

		}	

	}
	
	/*=====  End of ELIMINAR VENTA  ======*/

	/*=======================================
	=            RANGO DE FECHAS            =
	=======================================*/
	

	
	
	/*=====  End of RANGO DE FECHAS  ======*/
	
	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	static public function ctrRangoFechasVentasSum($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentasSum($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}

	/*======================================
	=            DESCARGAR EXEL            =
	======================================*/
	
	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tala, $_GET["fechaInicia"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			}

			/*===========================================
			=            CREAR ARCHIVO EXCEL            =
			===========================================*/
			
			$name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');//Archivo Excel
			header('Cache-control: cache, must-revalidate');
			header('Last-Modified: '.date('D, d M Y H:i.s'));			
			header('Pragma: public');
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'>
					<tr>
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					</tr>");

			foreach ($ventas as $row => $item) {
				
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id_usuarios", $item["id_vendedor"]);

				echo utf8_decode("<tr>
					   	<td style='font-weight:bold; border:1px solid #eee;'>".$item["codigo"]."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>".$cliente["nombre"]."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>".$vendedor["nombre"]."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>");

					$productos = json_decode($item["productos"], true);

					foreach ($productos as $key => $valueProductos) {
						
						echo utf8_decode($valueProductos["cantidad"]."<br>");

					}

					echo utf8_decode("</td><td style='border:1px solid #eee;'>");

					foreach ($productos as $key => $valueProductos) {

						echo utf8_decode($valueProductos["descripcion"]."<br>");

					}				

					echo utf8_decode("</td>
						<td style='font-weight:bold; border:1px solid #eee;'>$".number_format($item["impuesto"])."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>$".number_format($item["neto"])."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>$".number_format($item["total"])."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>".$item["metodo_pago"]."</td>
						<td style='font-weight:bold; border:1px solid #eee;'>".substr($item["fecha"], 0,10)."</td>

					</tr>");
					

			}

			echo "</table>";
			
			/*=====  End of CREAR ARCHIVO EXCEL  ======*/			

		}

	}
	
	/*=====  End of DESCARGAR EXEL  ======*/
	/*=========================================
	=            SUMA TOTAL VENTAS            =
	=========================================*/
	
	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}
	
	/*=====  End of SUMA TOTAL VENTAS  ======*/
	


	
}