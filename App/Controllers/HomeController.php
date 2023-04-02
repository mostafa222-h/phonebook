<?php
namespace App\Controllers ;

use App\Models\Contact;

class HomeController
{
    private $contactModel;
    public function __construct()
    {
        $this->contactModel = new Contact() ;
    }
    public function index()
    {
        
       

        $data = [
            'contacts' => $this->contactModel->getAll() 

        ];
        view('home.index',$data);
        echo "Hi From HomeController Of Phonebook" ;
    }
}


 // $faker = \Faker\Factory::create();
       
        // echo $faker->name();
        // echo $faker->email();
        // echo $faker->phoneNumber();
        // for($i = 0 ; $i <1000 ; $i++)
        // {
        //     $this->contactModel->create([
        //         'name' => $faker->name() ,
        //         'mobile' =>  $faker->phoneNumber(),
        //         'email' =>  $faker->email()
                
        //     ]);
        // }
