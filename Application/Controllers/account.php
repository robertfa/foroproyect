<?php
loadModel('user');
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{
    header('location:./index.php');
}

elseif($_GET['method'] == 'register')
{
    $messages=array();
    $params=array();
     
    if(isset($_POST['enviar']))
    {

        if(empty($_POST['nick'])){

            $messages[] =  '- introduce un nombre de usuario';

        }

          if(empty($_POST['pass1'])){

            $messages[] = '- introduce la contraseña';

        }

        if(empty($_POST['pass2'])){

            $messages[] =  '- repita la contraseña';

        }

        if($_POST['pass1'] != $_POST['pass2']){

           $messages[] =  '- Las contraseñas no coinciden';


        }
        $extension=pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
       
        if(!in_array($extension,array('png','jpg','jpeg')))
         {
                 $messages[] = '- La extension del archivo es incorrecta.';
         }
            
       if(existUser($_POST['nick'])){

          $messages[] = '- El usuario que ha introducido ya esta en uso';



        } 
        if(empty($messages))
         {     
            $fecha = date("Y-m-d");
            $filename=md5(uniqid()).'.'.$extension;
            move_uploaded_file($_FILES['avatar']['tmp_name'], getAppRoot().'/avatars/'.$filename);

         
            $param=array(
                ':nick' => htmlentities($_POST['nick']) ,
                ':password' => htmlentities(md5($_POST['pass1'])),
                ':correo' =>htmlentities( $_POST['correo']),
                ':fechaderegistro' => $fecha,
                ':avatar' => $filename,
                ':firma' => $_POST['firma']
            );


            CreateUser($param);
            
            header('Location: ./index.php');



         }
           
    }
    $params['messages']=$messages; 
    loadView('header');
    
    loadView('account/register',$params);
}       

elseif($_GET['method'] == 'login')
{
      $messages=array();
      $params=array();
      
      if(isset($_POST['enviar']))
        {   

            $param=array(
                ':username' => $_POST['username'],
                ':password' => md5($_POST['password'])
            );
           
            
            $rsUser =loginUser($param);

            if(empty($_POST['username']))
            {
                $messages[] = '- Introduce tu nombre de usuario.';
            }

            if(empty($_POST['password']))
            {
                $messages[] = '- Introduce tu contraseña.';
            }
           
            if(!$rsUser)
            {
                $messages[] = '- El usuario o contraseña son incorrectos.';
            }

            if(empty($messages))
            {
                $_SESSION['user'] = array(
                    'id' => $rsUser->id,
                    'username' => $rsUser->nick,
                    'tipo' => $rsUser->tipo
                );

                header('Location: ./index.php');
            }
        }
    loadView('header');
    
    $params['messages']=$messages; 
    loadView('account/login',$params);
    
}
elseif($_GET['method'] == 'logout')
{
    if(isLoggedIn())
    {
    session_destroy();
    }
    header('Location: ./?controller=login');
    loadView('header');
}

?>
 
