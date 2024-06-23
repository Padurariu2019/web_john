<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Muse - Sign In</title>
    <link rel="stylesheet" href="assets/css/sign_in.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="documentation_style.css">
</head>
<body>
    <main class="login-container">
        <section class="login-box">    
            <div class="signup-form">
                <div class="header-container">
                    <h1 class="welcome-back-title">Welcome back!</h1>
                    <img src="assets/images/logo.png" alt="Logo" class="signup-logo">
                </div>
                <form action="/sign_in" method="post">
                    <div class="input-container">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-container">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <?php if (isset($error)) {
                        echo '<p class="error">' . $error . '</p>';
                    }?>
                    
                    <button type= "submit" class="button" >Sign In</button>
                </form>
                <a href="/docs" class="btn documentation-button" target="_blank">MaWA Documentation-ScholarlyHTML</a>
            </div>
            <div class="vertical-line"></div>
            <aside class="signup-image">
                <img src="assets/images/poza1.jpg" alt="Signup Background Image">
            </aside>
        </section>
    </main>
    
</body>
</html>
