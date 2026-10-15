<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cliente;
use App\Models\Deposito;
use App\Models\Retiro;
use App\Models\PagoServicio;

class DashboardController extends Controller
{
    public function index(): void
    {
        $cli = new Cliente();
        $dep = new Deposito();
        $ret = new Retiro();
        $pag = new PagoServicio();

        $this->view('dashboard/index', [
            'title'          => 'Dashboard',
            'totalClientes'  => $cli->count(),
            'totalDepositos' => $dep->count(),
            'totalRetiros'   => $ret->count(),
            'totalPagos'     => $pag->count(),
        ]);
    }
}