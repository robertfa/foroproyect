<?php
  loadModel('category');    
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{
    loadModel('user');
    
    //$user= getUserName(1);
    //echo $user->nick;
    loadView('header');
    loadView('index/home');
}


elseif($_GET['method'] == 'newCategory')
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
                if(isLoggedIn() && $_SESSION['user']['tipo'] == 2)
                {
                $param=array(
                    ':titulo' => htmlentities($_POST['titulo']) ,
                    ':descripcion' => htmlentities($_POST['descripcion'])
                    );
                
                categoryCreate($param);
                
                header('Location: ./');
                }

            }
            
          
        }
    
    loadView('header'); 
    loadView('index/newCategory');
    
}
?>