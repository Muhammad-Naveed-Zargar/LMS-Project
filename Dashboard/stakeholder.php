<?php
require_once '../config.php';
require_once '../functions.php';
require_role(['stakeholder']);
include '../header.php';
$user = current_user();
?>
<div class="container mt-4">
  <h2>Stakeholder Dashboard</h2>
  <p>Welcome, <?php echo e($user['full_name']); ?></p>
  <div class="card p-3">
    <h5>Stakeholder Actions</h5>
    <p>Reports, analytics and contact with admins.</p>
  </div>
</div>
<?php include '../footer.php'; ?>
