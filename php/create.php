<!DOCTYPE HTML>
<html>
    <head>
        <title>Create New Inmate</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <style>
            .headColor
            {
                background-color: lightblue;
            }
        </style>
    </head>
    <body>

        <div class="container">

            <div class="page-header headColor">
                <h1>Create Inmate</h1>
            </div>
            <?php
            if ($_POST) {

                include '../database/database_connection.php';

                try {


                    $query = "INSERT INTO inmate SET name=:name, description=:description, bond=:bond, created=:created";

                    $stmt = $con->prepare($query);

                    $name = htmlspecialchars(strip_tags($_POST['name']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                    $bond = htmlspecialchars(strip_tags($_POST['bond']));

                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':bond', $bond);

                    $created = date('Y-m-d H:i:s');
                    $stmt->bindParam(':created', $created);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Name</td>
                        <td><input type='text' name='name' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Crime</td>
                        <td><textarea name='description' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Bond</td>
                        <td><input type='text' name='bond' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save' class='btn btn-primary' />
                            <a href='index.php' class='btn btn-danger'>Back to Inmate Roster</a>
                        </td>
                    </tr>
                </table>
            </form>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
