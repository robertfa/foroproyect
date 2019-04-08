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
        <?php
        $tema=$params['tema'];
        $user=getUser($tema->id_usuario);
        if(isLoggedIn())
        {   
        ?>   
            
            <div>
             <a class="btn blue" href="#reply"> responder </a>
             </div>
         <?php
       
        if(isLoggedIn() && $_SESSION['user']['id'] == $tema->id_usuario || isLoggedIn() && $_SESSION['user']['tipo'] >= '1')
        {
         ?>
             <div>
                <a  class="btn blue" href="./?controller=threads&method=eliminarthread&id=<?= $tema->id?>"> Eliminar Tema </a>
             </div>
        <?php
        }
        echo "<br/>";echo "<br/>";
        ?>
        
        
       <?php
        }
           
            $avatar=getAvatar($tema->id_usuario);

            echo '<div class="comments-container clearfix">';


                echo "<div class='comment'>";
                    echo '<div class="commentsTitulo">';
                         echo $tema->titulo;
                    echo "</div>";

                    echo "<div>";
                         echo $tema->fecha;
                    echo "</div>";
                    echo "<div class='contenido'>";
                         echo  nl2br($tema->contenido);
                    echo "</div>";
                echo "</div>";
                
                echo '<div class="commentsNick">';
                    echo '<div class="commentsAvatar">';
                        echo '<img src="./avatars/'.$avatar.'">';
                      //  echo "</div>";
                        echo '<div>Autor:        '.$user->nick.'</div>';  
                    echo "</div>";
                echo "</div>";

            
            echo "</div>";
        
         
        foreach($params['comentaris'] as $comentari)
        {
           $avatar=getAvatar($comentari->id_usuario);
           echo '<div class="comments-container clearfix">';
           $user=getUser($comentari->id_usuario);

        echo "<div class='comment'>";
            echo "<div class='contenido'>";
                echo "<div>";
                    echo $comentari->fecha;
                echo "</div>";
                
                echo "<div class='mensage'>";
                echo "<div id='mensaje$comentari->id'>".nl2br($comentari->comentario)."</div>"  ;
                echo "</div>";


            echo "<div id='editar$comentari->id'></div>";
            
            
            if(isLoggedIn() && $_SESSION['user']['id'] == $comentari->id_usuario)
            {
                            
                 
              ?>
            
              <a class="btn small blue" href="" id="editando<?= $comentari->id?>" class="editar" onclick="editar(<?= $comentari->id?>,event)">Editar</a>
 
              
            
            <?php
            }
           if(isLoggedIn() && $_SESSION['user']['id'] == $comentari->id_usuario || isLoggedIn() && $_SESSION['user']['tipo'] >= '1')
           {
             ?>
             
             <a  class="btn small blue" href="./?controller=threads&method=eliminarcomments&id=<?= $comentari->id?>&ruta=<?= $tema->id?>"> Eliminar </a>
           
            

             <?php
           }
          
          
              echo "</div>";
              echo "</div>";
          
           echo '<div class="commentsNick">';
                echo '<div class="commentsAvatar">';
                    echo '<img src="./avatars/'.$avatar.'">';
       
                    echo '<div>Autor:        '.$user->nick.'</div>';  
                echo "</div>";
            echo "</div>";
              echo "<br/>";echo "<br/>";

        echo "</div>";
        }
        
        ?>

    <script language="JavaScript">
        
        function editar(objecte,event)
        {
            
            if(!document.getElementById('texto'+objecte))
            {
               document.getElementById("mensaje"+objecte).style.display="none";
                var nom="editar"+objecte;
                
                var botoeditar="editando"+objecte;
                
                console.log(botoeditar);

                document.getElementById("editando"+objecte).style.display="none";



                var editar=document.getElementById(nom);
               

                var modificar = document.createElement('textarea');
                            modificar.setAttribute('id', 'texto'+objecte);
                            modificar.innerHTML=document.getElementById('mensaje'+objecte).innerHTML;
                            editar.appendChild(modificar);

                var boto = document.createElement('button');
                            boto.setAttribute('id','enviar'+objecte);
                            boto.setAttribute('class','btn small blue');
                            boto.appendChild(document.createTextNode('modificar'));
                            editar.appendChild(boto);

                document.getElementById('enviar'+objecte).addEventListener('click', function()
			    {
                    //alert("dfsdfs");
                    
                    if(window.XMLHttpRequest)
                    {
                        xhr=new XMLHttpRequest();
                    }
                    else if(window.activeXObject)
                    {
                        xhr= new activeXObject("Microsoft.XMLHTTP");
                    
                    }

                    var comentari=document.getElementById('texto'+objecte).value;
                    var identificador=objecte;
                   
                    var ruta='./?controller=threads&method=modificarcomments&comentario='+comentari+'&identificador='+identificador;
                    xhr.open('GET',ruta, true);
                
                    xhr.send(null);
                    
                    editar.removeChild(document.getElementById('texto'+objecte));
                    editar.removeChild(document.getElementById('enviar'+objecte));


                   // document.getElementById("editar"+objecte).style.display="none";

                    document.getElementById('mensaje'+objecte).innerHTML=comentari;
                    document.getElementById("mensaje"+objecte).style.display="block";


                    document.getElementById("editando"+objecte).style.display="block";
                });
                

            }
           
            event.preventDefault();
        }

    </script>        
        

    <?php
        
        $por_pagina=10;
        $tema= $tema->id;

        $total_registros=$params['total'];
        
        $total_paginas=ceil($total_registros/ $por_pagina);

        echo '<center> <a href="./?controller=threads&method=comments&id='.$tema.'&pagina=1"> << </a>';
        
            for($i=1;$i<= $total_paginas;$i++)
            {
                echo '<a href="./?controller=threads&method=comments&id='.$tema.'&pagina='.$i.'">'. $i.' </a>';


            }
        
        
        echo ' <a href="./?controller=threads&method=comments&id='.$tema.'&pagina='.$total_paginas.'"> >> </a></center>';

    ?>

