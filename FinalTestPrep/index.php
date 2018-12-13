<!DOCTYPE html>
<html>
    <head>
        <title>TEST2</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br>
<?php
        include("config.php");
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $sql = 'SELECT COUNT(*) AS TEAM FROM TEAM';
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table border="1" class="table table-striped">
        <div class="jumbotron text-center">
        <h1>United States Soccer Reports</h1>
        <p>Names: Welbert | Fatima | Ted</p> 
        </div>
        <h1>Main Menu</h1>
        <ul>
            <div class="btn-group-vertical">
                <a href="numberone.php" class="btn btn-primary">Question 1</a>
                <br>
                <a href="numbertwo.php" class="btn btn-primary">Question 2</a>
                <br>
                <a href="numberthree.php" class="btn btn-primary">Question 3</a>
                <br>
                <a href="numberfour.php" class="btn btn-primary">Question 4</a>
                <br>
                <a href="numberfive.php" class="btn btn-primary">Question 5</a>
            </div>
        </ul>
        <br>
        <tr>
                <th>Number of the teams that are playing the league</th>
            </tr>
            <?php while ($r = $q->fetch()): ?>
                <tr>
                    <td><?php echo $r['TEAM'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </body>
</html>