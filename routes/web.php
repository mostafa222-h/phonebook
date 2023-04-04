<?php
use App\Core\Routing\Route;
use App\Middleware\BlockFireFox;
use App\Middleware\BlockIE;

Route::get('/','HomeController@index');


Route::post('/contact/add','ContactController@add');

Route::get('/contact/delete/{id}','ContactController@delete');
// Route::get('/post/{slug}','PostController@single');
// Route::get('/post/{slug}/comment/{cid}','PostController@comment');
// Route::get('/todo/list','TodoController@list',[BlockFireFox::class,BlockIE::class]);
// Route::get('/todo/add','TodoController@add');
// Route::get('/todo/remove','TodoController@remove');
// Route::get('/archive','ArchiveController@index');
// Route::get('/archive/articles','ArchiveController@articles');
// Route::get('/archive/products','ArchiveController@products');
// Route::add(['get','post'],'/a',function(){
//         echo "welcome" ;
// });
// Route::get('/b',function(){
//     view('archive.index') ;
// });
// Route::put('/c',['Controller','Method']);
// Route::get('/d','Controller@Method');






