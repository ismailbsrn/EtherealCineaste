<?php
ob_start(); // Turns on output buffering
session_start(); // Starting Session
error_reporting(E_ALL);

if ($_POST) {
    $con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

    $stmt = $con->prepare("INSERT INTO `movie_reviews` (`movie_name`, `review_title`, `card_content`, `content`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $movie_name, $review_title, $card_content, $content);

    $movie_name = $_POST['movie_name'];
    $review_title = $_POST['review_title'];
    $card_content = $_POST['card_content'];
    $content = $_POST['movie_review_editor'];
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    $stmt->execute();
    $a = $stmt->affected_rows;

    if ($a > 0) {
        $_SESSION['count'] = 0;
        $_SESSION['message'] = "New record created successfully";
        echo "<script>window.location.href='new-movie-review.php';</script>";
    } else {
        echo "Error: " . $con->error;
    }

    $stmt->close();
    $con->close();
}
?>

<?php include 'admin-header.php'; ?>

<div class="main-container d-flex flex-column justify-content-center align-items-center mt-5">

    <div class="col-lg-9">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-success' role='alert'>" . $_SESSION['message'] . "</div>";
            $_SESSION['count']++;
            if ($_SESSION['count'] > 1) {
                unset($_SESSION['message']);
                unset($_SESSION['count']);
            }
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="movie_name" class="form-label">Film İsmi</label>
                <textarea class="form-control" id="movie_name" name="movie_name" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="review_title" class="form-label">İnceleme Başlığı</label>
                <textarea class="form-control" id="review_title" name="review_title" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="card_content" class="form-label">İnceleme Kart Metni</label>
                <textarea class="form-control" id="card_content" name="card_content" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_review_editor" class="form-label">İncelem Metni</label>
                <textarea class="form-control" id="movie_review_editor" name="movie_review_editor" rows="6"></textarea>
            </div>
            <button type="submit" id="save-btn" class="btn btn-secondary">
                Submit
            </button>
        </form>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#movie_review_editor').summernote({
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<?php include 'admin-footer.php'; ?>