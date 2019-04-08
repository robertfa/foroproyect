<?php
  loadModel('category');      
  if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
    {      
        if(isset($_POST['enviar']))
        {   
            //$messages = [];

            if(empty($_POST['titulo']))
            {

                $messages[] =  'introduce un Titulo';

            }

            elseif(empty($_POST['descripcion']))
            {

                $messages[] = 'introduce la descripcion';

            }

            else
            {
               
                
                $param=array(
                    ':titulo' => $_POST['titulo'] ,
                    ':descripcion' => $_POST['descripcion'])
                    );
                
                categoryCreate($param);


                header('Location: Controllers/index.php');
               

            }
            
          
        }
        
         loadView('header');
    
         loadView('categorias/home');
        
    }
      
        ?>
