<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\PagoServicio;
use App\Models\Cliente;

class PagoServicioController extends Controller
{
    private PagoServicio $model;

    public function __construct() { $this->model = new PagoServicio(); }

    public function index(): void
    {
        Session::start();
        $cli = new Cliente();
        $this->view('pagos/index', [
            'title'    => 'Pagos de Servicios',
            'pagos'    => $this->model->withCliente(),
            'clientes' => $cli->all(),
        ]);
    }

    public function store(): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/pagos');
        }

        $cli   = new Cliente();
        $monto = (float) $_POST['monto'];
        $saldo = $cli->saldo((int) $_POST['cliente_id']);

        if ($monto <= 0) {
            Session::flash('error', 'Monto invalido');
            $this->redirect('/pagos');
        }

        if ($monto > $saldo) {
            Session::flash('error', 'Saldo insuficiente. Disponible: S/ ' . number_format($saldo, 2));
            $this->redirect('/pagos');
        }

        $this->model->create($_POST);
        Session::flash('success', 'Pago registrado');
        $this->redirect('/pagos');
    }

    public function destroy(string $id): void
    {
        Session::start();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Token invalido');
            $this->redirect('/pagos');
        }
        $this->model->delete((int)$id);
        Session::flash('success', 'Pago eliminado');
        $this->redirect('/pagos');
    }
}