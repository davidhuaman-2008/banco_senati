<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-5 col-lg-4">
    <div class="card shadow-lg animate-in" data-aos="zoom-in">
      <div class="card-body p-5">
        <div class="text-center mb-4">
          <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
               style="width: 70px; height: 70px; background: linear-gradient(135deg, #6366f1, #ec4899);">
            <i class="bi bi-shield-lock fs-2 text-white"></i>
          </div>
          <h3 class="fw-bold">Iniciar Sesión</h3>
          <p class="text-secondary small">Ingresa tus credenciales para continuar</p>
        </div>

        <form method="POST" action="/login">
          <?= \App\Core\Csrf::field() ?>

          <div class="mb-3">
            <label class="form-label small text-secondary">
              <i class="bi bi-person"></i> Usuario
            </label>
            <input type="text" name="usuario" class="form-control" placeholder="admin" required autofocus>
          </div>

          <div class="mb-4">
            <label class="form-label small text-secondary">
              <i class="bi bi-key"></i> Contraseña
            </label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
            <i class="bi bi-box-arrow-in-right"></i> Ingresar
          </button>
        </form>

        <div class="text-center mt-4">
          <small class="text-secondary">
            Demo: <code class="text-primary">admin</code> / <code class="text-primary">admin123</code>
          </small>
        </div>
      </div>
    </div>
  </div>
</div>