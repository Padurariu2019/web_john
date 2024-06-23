<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Muse</title>
    <link rel="stylesheet" href="assets/css/favorites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets/js/favorites.js" defer></script>
</head>
<body>
<?php require_once 'partials/header.php'; ?>
<div class="title-bar my-favorites">
    <h1>MY FAVORITES</h1>
</div>
<nav>
    <div id="favorites-gallery">
        <?php
        if (count($favorites) == 0) {
            echo '<h3 style="color:black">No favorites yet</h3>';
        } else {
            for ($i = 0; $i < min(count($favorites), 5); $i++) {
                $favorite_id = $favorites[$i];
                echo '<img src="http://localhost:5050/api/v1/products/' . $favorite_id . '/image" alt="Favorite">';
            }
        }
        ?>
    </div>
</nav>
<div class="title-bar popular-products">
    <h4>THE MOST POPULAR PRODUCTS</h4>
</div>
<div>
    <div id="popular-products-gallery">
        <?php
        for ($i = 0; $i < 5; $i++) {
            $product_id = $top_products[$i]['id'];
            echo '<img src="http://localhost:5050/api/v1/products/' . $product_id . '/image" alt="Popular Product">';
        }
        ?>
    </div>
</div>
<div class="title-bar rankings">
    <h3>AVAILABLE RANKINGS OF THE MOST POPULAR PRODUCTS</h3>
</div>
<div id="top-container"></div>
<footer>
    <button class="rounded-button" id="generate-html-top">HTML</button>
    <button class="rounded-button" id="generate-rss-top">RSS</button>
    <button class="rounded-button" id="generate-pdf-top">PDF</button>
</footer>
<script>
    var tops = <?php echo json_encode($data); ?>;
    console.log(tops);
</script>
</body>
</html>
