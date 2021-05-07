<?php

$item = "id_cliente";
$valor = null;
$ventasComprador = ControladorVentas::ctrMostrarVentasComprador($item, $valor);



?>

<!--================================================
		VENDEDORES
==================================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
		
		<h3 class="box-title">Compradores</h3>

	</div>

	<div class="box-body">
		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height: 300px;"></div>

		</div>

	</div>

</div>

<?php?>

<script>	

     //Grafico de barras
    var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,
      data: [

      <?php

      foreach ($ventasComprador as $key => $value) {        
        echo "{y: '".$value["nombre"]."', a: ".round($value["total"],2)."},";                
      }

      ?>        
        
      ],
      barColors: ['#f6a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['compras'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>