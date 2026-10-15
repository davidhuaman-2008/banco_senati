<div class="d-flex justify-content-between align-items-center mb-3">
  <h2><i class="bi bi-arrow-down-circle"></i> Retiros</h2>
  <button class="btn btn-warning" id="btnNuevoRetiro">
    <i class="bi bi-plus-circle"></i> Nuevo Retiro
  </button>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <table class="table table-hover">
      <thead class="table-dark">
        <tr><th>#</th><th>Cliente</th><th>Cuenta</th><th>Fecha</th><th>Monto</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <?php foreach ($retiros as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= htmlspecialchars($r['cliente']) ?></td>
          <td><?= htmlspecialchars($r['n_cuenta']) ?></td>
          <td><?= htmlspecialchars($r['fecha']) ?></td>
          <td>S/ <?= number_format((float)$r['monto'], 2) ?></td>
          <td>
            <form action="/retiros/<?= (int)$r['id'] ?>/delete" method="POST" class="d-inline"
                  data-confirm="¿Eliminar este retiro?">
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

<div id="modalRetiroWrap" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,.75); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:1rem;">
  <div style="background:linear-gradient(135deg, #1e293b, #0f172a); border:1px solid rgba(148,163,184,.25); border-radius:1rem; max-width:500px; width:100%; color:#e2e8f0; box-shadow:0 20px 60px rgba(0,0,0,.6); animation:slideUp .3s ease-out;">
    <div style="padding:1.25rem; border-bottom:1px solid rgba(148,163,184,.15); display:flex; justify-content:space-between; align-items:center;">
      <h5 style="margin:0; font-weight:600; color:#fff;"><i class="bi bi-arrow-down-circle"></i> Nuevo Retiro</h5>
      <button type="button" onclick="cerrarModalRetiro()" style="background:none; border:none; color:#94a3b8; font-size:1.75rem; line-height:1; cursor:pointer;">×</button>
    </div>
    <form action="/retiros" method="POST">
      <?= \App\Core\Csrf::field() ?>
      <div style="padding:1.25rem;">
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Cliente</label>
          <select name="cliente_id" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
            <option value="">Seleccione...</option>
            <?php foreach ($clientes as $c): ?>
              <option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['n_cuenta'].' - '.$c['nombre'].' '.$c['apellido']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Fecha</label>
          <input type="date" name="fecha" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0; color-scheme:dark;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Monto</label>
          <input type="number" step="0.01" name="monto" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
      </div>
      <div style="padding:1.25rem; border-top:1px solid rgba(148,163,184,.15); display:flex; justify-content:flex-end; gap:.5rem;">
        <button type="button" onclick="cerrarModalRetiro()" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn btn-warning">Guardar</button>
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
function abrirModalRetiro() { document.getElementById('modalRetiroWrap').style.display = 'flex'; }
function cerrarModalRetiro() { document.getElementById('modalRetiroWrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnNuevoRetiro').addEventListener('click', abrirModalRetiro);
    document.getElementById('modalRetiroWrap').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalRetiro();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalRetiro();
    });
});
</script>