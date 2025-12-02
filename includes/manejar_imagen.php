<?php

function procesarImagen($inputName, $nombreProducto, $idProducto) {
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $extension = pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);
    $nombreLimpio = strtolower(
        preg_replace('/[^a-zA-Z0-9]+/', '-', $nombreProducto)

    );

    $nombreFinal = $nombreLimpio . '-' . $idProducto . '.' . $extension;
    $destino = __DIR__ . '/../src/images/' . $nombreFinal;

    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $destino)) {
        return $nombreFinal;

    }
    return null;
}
