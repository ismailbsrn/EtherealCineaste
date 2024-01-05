<?php

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];

    move_uploaded_file($file, '../images/heros/' . $fileName);

    echo '../images/heros/' . $fileName;
} else {
    echo 'Error uploading file.';
}
?>