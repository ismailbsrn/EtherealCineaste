<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the admin is logged in and has "root" access
if ($_SESSION['root'] != 1) {
    die("Unauthorized access");
}

?>

<?php include 'admin-header.php'; ?>

<div class="main-container d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="col-lg-9">
        <div class="alert-box"></div>
        <form method="post">
            <div class="mb-3">
                <label for="admin_name" class="form-label">Admin Adı</label>
                <textarea class="form-control" id="admin_name" name="admin_name" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="admin_surname" class="form-label">Admin Soyadı</label>
                <textarea class="form-control" id="admin_surname" name="admin_surname" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <textarea class="form-control" id="username" name="username" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <textarea class="form-control" id="password" name="password" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="password_check" class="form-label">Şifre Tekrar</label>
                <textarea class="form-control" id="password_check" name="password_check" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="delete_authority" class="form-label">Silme Yetkisi</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delete_authority" id="delete_yes" value="1">
                    <label class="form-check-label" for="delete_yes">
                        Evet
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delete_authority" id="delete_no" value="0"
                        checked>
                    <label class="form-check-label" for="delete_no">
                        Hayır
                    </label>
                </div>
            </div>
            <button type="submit" id="save-btn" class="btn btn-secondary">
                Submit
            </button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#save-btn").click(function (e) {
            e.preventDefault();
            var admin_name = $('#admin_name').val();
            var admin_surname = $('#admin_surname').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var password_check = $('#password_check').val();
            var delete_authority = $("input[name='delete_authority']:checked").val() == "1" ? 1 : 0;

            var dataString = 'admin_name=' + admin_name + '&admin_surname=' + admin_surname + '&username=' + username +
                '&password=' + password + '&password_check=' + password_check + '&delete_authority=' + delete_authority;

            if (password != password_check) {
                $(".alert-box").html("<div class=\"alert alert-danger\">Şifreler uyuşmuyor</div>");
            } else if (admin_name == '' || admin_surname == '' || username == '' || password == '' || password_check == '') {
                $(".alert-box").html("<div class=\"alert alert-danger\">Tüm alanları doldurunuz</div>");
            } else {
                $.ajax({
                    type: "POST",
                    url: "save-admin.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        alert(result);
                    }
                });
            }
        });
    });

</script>

<?php include 'admin-footer.php'; ?>