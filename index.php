<?php

#front controller



include "bootstrap/init.php";
use App\Core\Routing\Router;
use App\Models\Product;
use App\Models\User;

$router = new Router();
$router->run();



// try {
//     $connection= new \PDO("mysql:dbname={$_ENV['DB_NAME']};host={$_ENV['DB_HOST']}",$_ENV['DB_USER'],$_ENV['DB_PASS']) ;
//     $connection->exec("set names utf8;");
// }catch(PDOException $e){
//     echo('connection failed :' . $e->getMessage()); die();
// }

