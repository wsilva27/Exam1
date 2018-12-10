<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Team</title>
    </head>
    <body>
        <h3>United States Soccer Reports: Filter by Team</h3>
        <?php
        include("config.php");
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $sql = "CALL GetTeam()";
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <select onchange="loadGrades(this)">
            <option value="">-Select Team-</option>
            <?php while ($r = $q->fetch()): ?>
            <option value="<?php echo $r['TEAM_NAME'] ?>"><?php echo $r['TEAM_NAME'] ?></option>
                
            <?php endwhile; ?>
        </select>
        <script>
        function loadGrades(a){
            team = a.value;
            window.location = "resultbyteam.php?TEAM_NAME="+team;
        }
        </script>
    </body>
</html>