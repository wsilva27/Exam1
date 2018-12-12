<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TEST2</title>
    </head>
    <body>
        <h3>United States Soccer Reports</h3>

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
        <table border="1">
            <tr>
                <th>TEAMS REPORTS</th>
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
            <li><a href="numbertwo.php">2 - </a></li>
            <li><a href="numberthree.php">3 - Get Goals Scored on the Second Half</a></li>
            <li><a href="numberfour.php">4 - </a></li>
            <li><a href="numberfive.php">5 - </a></li>
        </ul>
    </body>
</html>