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
        <div class="register-container">
            <h1 class="heading-title">REGISTER</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div>
                <form method="POST" action="/phpmotors/accounts/index.php">
                    <label for="clientFirstname">First Name</label>
                    <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
                    <label for="clientLastname">Last Name</label>
                    <input type="text" id="clientLastname" name="clientLastname" required>
                    <label for="clientEmail">Email</label>
                    <input type="email" id="clientEmail" name="clientEmail" required>
                    <label for="clientPassword">Password</label>
                    <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                    <h5>
                        Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
                    </h5>
                    <button type="button" title="Show Password" class="show-password">Show Password</button>
                    <button type="submit" name="submit" id="regbtn">Register</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
                </form>
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