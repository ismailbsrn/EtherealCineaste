<?php include 'admin-header.php'; ?>

<div class="main-container d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="col-lg-9">
        <div class="alert-box">

        </div>
        <form method="post">
            <div class="mb-3">
                <label for="movie_name" class="form-label">Film İsmi</label>
                <textarea class="form-control" id="movie_name" name="movie_name" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="review_title" class="form-label">İnceleme Başlığı</label>
                <textarea class="form-control" id="review_title" name="review_title" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_review_card_image" class="form-label">İnceleme Kart Görseli</label>
                <textarea class="form-control" id="movie_review_card_image" name="movie_review_card_image"
                    rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="image_location" class="form-label">Görselin Konumu</label>
                <textarea class="form-control" id="image_location" name="image_location" rows="1" disabled></textarea>
            </div>
            <div class="mb-3">
                <label for="card_content" class="form-label">İnceleme Kart Metni</label>
                <textarea class="form-control" id="card_content" name="card_content" rows="1"></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_review_editor" class="form-label">İnceleme Metni</label>
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
            ],
            callbacks: {
                onImageUpload: function (files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            }
        });

        $('#movie_review_card_image').summernote({
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
                url: 'upload-review-image.php',
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


        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajax({
                method: 'POST',
                url: 'upload-review-image.php',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#movie_review_editor').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };



        $("#save-btn").click(function (e) {
            e.preventDefault();
            var movie_review_editor = $('#movie_review_editor').summernote('code');
            var movie_name = $('#movie_name').val();
            var review_title = $('#review_title').val();
            var movie_review_card_image = $('#image_location').val();
            var card_content = $('#card_content').val();
            var dataString = 'movie_review_editor=' + encodeURIComponent(movie_review_editor) + '&movie_name=' + encodeURIComponent(movie_name) + '&review_title=' + encodeURIComponent(review_title) + '&card_content=' + encodeURIComponent(card_content) + '&movie_review_card_image=' + encodeURIComponent(movie_review_card_image);
            if (movie_review_editor == '' || movie_name == '' || review_title == '' || card_content == '') {
                $(".alert-box").html("<div class=\"alert alert-danger\">Tüm alanları doldurunuz</div>");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "save-movie-review.php",
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