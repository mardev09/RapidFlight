<?php

require_once("src/Core/Controller.php");

class UsuarioController extends Controller
{
    public function login()
    {
        $userModel = $this->model('Usuario');
        $data = $userModel->getUser($_POST['email']);

        if (password_verify($_POST['password'], $data['password'])) {
            session_start();

            $_SESSION['email'] = $data['email'];

            echo $_SESSION['email'];
            header('Location: /inicio');
            die;
        }

        header('Location: /login');
    }

    public function register()
    {
        $email = $_POST['email'];
        $userModel = $this->model('Usuario');

        if ($userModel->checkEmailExists($email)) {
            // Manejar error de email duplicado
            header('Location: /register?error=email_exists');
            die;
        }

        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $userModel->addUser([$email, $hash]);

        header('Location: /login');
    }
}