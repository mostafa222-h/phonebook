<?php
namespace App\Controllers ;
use App\Models\User;

class PostController
{
    public function single()
    { 
      global $request ;
      // echo "aaaa";die();
     
      $user = new User(4);
     // $result = $user->remove();


      $user->name = 'Sara' ;
      $user->save();


      
      var_dump($user->getAttributes());
      //nice_dump($request);die();
    
      $slug =  $request->get_route_param('slug');
      
      echo "slug: $slug";
    }
    public function comment()
    {
      global $request ;
      $cid = $request->get_route_param('cid');
      echo "comment_id: $cid";
    }
}