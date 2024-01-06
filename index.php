<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethereal Cinéaste</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Fonts and Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <!-- Slider main container -->
    <div class="swiper" id="hero-slider">
        <!-- Wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php
            $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");
            $result = $mysqli->query("SELECT * FROM heros ORDER BY id DESC LIMIT 6");

            if (!$result) {
                die("Failed to retrieve notes: " . $mysqli->error);
            }

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="swiper-slide">
                    <a href="">
                        <div class="slide-image">
                            <?php

                            $imageURL = str_replace('../', '', $row['hero_content']);

                            echo '<img src="' . $imageURL . '" alt="" />';

                            ?>
                        </div>
                        <div class="slide-content">

                        </div>
                    </a>
                </div>
                <?php
            }
            ?>

        </div>
    </div>


    <section class="articles">
        <div class="articles-title">
            <h3>İNCELEMELER</h3>
        </div>
        <div class="article-container">
            <?php
            $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");
            $result = $mysqli->query("SELECT * FROM movie_reviews ORDER BY id DESC LIMIT 6");

            if (!$result) {
                die("Failed to retrieve notes: " . $mysqli->error);
            }

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="article">
                    <div class="article-img">
                        <?php

                        $imageURL = str_replace('../', '', $row['card_image']);

                        echo '<img src="' . $imageURL . '" alt="" />';

                        ?>
                    </div>
                    <div class="article-content">
                        <h3>
                            <?php echo $row['review_title'] ?>
                        </h3>
                        <br>
                        <p>
                            <?php
                            $content = html_entity_decode($row['card_content']);
                            echo substr($content, 0, 200);
                            if (strlen($content) > 200) {
                                echo '...';
                            }
                            ?>
                        </p>

                    </div>
                    <div class="article-footer">
                        <a href="#" class="read-more-link" data-movie-id="movie1"
                            onclick="window.location.href='contents/review.php?movieID=<?php echo $row['id']; ?>'">devamını
                            gör</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="articles-footer">
            <div class="articles-footer-btn">
                <a href="reviews.php">tüm incelemeleri görüntüle</a>
            </div>
        </div>
    </section>

    <section class="on-show">
        <div class="on-show-title">
            <h3>VİZYONDAKİ FİLMLER</h3>
        </div>
        <!-- Slider main container -->
        <div class="swiper" id="on-show-slider">
            <!-- Wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                function getSymbolPath($tag)
                {
                    $symbolPaths = [
                        '+7' => './assets/content-rating-system/7yas.png',
                        '+13' => './assets/content-rating-system/13yas.png',
                        '+18' => './assets/content-rating-system/18yas.png',
                        'genel' => './assets/content-rating-system/genel.png',
                        'olumsuz' => './assets/content-rating-system/olumsuz.png',
                        'siddet' => './assets/content-rating-system/siddet.png',
                    ];

                    return isset($symbolPaths[$tag]) ? $symbolPaths[$tag] : './assets/content-rating-system/genel.png';
                }
                ?>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");
                $result = $mysqli->query("SELECT * FROM on_show_movie ORDER BY id DESC LIMIT 10");

                if (!$result) {
                    die("Failed to retrieve notes: " . $mysqli->error);
                }

                while ($row = $result->fetch_assoc()) {
                    if ($row['on_show'] == 0) {
                        continue;
                    }
                    ?>

                    <div class="swiper-slide">
                        <a href="on-show.php">
                            <div class="on-show-slider-card">
                                <div class="on-show-slider-card-image">
                                    <?php

                                    $imageURL = str_replace('../', '', $row['card_image']);

                                    echo '<img src="' . $imageURL . '" alt="" />';

                                    ?>
                                </div>
                                <div class="on-show-slider-card-top-layer">
                                    <div class="on-show-slider-card-symbols">


                                        <?php

                                        $contentRatingTags = $row['content_rating_tags'];

                                        $tagsArray = explode(',', $contentRatingTags);

                                        foreach ($tagsArray as $tag) {
                                            $symbolPath = getSymbolPath($tag);

                                            echo '<img src="' . $symbolPath . '" alt="' . $tag . '" />';
                                        }
                                        ?>
                                    </div>
                                    <div class="on-show-slider-card-text">
                                        <h3>
                                            <?php echo $row['movie_name'] ?>
                                        </h3>
                                        <h4>
                                            <?php echo $row['director_name'] ?>
                                        </h4>
                                        <p>
                                            <?php echo $row['genres']; ?>
                                        </p>
                                    </div>

                                </div>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>

        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>

        <!-- Navigation -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        </div>

    </section>

    <section class="news-section">
        <div class="news-title">
            <h3>HABERLER</h3>
        </div>
        <div class="news-container">
            <br><br>
            <?php
            $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");

            $result = $mysqli->query("SELECT * FROM movie_news ORDER BY id DESC LIMIT 3");

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
                                echo substr($content, 0, 200);
                                if (strlen($content) > 200) {
                                    echo '...';
                                }
                                ?>

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
        <div class="news-section-footer">
            <div class="news-section-footer-btn">
                <a href="#">tüm haberleri görüntüle</a>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="assets/main.js"></script>
</body>

</html>