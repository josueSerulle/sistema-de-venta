<?php
    $ventas = ControladorVenta::ctrMostrarVenta(null,null,null);
    $usuarios = ControladorUsuario::ctrMostrarUsuarios(null,null);
    $arrayVendedores = array();
    $arrayListasVendedores = array();
    foreach($ventas as $key => $valorVenta)
    {
        foreach($usuarios as $key => $valorUsuarios)
        {
            if($valorUsuarios["id"] == $valorVenta["id_vendedor"])
            {
                //capturar los vendedores en un array
                array_push($arrayVendedores,$valorUsuarios["Nombre"]);
                //capturar los nombre y los valores netos en un mismo array
                $arrayListasVendedores = array($valorUsuarios["Nombre"] => $valorVenta["neto"]);
                  //Sumar los netos de cada vendedor
                foreach($arrayListasVendedores as $key => $valor)
                    $sumaTotalVendedores[$key] += $valor;
            }
        }
    }
    //Evitamos repetir nombre
    $noRepetirNombre = array_unique($arrayVendedores);
?>
<!--======================================================== 
Vendedores
 ========================================================-->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Vendedores</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart1" style="height: 300px"></div>
        </div>
    </div>
</div>

<script>
     //BAR CHART
     var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [
        <?php
            foreach($noRepetirNombre as $valor)
            {
                echo "{y: '".$valor."', a: '".$sumaTotalVendedores[$valor]."'},";
            }
        ?>
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Ventas'],
      hideHover: 'auto',
      preUnits: '$'
    });
</script>