<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizyondaki Filmler</title>
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
    <div class="on-show-main">

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
        <div class="on-show-container">
            <?php
            $mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");
            $result = $mysqli->query("SELECT * FROM on_show_movie ORDER BY id DESC LIMIT 20");

            if (!$result) {
                die("Failed to retrieve notes: " . $mysqli->error);
            }

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="on-show-card">
                    <div class="on-show-card-image">
                        <?php

                        $imageURL = str_replace('../', '', $row['card_image']);

                        echo '<img src="' . $imageURL . '" alt="" />';

                        ?>
                    </div>
                    <div class="on-show-card-top-layer">
                        <div class="on-show-card-symbols">

                            <?php

                            $contentRatingTags = $row['content_rating_tags'];

                            $tagsArray = explode(',', $contentRatingTags);

                            foreach ($tagsArray as $tag) {
                                $symbolPath = getSymbolPath($tag);

                                echo '<img src="' . $symbolPath . '" alt="' . $tag . '" />';
                            }
                            ?>
                        </div>
                        <div class="on-show-card-text">
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
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php include 'partials/footer.php'; ?>
    <script src="assets/main.js"></script>
</body>

</html>