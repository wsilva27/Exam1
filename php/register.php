<?php
    if(!isset($_SESSION))
        session_start();
    ob_start();
    include "conn_inc.php";
    // Welbert Marques Silva
    // CIS485test1 Web Programming - PHP
    // Fall 2018
    // Practical Test 1
?>                                                                         
<html>                                                                     
<head>                                                                     
    <title>The PHP Store</title>                                               
</head>                                                                    
<body>                                                                     
    <?php     
        if (isset($_POST['submit']) && $_POST['submit'] == "Register") {
            if ($_POST['username'] != "" &&                
            $_POST['password'] != "" &&
            $_POST['first_name'] != "" &&
            $_POST['last_name'] != "" &&
            $_POST['email'] != "") {
                $query = "SELECT username FROM user_info " . "WHERE username = '" . $_POST['username'] . "';";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($result) != 0) {
    ?>
    <div style="color:#FF0000">
        <strong>The Username, 
            <?php echo $_POST['username']; ?>, 
            is already in use, please choose another!</strong>
        <form action="register.php" method="post">
            <table width="75%" align="center" border="1">
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username"><br /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" value="<?php echo $_POST['password']; ?>"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" value="<?php echo $_POST['email']; ?>"></td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="first_name" value="<?php echo $_POST['first_name']; ?>"></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="last_name" value="<?php echo $_POST['last_name']; ?>"></td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td><input type="text" name="city" value="<?php echo $_POST['city']; ?>"></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><input type="text" name="state" value="<?php echo $_POST['state']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Register"> </td>
                    <td><input type="reset" value="Clear"></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
                } else {
                    $query = "INSERT INTO user_info (username, password, email, " .
                               "first_name, last_name, city, state, hobbies) " .
                               "VALUES ('" . $_POST['username'] . "', " .
                               "(PASSWORD('" . $_POST['password'] . "')), '" .
                               $_POST['email'] . "', '" . $_POST['first_name'] .
                               "', '" . $_POST['last_name'] . "', '" . $_POST['city'] .
                               "', '" . $_POST['state'] . "', 'nothing');";
                    $result = mysqli_query($conn, $query) or die(">>>>" . mysqli_error($conn));
                    $_SESSION['user_logged'] = $_POST['username'];
                    $_SESSION['user_password'] = $_POST['password'];
    ?>
    <p>
        Thank you, <?php echo $_POST['first_name'] . " " . $_POST['last_name']; ?> for registering!<br />
    <?php
                    header("Refresh: 5; URL=index.php");
                    echo "Your registration is complete! " . "You are being sent to the page you requested!<br />";
                    echo "(If your browser doesn't support this, " . "<a href=\"index.php\">click here</a>)";
                    die();
                }
    ?>
    </p>
    <?php
            } else {
    ?>
    <div>
        <font color="#FF0000"><b>The Username, Password, Email, First Name, and Last Name fields are required!</b></font>
        <form action="register.php" method="post">
            Username: <input type="text" name="username" value="<?php echo $_POST['username']; ?>"><br />
            Password: <input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br />
            Email: <input type="text" name="email" value="<?php echo $_POST['email']; ?>"><br />
            First Name: <input type="text" name="first_name" value="<?php echo $_POST['first_name']; ?>"><br />
            Last Name: <input type="text" name="last_name" value="<?php echo $_POST['last_name']; ?>"><br />
            City: <input type="text" name="city" value="<?php echo $_POST['city']; ?>"><br />
            State: <input type="text" name="state" value="<?php echo $_POST['state']; ?>"><br />
            <input type="submit" name="submit" value="Register"> &nbsp;
            <input type="reset" value="Clear">
        </form>                                                                 
    </div>
    <?php
            }
    } else {
    ?>
    <div>                                                                       
        Welcome to the registration page!<br />                                 
        The Username, Password, Email, First Name, and Last Name fields         
        are required!                                                           
        <form action="register.php" method="post">
            <table>                                                                 
                <tr>                                                               
                    <td>Username:</td><td><input type="text" name="username"></td> 
                </tr>                                                              
                <tr>                                                               
                    <td>Password: </td>                                           
                    <td><input type="password" name="password"></td>              
                </tr>                                                              
                <tr>                                                               
                    <td>Email: </td>                                              
                    <td><input type="text" name="email"></td>                     
                </tr>                                                              
                <tr>                                                               
                    <td>First Name: </td>                                         
                    <td><input type="text" name="first_name"></td>                
                </tr>                                                              
                <tr>                                                               
                    <td>Last Name: </td>                                          
                    <td><input type="text" name="last_name"></td>                 
                </tr>                                                              
                <tr>                                                               
                    <td>City: </td>                                               
                    <td><input type="text" name="city"></td>                      
                </tr>                                                              
                <tr>                                                               
                    <td>State: </td>                                              
                    <td><input type="text" name="state"></td>                     
                </tr>                                                              
                <tr>                                                               
                    <td><input type="submit" name="submit" value="Register"></td> 
                    <td><input type="reset" value="Clear"></td>                   
                </tr>                                                              
            </table>                                                                  
        </form>
    </div>
<?php                                                                     
    }                                                                         
?>                                                                        
</body>                                                                   
</html>                                                                   
