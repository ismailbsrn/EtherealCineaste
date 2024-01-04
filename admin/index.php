<?php
// admin_dashboard.php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
// Rest of the admin dashboard code
?>


<?php include 'admin-header.php'; ?>

<div class="d-flex justify-content-center align-items-center mt-5">
    Yönetim Paneline Hoşgeldiniz!
</div>

<?php include 'admin-footer.php'; ?>