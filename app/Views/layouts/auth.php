<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($title ?? 'Login') ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
  <?php if ($msg = \App\Core\Session::flash('error')): ?>
    <div class="alert alert-danger mt-3"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
  <?php require __DIR__ . '/../' . $view . '.php'; ?>
</div>
</body>
</html>