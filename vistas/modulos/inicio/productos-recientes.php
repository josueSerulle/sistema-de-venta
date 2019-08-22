<?php
    $productos = ControladorProductos::ctrMostrasProductos(null,null,"idReciente");
?>
<!-- PRODUCT LIST -->
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Productos Agregados Recientemente</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
                for($i = 0; $i < 10; $i++)
                {
                    if($productos[$i]["imagen"] == null)
                        $imagen = "vistas/imagenes/productos/default/anonymous.png";
                    else
                        $imagen = $productos[$i]["imagen"];

                    echo '<li class="item">
                        <div class="product-img">
                            
                            <img src="'.$imagen.'" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="" class="product-title">
                                '.$productos[$i]["descripcion"].'
                                <span class="label label-warning pull-right">
                                    $'.$productos[$i]["precio_venta"].'
                                </span>
                            </a>
                        </div>
                    </li>';
                }
            ?>
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="producto" class="uppercase">Ver todos los Productos</a>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->