<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Muse</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <main class="login-container">
        <div class="login-box"> 
            <article class="signup-form">
                <div class="header-container">
                    <div class="text-container">
                        <h2 class="get-started-title">Get started</h2> 
                        <p class="account-signin">
                            Already have an account? <a href="sign_in" class="signup-link">Sign in</a>
                        </p>
                    </div>
                    <img src="assets/images/logo.png" alt="Logo" class="signup-logo">
                </div>                      
                <form action="/" method="post" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required>


                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select your gender</option>
                        <?php foreach ($genders as $gender){ ?>
                            <option value="<?php echo $gender->id; ?>"><?php echo $gender->gender; ?></option>
                        <?php } ?>
                    </select>
                    
                    <label for="skin_type">Skin type:</label>
                    <select id="skin_type" name="skin_type" required>
                        <option value="" disabled selected>What type of skin do you have?</option>
                        <?php foreach ($skinTypes as $skinType){ ?>
                            <option value="<?php echo $skinType->id; ?>"><?php echo $skinType->type; ?></option>
                        <?php } ?>
                    </select>

                    
                    <label for="social_status">Social Status:</label>
                    <select id="social_status" name="social_status" required>
                        <option value="" disabled selected>Select your social status</option>
                        <?php foreach ($socialStatuses as $socialStatus){ ?>
                            <option value="<?php echo $socialStatus->id; ?>"><?php echo $socialStatus->status; ?></option>
                        <?php } ?>
                    </select>

                    <label for="age_group">Age group:</label>
                    <select id="age_group" name="age_group" required>
                        <option value="" disabled selected>What age group do you belong to?</option>
                        <?php foreach ($ageGroups as $ageGroup){ ?>
                            <option value="<?php echo $ageGroup->id; ?>"><?php echo $ageGroup->group; ?></option>
                        <?php } ?>
                    </select>
                    
                    <label for="image">Profile picture:</label>
                    <input type="file" id="image" name="image">

                    <?php if (isset($error)) {
                        echo '<p class="error">' . $error . '</p>';
                    }?>

                    <button type="submit" class="button">Sign Up</button>
                </form>
            </article>
            <div class="vertical-line"></div>
            <aside class="signup-image">
                <img src="assets/images/pensule.jpg" alt="Signup Image">
            </aside>
        </div>
    </main>
</body>
</html>
