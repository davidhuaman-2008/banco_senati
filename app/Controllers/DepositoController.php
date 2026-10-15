<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Deposito;
use App\Models\Cliente;

class DepositoController extends Controller
{
    private Deposito $model;

    public function __construct() { $this->model = new Deposito(); }

    public function index(): void
    {
        Session::start();
        $cli = new Cliente();
        $this->view('depositos/index', [
            'title'     => 'Depositos',
            'depositos' => $this->model->withCliente(),
            'clientes'  => $cli->all(),
        ]);
    }

    public function store(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/depositos');
        }

        if ((float)$_POST['monto'] <= 0) {
            Session::flash('error', 'Monto debe ser mayor a 0');
            $this->redirect('/depositos');
        }

        $this->model->create($_POST);
        Session::flash('success', 'Deposito registrado');
        $this->redirect('/depositos');
    }

    public function destroy(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/depositos');
        }
        $this->model->delete((int)$id);
        Session::flash('success', 'Deposito eliminado');
        $this->redirect('/depositos');
    }
}