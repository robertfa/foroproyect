<?php

function mostrarTemas($id,$empieza,$por_pagina)
{
    $sql="SELECT t.id as temasId,t.titulo,t.fecha,u.id as userId,u.nick,t.tipo
            FROM temas t
            JOIN usuarios u ON u.id=t.id_usuario
            WHERE id_categoria =:getid ORDER BY fecha ASC LIMIT $empieza,$por_pagina";

     $result=getdbc()->prepare($sql);
     $result->execute(array(':getid'=> $id));
     return $result->fetchAll(PDO::FETCH_OBJ);


}

function totalTemas($id)
{
    $sql='SELECT t.id as temasId,t.titulo,t.fecha,u.id as userId,u.nick,t.tipo
            FROM temas t
            JOIN usuarios u ON u.id=t.id_usuario
            WHERE id_categoria =:getid';
    $result=getdbc()->prepare($sql);
    $result->execute(array(':getid'=> $id));
    return $result->rowCount();
}


function crearTemas($params)
{
    $conn =getdbc()->prepare('INSERT INTO temas(id_categoria,titulo,contenido,fecha,id_usuario,tipo) VALUES (:idcategoria,:titulo,:contenido,:fecha,:idusu,:tipo)');
    $conn->execute($params);


}

function crearTemasLive($params)
{
    $conn =getdbc()->prepare('INSERT INTO temas(id_categoria,titulo,contenido,fecha,id_usuario,tipo) VALUES (:idcategoria,:titulo,:contenido,:fecha,:idusu,:tipo)');
    $conn->execute($params);           
}

function seleccionarTemas($id)
{

    $tema =getdbc()->prepare('SELECT id_usuario FROM temas WHERE id=:id');
    $tema->execute(array(':id'=> $id));
    return $tema->fetch();


}
function eliminarTemas($id)
{
    $conn =getdbc()->prepare('DELETE FROM temas WHERE id=:id');
    $conn->execute(array(':id'=> $id));

}

function seleccionarTemaDatos($id)
{
    
    $sql='SELECT id,id_categoria,titulo,contenido,fecha,id_usuario
    FROM temas 
    WHERE id =:getid';
    $result=getdbc()->prepare($sql);
    $result->execute(array(':getid'=> $id));
    return $result->fetch(PDO::FETCH_OBJ);
}





































?>