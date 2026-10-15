<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Core\Validator;
use App\Models\Cliente;

class ClienteController extends Controller
{
    private Cliente $model;

    public function __construct() { $this->model = new Cliente(); }

    public function index(): void
    {
        Session::start();
        $this->view('clientes/index', [
            'title'    => 'Clientes',
            'clientes' => $this->model->all(),
        ]);
    }

    public function store(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/clientes');
        }

        $errors = Validator::validate($_POST, [
            'n_cuenta' => 'required|min:4|max:20',
            'nombre'   => 'required|min:2|max:60',
            'apellido' => 'required|min:2|max:60',
            'dni'      => 'required|min:8|max:8',
        ]);

        if ($errors) {
            Session::flash('error', 'Datos invalidos');
            $this->redirect('/clientes');
        }

        $this->model->create($_POST);
        Session::flash('success', 'Cliente registrado');
        $this->redirect('/clientes');
    }

    public function update(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/clientes');
        }
        $this->model->update((int)$id, $_POST);
        Session::flash('success', 'Cliente actualizado');
        $this->redirect('/clientes');
    }

    public function destroy(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/clientes');
        }
        $this->model->delete((int)$id);
        Session::flash('success', 'Cliente eliminado');
        $this->redirect('/clientes');
    }
}