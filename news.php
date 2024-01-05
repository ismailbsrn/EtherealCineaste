<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haberler</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <div class="news-main">
        <br><br><br><br>
        <section class="news-section">
            <div class="news-container">
                <?php
                $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");

                $result = $mysqli->query("SELECT * FROM movie_news ORDER BY id DESC LIMIT 6");

                if (!$result) {
                    die("Failed to retrieve notes: " . $mysqli->error);
                }

                while ($row = $result->fetch_assoc()) {
                    ?>



                    <div class="news">
                        <div class="news-img">
                            <?php

                            $imageURL = str_replace('../', '', $row['card_image']);

                            echo '<img src="' . $imageURL . '" alt="" />';

                            ?>
                        </div>
                        <div class="news-right">
                            <div class="news-content">
                                <h3>
                                    <?php echo $row['news_title'] ?>
                                </h3>
                                <br>
                                <p>
                                    <?php $content = html_entity_decode($row['card_content']);
                                        echo substr($content, 0, 200) ?>
                                </p>

                            </div>
                            <div class="news-footer">
                                <a href="#" class="read-more-link" data-movie-id="movie1"
                                    onclick="window.location.href='contents/news.php?movieID=<?php echo $row['id']; ?>'">habere
                                    git</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </section>
    </div>

    <?php include 'partials/footer.php'; ?>
    <script src="assets/main.js"></script>
</body>

</html>