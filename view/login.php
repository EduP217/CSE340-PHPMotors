<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PHP Motors</title>

    <link rel="stylesheet" href="../css/style.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
</head>

<body>
    <header>
        <?php include '../snippets/header.php'; ?>
    </header>
    <nav class="header-navigation">
        <?php echo $navList; ?>
    </nav>
    <main>
        <div class="login-container">
            <h1 class="heading-title text-center">LOGIN</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div>
                <form action="/phpmotors/accounts/index.php" method="POST">
                    <input type="hidden" name="action" value="Login">
                    <label for="clientEmail">Email</label>
                    <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>  required>
                    <label for="clientPassword">Password</label>
                    <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                    <h5>
                        Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
                    </h5>
                    <button type="submit">Sign In</button>
                </form>
            </div>
            <div class="text-right">
                <h3>No account? <a href="?action=registration"><u>Register</u></a></h3>
            </div>
        </div>
    </main>
    <footer>
        <?php include '../snippets/footer.php'; ?>
    </footer>

    <script src="../js/utils.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>