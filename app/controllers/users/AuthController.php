<?php

require_once 'app/models/User.php';

class AuthController
{
    public function register()
    {
        include 'app/views/users/register.php';
    }


    public function store()
    {
        if (isset($_POST['username']) && isset($_POST['email'])
            && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                echo "Password do not match";
                return;
            }

            $userModel = new AuthUser();

            $userModel->register($_POST['username'],$_POST['email'],password_hash($password, PASSWORD_DEFAULT));

        }
        header("Location: index.php?page=users");
    }

    public function login()
    {
        include 'app/views/users/login.php';
    }

    public function authenticate()
    {
        $authModel = new AuthUser();

        if(isset($_POST['email'])&&isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $remember = isset($_POST['remember'])? $_POST['remember']: '';

            $user = $authModel->findByEmail($email);
            if($user && password_verify($password,$user['password'])){
                session_start();
                $_SESSION['user_id']=$user['id'];
                $_SESSION['user_role']=$user['role'];

                if($remember = 'on'){
                    setcookie('user_email',$email,time() + (7 * 24 * 60 * 60), '/');
                    setcookie('password',$password,time() + (7 * 24 * 60 * 60), '/');
                }
                header("Location: index.php");
            }else{
                echo "Invalid email or password";
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}