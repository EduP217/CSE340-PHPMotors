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
        <div class="manage-account-container">
            <h1 class="heading-title">Manage Account</h1>
            <div>
                <h3 class="heading-subtitle">Update Account</h3>
                <?php
                if (isset($accountMessage)) {
                    echo $accountMessage;
                }
                ?>
                <form method="POST" action="/phpmotors/accounts/index.php">
                    <label for="clientFirstname">First Name</label>
                    <input type="text" id="clientFirstname" name="clientFirstname" <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";} ?> required>
                    <label for="clientLastname">Last Name</label>
                    <input type="text" id="clientLastname" name="clientLastname" <?php if (isset($clientLastname)) {echo "value='$clientLastname'";} ?> required>
                    <label for="clientEmail">Email</label>
                    <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required>
                    <button type="submit" name="submit" class="updbtn">Update Info</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="clientId" value="<?php if (isset($clientId)) {echo $clientId;} ?>" />
                </form>
            </div>
            <div>
                <h3 class="heading-subtitle">Update Password</h3>
                <?php
                if (isset($passwordMessage)) {
                    echo $passwordMessage;
                }
                ?>
                <form method="POST" action="/phpmotors/accounts/index.php">
                    <h5 class="heading-subtitle">Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</h5>
                    <h5 class="heading-subtitle">*note your original password will be changed</h5>
                    <label for="clientPassword">Password</label>
                    <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                    <button type="submit" name="submit" class="updbtn">Update Password</button>
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value="<?php if (isset($clientId)) {echo $clientId;} ?>" />
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