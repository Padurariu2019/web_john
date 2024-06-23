<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About Page Design</title>
	<link rel="stylesheet" href="assets/css/about.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
	<?php require_once 'partials/header.php'; ?>

	<main>
		<section class="about-section">
			<div class="container">
				<div class="bio">
					<h2>MUSE - Who Are We</h2>
					<p>We are two second-year students at the Faculty of Computer Science in Iasi, and we have chosen a project that aligns perfectly with our passion for makeup and skincare. In developing this web application, we aim to combine our knowledge of web technologies with our interest in beauty to create an easily navigable and useful platform.</p>
				</div>
				<div class="photo photo1">
					<img src="assets/images/skin5.jpeg" alt="Descriere alternativă a imaginii">
				</div>
				<div class="photo photo-special ">
					<img src="assets/images/skin3.jpeg" alt="Descriere alternativă a imaginii">
					<div class="overlay">
						<p>ABOUT US</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="photo photo2">
					<img src="assets/images/skin2.jpeg" alt="Descriere alternativă a imaginii">
				</div>
				<div class="bio">
					<h2> Our Purpose and Mission</h2>
					<p>Through this platform, we aim to provide advice and product recommendations that encompass a complete routine, from skincare tips to makeup application. Specifically, users receive all this personalized information based on criteria that help us determine what suits them best, and according to the preferences they specify.
						By creating this interactive web application, people without experience or who do not have extensive knowledge will be able to incorporate into their skincare routine products that match their needs and preferences.</p>
				</div>
			</div>
			<div class="container">
				<div class="bio">
					<h2>How It Works</h2>
					<p>The application is easy to use for users. They create an account, and then they only need to select their preferences and the categories they fit into. Each criteria is in a separate box, where the user will tick the option that suits them. Depending on the selected domain (cosmetics or skin), they will receive advice and examples of products from various brands that they can use. They can add to favorites the products that seem interesting, and can view them anytime by clicking the heart-shaped button in the header. There, they can also see products popular among other users, and download reports, in various formats, with popular products organized by specific categories. Additionally, users can easily navigate to specific pages like Contact and Help using the site's navigation menu, ensuring they can always find the assistance and information they need without hassle. </p>
				</div>
				<div class="photo photo3">
					<img src="assets/images/skin0.jpeg" alt="Descriere alternativă a imaginii">
				</div>
			</div>
		</section>
	</main>
</body>

</html>