<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Muse</title>
    <link rel="stylesheet" href="assets/css/skin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>

<?php require_once 'partials/header.php'; ?>

<main>
    <div id="page1-imgs">
        <div class="card">
            <img src="assets/images/im2.jpeg" alt="skin1">
        </div>
        <div class="card">
            <img src="assets/images/im3.jpeg" alt="skin2">
        </div>
        <div class="card">
            <img src="assets/images/im1.jpeg" alt="skin3">
        </div>
    </div>

    <section>
        <div class="black-bar"></div>
        <div class="preferences">Preferences</div>
        <div class="subtitle"><i>for personalised advice, complete the following:</i></div>
        <form action="recommendations" method="POST">
            <div class="page1-card-wrapper">

                <div class="card-type2">
                    <h1>Age</h1>
                    <p>Choose the age interval you fit in</p>
                    <ul class="page1-cards">
                        <?php foreach ($ageGroups as $ageGroup) { ?>
                            <li>
                                <label class="checkbox">
                                    <input type="radio" name="age_group" value="<?php echo $ageGroup->id; ?>">
                                    <span><?php echo $ageGroup->group; ?></span>
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="card-type2">
                    <h1>Skin Type</h1>
                    <p>Choose your skin type</p>
                    <ul class="page1-cards">
                        <?php foreach ($skinTypes as $skinType) { ?>
                            <li>
                                <label class="checkbox">
                                    <input type="radio" name="skin_type" value="<?php echo $skinType->id; ?>">
                                    <span><?php echo $skinType->type; ?></span>
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="card-type2">
                    <h1>Time of Day</h1>
                    <p>Choose the time of the day</p>
                    <ul class="page1-cards">
                        <?php foreach ($timesOfDay as $timeOfDay) { ?>
                            <li>
                                <label class="checkbox">
                                    <input type="radio" name="time_of_day" value="<?php echo $timeOfDay->id; ?>">
                                    <span><?php echo $timeOfDay->timeOfDay; ?></span>
                                </label>
                            </li>
                        <?php } ?>
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
