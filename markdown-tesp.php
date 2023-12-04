<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethereal Cinéaste</title>
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
    <?php include 'assets/header.php'; ?>

    <div id="markdown-container"></div>


    <?php include 'assets/footer.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/main.js"></script>
    <script>
        // Fetch the Markdown content
        fetch('test.md')
            .then(response => response.text())
            .then(markdownContent => {
                // Convert Markdown to HTML
                const converter = new showdown.Converter();
                const htmlContent = converter.makeHtml(markdownContent);

                // Display the HTML content in the specified container
                document.getElementById('markdown-container').innerHTML = htmlContent;
            });
    </script>

</body>

</html>