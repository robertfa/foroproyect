<?php

loadModel('temas');  
loadModel('posts');   
loadModel('user');   
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{
        //Muestra los Temas de la Categoria seleccionada

      
        
       // $temas=mostrarTemas($_GET['category']);


        $por_pagina=15;


        if(isset($_GET['pagina']))
        {
            $pagina=$_GET['pagina'];
    
        }
        else
        {
            $pagina=1;
        }
    

        $empieza=($pagina-1) * $por_pagina;
    
        
        $temas=mostrarTemas($_GET['category'],$empieza,$por_pagina);
    
        $params['temas']=$temas;
        
        $total_registros=totalTemas($_GET['category']);
        
        
        $params['total']=$total_registros;

       

       loadView('header');
       
       loadView('threads/home',$params);
       
       
        
}
elseif($_GET['method'] == 'newThreads')
{
    // Crear un nuevo Tema

     if(isset($_POST['enviar']))
        {   
            //$messages = [];

            if(empty($_POST['titulo']))
            {

                $messages[] =  'introduce un Titulo';

            }

            elseif(empty($_POST['contenido']))
            {

                $messages[] = 'introduce contenido';

            }

            else
            {
                $fecha = date("Y-m-d");
                
                $param=array(':idcategoria'=> $_GET['category'],
                    ':titulo' => $_POST['titulo'],
                    ':contenido' => $_POST['contenido'],
                    ':fecha'=> $fecha,':idusu'=> $_SESSION['user']['id'],
                    ':tipo'=> '0'
                );

                crearTemas($param);



                header('Location: ./?controller=threads&category='.$_GET['category']);
               

            }
            
          
        }
        
         loadView('header');
         loadView('threads/newThreads');
    
    
    
    
    
}
elseif($_GET['method'] == 'newThreadsLive')
{
    // Crear un nuevo Tema

     if(isset($_POST['enviar']))
        {   
            //$messages = [];

            if(empty($_POST['titulo']))
            {

                $messages[] =  'introduce un Titulo';

            }

            elseif(empty($_POST['contenido']))
            {

                $messages[] = 'introduce contenido';

            }

            else
            {
                $fecha = date("Y-m-d");

                
                
                $param=array(':idcategoria'=> $_GET['category'],
                    ':titulo' =>htmlentities( $_POST['titulo']),
                    ':contenido' => htmlentities($_POST['contenido']),
                    ':fecha'=> $fecha,
                    ':idusu'=> $_SESSION['user']['id'],
                    ':tipo'=> '1'
                );

                crearTemasLive($param);



                header('Location: ./?controller=threads&category='.$_GET['category']);
               

            }
            
          
        }
        
         loadView('header');
         loadView('threads/newThreads');
    
    
    
    
    
}
elseif($_GET['method'] == 'comments')
{
   
 
    $params['tema']=seleccionarTemaDatos( $_GET['id']);
      
    
    $por_pagina=10;


    if(isset($_GET['pagina']))
    {
        $pagina=$_GET['pagina'];

    }
    else
    {
        $pagina=1;
    }

    $empieza=($pagina-1) * $por_pagina;

    
    $comentaris=seleccionarTodosPost($_GET['id'],$empieza,$por_pagina);

    $params['comentaris']=$comentaris;
     
    
    $total_registros=totalPost($_GET['id']);
    
    
    $params['total']=$total_registros;
     

       if(isset($_POST['enviar']))
        {   
            //$messages = [];

            if(empty($_POST['comentario']))
            {

                $messages[] =  'introduce un Comentario';

            }

            else
            {
                
                //$fecha = date("Y-m-d");
                
                $param=array(
                    ':id_temas'=> $_GET['id'],
                    ':id_usuario'=> $_SESSION['user']['id'],
                    ':comentario' => htmlentities($_POST['comentario'])
                );
                crearPosts($param);


                header('Location: ./?controller=threads&method=comments&id='.$_GET['id'].'&pagina='.$pagina);
                
                
               

            }
            
          
        }
    
    

     loadView('header');
     loadView('threads/comments',$params);
     loadView('threads/newComments');
    
    
}
elseif($_GET['method'] == 'commentsLive')
{

    $params['tema']=seleccionarTemaDatos( $_GET['id']);
  
    
    
     
    
    $comentaris=seleccionarTodosPostLive( $_GET['id']);

     $params['comentaris']=$comentaris;
     
     
       if(isset($_POST['enviar']))
        {   
            //$messages = [];

            if(empty($_POST['comentario']))
            {

                $messages[] =  'introduce un Comentario';

            }

            else
            {
                
                //$fecha = date("Y-m-d");
                // $fecha = date("Y-m-d H:i:s"); 
                //$fecha = time();
                $param=array(
                    ':id_temas'=> $_GET['id'],
                    ':id_usuario'=> $_SESSION['user']['id'],
                    ':comentario' => htmlentities($_POST['comentario'])
                );
                crearPosts($param);
                



            header('Location: ./?controller=threads&method=commentsLive&id='.$_GET['id']);
               

            }
            
          
        }

       
     loadView('header');
     loadView('threads/commentsLive',$params);
     loadView('threads/newComments');
     
    
}
elseif($_GET['method'] == 'commentsLiveData')
{
    
   
    $params['tema']=seleccionarTemaDatos( $_GET['id']);
    
      
    
    $comentaris=seleccionarTodosPostLive( $_GET['id']);
    
     $params['comentaris']=$comentaris;

     loadView('threads/commentsLiveData',$params);

}

elseif($_GET['method'] == 'eliminarthread')
{
   
    
    $tema=seleccionarTemas($_GET['id']);

    if($_SESSION['user']['id'] == $tema->id_usuario || $_SESSION['user']['tipo'] >= '1')
    {
        

        eliminarTemas($_GET['id']);
        
    }
    
    header('Location: ./?controller=index');
}

elseif($_GET['method'] == 'eliminarcomments')
{
    
    $posts=seleccionarPost($_GET['id']);
    

    if($_SESSION['user']['id'] == $posts->id_usuario || $_SESSION['user']['tipo'] >= '1')
    {
    
        eliminarPostsLive($_GET['id']);
        
    }
  
  // header('Location: $_GET["ruta"])');
    header('Location: ./?controller=threads&method=comments&id='.$_GET["ruta"].'');
}
elseif($_GET['method'] == 'eliminarcommentsLive')
{
    $posts=seleccionarPost($_GET['id']);
    

    if($_SESSION['user']['id'] == $posts->id_usuario || $_SESSION['user']['tipo'] >= '1')
    {
    
        eliminarPostsLive($_GET['id']);
        

        
    }
  
  // header('Location: $_GET["ruta"])');
    header('Location: ./?controller=threads&method=commentsLive&id='.$_GET["ruta"].'');
}
elseif($_GET['method'] == 'modificarcomments')
{
    
        modificarPosts($_GET['comentario'], $_GET['identificador']);

}   
    ?>


