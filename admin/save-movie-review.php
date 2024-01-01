<?php
$con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

$stmt = $con->prepare("INSERT INTO `movie_reviews` (`movie_name`, `review_title`, `card_image`, `card_content`, `content`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $movie_name, $review_title, $card_image , $card_content, $content);

$movie_name = $_POST['movie_name'];
$review_title = $_POST['review_title'];
$card_content = $_POST['card_content'];
$card_image = $_POST['movie_review_card_image'];
$content = $_POST['movie_review_editor'];
$content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

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