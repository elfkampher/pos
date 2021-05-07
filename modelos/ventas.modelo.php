<?php

require_once "conexion.php";

class ModeloVentas{

	/*======================================
	=            MOSTRAR VENTAS            =
	======================================*/
	
	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_venta ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");

			$stmt ->execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}
	
	/*=====  End of MOSTRAR VENTAS  ======*/

	/*======================================
	=            MOSTRAR VENTAS            =
	======================================*/
	
	static public function mdlMostrarVentasVendedor($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT sum(v.total) as total, u.nombre FROM ventas v, usuarios u WHERE v.id_vendedor = u.id_usuarios GROUP BY $item;");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarVentasComprador($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT sum(v.total) as total, c.nombre FROM ventas v, clientes c WHERE v.id_cliente = c.id_cliente GROUP BY v.$item;");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}



	
	/*=====  End of MOSTRAR VENTAS COMPRADOR  ======*/

	

	/*==========================================
	=            REGISTRO DE VENTAS            =
	==========================================*/
	
	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null();
	}
	
	/*=====  End of REGISTRO DE VENTAS  ======*/

	/*==========================================
	=            EDICION DE VENTAS            =
	==========================================*/
	
	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total = :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null();
	}
	
	/*=====  End of EDICION DE VENTAS  ======*/

	/*======================================
	=            ELIMINAR VENTA            =
	======================================*/
	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_venta = :id_venta");

		$stmt -> bindParam(":id_venta", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;
	}
	
	
	/*=====  End of ELIMINAR VENTA  ======*/
	
	/*=======================================
	=            RANGO DE FECHAS            =
	=======================================*/
	
	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");

			$stmt ->execute();

			return $stmt -> fetchAll();

		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");
			
			$stmt ->execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");				

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
					
			}			

			
			

			$stmt ->execute();

			return $stmt->fetchAll();			

		}

	}
	
	/*=====  End of RANGO DE FECHAS  ======*/

	/*=======================================
	=            RANGO DE FECHAS AGRUPADO           =
	=======================================*/
	
	static public function mdlRangoFechasVentasSum($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha, '%Y-%m') AS fecha ,round(sum(total),2) AS total FROM ventas GROUP BY MONTH(fecha);");

			$stmt ->execute();

			return $stmt -> fetchAll();

		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha, '%Y-%m') AS fecha ,round(sum(total),2) AS total FROM ventas AND fecha LIKE '%$fechaFinal%' GROUP BY MONTH(fecha);");
			
			$stmt ->execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha, '%Y-%m') AS fecha ,round(sum(total),2) AS total FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY MONTH(fecha) ");				

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha, '%Y-%m') AS fecha ,round(sum(total),2) AS total FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY MONTH(fecha)");
					
			}		
			

			$stmt ->execute();

			return $stmt->fetchAll();			

		}

	}
	
	/*=====  End of RANGO DE FECHAS  ======*/

	/*================================================
	=            SUMAR EL TOTAL DE VENTAS            =
	================================================*/
	
	static public function mdlSumaTotalVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT sum(total) as total FROM $tabla");

		$stmt -> execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;

	}
	
	/*=====  End of SUMAR EL TOTAL DE VENTAS  ======*/
	
	
	
	
	
}