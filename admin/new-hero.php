<?php include 'admin-header.php'; ?>

<div class="main-container d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="col-lg-9">
        <div class="alert-box">

        </div>
        <form method="post">
            <div class="mb-3">
                <label for="image_editor" class="form-label">Görsel</label>
                <textarea class="form-control" id="image_editor" name="image_editor"></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Görsel Açıklaması</label>
                <textarea class="form-control" id="description" name="description" rows="1"></textarea>
            </div>
            <button type="submit" id="save-btn" class="btn btn-secondary">
                Submit
            </button>
        </form>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#image_editor').summernote({
            tabsize: 2,
            height: 20,
            toolbar: [
                // ['style', ['style']],
                // ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript', 'clear']],
                // ['fontname', ['fontname']],
                // ['color', ['color']],
                // ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                ['insert', ['picture']],
                // ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            }
        });

        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajax({
                method: 'POST',
                url: 'upload-hero-image.php',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#image_editor').summernote('insertImage',img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $("#save-btn").click(function (e) {
            e.preventDefault();
            var image_editor = $('#image_editor').summernote('code');
            var description = $('#description').val();
            var dataString = 'image_editor=' + encodeURIComponent(image_editor) + '&description=' + encodeURIComponent(description);
            if (image_editor == '' || description == '') {
                $(".alert-box").html("<div class=\"alert alert-danger\">Tüm alanları doldurunuz</div>");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "save-new-hero.php",
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