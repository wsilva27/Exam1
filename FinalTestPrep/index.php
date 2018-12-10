<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Soccer</title>
    </head>
    <body>
        <h3>United States Soccer Reports</h3>

        <?php
        include("config.php");
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $sql = 'CALL GetCountPlayers()';
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table border="1">
            <tr>
                <th>Players Report</th>
            </tr>
            <?php while ($r = $q->fetch()): ?>
                <tr>
                    <td><?php echo $r['players'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <ul>
            <li><a href="getbyteam.php">Filter by Team</a></li>
            <li><a href="filter_by_grade.php">Filter by Grade</a></li>
            <li><a href="filter_by_zipcode.php">Filter by Zip Code</a></li>
        </ul>
    </body>
</html>