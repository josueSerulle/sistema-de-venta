<?php
    $ventas = ControladorVenta::ctrMostrarVenta(null,null,null);
    $cliente = ControladorCliente::ctrMostrarCliente(null,null);
    $arrayCliente = array();
    $arrayListaCliente = array();
    foreach($ventas as $key => $valorVenta)
    {
        foreach($cliente as $key => $valorcliente)
        {
            if($valorcliente["id"] == $valorVenta["id_cliente"])
            {
                //capturar los vendedores en un array
                array_push($arrayCliente,$valorcliente["nombre"]);
                //capturar los nombre y los valores netos en un mismo array
                $arrayListaCliente = array($valorcliente["nombre"] => $valorVenta["neto"]);
                 //Sumar los netos de cada vendedor
                foreach($arrayListaCliente as $key => $valor)
                    $sumaTotalCliente[$key] += $valor;
            }
        }
    }
    //Evitamos repetir nombre
    $noRepetirNombre = array_unique($arrayCliente);
?>
<!--======================================================== 
Vendedores
 ========================================================-->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Clientes</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart2" style="height: 300px"></div>
        </div>
    </div>
</div>

<script>
     //BAR CHART
     var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,
      data: [
        <?php
            foreach($noRepetirNombre as $valor)
            {
                echo "{y: '".$valor."', a: '".$sumaTotalCliente[$valor]."'},";
            }
        ?>
      ],
      barColors: ['#f6a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Ventas'],
      hideHover: 'auto',
      preUnits: '$'
    });
</script>