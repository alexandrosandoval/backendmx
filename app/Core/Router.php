<?php
// Enrutador básico del sistema.
namespace App\Core;

use App\Controllers\AuthController;
use App\Controllers\DashboardController;

class Router
{
    public function dispatch(): void
    {
        $route = $_GET['route'] ?? 'login';

        switch ($route) {
            case 'login':
                (new AuthController())->login();
                break;
            case 'login-submit':
                (new AuthController())->loginSubmit();
                break;
            case 'logout':
                (new AuthController())->logout();
                break;
            case 'dashboard':
                (new DashboardController())->index();
                break;
            default:
                http_response_code(404);
                echo 'Ruta no encontrada.';
        }
    }
}
