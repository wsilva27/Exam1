<?php
    session_start();
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1

    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
        //Nothing if true but,
    } else {
        $redirect = $_SERVER['PHP_SELF'];
        header("Refresh: 3; URL=login.php?redirect=$redirect");
        echo "You are being redirected to the login page!<br />";
        echo "(If your browser doesn't support this, " .
           "<a href=\"login.php?redirect=$redirect\">click here</a>)";
        die();
    }        
?>

