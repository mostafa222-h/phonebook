<?php
namespace App\Utilities ;



class Validation 
{
    public static function is_valid_email(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return false ;


        return true ;    
        
    }

    public static function is_valid_fullname(string $fullname)
    {
        return strContains(trim($fullname) , ' ') && strlen ($fullname) > 10 ;
    }

    public static function is_strong_password(string $password)
    {
        $lengthCheck = (strlen($password)>= 8) ? 1 : 0;
        $lettersCheck = preg_match('/[a-zA-z]/',$password);
        $digitsCheck = preg_match('/\d/',$password);
        return ($lengthCheck && $lettersCheck && $digitsCheck);
    }
}