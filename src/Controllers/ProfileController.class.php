<?php
require_once("src/Core/Controller.php");

class ProfileController extends Controller
{

    public function showEditForm()
    {
        if (!isset($_SESSION['email'])) {
            header('Location: /login');
            die;
        }

        $userModel = $this->model('Usuario');
        $user = $userModel->getUser($_SESSION['email']);

        $this->view('EditProfileView', $user);
    }

    public function updateProfile()
    {
        if (!isset($_SESSION['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'No autenticado']);
            die;
        }

        $userModel = $this->model('Usuario');

        // Soportar tanto JSON (modal) como POST (formulario)
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($contentType, 'application/json') !== false) {
            $rawData = file_get_contents("php://input");
            $input = json_decode($rawData, true);
        } else {
            $input = $_POST;
        }

        $data = [
            'nombre' => $input['nombre'] ?? '',
            'apellidos' => $input['apellidos'] ?? '',
            'fechaNacimiento' => $input['fechaNacimiento'] ?? null,
            'telefono' => $input['telefono'] ?? '',
            'direccion' => $input['direccion'] ?? '',
            'ciudad' => $input['ciudad'] ?? '',
            'codigoPostal' => $input['codigoPostal'] ?? '',
            'pais' => $input['pais'] ?? 'España',
            'pasaporte' => $input['pasaporte'] ?? ''
        ];

        try {
            $userModel->updateProfile($_SESSION['email'], $data);

            if (strpos($contentType, 'application/json') !== false) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                die;
            }
            header('Location: /account');
        } catch (Exception $e) {
            if (strpos($contentType, 'application/json') !== false) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                die;
            }
            header('Location: /account');
        }
    }
}
