<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Muse</title>
	<link rel="stylesheet" href="assets/css/products.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <script>
        let globalVars = {
            apiUrl: "<?= $apiUrl ?>",
            userId: <?= $userId ?>,
            filters: "<?= $filterString?>"
        }
    </script>
    
    <script src="assets/js/productInserter.js" defer></script>
</head>
<body>
<?php require_once 'partials/header.php'; ?>

<div class="products-container" id="product-container">

</div>

</body>
</html>