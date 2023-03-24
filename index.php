<?php

#front controller

//echo "frontControlleradefa" ;
include "vendor/autoload.php";
use App\Core\Request;


echo $_SERVER['REQUEST_URI'];


new Request();