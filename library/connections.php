<?php
// Proxy connections to the phpmotors database
function phpmotorsConnect()
{
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'X0Q)1goOwN/rLjbr';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username,
            $password,
            $options
        );
        //echo 'it worked!';
        return $link;
    } catch (PDOException $e) {
        //echo "it didn't worked, error: ". $e->getMessage();
        header('Location: /CSE340/CSE340-PHPMotors/view/500.php');
        exit;
    }
}
//phpmotorsConnect();

?>