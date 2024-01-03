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
                <label for="movie_card_image" class="form-label">Film Kart Görseli</label>
                <textarea class="form-control" id="movie_card_image" name="movie_card_image" rows="1"></textarea>
            </div>
            <div class="mb-3">
            <label for="image_location" class="form-label">Görselin Konumu</label>
                <textarea class="form-control" id="image_location" name="image_location"
                    rows="1" disabled></textarea>
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

        $('#movie_card_image').summernote({
            tabsize: 2,
            height: 20,
            toolbar: [
                ['insert', ['picture']],
            ],
            callbacks: {
                onImageUpload: function (files) {
                    for (let i = 0; i < files.length; i++) {
                        $.uploadCardImage(files[i]);
                    }
                }
            }
        });

        $.uploadCardImage = function (file) {
            let cardimage = new FormData();
            cardimage.append('file', file, file.name);

            $.ajax({
                method: 'POST',
                url: 'upload-movie-image.php',
                contentType: false,
                cache: false,
                processData: false,
                data: cardimage,
                success: function (img) {
                    $('#image_location').val(img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $("#save-btn").click(function (e) {
            e.preventDefault();
            var movie_name = $('#movie_name').val();
            var director_name = $('#director_name').val();
            var card_image = $('#image_location').val();
            var content_rating_tags = $('#content_rating_tags').val();
            var genres = $('#genres').val();
            //var dataString = 'movie_review_editor=' + encodeURIComponent(movie_review_editor) + '&movie_name=' + encodeURIComponent(movie_name) + '&review_title=' + encodeURIComponent(review_title) + '&card_content=' + encodeURIComponent(card_content) + '&movie_review_card_image=' + encodeURIComponent(movie_review_card_image);
            var dataString = 'movie_name=' + encodeURIComponent(movie_name) + '&director_name=' + encodeURIComponent(director_name) + '&card_image=' + encodeURIComponent(card_image) + '&content_rating_tags=' + encodeURIComponent(content_rating_tags) + '&genres=' + encodeURIComponent(genres);
            if (movie_name == '' || director_name == '' || content_rating_tags == '' || genres == '' || card_image == '' ) {
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