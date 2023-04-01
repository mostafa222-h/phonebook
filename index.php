<?php

#front controller



include "bootstrap/init.php";
use App\Core\Routing\Router;
use App\Models\Product;
use App\Models\User;

$user_data = [
    'name' => "omid" ,
    'email' => "omid@gmail.com" ,
    'password' => 123456
] ;
$userModel = new User();
$result = $userModel->update(['name'=>'omiiiid'],['id'=>1]);
// $user = $userModel->getAll();
var_dump($result);

// $productModel = new Product();
// for($i = 1 ; $i <= 20 ; $i++)
// {
//     $productModel->create([
//         'id' => $i ,
//         'title' => "Product-$i",
//     ]);
// }

// $router = new Router();
// $router->run();



// try {
//     $connection= new \PDO("mysql:dbname={$_ENV['DB_NAME']};host={$_ENV['DB_HOST']}",$_ENV['DB_USER'],$_ENV['DB_PASS']) ;
//     $connection->exec("set names utf8;");
// }catch(PDOException $e){
//     echo('connection failed :' . $e->getMessage()); die();
// }

