<?php
// Controlador de autenticación.
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(): void
    {
        if (isLoggedIn()) {
            redirect('/?route=dashboard');
        }
        view('auth/login', ['error' => null]);
    }

    public function loginSubmit(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!Validator::required($email) || !Validator::required($password) || !Validator::email($email)) {
            view('auth/login', ['error' => 'Credenciales inválidas.']);
            return;
        }

        $user = (new User())->findByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],
            ];
            redirect('/?route=dashboard');
        }

        view('auth/login', ['error' => 'Usuario o contraseña incorrectos.']);
    }

    public function logout(): void
    {
        session_destroy();
        redirect('/?route=login');
    }
}
