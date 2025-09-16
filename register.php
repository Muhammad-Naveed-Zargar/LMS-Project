<?php
require_once 'config.php';
require_once 'functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid CSRF token';
    }
    $name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student';

    if (!$name) $errors[] = 'Full name required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required';
    if (strlen($password) < 6) $errors[] = 'Password must be >= 6 chars';
    if (!in_array($role, ['admin','instructor','student','stakeholder'])) $role='student';

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (full_name,email,password,role) VALUES (?,?,?,?)');
        try {
            $stmt->execute([$name,$email,$hash,$role]);
            flash('success','Account created. You can login now.');
            header('Location: login.php'); exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1]==1062) $errors[] = 'Email already in use';
            else $errors[] = 'Database error: '.$e->getMessage();
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Register</h4>
          <?php if ($errors): ?>
            <div class="alert alert-danger">
              <ul><?php foreach($errors as $err) echo '<li>'.e($err).'</li>'; ?></ul>
            </div>
          <?php endif; ?>

          <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo e($_SESSION['csrf_token']); ?>" />
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input class="form-control" name="full_name" value="<?php echo e($_POST['full_name'] ?? ''); ?>" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input class="form-control" name="email" type="email" value="<?php echo e($_POST['email'] ?? ''); ?>" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" name="password" type="password" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <select name="role" class="form-select">
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
                <option value="stakeholder">Stakeholder</option>
                <option value="admin">Admin</option>
              </select>
              <small class="text-muted">Choose role (in production only Admin should create Admin accounts).</small>
            </div>
            <button class="btn btn-primary">Create account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
