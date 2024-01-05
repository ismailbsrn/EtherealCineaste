<?php
$mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

if (isset($_GET['movieID'])) {
    $movieID = $_GET['movieID'];
    $result = $mysqli->query("SELECT * FROM lists WHERE id = '$movieID'");
    if (!$result) {
        die("Failed to retrieve notes: " . $mysqli->error);
    } else {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $entry_date = $row['entry_date'];
        $list_title = $row['list_title'];
        $content = html_entity_decode($row['content']); // Decode the contents to display in browser    
    }


} else {
    echo "No movie ID provided.";
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listeler</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../assets/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
</head>

<body>
    <?php include '../partials/header.php'; ?>
    <div id="markdown-container">
        <?php echo $content; ?>
    </div>

    <?php include '../partials/footer.php'; ?>
    <script src="assets/main.js"></script>
</body>

</html>