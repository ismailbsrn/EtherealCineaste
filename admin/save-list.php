<?php
$con = mysqli_connect("localhost", "root", "", "ethereal_cineaste");

$stmt = $con->prepare("INSERT INTO `lists` (`list_title`, `card_image`, `card_content`, `content`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $list_title, $card_image , $card_content, $content);

$list_title = $_POST['list_title'];
$card_image = $_POST['list_card_image'];
$card_content = $_POST['card_content'];
$content = $_POST['list_editor'];

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