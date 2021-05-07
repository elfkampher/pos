<?php
$item = null;  
$valor = null;

$productos = ControladorProductos::ctrMostrarProductosOrdenVenta($item, $valor);

$colores = array("#f56954", "#00a65a", "#f39c12", "#00c0ef", "purple", "3c8dbc", "cyan", "magenta", "orange", "#d2d6de");

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();

?>

<div class="box box-default">
  
  <div class="box-header with-border">
  
    <h3 class="box-title">Productos más vendidos</h3>    
  
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  
    <div class="row">
  
      <div class="col-md-7">
  
        <div class="chart-responsive">
  
          <canvas id="pieChart" height="150"></canvas>
  
        </div>
        <!-- ./chart-responsive -->
      </div>
      <!-- /.col -->
      <div class="col-md-5">

        <ul class="chart-legend clearfix">

          <?php

          for($i = 0; $i < 10; $i++){

            echo '<li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';

          }
          ?>

          

        </ul>

      </div>
      
    </div>
    
  </div>
  
  <div class="box-footer no-padding">
  
    <ul class="nav nav-pills nav-stacked">

      <?php

        for($i = 0; $i < 5; $i++ ){

          if($productos[$i]["imagen"] != ""){
            $imagen = '<img src="'.$productos[$i]["imagen"].'" class="img-thumbnail" width="60px style="margin-right:10px">';
          } else {
            $imagen = '<img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="60px style="margin-right:10px">';
            
          }

          echo '<li>
                  <a>
                    '.$imagen.'        
                    '.$productos[$i]["descripcion"].'
                    <span class="pull-right text-'.$colores[$i].'"><i class="fa fa-angle-down"></i> '.round($productos[$i]["ventas"]*100/$totalVentas["total"],2).'%</span>
                  </a>
                </li>';

        }

      ?>
  
      
    </ul>
  
  </div>

</div>

<script>
  
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    <?php

    for($i = 0; $i < 10; $i++){

        echo "{
         value    : ".$productos[$i]["ventas"].",
         color    : '".$colores[$i]."',
         highlight: '".$colores[$i]."',
         label    : '".$productos[$i]["descripcion"]."'
        },";

    }

    ?>
    
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

</script>
