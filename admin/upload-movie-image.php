<?php
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];

    move_uploaded_file($file, '../images/on-show-movies/' . $fileName);

    echo '../images/on-show-movies/' . $fileName;
} else {
    echo 'Error uploading file.';
}
?>