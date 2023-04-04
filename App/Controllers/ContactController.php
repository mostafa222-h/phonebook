<?php
namespace App\Controllers ;

use App\Models\Contact;
use App\Utilities\Validation;

class ContactController
{
    private $contactModel;
    public function __construct()
    {
        $this->contactModel = new Contact() ;
    }
    public function add()
    {
        global $request;
        $data['alreadyExists'] = false;
        # check if contacts number already exists => return and die
        $count = $this->contactModel->count(['mobile' => $request->input('mobile')]);
        if($count)
        {
            $data['alreadyExists'] = true;
            view('contact.add-result',$data);
            die();
        }
        
           # create new contact
           if(!Validation::is_valid_email( $request->input('email')))
           {
                $data['success'] = false ;
                $data['message'] = "Invalid Email Address" ;
                view('contact.add-result',$data);
                die();
           }
                $contact_id  = $this->contactModel->create([
                        'name' => $request->input('name') ,
                        'mobile' => $request->input('mobile') ,
                        'email' => $request->input('email')
                ]);
                $data['success'] = true ;
                $data['contact_id'] = $contact_id;
                $data['message'] = "contact with id  $contact_id   Created Successfully." ;
                
           

        
        
     
      view('contact.add-result',$data);
        
        
    }

    public function delete()
    {
        global $request ;
        $id = $request->get_route_param('id');
        $data['deleted_count'] = $this->contactModel->delete(['id' => $id]);
        view('contact.delete-result',$data);
    }
    
}
