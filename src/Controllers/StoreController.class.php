<?php
require_once("src/Core/Controller.php");

class StoreController extends Controller
{

    public function showStore()
    {
        if (!isset($_SESSION['email'])) {
            header('Location: /login');
            die;
        }

        $pointsModel = $this->model('Points');
        $puntos = $pointsModel->getUserPoints($_SESSION['email']);

        $storeModel = $this->model('Store');
        $productos = $storeModel->getActiveProducts();

        $this->view('StoreView', ['puntos' => $puntos, 'productos' => $productos]);
    }

    public function redeemProduct()
    {
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            die;
        }

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);
        $idProducto = $data['idProducto'];

        $storeModel = $this->model('Store');
        $producto = $storeModel->getProductById($idProducto);

        if (!$producto) {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
            die;
        }

        // Verificar stock
        if ($producto['stock'] == 0) {
            echo json_encode(['success' => false, 'message' => 'Sin stock']);
            die;
        }

        $pointsModel = $this->model('Points');

        if ($pointsModel->redeemPoints($_SESSION['email'], $producto['puntosRequeridos'], $idProducto)) {
            $storeModel->updateStock($idProducto);
            echo json_encode(['success' => true, 'message' => 'Canje exitoso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Puntos insuficientes']);
        }
    }
}
