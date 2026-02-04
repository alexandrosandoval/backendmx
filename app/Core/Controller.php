<?php
// Controlador base con validación de sesión.
namespace App\Core;

class Controller
{
    protected function requireAuth(): void
    {
        if (!isLoggedIn()) {
            redirect('/?route=login');
        }
    }
}
