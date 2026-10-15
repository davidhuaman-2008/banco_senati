<?php
/** @var int $totalClientes */
/** @var int $totalDepositos */
/** @var int $totalRetiros */
/** @var int $totalPagos */
?>
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
  <div>
    <h1 class="mb-1" style="font-weight: 800; letter-spacing: -.5px;">
      <i class="bi bi-speedometer2"></i> Dashboard
    </h1>
    <p class="text-secondary mb-0">Bienvenido de nuevo, <strong class="text-light"><?= htmlspecialchars(\App\Core\Session::get('user')['usuario']) ?></strong></p>
  </div>
  <div class="text-end">
    <div class="text-secondary small">Última actualización</div>
    <div class="text-light fw-bold"><?= date('d/m/Y H:i') ?></div>
  </div>
</div>

<!-- Tarjetas de contadores -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="0">
    <div class="card h-100" style="background: linear-gradient(135deg, rgba(99,102,241,.2), rgba(139,92,246,.1)); border-color: rgba(99,102,241,.3);">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
            <i class="bi bi-people fs-3 text-white"></i>
          </div>
          <span class="badge bg-success bg-opacity-25 text-success">
            <i class="bi bi-arrow-up"></i> activo
          </span>
        </div>
        <h6 class="text-secondary text-uppercase small mb-1" style="letter-spacing: 1px;">Clientes</h6>
        <h2 class="mb-0 text-white fw-bold counter" data-target="<?= (int)$totalClientes ?>">0</h2>
        <a href="/clientes" class="btn btn-sm btn-primary mt-3 w-100">
          Ver más <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
    <div class="card h-100" style="background: linear-gradient(135deg, rgba(16,185,129,.2), rgba(5,150,105,.1)); border-color: rgba(16,185,129,.3);">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #10b981, #059669);">
            <i class="bi bi-cash-stack fs-3 text-white"></i>
          </div>
          <span class="badge bg-success bg-opacity-25 text-success">
            <i class="bi bi-arrow-up"></i> activo
          </span>
        </div>
        <h6 class="text-secondary text-uppercase small mb-1" style="letter-spacing: 1px;">Depósitos</h6>
        <h2 class="mb-0 text-white fw-bold counter" data-target="<?= (int)$totalDepositos ?>">0</h2>
        <a href="/depositos" class="btn btn-sm btn-success mt-3 w-100">
          Ver más <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
    <div class="card h-100" style="background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(217,119,6,.1)); border-color: rgba(245,158,11,.3);">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <i class="bi bi-arrow-down-circle fs-3 text-white"></i>
          </div>
          <span class="badge bg-warning bg-opacity-25 text-warning">
            <i class="bi bi-dash"></i> estable
          </span>
        </div>
        <h6 class="text-secondary text-uppercase small mb-1" style="letter-spacing: 1px;">Retiros</h6>
        <h2 class="mb-0 text-white fw-bold counter" data-target="<?= (int)$totalRetiros ?>">0</h2>
        <a href="/retiros" class="btn btn-sm btn-warning mt-3 w-100">
          Ver más <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">
    <div class="card h-100" style="background: linear-gradient(135deg, rgba(239,68,68,.2), rgba(220,38,38,.1)); border-color: rgba(239,68,68,.3);">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <i class="bi bi-receipt fs-3 text-white"></i>
          </div>
          <span class="badge bg-danger bg-opacity-25 text-danger">
            <i class="bi bi-graph-up"></i> activo
          </span>
        </div>
        <h6 class="text-secondary text-uppercase small mb-1" style="letter-spacing: 1px;">Pagos</h6>
        <h2 class="mb-0 text-white fw-bold counter" data-target="<?= (int)$totalPagos ?>">0</h2>
        <a href="/pagos" class="btn btn-sm btn-danger mt-3 w-100">
          Ver más <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Gráfico + Reportes -->
<div class="row g-4">
  <div class="col-lg-8" data-aos="fade-right">
    <div class="card h-100">
      <div class="card-body p-4">
        <h5 class="card-title mb-4">
          <i class="bi bi-bar-chart-line text-primary"></i> Resumen General
        </h5>
        <canvas id="chartResumen" style="max-height: 300px;"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4" data-aos="fade-left">
    <div class="card h-100">
      <div class="card-body p-4">
        <h5 class="card-title mb-4">
          <i class="bi bi-file-earmark-pdf text-danger"></i> Reportes PDF
        </h5>
        <div class="d-grid gap-2">
          <a href="/reportes/clientes" class="btn btn-outline-primary">
            <i class="bi bi-people"></i> Clientes
          </a>
          <a href="/reportes/depositos" class="btn btn-outline-success">
            <i class="bi bi-cash-stack"></i> Depósitos
          </a>
          <a href="/reportes/retiros" class="btn btn-outline-warning">
            <i class="bi bi-arrow-down-circle"></i> Retiros
          </a>
          <a href="/reportes/pagos" class="btn btn-outline-danger">
            <i class="bi bi-receipt"></i> Pagos
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
    // Contadores animados
    document.querySelectorAll('.counter').forEach(function(el) {
        var target = parseInt(el.dataset.target) || 0;
        var current = 0;
        var increment = Math.max(1, Math.ceil(target / 40));
        var timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                el.textContent = target;
                clearInterval(timer);
            } else {
                el.textContent = current;
            }
        }, 30);
    });

    // Esperar a que Chart.js esté disponible
    function initChart() {
        if (typeof Chart === 'undefined') {
            console.warn('Esperando Chart.js...');
            return setTimeout(initChart, 100);
        }

        var canvas = document.getElementById('chartResumen');
        if (!canvas) {
            console.error('No se encontró #chartResumen');
            return;
        }

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: ['Clientes', 'Depósitos', 'Retiros', 'Pagos'],
                datasets: [{
                    label: 'Total',
                    data: [
                        <?= (int)$totalClientes ?>,
                        <?= (int)$totalDepositos ?>,
                        <?= (int)$totalRetiros ?>,
                        <?= (int)$totalPagos ?>
                    ],
                    backgroundColor: [
                        'rgba(99, 102, 241, .7)',
                        'rgba(16, 185, 129, .7)',
                        'rgba(245, 158, 11, .7)',
                        'rgba(239, 68, 68, .7)'
                    ],
                    borderColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 2,
                    borderRadius: 12,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 1500, easing: 'easeOutQuart' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, .95)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        borderColor: '#6366f1',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148, 163, 184, .1)' },
                        ticks: { color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    }

    // Iniciar cuando el DOM y Chart.js estén listos
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChart);
    } else {
        initChart();
    }
})();
</script>