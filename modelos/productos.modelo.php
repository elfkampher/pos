<?php

require_once "conexion.php";

class ModeloProductos{

	/*=========================================
	=            MOSTRAR PRODUCTOS            =
	=========================================*/
	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_producto DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=========================================
	=            MOSTRAR PRODUCTOS            =
	=========================================*/
	static public function mdlMostrarProductosOrdenVenta($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY ventas DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ventas DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	/*=====  End of MOSTRAR PRODUCTOS  ======*/

	/*=========================================
	=            INGRESAR PRODUCTOS            =
	=========================================*/
	static public function mdlIngresarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt=null;
	}

	/*=========================================
	=            EDITAR PRODUCTOS            =
	=========================================*/
	static public function mdlEditarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt=null;
	}

		/*=========================================
	=            ELIMINAR PRODUCTOS            =
	=========================================*/
	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");

		$stmt -> bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";

		}else{
			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/*===========================================
	=            ACTUALIZAR PRODUCTO            =
	===========================================*/
	
	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_producto = :id");

		$stmt ->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt ->bindParam(":id", $valor, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";


		}	

		

		$stmt -> close();

		$stmt = null;

	}
	
	/*=====  End of ACTUALIZAR PRODUCTO  ======*/

	/*===========================================
	=            MOSTRAR SUMA VENTAS            =
	===========================================*/
	
	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) AS total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt ->close();

		$stmt = null;
	}
	
	/*=====  End of MOSTRAR SUMA VENTAS  ======*/
	
}