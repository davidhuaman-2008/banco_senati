<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title ?? 'Banco Senati') ?></title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- AOS animaciones -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
:root {
    --primary: #6366f1;
    --primary-glow: rgba(99, 102, 241, .4);
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #0f172a;
    --darker: #020617;
    --card: rgba(30, 41, 59, .7);
    --border: rgba(148, 163, 184, .15);
}

* { transition: all .25s cubic-bezier(.4, 0, .2, 1); }

body {
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
    background-attachment: fixed;
    color: #e2e8f0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    min-height: 100vh;
}

/* Animación de fondo */
body::before {
    content: '';
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background:
        radial-gradient(circle at 20% 30%, rgba(99, 102, 241, .15), transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(236, 72, 153, .12), transparent 40%);
    pointer-events: none;
    z-index: 0;
    animation: floatBg 15s ease-in-out infinite;
}

@keyframes floatBg {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(-20px, -20px); }
}

/* Navbar glassmorphism */
.navbar {
    background: rgba(15, 23, 42, .75) !important;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-brand {
    font-weight: 700;
    letter-spacing: -.5px;
    background: linear-gradient(135deg, #818cf8, #ec4899);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.35rem;
}

/* Contenedor principal */
.container { position: relative; z-index: 1; }

/* Cards modernas */
.card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, .3);
    overflow: hidden;
    position: relative;
}

.card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 3px;
    background: linear-gradient(90deg, var(--primary), #ec4899);
    opacity: 0;
}

.card:hover::before { opacity: 1; }
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 48px rgba(99, 102, 241, .25);
    border-color: rgba(99, 102, 241, .3);
}

/* Botones */
.btn {
    border-radius: .6rem;
    font-weight: 500;
    letter-spacing: .2px;
    transition: all .2s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, .3);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), #8b5cf6);
    border: none;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    border: none;
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    color: #fff;
}

/* Tablas */
.table {
    color: #cbd5e1;
    border-color: var(--border);
}

.table thead {
    background: rgba(15, 23, 42, .6);
    border-bottom: 2px solid var(--primary);
}

.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: .75rem;
    letter-spacing: .5px;
    color: #94a3b8;
    padding: 1rem;
}

.table tbody tr {
    border-color: var(--border);
    transition: all .2s;
}

.table tbody tr:hover {
    background: rgba(99, 102, 241, .08);
    transform: scale(1.005);
}

.table-hover > tbody > tr:hover > * { color: #fff; }

/* Inputs */
.form-control, .form-select {
    background: rgba(15, 23, 42, .6);
    border: 1px solid var(--border);
    color: #e2e8f0;
    border-radius: .6rem;
    padding: .65rem 1rem;
}

.form-control:focus, .form-select:focus {
    background: rgba(15, 23, 42, .8);
    border-color: var(--primary);
    box-shadow: 0 0 0 4px var(--primary-glow);
    color: #fff;
}

.form-control::placeholder { color: #64748b; }

/* Modal */
.modal-content {
    background: rgba(15, 23, 42, .95);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 1rem;
    color: #e2e8f0;
}

.modal-header, .modal-footer { border-color: var(--border); }

/* Alertas */
.alert {
    border-radius: .75rem;
    border: 1px solid;
    animation: slideDown .4s ease-out;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Badge animado */
.badge {
    padding: .4em .8em;
    border-radius: .5rem;
    font-weight: 500;
}

/* Animaciones utilitarias */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-in { animation: fadeInUp .6s cubic-bezier(.4, 0, .2, 1) both; }
.delay-1 { animation-delay: .1s; }
.delay-2 { animation-delay: .2s; }
.delay-3 { animation-delay: .3s; }
.delay-4 { animation-delay: .4s; }

/* Scrollbar */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-track { background: var(--darker); }
::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary), #8b5cf6);
    border-radius: 5px;
}
::-webkit-scrollbar-thumb:hover { background: #8b5cf6; }

/* Fix inputs editables en modales */
.modal .form-control,
.modal .form-select {
    pointer-events: auto !important;
    position: relative;
    z-index: 10;
}

.modal * {
    pointer-events: auto;
}

.modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}

/* Fix date input en modo oscuro */
input[type="date"] {
    color-scheme: dark;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* Fix autofill */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-text-fill-color: #e2e8f0;
    -webkit-box-shadow: 0 0 0 1000px rgba(15, 23, 42, .9) inset;
    transition: background-color 5000s ease-in-out 0s;
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">
      <i class="bi bi-bank2"></i> Banco Senati
    </a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <?php if (\App\Core\Session::has('user')): ?>
        <span class="text-light d-flex align-items-center gap-2">
          <i class="bi bi-person-circle fs-5"></i>
          <span><?= htmlspecialchars(\App\Core\Session::get('user')['usuario']) ?></span>
          <span class="badge bg-primary"><?= htmlspecialchars(\App\Core\Session::get('user')['rol'] ?? 'user') ?></span>
        </span>
        <form action="/logout" method="POST" class="d-inline">
          <?= \App\Core\Csrf::field() ?>
          <button class="btn btn-outline-light btn-sm">
            <i class="bi bi-box-arrow-right"></i> Salir
          </button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container my-5">
  <?php if ($msg = \App\Core\Session::flash('success')): ?>
    <div class="alert alert-success animate-in" data-aos="fade-down">
      <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>
  <?php if ($msg = \App\Core\Session::flash('error')): ?>
    <div class="alert alert-danger animate-in" data-aos="fade-down">
      <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>

  <?php require __DIR__ . '/../' . $view . '.php'; ?>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
AOS.init({ duration: 600, once: true, easing: 'ease-out-cubic' });

// Confirmaciones globales para formularios con data-confirm
document.querySelectorAll('form[data-confirm]').forEach(f => {
    f.addEventListener('submit', e => {
        e.preventDefault();
        Swal.fire({
            title: f.dataset.confirm,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#0f172a',
            color: '#e2e8f0',
        }).then(r => { if (r.isConfirmed) f.submit(); });
    });
});
</script>
</body>
</html>