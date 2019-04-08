<?php
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{

        $sql='SELECT t.id as temasId,t.titulo,t.fecha,u.id as userId,u.nick
            FROM temas t
            LEFT JOIN posts p ON p.id_temas=t.id
            JOIN usuarios u ON u.id=t.id_usuario
            WHERE titulo LIKE :post OR comentario LIKE :post GROUP BY t.id';
        $result=getdbc()->prepare($sql);
        $result->execute(array(':post'=> '%'.$_POST['buscador'].'%'));
        $temas=$result->fetchAll(PDO::FETCH_OBJ);
      
        $params['temas']=$temas;
        loadView('header');
       
        loadView('search/home',$params);
       
       
        
}

 ?>
    