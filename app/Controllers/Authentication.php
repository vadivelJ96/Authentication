<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Authentication extends BaseController
{
    public function index()
    {
         return view('login');  
    }

    public function login(){
        $session = session();
        $userModel=new UserModel();
 
        $email=$this->request->getVar('email');
        $password=$this->request->getVar('password');

        $user=$userModel->where('email',$email)->first();

        if(is_null($user)){
            return redirect()->back()->withInput()->with('error','Invalid username');
        }

        if($user['status']=='inactive'){
            return redirect()->back()->withInput()->with('error','user is deactivated..!!');
        }

        $pwd_verify=password_verify($password,$user['password']);
        if(!$pwd_verify){
            return redirect()->back()->withInput()->with('error','Invalid password');
        }
    
        $_session_data=[
            'isLoggedIn'=>TRUE,
            'user'=>$user,
        ];

        $session->set($_session_data);

        return redirect()->to('/dashboard');
    }

    public function logout(){
        session_destroy();
        return redirect()->to('/login');
    }


    public function registerView(){
        return view('register');
    }

    public function register(){
  
        $rules = [
            'username' => ['rules' => 'required|min_length[3]|max_length[30]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password' => ['label' => 'confirm password', 'rules' => 'matches[password]']
        ];
        
       

        if($this->validate($rules)){
            $model=new UserModel();
            $data=[
                'user_name'=>$this->request->getVar('username'),
                'email' => $this -> request -> getVar('email'),
                'password'=> password_hash($this->request->getVar('password'),PASSWORD_DEFAULT)
            ];
           
            $model->save($data);
            return redirect()->to('/login');

        }else{
            return redirect()
            ->back()
            ->withInput()
            ->with('validation', $this->validator)
            ->with('error', 'Validation failed..!!');
           

        }
    }


}
