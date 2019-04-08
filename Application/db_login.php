<?php
$config['DB_HOST'] = 'localhost';
$config['DB_NAME'] = 'foroproyect';
$config['DB_USER'] = 'root';
$config['DB_PASS'] = '';

try
{
    $dbc = new PDO('mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_NAME'], $config['DB_USER'], $config['DB_PASS'],
        array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8"
        )
    );
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


?>