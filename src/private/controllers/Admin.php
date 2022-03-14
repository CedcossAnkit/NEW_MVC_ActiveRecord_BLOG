<?php

namespace App\Controllers;

// if (session_start()) {
// } else {

//     session_start();
// }

use App\Libraries\Controller;

class Admin extends Controller
{
    public function index()
    {
        echo "default file";
    }
    public function signup()
    {

        $data = array(
            'action' => isset($_POST['register']) ? $_POST['register'] : 'gg',
            'name' => isset($_POST['name']) ? $_POST['name'] : 'gg',
            'email' => isset($_POST['email']) ? $_POST['email'] : 'gg',
            'password' => isset($_POST['password']) ? $_POST['password'] : 'gg',
        );

        if ($data['action'] == 'register') {

            if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
            } else {
                if ($_POST['password'] == $_POST['password2']) {
                    //main insert code
                    $users = $this->model('Users');
                    $users->name = $data['name'];
                    $users->username = $data['name'];
                    $users->email = $data['email'];
                    $users->password = $data['password'];

                    $users->save();
                    echo "data sucessfully inserted";
                } else {
                    echo "password not match";
                }
            }
        }

        $this->view('signup', $data);
    }
    public function signin()
    {

        if (isset($_POST)) {

            $data = array(
                'action' => isset($_POST['login']) ? $_POST['login'] : 'gg',
                'email' => isset($_POST['email']) ? $_POST['email'] : 'gg',
                'password' => isset($_POST['password']) ? $_POST['password'] : 'gg'
            );

            if ($data['action'] == 'login') {

                if ($data['email'] != "" || $data['password'] != "") {
                    $data2 = $this->model('Users')::find_by_email_and_password($data['email'], $data['password']);



                    if (isset($data2)) {
                        // echo "valid";
                        if (isset($data2)) {
                            $_SESSION['login'] = array(
                                'id' => $data2->id,
                                'name' => $data2->name,
                                'username' => $data2->name,
                                'email' => $data2->email,
                                'password' => $data2->password,
                                'role' => $data2->role,
                                'status' => $data2->status,
                            );
                        }
                        header('Location: http://localhost:8080/public/admin/dashboard');

                        // // $password = $users->find_by_password($data['password']);
                        // // echo "$name,$password";
                        // echo "<pre>";
                        // // print_r($_SESSION['login']);
                        // // if ($_SESSION['login'][0]['role'] == "user") {
                        // //     echo "user";
                        // // } else {
                        // //     echo "admin";
                        // // }
                        // echo "</pre>";
                    } else {
                        echo "invalid";
                    }
                }
            }
        }
        $this->view('signin', $data);
    }


    public function dashboard()
    {
        $alldata['users']=$this->model('Users')::find('all');
        // $_SESSION['alldata']=$alldata;
        // print_r($alldata);
        $this->view('dashboard', $alldata);
        
    }

    public function Validation()
    {
        if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {

            return false;
        } else {
            return true;
        }
    }

    public function feachDeatls()
    {
        $alldata['users']=$this->model('Users')::find('all');
        // echo "<pre>";
        // print_r($alldata);
        // echo "</pre>";
        return $alldata;
    }
}
