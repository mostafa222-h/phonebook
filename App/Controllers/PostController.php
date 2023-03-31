<?php
namespace App\Controllers ;

class PostController
{
    public function single()
    {
        //echo "aaaa";die();
      global $request ;
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