<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Muse</title>
	<link rel="stylesheet" href="assets/css/cosmetics.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body>

	<?php require_once 'partials/header.php'; ?>

	<main>
		<div id="page1-imgs">

			<div class="card">
				<img src="assets/images/makeup.jpg" alt="cosmetics1">
			</div>
			<div class="card">
				<img src="assets/images/IMG_2637.JPG" alt="cosmetics2">
			</div>

			<div class="card">
				<img src="assets/images/IMG_2638.JPG" alt="cosmetics3">
			</div>

		</div>

		<section>
			<div class="black-bar"></div>
			<div class="preferences">Preferences</div>
			<div class="subtitle"><i>for personalised advice, complete the following:</i></div>
			<form action="recommendations" method="POST">
				<div class="page1-card-wrapper">

					<div class="card-type2 ">
						<h1>age</h1>

						<p>Choose the age interval you fit in</p>

						<ul class="page1-cards">
							<?php foreach ($ageGroups as $ageGroup) : ?>
								<li>
									<label class="checkbox">
										<input type="radio" name="age_group" value="<?= $ageGroup->id ?>" required>
										<span><?= $ageGroup->group ?></span>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>

					</div>

					<div class="card-type2">
						<h1>skin type</h1>
						<p>Choose your skin type</p>
						<ul class="page1-cards">
							<?php foreach ($skinTypes as $skinType) : ?>
								<li>
									<label class="checkbox">
										<input type="radio" name="skin_type" value="<?= $skinType->id ?>" required>
										<span><?= $skinType->type ?></span>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="card-type2">
						<h1>occasion</h1>
						<p>Choose the occasion <br>you are looking for</p>
						<ul class="page1-cards">
							<?php foreach ($occasions as $occasion) : ?>
								<li>
									<label class="checkbox">
										<input type="radio" name="occasion" value="<?= $occasion->id ?>" required>
										<span><?= $occasion->occasion ?></span>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="step-container">
					<input type="submit" class="pink-btn" value="Get recommandations">
				</div>
			</form>
		</section>
	</main>

</body>

</html>