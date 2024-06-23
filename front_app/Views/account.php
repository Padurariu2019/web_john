<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Muse</title>
	<link rel="stylesheet" href="assets/css/account.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body>
	<?php require_once 'partials/header.php'; ?>

	<div class="account-container">
		<div class="main-content">
			<div class="user-photo">
				<img src=<?php echo $apiUrl . "/users/" . $userId . "/image"?> alt="User Photo">
			</div>
			<div class="card" id="personal-info">
				<h2>Personal Information</h2>
				<h3>you can view or edit your personal information</h3>
                <form action="account" method="post">
                    <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" >

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" >

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" >

                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" >

                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" >
                        <option value="" selected hidden>Select your gender</option>
                        <?php foreach ($genders as $gender){ ?>
                            <option value="<?php echo $gender->id; ?>"><?php echo $gender->gender; ?></option>
                        <?php } ?>
                    </select>
                    
                    <label for="skin_type">Skin type:</label>
                    <select id="skin_type" name="skin_type" >
                        <option value="" selected hidden>What type of skin do you have?</option>
                        <?php foreach ($skinTypes as $skinType){ ?>
                            <option value="<?php echo $skinType->id; ?>"><?php echo $skinType->type; ?></option>
                        <?php } ?>
                    </select>

                    
                    <label for="social_status">Social Status:</label>
                    <select id="social_status" name="social_status" >
                        <option value="" selected hidden>Select your social status</option>
                        <?php foreach ($socialStatuses as $socialStatus){ ?>
                            <option value="<?php echo $socialStatus->id; ?>"><?php echo $socialStatus->status; ?></option>
                        <?php } ?>
                    </select>

                    <label for="age_group">Social Status:</label>
                    <select id="age_group" name="age_group" >
                        <option value="" selected hidden>What age group do you belong to?</option>
                        <?php foreach ($ageGroups as $ageGroup){ ?>
                            <option value="<?php echo $ageGroup->id; ?>"><?php echo $ageGroup->group; ?></option>
                        <?php } ?>
                    </select>

                    <button type="submit" class="button">Update</button>
                </form>
			</div>
		</div>
	</div>
</body>

</html>