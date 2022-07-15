<div class="header-container">
    <img src="/phpmotors/images/site/logo.png" alt="phpmotors logo" class="header-logo">
    <?php 
    if(isset($cookieFirstname)) echo "<span>Welcome, $cookieFirstname</span>";
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==1) {
        echo "<div class='header-signin'><a href='/phpmotors/accounts/'>Welcome, ".$_SESSION['clientData']['clientFirstname']."</a><div class='vertical-divider'></div><a href='/phpmotors/accounts?action=logout'>Logout</a></div>";
    } else {
        echo "<a href='/phpmotors/accounts?action=login' class='header-signin'>My Account</a>";
    } ;
    ?>
    <a href='/phpmotors/search' class='header-search'>
        <img src='/phpmotors/images/site/search-icon.svg' alt="search" />
    </a>
</div>