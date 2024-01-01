<?php

// Check if a file was uploaded
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];

    // Move the uploaded file to a desired location
    move_uploaded_file($file, '../images/news/' . $fileName);

    // Return the path of the uploaded image
    echo '../images/news/' . $fileName;
} else {
    // Return an error message if the file upload failed
    echo 'Error uploading file.';
}
?>