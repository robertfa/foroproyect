<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="forum-container">
            <div class="forum-row head">
                <div class="forum-column">   
                Categorias
                </div>
            </div>
        <div id="category-container">
        <?php
	
        $sql='SELECT * FROM categorias';
        $result=getdbc()->query($sql);
        $categorias=$result->fetchAll(PDO::FETCH_OBJ);
        
        foreach($categorias as $categoria)
        {
            $id = $categoria->id;
            $titulo = $categoria->nombre;
            $descripcion = $categoria->descripcion;
		echo '<div class="forum-row">';
                    echo '<div class="forum-column">';
			echo "<div class='title'><a href='./?controller=threads&category=$id'>$titulo</a></div>";
			echo "<div class='description'> $descripcion </div>";
                        
                    echo '</div>';
		echo '</div>';
            
            
        }
         ?> 
         </div>
        </div>
        <?php
        if(isLoggedIn() && $_SESSION['user']['tipo'] == 2)
        {
        ?>   
            <div class="forum-buttons">
                <a href="./?controller=index&method=newCategory" class="btn blue"> nueva categoria </a>
            </div>

       <?php
        }
         ?>
    </div>