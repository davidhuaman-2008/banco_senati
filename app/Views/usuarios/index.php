<div class="d-flex justify-content-between align-items-center mb-3">
  <h2><i class="bi bi-person-badge"></i> Usuarios</h2>
  <button class="btn btn-dark" id="btnNuevoUsuario">
    <i class="bi bi-plus-circle"></i> Nuevo Usuario
  </button>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <table class="table table-hover">
      <thead class="table-dark">
        <tr><th>#</th><th>Usuario</th><th>Rol</th><th>Activo</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= (int)$u['id'] ?></td>
          <td><?= htmlspecialchars($u['usuario']) ?></td>
          <td><span class="badge bg-info"><?= htmlspecialchars($u['rol']) ?></span></td>
          <td><?= $u['activo'] ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>' ?></td>
          <td>
            <form action="/usuarios/<?= (int)$u['id'] ?>/delete" method="POST" class="d-inline"
                  data-confirm="¿Eliminar este usuario?">
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

<div id="modalUsuarioWrap" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,.75); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:1rem;">
  <div style="background:linear-gradient(135deg, #1e293b, #0f172a); border:1px solid rgba(148,163,184,.25); border-radius:1rem; max-width:500px; width:100%; color:#e2e8f0; box-shadow:0 20px 60px rgba(0,0,0,.6); animation:slideUp .3s ease-out;">
    <div style="padding:1.25rem; border-bottom:1px solid rgba(148,163,184,.15); display:flex; justify-content:space-between; align-items:center;">
      <h5 style="margin:0; font-weight:600; color:#fff;"><i class="bi bi-person-badge"></i> Nuevo Usuario</h5>
      <button type="button" onclick="cerrarModalUsuario()" style="background:none; border:none; color:#94a3b8; font-size:1.75rem; line-height:1; cursor:pointer;">×</button>
    </div>
    <form action="/usuarios" method="POST">
      <?= \App\Core\Csrf::field() ?>
      <div style="padding:1.25rem;">
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Usuario</label>
          <input name="usuario" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Contraseña</label>
          <input type="password" name="password" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
        </div>
        <div style="margin-bottom:1rem;">
          <label style="display:block; margin-bottom:.35rem; font-size:.875rem; color:#94a3b8;">Rol</label>
          <select name="rol" required style="width:100%; padding:.6rem; background:rgba(15,23,42,.6); border:1px solid rgba(148,163,184,.2); border-radius:.5rem; color:#e2e8f0;">
            <option value="empleado">Empleado</option>
            <option value="obrero">Obrero</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>
      <div style="padding:1.25rem; border-top:1px solid rgba(148,163,184,.15); display:flex; justify-content:flex-end; gap:.5rem;">
        <button type="button" onclick="cerrarModalUsuario()" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn btn-dark">Guardar</button>
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
function abrirModalUsuario() { document.getElementById('modalUsuarioWrap').style.display = 'flex'; }
function cerrarModalUsuario() { document.getElementById('modalUsuarioWrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnNuevoUsuario').addEventListener('click', abrirModalUsuario);
    document.getElementById('modalUsuarioWrap').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalUsuario();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalUsuario();
    });
});
</script>