<?php
    $venta = ControladorVenta::ctrSumaTotalVentas();
    $totalCategoria = count(ContrladorCategorias::ctrMostrarCategoria(null,null));
    $totalCliente = count(ControladorCliente::ctrMostrarCliente(null,null));
    $totalProductos = count(ControladorProductos::ctrMostrasProductos(null,null,"id"));
?>
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3><?php echo number_format($venta["total"]); ?></h3>
            <p>Ventas</p>
        </div>
        <div class="icon">
            <i class="ion ion-social-usd"></i>
        </div>
        <a href="administrar-ventas" class="small-box-footer">
            Mas INFO
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?php echo number_format($totalCategoria); ?></h3>
            <p>Categorias</p>
        </div>
        <div class="icon">
            <i class="ion ion-clipboard"></i>
        </div>
        <a href="categorias" class="small-box-footer">
            Mas INFO 
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<!-- ./col -->
 <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo number_format($totalCliente); ?></h3>
            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="cliente" class="small-box-footer">
            Mas INFO
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
            <h3><?php echo number_format($totalProductos); ?></h3>
            <p>Productos</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-cart"></i>
        </div>
        <a href="producto" class="small-box-footer">
            Mas INFO
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<!-- ./col -->