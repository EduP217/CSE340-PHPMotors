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
            <h1 class="heading-title text-center">REGISTER</h1>
            <div>
                <form action="?action=registration" method="POST">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" required>
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <h5>
                        Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
                    </h5>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <button type="button" title="Show Password" class="show-password">Show Password</button>
                    <button type="submit">Register</button>
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