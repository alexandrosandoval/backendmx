<?php
// Vista de inicio de sesión.
ob_start();
?>
<div class="login-shell">
    <div class="login-card">
        <div class="login-brand">
            <i class="fa-solid fa-layer-group"></i>
            <div>
                <h1>ProjectFlow</h1>
                <p>Control inteligente y seguro</p>
            </div>
        </div>

        <h2>Acceso al sistema</h2>
        <p>Ingresa con tu usuario y contraseña.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo e($error); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/?route=login-submit" id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <small class="form-text text-muted">Se valida en tiempo real.</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

        <div class="login-footer">
            <span>¿Olvidaste tu contraseña?</span>
            <a href="#" class="text-decoration-none">Solicitar ayuda</a>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
$title = 'Acceso | ProjectFlow';
require __DIR__ . '/../layouts/base.php';
