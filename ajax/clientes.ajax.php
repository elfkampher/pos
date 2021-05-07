<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id_cliente";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

	public $idCliented;

	public function ajaxEliminarCliente(){

		$item = "id_cliente";
		$valor = $this->idCliented;

		$respuesta = ControladorClientes::ctrEliminarCliente($item, $valor);

		echo $respuesta;
	}
}

/*======================================
=            EDITAR CLIENTE            =
======================================*/

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

if(isset($_POST["idCliented"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliented = $_POST["idCliented"];
	$cliente -> ajaxEliminarCliente();

}