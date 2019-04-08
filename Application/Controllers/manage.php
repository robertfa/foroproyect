<?php
loadModel('user');
if(!isset($_GET['method']) || isset($_GET['method']) && $_GET['method'] == 'home')
{

    $usu=getList($_SESSION['user']['tipo']);
   
    loadView('header');
    $params['usuario']=$usu; 

    loadView('manage/home',$params);

}
elseif($_GET['method'] == 'banear')
{
  
    banearUser($_GET['id']);

    header('Location: ./?controller=manage');
    loadView('header');
}

elseif($_GET['method'] == 'ascender')
{
  
    promocionarUser($_GET['id']);

    header('Location: ./?controller=manage');
    loadView('header');
}

?>