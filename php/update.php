<!DOCTYPE HTML>
<html>
    <head>
        <title>Update</title>

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
                <h1>Update Inmate</h1>
            </div>

            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            include 'database/database_connection.php';

            try {
                $query = "SELECT id, name, description, bond FROM inmate WHERE id = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row['name'];
                $description = $row['description'];
                $bond = $row['bond'];
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
            ?>
            <?php
            if ($_POST) {

                try {

                    $query = "UPDATE inmate
                    SET name=:name, description=:description, bond=:bond
                    WHERE id = :id";

                    $stmt = $con->prepare($query);

                    // posted values
                    $name = htmlspecialchars(strip_tags($_POST['name']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                    $bond = htmlspecialchars(strip_tags($_POST['bond']));

                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':bond', $bond);
                    $stmt->bindParam(':id', $id);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Name</td>
                        <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Crime</td>
                        <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Bond</td>
                        <td><input type='text' name='bond' value="<?php echo htmlspecialchars($bond, ENT_QUOTES); ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save Changes' class='btn btn-primary' />
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
