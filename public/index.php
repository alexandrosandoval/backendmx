<?php
declare(strict_types=1);

// Punto de entrada del sistema (Front Controller).
// Todas las peticiones pasan por este archivo.

session_start();

require_once __DIR__ . '/../app/Core/Autoloader.php';
require_once __DIR__ . '/../app/Core/helpers.php';

use App\Core\Router;

$router = new Router();
$router->dispatch();
