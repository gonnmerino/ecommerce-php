<?php

  $nuevoNombre = trim($_POST['nombre']);

  $fechaHoraActual = date('YmdHis');

  $SKU = $nuevoNombre . $fechaHoraActual;

  echo $SKU;

  //$SKU = 

?>