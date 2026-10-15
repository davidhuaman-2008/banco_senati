<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    private Usuario $model;

    public function __construct() { $this->model = new Usuario(); }

    public function index(): void
    {
        Session::start();
        $this->view('usuarios/index', [
            'title'    => 'Usuarios',
            'usuarios' => $this->model->all(),
        ]);
    }

    public function store(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/usuarios');
        }
        $this->model->create($_POST);
        Session::flash('success', 'Usuario creado');
        $this->redirect('/usuarios');
    }

    public function destroy(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/usuarios');
        }
        $this->model->delete((int)$id);
        Session::flash('success', 'Usuario eliminado');
        $this->redirect('/usuarios');
    }
}