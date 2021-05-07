<?php
	
	
/*if(isset($_GET["fechaInicial"])){

	$fechaInicial = $_GET["fechaInicial"];
	$fechaFinal = $_GET["fechaFinal"];

	}else{

	$fechaInicial = null;
	$fechaFinal = null;

	}

	$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

  $arrayFechas = array();
  $arrayVentas = array();
  $sumaPagosMes = array();
  
	foreach ($respuesta as $key => $value) {

    $fecha = substr($value["fecha"], 0, 7);
    //introducir fechas en el array fecha
    array_push($arrayFechas, $fecha);
    //capturar total de ventas    
    
    $arrayVentas = array($fecha => $value["total"]);

    foreach ($arrayVentas as $key => $value) {
      
      $sumaPagosMes[$key] += $value;

    }

	}

  $noRepetirFechas = array_unique($arrayFechas);*/
  
  if(isset($_GET["fechaInicial"])){

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];

  }else{

  $fechaInicial = null;
  $fechaFinal = null;

  }

  $respuestaSum = ControladorVentas::ctrRangoFechasVentasSum($fechaInicial, $fechaFinal);
  
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

    <?php

    if($respuestaSum != null){            

      foreach ($respuestaSum as list ($fecha, $valor)) {

         echo "{ y: '".$fecha."', ventas: ".$valor." },";

      }
      
      echo "{ y: '".$fecha."', ventas: ".$valor." }";
    
    }else{

      echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });

</script>