<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cliente;
use App\Models\Deposito;
use App\Models\Retiro;
use App\Models\PagoServicio;
use Dompdf\Dompdf;

class ReporteController extends Controller
{
    public function clientesPdf(): void
    {
        $this->generarPdf('Clientes', (new Cliente())->all(), ['ID','Cuenta','Nombre','Apellido','DNI']);
    }

    public function depositosPdf(): void
    {
        $this->generarPdf('Depositos', (new Deposito())->withCliente(), ['ID','Cliente','Fecha','Monto']);
    }

    public function retirosPdf(): void
    {
        $this->generarPdf('Retiros', (new Retiro())->withCliente(), ['ID','Cliente','Fecha','Monto']);
    }

    public function pagosPdf(): void
    {
        $this->generarPdf('Pagos de Servicios', (new PagoServicio())->withCliente(), ['ID','Cliente','Concepto','Fecha','Monto']);
    }

    private function generarPdf(string $titulo, array $rows, array $headers): void
    {
        $html = '<h2>' . htmlspecialchars($titulo) . '</h2><table border="1" cellpadding="5" cellspacing="0" width="100%"><thead><tr>';
        foreach ($headers as $h) $html .= '<th>' . htmlspecialchars($h) . '</th>';
        $html .= '</tr></thead><tbody>';
        foreach ($rows as $r) {
            $html .= '<tr>';
            foreach ($r as $v) $html .= '<td>' . htmlspecialchars((string)$v) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream(strtolower($titulo) . '.pdf', ['Attachment' => false]);
    }
}