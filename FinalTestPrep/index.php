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
        <h3>United States Soccer Reports</h3>
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
            <tr>
                <th>Number of the teams that are playing the league</th>
            </tr>
            <?php while ($r = $q->fetch()): ?>
                <tr>
                    <td><?php echo $r['TEAM'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <h1>Main Menu</h1>
        <ul>
            <li><a href="numberone.php">1 - Get Teams report</a></li>
            <li><a href="numbertwo.php">2 - Get Player who scored the last goal for the first team against third</a></li>
            <li><a href="numberthree.php">3 - Get Goals Scored on the Second Half</a></li>
            <li><a href="numberfour.php">4 - Get Players who scored first goal on each match</a></li>
            <li><a href="numberfive.php">5 - Get Captain Players who scored first goal on each match</a></li>
        </ul>
    </body>
</html>