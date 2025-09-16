<?php
require_once 'config.php';
require_once 'functions.php';

$err = null;
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $err = 'Invalid CSRF token';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $stmt = $pdo->prepare('SELECT id,full_name,email,password,role FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            // redirect to role dashboard
            switch ($user['role']) {
                case 'admin': header('Location: dashboards/admin.php'); break;
                case 'instructor': header('Location: dashboards/instructor.php'); break;
                case 'student': header('Location: dashboards/student.php'); break;
                case 'stakeholder': header('Location: dashboards/stakeholder.php'); break;
                default: header('Location: dashboards/student.php');
            }
            exit;
        } else {
            $err = 'Invalid credentials';
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Login</h4>
          <?php if ($err): ?>
            <div class="alert alert-danger"><?php echo e($err); ?></div>
          <?php endif; ?>
          <?php if ($msg = flash('success')): ?>
            <div class="alert alert-success"><?php echo e($msg); ?></div>
          <?php endif; ?>

          <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo e($_SESSION['csrf_token']); ?>" />
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input class="form-control" name="email" type="email" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" name="password" type="password" required />
            </div>
            <button class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
