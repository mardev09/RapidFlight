<?php

require_once("src/Core/Controller.php");

class UsuarioController extends Controller 
{
    public function login() {
        $userModel = $this->model('Usuario');
        $data = $userModel->getUser($_POST['email']);
        
        if(password_verify($_POST['password'], $data['password'])) {
            session_start();

            $_SESSION['email'] = $data['email'];

            echo $_SESSION['email'];
            header('Location: /inicio');
            die;
        }

        header('Location: /login');
    }

    public function register() {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $userModel = $this->model('Usuario');
        $userModel->addUser([$_POST['email'], $hash]);

        header('Location: /login');
    }
}