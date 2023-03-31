<?php

namespace App\Controllers;

class TodoController
{
    public function list()
    {
        $tasks = ['First Task','Second Task','Third Task'] ;
        $data = [
            'tasks' => $tasks ,
        ] ;
        view('todo.list',$data) ;
    }
}