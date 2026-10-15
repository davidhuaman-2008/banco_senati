<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        Session::start();
        $this->view('auth/login', ['title' => 'Iniciar Sesion']);
    }

    public function login(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token CSRF invalido');
            $this->redirect('/login');
        }

        $usuario  = trim($_POST['usuario'] ?? '');
        $password = $_POST['password'] ?? '';

        $model = new Usuario();
        $user  = $model->findByUsuario($usuario);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('user', [
                'id'      => $user['id'],
                'usuario' => $user['usuario'],
                'rol'     => $user['rol'],
            ]);
            $this->redirect('/dashboard');
        }

        Session::flash('error', 'Credenciales incorrectas');
        $this->redirect('/login');
    }

    public function logout(): void
    {
        Session::start();
        Session::destroy();
        $this->redirect('/login');
    }
}