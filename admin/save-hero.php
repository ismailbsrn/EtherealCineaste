<?php
$con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

$stmt = $con->prepare("INSERT INTO `heros` (`hero_content`, `hero_description`) VALUES (?, ?)");
$stmt->bind_param("ss", $hero_content, $hero_description);

$hero_content = $_POST['image_location'];
$hero_description = $_POST['description'];

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