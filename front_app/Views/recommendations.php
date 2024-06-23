<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Muse</title>
	<link rel="stylesheet" href="assets/css/recommendations.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script>
		console.log("hello");
        let globalVars = {
            apiUrl: "<?= $apiUrl ?>",
            userId: <?= $userId ?>,
			filters: "<?= $filterString ?>"
        }
		console.log(globalVars);
    </script>
    <script src="assets/js/productInserter.js" defer></script>
</head>

<body>

	<?php require_once 'partials/header.php'; ?>

	<main>

		<div id="reccom">
			<h1>OUR RECOMMENDATION</h1>
		</div>

		<section id="content">
			<div id="left-box">

				<h2>ADVICE </h2>
				<h3><i>~based on your selection~</i></h3>

				<?php foreach ($pageData as $data): ?>
					<h4 class="advice-title"><?= $data['title'] ?> (<?= $data['option']?>):</h4>
					<p class="advice-content"><?= $data['description'] ?></p>
				<?php endforeach; ?>
			</div>


			<div id="right-box">
				<img src="assets/images/makeup2.jpg" alt="Just an image">
			</div>

		</section>

		<section>
			<div class="products-container" id="product-container">

			</div>
		</section>
		
	</main>
</body>

</html>