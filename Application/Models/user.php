<?php

function getUser($id)
{
    
    $user=getdbc()->prepare('SELECT id, nick,tipo FROM usuarios WHERE id=:id');
    $user->execute(array(':id' => $id));
    return $user->fetch();
}

function getUserName($id)
{
    
    $user=getdbc()->prepare('SELECT id, nick FROM usuarios WHERE id=:id');
    $user->execute(array(':id' => $id));
    return $user->fetch();
}

function existUser($nick)
{
    $repetir = getdbc()->prepare('SELECT count(id) as total FROM usuarios WHERE nick=:nick');
    $repetir->execute(array(':nick' => $nick));
    $rsRepetir = $repetir->fetch();
    return  $rsRepetir->total;


}
  
function getAvatar($id)
{
    $user=getdbc()->prepare('SELECT avatar FROM usuarios WHERE id=:id');
    $user->execute(array(':id' => $id));
    $torna=$user->fetch();
    return $torna->avatar;
}

function CreateUser($params)
{
    $conn = getdbc()->prepare('INSERT INTO usuarios(nick, password,correo,fechaderegistro,avatar,firma) VALUES (:nick, :password,:correo,:fechaderegistro,:avatar,:firma)');
    $conn->execute($params);


}

function loginUser($params)
{
    $user = getdbc()->prepare('SELECT id, nick,tipo FROM usuarios WHERE nick = :username AND password = :password');
    $user->execute($params);
    return $user->fetch();

}
function getList($sesion)
{
    $usu = getdbc()->prepare('SELECT id,nick,tipo,fechaderegistro,activo FROM usuarios WHERE tipo < :usertipo');
    $usu->execute(array(':usertipo' => $sesion));
    return $usu->fetchAll();


}

function banearUser($id)
{
    $conn = getdbc()->prepare('UPDATE usuarios SET activo= NOT activo WHERE id = :id');
    $conn->execute(array(':id' => $id));

}

function promocionarUser($id)
{
    $conn = getdbc()->prepare('UPDATE usuarios SET tipo= NOT tipo WHERE id = :id');
    $conn->execute(array(':id' => $id));

}

function dataUserChange($params)
{
    $conn = getdbc()->prepare('UPDATE usuarios SET nick=:nick, password=:password,correo=:correo,avatar=:avatar,firma=:firma WHERE nick = :nick');
    $conn->execute($params);



}