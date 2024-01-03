<?php
$con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

$stmt = $con->prepare("INSERT INTO `on_show_movie` (`movie_name`, `director_name`, `card_image`, `content_rating_tags`, `genres`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $movie_name, $director_name, $card_image, $content_rating_tags, $genres);

$movie_name = $_POST['movie_name'];
$director_name = $_POST['director_name'];
$content_rating_tags = $_POST['content_rating_tags'];
$card_image = $_POST['card_image'];
$genres = $_POST['genres'];

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