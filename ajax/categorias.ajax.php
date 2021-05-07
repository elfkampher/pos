<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{
	/*========================================
	=            EDITAR CATEGORIA            =
	========================================*/
	
	public $idCategoria;

	public function ajaxEditarCategoria(){
		$item = "id_categoria";
		$valor = $this->idCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		echo json_encode($respuesta);
	}
	
	/*=====  End of EDITAR CATEGORIA  ======*/
	
}

if(isset($_POST["idCategoria"])){
	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}