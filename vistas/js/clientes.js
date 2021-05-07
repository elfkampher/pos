/*======================================
=            EDITAR CLIENTE            =
======================================*/

$(".btnEditarCliente").click(function(){
  
 var idCliente = $(this).attr("idCliente");

 var datos = new FormData();

 datos.append("idCliente", idCliente);

 $.ajax({

 	url:"ajax/clientes.ajax.php",
 	method:"POST",
 	data: datos,
 	cache: false,
 	contentType: false,
 	processData: false,
 	dataType:"json",
 	success:function(respuesta){

 		$("#idCliente").val(respuesta["id_cliente"]);
 		$("#editarCliente").val(respuesta["nombre"]);
 		$("#editarDocumentoId").val(respuesta["documento"]);
 		$("#editarEmail").val(respuesta["email"]);
 		$("#editarTelefono").val(respuesta["telefono"]);
 		$("#editarDireccion").val(respuesta["direccion"]);
 		$("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]); 		

 	}

 });

});

/*======================================
=            EDITAR CLIENTE            =
======================================*/

$(".btnEliminarCliente").click(function(){
	
	var idCliente = $(this).attr("idCliente");

	swal({
		title: '¿Esta seguro de borrar el cliente?',
		text: '¡Si no lo está puede cancelar la acción!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonText: "d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, Borrar Cliente!"
	}).then((result) => {
		if(result.value){
			$.post("ajax/clientes.ajax.php", {
				idCliented:idCliente
			}).done(function(data){
				if(data=="ok"){
					swal({
						type:"success",
						title:"!El cliente ha sido eliminado correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm:false
					}).then((result)=>{
						if(result.value){
							window.location = "clientes";
						}
					});
				}
			});		
		}
	});
	
});