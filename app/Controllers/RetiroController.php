<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Retiro;
use App\Models\Cliente;

class RetiroController extends Controller
{
    private Retiro $model;

    public function __construct() { $this->model = new Retiro(); }

    public function index(): void
    {
        Session::start();
        $cli = new Cliente();
        $this->view('retiros/index', [
            'title'    => 'Retiros',
            'retiros'  => $this->model->withCliente(),
            'clientes' => $cli->all(),
        ]);
    }

    public function store(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/retiros');
        }

        $cli   = new Cliente();
        $monto = (float) $_POST['monto'];
        $saldo = $cli->saldo((int) $_POST['cliente_id']);

        if ($monto <= 0) {
            Session::flash('error', 'Monto invalido');
            $this->redirect('/retiros');
        }

        if ($monto > $saldo) {
            Session::flash('error', 'Saldo insuficiente. Disponible: S/ ' . number_format($saldo, 2));
            $this->redirect('/retiros');
        }

        $this->model->create($_POST);
        Session::flash('success', 'Retiro registrado');
        $this->redirect('/retiros');
    }

    public function destroy(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/retiros');
        }
        $this->model->delete((int)$id);
        Session::flash('success', 'Retiro eliminado');
        $this->redirect('/retiros');
    }
}