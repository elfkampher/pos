<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class TablaProductosVentas{
	/*==================================================
	=            MOSTRAR TABLA DE PRODUCTOS            =
	==================================================*/
	public function mostrarTablaProductosVentas(){

		$item = null;
		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);
				
		

		$datosJson = '{
			"data": [';
				for($i = 0; $i < count($productos); $i++){

					/*==================================================
					=            DEFINIMOS LAS ACCIONES            =
					==================================================*/

					$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar</button></div>";
					/*==================================================
					=            TRAEMOS IMAGEN DEL PRODUCTO            =
					==================================================*/
					if($productos[$i]["imagen"] != ""){
						$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
					} else {
						$imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";;
					}
						
					
					/*==================================================
					=            TRRAEMOS EL STOCK                  =
					==================================================*/
					if($productos[$i]["stock"]<=10){
						$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
					}else if($productos[$i]["stock"]>=11 && $productos[$i]["stock"]<=15){
						$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
					}else{
						$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
					}
						

					$datosJson .= '[
						"'.($i+1).'",
						"'.$imagen.'",
						"'.$productos[$i]["codigo"].'",
						"'.$productos[$i]["descripcion"].'",
						"'.$stock.'",						
						"'.$botones.'"	
					],';
				}
		$datosJson = substr($datosJson, 0, -1);				
		$datosJson .= ']
		}';

		echo $datosJson;

	}
}

/*==================================================
=            ACTIVAR TABLA DE PRODUCTOS            =
==================================================*/

$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

/*=====  End of ACTIVAR TABLA DE PRODUCTOS  ======*/

