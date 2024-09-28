<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CountryModel;
use App\Models\StateModel;
use App\Models\CityModel;


class User extends BaseController
{

    protected $userModel;

    protected $countryModel;

    protected $stateModel;

    protected $cityModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
        $this->countryModel = new CountryModel();
        $this->stateModel = new StateModel();
        $this->cityModel = new CityModel();
    }


    public function index()
    {
        $users = $this->userModel->getUsersWithLocation();
        $data['users'] = $users;
        return view('dashboard', $data);
    }

    public function createUser()
    {
       
        $data['editUser'] = null;
       
        return view("user_view", $data);
    }

    public function editUser()
    {
        $editUserId = $this->request->getGet("editUserId");
        $data['editUser'] = $this->userModel->find($editUserId);
        return view("user_view", $data);
    }

    public function editByUser()
    {

        $rules = [
            'username' => ['rules' => 'required|min_length[3]|max_length[30]'],
            'role' => ['rules' => 'required|in_list[admin,user,staff]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|'],
            'status' => ['rules' => 'in_list[active,inactive]'],
        ];

        $newPassword = $this->request->getPost("new_password");
        $confirmNewPassword = $this->request->getPost("confirm_new_password");


        if (!empty($newPassword) || !empty($confirmNewPassword)) {
            // Add password validation rules if the password field is not empty
            $rules['new_password'] = ['rules' => 'required|min_length[8]|max_length[255]'];
            $rules['confirm_new_password'] = ['label' => 'Confirm New Password', 'rules' => 'matches[new_password]'];
        }

        $profilePic = $this->request->getFile("profilePic");

        if (!empty($profilePic)) {
            $rules['profilePic'] = [
                'rules' => 'is_image[profilePic]|mime_in[profilePic,image/jpg,image/jpeg,image/png,image/svg+xml]|max_size[profilePic,5120]',
                'label' => 'profilePic',
            ];
        }

        if ($this->validate($rules)) {

            $editUserId = $this->request->getPost("id");

            $data = [
                'user_name' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'email' => $this->request->getPost('email'),
                'status' => $this->request->getPost('status'),
                'address1'  =>$this->request->getVar('address1'),
                'address2'  =>$this->request->getVar('address2'),
                'address3'  =>$this->request->getVar('address3'),
                'country_id'  =>$this->request->getVar('country'),
                'state_id'    =>$this->request->getVar('state'),
                'city_id'     =>$this->request->getvar('city')
            ];

            $userDetails = $this->userModel->find($editUserId);
            $oldImageName = $userDetails['profilePicName'];



            if ($profilePic && $profilePic->isValid() && !$profilePic->hasMoved()) {

                if (file_exists("uploads/" . $oldImageName)) {
                    if (is_file("uploads/" . $oldImageName)) {
                        unlink("uploads/" . $oldImageName);
                    }

                    $data['profilePicName'] = $profilePic->getRandomName();
                    $profilePic->move("uploads/", $data['profilePicName']);


                }

            } else {
                $data["profilePicName"] = $oldImageName;
            }

            if ($newPassword !== null && $newPassword != "") {
                $newPassword = password_hash($this->request->getPost("new_password"), PASSWORD_DEFAULT);
                $data["password"] = $newPassword;
            }
            if ($newPassword == null || $newPassword == "") { //also check length is lesser than 8 digit
                unset($data["password"]); //delete password from data array here
            }

            $this->userModel->update($editUserId, $data);
            return redirect()->to("/dashboard");

        } else {
            $editUserId = $this->request->getPost("id");
            $data['editUser'] = $this->userModel->find($editUserId);
            $data['validation'] = $this->validator;
            return view('user_view', $data);

            // return redirect()
            // ->back()
            // ->withInput()a
            // ->with('validation', $this->validator)
            // ->with('error', 'Validation failed..!!');
        }



    }

    public function editProfile()
    {

        $rules = [
            'username' => ['rules' => 'required|min_length[3]|max_length[30]'],
            'role' => ['rules' => 'required|in_list[admin,user,staff]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|'],
            'status' => ['rules' => 'in_list[active,inactive]'],
        ];

        $newPassword = $this->request->getPost("new_password");
        $confirmNewPassword = $this->request->getPost("confirm_new_password");

        if (!empty($newPassword) || !empty($confirmNewPassword)) {
            // Add password validation rules if the password field is not empty
            $rules['new_password'] = ['rules' => 'required|min_length[8]|max_length[255]'];
            $rules['confirm_new_password'] = ['label' => 'Confirm New Password', 'rules' => 'matches[new_password]'];
        }

        $profilePic = $this->request->getFile("profilePic");

        if (!empty($profilePic)) {
            $rules['profilePic'] = [
                'rules' => 'is_image[profilePic]|mime_in[profilePic,image/jpg,image/jpeg,image/png,image/svg+xml]|max_size[profilePic,5120]',
                'label' => 'profilePic',
            ];
        }

        if ($this->validate($rules)) {

            $editUserId = $this->request->getPost("id");

            $data = [
                'user_name' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'email' => $this->request->getPost('email'),
                'status' => $this->request->getPost('status'),
                'address1'  =>$this->request->getPost('address1'),
                'address2'  =>$this->request->getPost('address2'),
                'address3'  =>$this->request->getPost('address3'),
                'country_id'  =>$this->request->getPost('country'),
                'state_id'    =>$this->request->getPost('state'),
                'city_id'     =>$this->request->getPost('city')
            ];

            $userDetails = $this->userModel->find($editUserId);
            $oldImageName = $userDetails['profilePicName'];

            if ($profilePic && $profilePic->isValid() && !$profilePic->hasMoved()) {

                if (file_exists("uploads/" . $oldImageName)) {
                    if (is_file("uploads/" . $oldImageName)) {
                        unlink("uploads/"  . $oldImageName);
                    }

                    $data['profilePicName'] = $profilePic->getRandomName();
                    $profilePic->move("uploads/", $data['profilePicName']);

                }

            } else {
                $data["profilePicName"] = $oldImageName;
            }

            if ($newPassword !== null && $newPassword != "") {
                $newPassword = password_hash($this->request->getPost("new_password"), PASSWORD_DEFAULT);
                $data["password"] = $newPassword;
            }
            if ($newPassword == null && $newPassword == "") { //also check length is lesser than 8 digit
                unset($data["password"]); //delete password from data array here
            }

            $this->userModel->update($editUserId, $data);
            $user = $this->userModel->find($editUserId);
            $session = session();
            $session->set('user', $user);

          
            return redirect()->to('/dashboard');

        } else {
            $data['validation'] = $this->validator;
            return view('profile', $data);


        }



    }

    public function deactivateUser()
    {
        $deleteUserId = $this->request->getGet("deleteUserId");
        $data = [
            "status" => "inactive",
        ];
        $user = $this->userModel->update($deleteUserId, $data);
        $users = $this->userModel->findall();
        $data["users"] = $users;

        return view("dashboard", $data);
    }

    public function myProfile()
    {
        return view('profile');
    }

    public function createUserByadmin()
    {
        $userModel = new UserModel();

        $email = $this->request->getVar('email');

        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            return redirect()->back()->withInput()->with('error', 'User Already Exists..!!');
        }

        $rules = [
            'username' => ['rules' => 'required|min_length[3]|max_length[30]'],
            'role' => ['rules' => 'required|in_list[admin,staff]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password' => ['label' => 'confirm password', 'rules' => 'matches[password]']
        ];


        $profilePic = $this->request->getFile("profilePic");

        if (!empty($profilePic)) {
            $rules['profilePic'] = [
                'rules' => 'is_image[profilePic]|mime_in[profilePic,image/jpg,image/jpeg,image/png,image/svg+xml]|max_size[profilePic,5120]',
                'label' => 'profilePic',
            ];
        }

        if ($this->validate($rules)) {
            $model = new UserModel();

            $data = [
                'profilePicName' => $this->request->getVar('profilePicName'),
                'user_name' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'address1'  =>$this->request->getVar('address1'),
                'address2'  =>$this->request->getVar('address2'),
                'address3'  =>$this->request->getVar('address3'),
                'country_id'  =>$this->request->getVar('country'),
                'state_id'    =>$this->request->getVar('state'),
                'city_id'     =>$this->request->getvar('city')
            ];



            if ($profilePic && $profilePic->isValid() && !$profilePic->hasMoved()) {

                $data['profilePicName'] = $profilePic->getRandomName();

                $profilePic->move('uploads/', $data['profilePicName']);
            }



           

            $model->save($data);
            $data['users'] = $userModel->findAll();
            return redirect('dashboard');

        } else {

            $data['validation'] = $this->validator;
            $data['editUser'] = null;
            return view('user_view', $data);

        }
    }

    public function getStatesByCountry($country_id)
    {
        $states = $this->stateModel->where('country_id', $country_id)->findAll();
        return $this->response->setJSON($states);
    }

    public function getCitiesByState($state_id)
    {
        $cities = $this->cityModel->where('state_id', $state_id)->findAll();
        return $this->response->setJSON($cities);
    }

    public function getCountriesList(){
        $countries=$this->countryModel->findAll();
        return $this->response->setJSON($countries);
    }

    public function getStatesList(){
        $states=$this->stateModel->findAll();
        return $this->response->setJson($states);
    }

    public function getCitiesList(){
        $cities=$this->cityModel->findAll();
        return $this->response->setJson($cities);
    }

    public function getUserDetails(){

        $userId=$this->request->getGet('user_id');
        $user  =$this->userModel->find($userId);
        return $this->response->setJSON($user);
    }

}
