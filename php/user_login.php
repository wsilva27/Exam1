<?php
    if(!isset($_SESSION))
        session_start();
    include "conn_inc.php";
    // Welbert Marques Silva
    // Web Programming - PHP                                                   
    // Fall 2018                                                               
    // Practical Test 1                                                        
?>
<html>
<head>
    <title>The PHP Store</title>
</head>
<body>
<?php
    if (isset($_POST['submit'])) {                                             
            $query = "SELECT username, password FROM user_info " .                   
                     "WHERE username = '" . $_POST['username'] . "' " .              
                     "AND password = (PASSWORD('" . $_POST['password'] . "'))";      
            $result = mysqli_query($conn, $query)                                            
                or die(mysqli_error($conn));                                                 

        if (mysqli_num_rows($result) == 1) {                                      
            $_SESSION['user_logged'] = $_POST['username'];                         
            $_SESSION['user_password'] = $_POST['password'];                       
            header ("Refresh: 5; URL=" . $_POST['redirect'] . "");                 
            echo "You are being redirected to your original page request!<br />";  
            echo "(If your browser doesn't support this, " .                       
                "<a href=\"" . $_POST['redirect']. "\">click here</a>)";          
        } else {                                                                 
?>                                                                         
            <center>
                <h3>Invalid Username and/or Password</h3>
                Not registered?
                <a href="register.php">Click here</a> to register.<br />
                <form action="user_login.php" method="post">
                    <input type="hidden" name="redirect"
                    value="<?php echo $_POST['redirect']; ?>">
                    Username: <input type="text" name="username"><br />
                    Password: <input type="password" name="password"><br /><br />
                    <input type="submit" name="submit" value="Login">
                </form>                                                                  
            </center>                                                                  
<?php                                                                      
        }                                                                        
    } else {                                                                   
        if (isset($_GET['redirect'])) {                                          
            $redirect = $_GET['redirect'];                                         
        } else {                                                                 
            $redirect = "index.php";                                               
        }                                                                        
?>
        <center>                                                                   
            <h2>Login below by supplying your username/password...</h2>              
            Or <a href="register.php">click here</a> to register.<br /><br />        
            <form action="user_login.php" method="post">                             
            <input type="hidden" name="redirect"                                   
            value="<?php echo $redirect; ?>">                                    
            Username: <input type="text" name="username"><br />                    
            Password: <input type="password" name="password"><br /><br />          
            <input type="submit" name="submit" value="Login">                      
            </form>                                                                  
        </center>                                                                  
<?php                                                                      
    }                                                                          
?>                                                                         
</body>                                                                    
</html>                                                                    
