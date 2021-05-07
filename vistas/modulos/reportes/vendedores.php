<?php

$item = "id_vendedor";
$valor = null;
$ventasVendedor = ControladorVentas::ctrMostrarVentasVendedor($item, $valor);



?>

<!--================================================
		VENDEDORES
==================================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
		
		<h3 class="box-title">Vendedores</h3>

	</div>

	<div class="box-body">
		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

	</div>

</div>

<?php?>

<script>
	
    //Grafico de barras
    var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [
      <?php
      foreach ($ventasVendedor as $key => $value) {        
        echo "{y: '".$value["nombre"]."', a: ".round($value["total"],2)."},";                
      }

      ?>        
        
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['ventas'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>