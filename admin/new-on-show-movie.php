<?php include 'admin-header.php'; ?>

<div class="main-container d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="col-lg-9">
        <div class="alert-box">
            
        </div>
        <form method="post">
            <div class="mb-3">
                <label for="movie_name" class="form-label">Film İsmi</label>
                <textarea class="form-control" id="movie_name" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="director_name" class="form-label">Yönetmen İsmi</label>
                <textarea class="form-control" id="director_name" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="content_rating_tags" class="form-label">Uygunluk Etiketleri</label>
                <textarea class="form-control" id="content_rating_tags" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="genres" class="form-label">Tür</label>
                <textarea class="form-control" id="genres" rows="1"></textarea>
            </div>
            <button type="submit" id="save-btn" class="btn btn-secondary" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                Submit
            </button>
        </form>

    </div>
</div>

<script>
    $(document).ready(function () {
        $("#save-btn").click(function (e) {
            e.preventDefault();
            var movie_name = $('#movie_name').val();
            var director_name = $('#director_name').val();
            var content_rating_tags = $('#content_rating_tags').val();
            var genres = $('#genres').val();
            if (movie_name == '' || director_name == '' || content_rating_tags == '' || genres == '') {
                $(".alert-box").html("<div class=\"alert alert-danger\">Tüm alanları doldurunuz</div>");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "save-on-show-movie.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        alert(result);
                    }
                });
            }
            return false;
        });
    });
</script>

<?php include 'admin-footer.php'; ?>