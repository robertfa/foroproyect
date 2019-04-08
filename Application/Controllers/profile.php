<?php
loadModel('user');
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{
    $messages=array();
    $params=array();
     
    $tot = getdbc()->prepare('SELECT * FROM usuarios WHERE nick=:nick');
    $tot->execute(array(':nick' => $_SESSION['user']['username']));
    $uno= $tot->fetch();
        
    if(isset($_POST['enviar']))
    {  

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

        if(empty($messages))
            {     
            $filename=md5(uniqid()).'.'.$extension;
            move_uploaded_file($_FILES['avatar']['tmp_name'], getAppRoot().'/avatars/'.$filename);


            $param=array(
                ':nick' => htmlentities( $_SESSION['user']['username']) ,
                ':password' => htmlentities(md5($_POST['pass1'])),
                ':correo' => htmlentities($_POST['correo']),
                ':avatar' => $filename,
                ':firma' =>htmlentities( $_POST['firma'])
            );    

            dataUserChange($param);
           
//            header('Location: ./index.php');

            }
           
    }

 
    $params['messages']=$messages;
    $params['tot']=$uno;
    
    loadView('header');
    
    loadView('profile/home',$params);



}
 ?>
 