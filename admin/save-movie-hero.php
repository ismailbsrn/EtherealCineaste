<?php
$con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

$stmt = $con->prepare("INSERT INTO `heros` (`hero_content`, `hero_description`) VALUES (?, ?)");
$stmt->bind_param("ss", $image_editor, $description);

$description = $_POST['description'];
$image_editor = $_POST['image_editor'];
$image_editor = htmlspecialchars($image_editor, ENT_QUOTES, 'UTF-8');

$stmt->execute();
$a = $stmt->affected_rows;

if ($a > 0) {
    echo "New record created successfully";
} else {
    echo "Error: " . $con->error;
}

$stmt->close();
$con->close();
?>