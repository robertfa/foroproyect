<?php

function categoryCreate($params)
{
    $conn =getdbc()->prepare('INSERT INTO categorias(nombre,descripcion) VALUES (:titulo, :descripcion)');
    $conn->execute($params);


}




  ?>