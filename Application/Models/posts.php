<?php


function modificarPosts($coment,$id)
{
    $conn = getdbc()->prepare('UPDATE posts SET comentario=:comentario WHERE id = :identificador');
          
    $conn->execute(array(':comentario' => $coment,':identificador' =>   $id ));
    

}


function eliminarPostsLive($id)
{

    $conn =getdbc()->prepare('DELETE FROM posts WHERE id=:id');
    $conn->execute(array(':id'=> $id));

}

function seleccionarPost($id)
{
    $posts =getdbc()->prepare('SELECT id_usuario FROM posts WHERE id=:id');
    $posts->execute(array(':id'=> $_GET['id']));
    return $posts->fetch();

}




function seleccionarTodosPost($id,$empieza,$por_pagina)
{

    $sql="SELECT id,id_temas,id_usuario,comentario,fecha
            FROM posts 
            WHERE id_temas =:getid ORDER BY fecha ASC LIMIT $empieza,$por_pagina";
    $result=getdbc()->prepare($sql);
    $result->execute(array(':getid'=> $id));
    return $result->fetchAll(PDO::FETCH_OBJ);

}

function crearPosts($params)
{
    $conn =getdbc()->prepare('INSERT INTO posts(id_temas,id_usuario,comentario) VALUES (:id_temas,:id_usuario,:comentario)');
    $conn->execute($params);  

}

function seleccionarTodosPostLive($id)
{
    $sql='SELECT id,id_temas,id_usuario,comentario,fecha
            FROM posts 
            WHERE id_temas =:getid ORDER BY fecha DESC LIMIT 10';
    $result=getdbc()->prepare($sql);
    $result->execute(array(':getid'=> $id));
    return $result->fetchAll(PDO::FETCH_OBJ);

}


function totalPost($id)
{
    $sql='SELECT id,id_temas,id_usuario,comentario,fecha
    FROM posts 
    WHERE id_temas =:getid';
    $result=getdbc()->prepare($sql);
    $result->execute(array(':getid'=> $id));
    return $result->rowCount();


}











?>