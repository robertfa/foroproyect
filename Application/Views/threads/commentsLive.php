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
    <body onload="load()">
    <h1>Tema modo LIVE</h1>
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
                     echo nl2br($tema->contenido);
                echo "</div>";
            echo "</div>";
            
            echo '<div class="commentsNick">';
                echo '<div class="commentsAvatar">';
                    echo '<img src="./avatars/'.$avatar.'">';
            
                    echo '<div>Autor:        '.$user->nick.'</div>';  
                echo "</div>";
            echo "</div>";

        
        echo "</div>";
    
        ?>

        <div id="comentarisLive">
        
        </div> 
        

     

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
                    


                    document.getElementById("editar"+objecte).style.display="none";

                    document.getElementById('mensaje'+objecte).innerHTML=comentari;
                    document.getElementById("mensaje"+objecte).style.display="block";
                    document.getElementById("editando"+objecte).style.display="block";
                });
            }
           
            event.preventDefault();
        }    

        
        function load()
        {        
            
                    if(window.XMLHttpRequest)
                    {
                        xhr=new XMLHttpRequest();
                    }
                    else if(window.activeXObject)
                    {
                        xhr= new activeXObject("Microsoft.XMLHTTP");
                    
                    }

                    xhr.onreadystatechange = function()
                    {
                        if(xhr.readyState == 4)
                        {
                            
                            if(xhr.status == 200)
                            {
                                
                            // alert(xhr.responseText);

                            document.getElementById('comentarisLive').innerHTML =xhr.responseText;
                                

                                
                            }
                            else
                            {
                                alert("error"+ xhr.statusText);
                            }
                        }
                        
                        
                    }

                    var ruta="./?controller=threads&method=commentsLiveData&id=<?= $tema->id ?>";
                    xhr.open('GET',ruta, true);
                
                    xhr.send(null);

                    setTimeout("load()", 5000);
        }


          

    </script>        
        
    </body>
</html>


