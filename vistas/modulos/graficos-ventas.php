<?php
	
	if(isset($_GET["fechaInicial"])){

	$fechaInicial = $_GET["fechaInicial"];
	$fechaFinal = $_GET["fechaFinal"];

	}else{

	$fechaInicial = null;
	$fechaFinal = null;

	}

	$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal, $valor);

	foreach ($respuesta as $key => $value) {



	}


?>

<!--========================================================
			            GRAFICO DE VENTAS
===========================================================-->

<div class="box box-solid bg-teal-gradient">

	<div class="box-header">
		
		<i class="fa fa-th"></i>

		<h3 class="box-title">Grafico de Ventas</h3>

	</div>

	<div class="box-boxy border-radus-none nuevoGraficoVentas">
		
		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

	</div>

</div>

<script>
	
var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });

</script>