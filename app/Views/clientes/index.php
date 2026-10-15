<div class="d-flex justify-content-between align-items-center mb-3">
  <h2><i class="bi bi-people"></i> Clientes</h2>
  <button class="btn btn-primary" id="btnNuevoCliente">
    <i class="bi bi-plus-circle"></i> Nuevo Cliente
  </button>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <table class="table table-hover">
      <thead class="table-dark">
        <tr><th>#</th><th>N Cuenta</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Saldo</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <?php foreach ($clientes as $c): ?>
        <tr>
          <td><?= (int)$c['id'] ?></td>
          <td><?= htmlspecialchars($c['n_cuenta']) ?></td>
          <td><?= htmlspecialchars($c['nombre']) ?></td>
          <td><?= htmlspecialchars($c['apellido']) ?></td>
          <td><?= htmlspecialchars($c['dni']) ?></td>
          <td>S/ <?= number_format((new \App\Models\Cliente())->saldo((int)$c['id']), 2) ?></td>
          <td>
            <form action="/clientes/<?= (int)$c['id'] ?>/delete" method="POST" class="d-inline"
                  data-confirm="¿Eliminar este cliente?">
              <?= \App\Core\Csrf::field() ?>
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="modalClienteWrap" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,.75); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:1rem;">
  <div style="background:linear-gradient(135deg, #1e293b, #0f172a); border:1px solid rgba(148,163,184,.25); border-radius:1rem; max-width:500px; width:100%; color:#e2e8f0; box-shadow:0 20px 60px rgba(0,0,0,.6); animation:slideUp .3s ease-out;">
    <div style="padding:1.25rem; border-bottom:1px solid rgba(148,163,184,.15); display:flex; justify-content:space-between; align-items:center;">
      <h5 style="margin:0; font-weight:600; color:#fff;"><i class="bi bi-people"></i> Nuevo Cliente</h5>
      <button type="button" onclick="cerrarModalCliente()" style="background:none; border:none; color:#94a3b8; font-size:1.75rem; line-height:1; cursor:pointer;">×</button>
    </div>
    <form action="/clientes" method="POST">
      <?= \App\Core\Csrf::field() ?>
      <div style="padding:1.25rem;">
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">N Cuenta</label>
          <input name="n_cuenta" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Nombre</label>
          <input name="nombre" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Apellido</label>
          <input name="apellido" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">DNI</label>
          <input name="dni" maxlength="8" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Email</label>
          <input type="email" name="email" style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Telefono</label>
          <input name="telefono" style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
      </div>
      <div style="padding:1.25rem; border-top:1px solid rgba(148,163,184,.15); display:flex; justify-content:flex-end; gap:.5rem;">
        <button type="button" onclick="cerrarModalCliente()" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<style>
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px) scale(.95); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
</style>

<script>
function abrirModalCliente() { document.getElementById('modalClienteWrap').style.display = 'flex'; }
function cerrarModalCliente() { document.getElementById('modalClienteWrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnNuevoCliente').addEventListener('click', abrirModalCliente);
    document.getElementById('modalClienteWrap').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalCliente();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalCliente();
    });
});
</script>