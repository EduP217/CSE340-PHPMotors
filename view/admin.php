<?php if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=1) header('Location: /phpmotors');?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PHP Motors</title>

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
        <div class="container">
            <h1 class="heading-title"><?php echo $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname']; ?></h1>
            <span>You are logged in.</span>
            <ul>
                <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
            </ul>
            <?php 
                if(intval($_SESSION['clientData']['clientLevel']) > 1) {
                    //echo 'ClientLevel is greater than 3.';
            ?>
            <div class="inventory-management">
                <h3>Inventory Management</h3>
                <p>Use this link to manage the inventory.</p>
                <a href="/phpmotors/vehicles/" class="text-underline">Vehicle Management</a>
            </div>
            <?php 
                }
            ?>
        </div>
    </main>
    <footer>
        <?php include '../snippets/footer.php'; ?>
    </footer>

    <script src="../js/utils.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>