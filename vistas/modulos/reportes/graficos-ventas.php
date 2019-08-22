<?php
    error_reporting(0);
    if(isset($_GET["fechaInical"]))
    {
      $fehcaInical = $_GET["fechaInical"];
      $fechaFinal = $_GET["fechaFinal"];
    }
    else
    {
      $fehcaInical = null;
      $fechaFinal = null;
    }
    $venta = ControladorVenta::ctrRangoFecha($fehcaInical,$fechaFinal);
    
    $arrayFecha = array();
    $arrayVenta = array();
    $sumaPagoMes = array();
    
    foreach($venta as $key => $valor)
    {
        //capturar solo años y el mes
        $fecha = substr($valor["fecha"],0,7);
        //introducir fecha en el array
        array_push($arrayFecha,$fecha);
        //capturar venta
        $arrayVenta = array($fecha => $valor["total"]);
        //sumar pago de un mismo mes
        foreach($arrayVenta as $key => $valor)
        {
            $sumaPagoMes[$key] += $valor;
        }
    }
    $noRepetirFecha = array_unique($arrayFecha);
?>

<!-- Grafico de venta -->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Grafico de Ventas</h3>
    </div>
    <div class="box-body border-radius-none nuevoGraficoVenta">
        <div class="chart" id="line-chart-ventas" style="height: 250px">

        </div>
    </div>
</div>

<script>
    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart-ventas',
      resize: true,
      data: [
        <?php
            if($noRepetirFecha != null)
            {
                foreach($noRepetirFecha as $key)
                {
                    echo "{y: '".$key."', ventas: ".$sumaPagoMes[$key]."},"; 
                }
                echo "{y: '".$key."', ventas: ".$sumaPagoMes[$key]."}";
            }
            else
                echo "{y:'0', ventas: '0'}";
        ?>
      ],
    
      xkey: 'y',
      ykeys: ['ventas'],
      labels: ['ventas'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto',
      preUnits: '$'
    });
</script>