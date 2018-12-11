<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  
        <style>
            body {font-size: 0.8em;}
            .row {margin: 10px 0;}
            .container {margin-top: 20px;}
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <a class="navbar-brand" href="javascript:avoid(0);">Team Fatima / Welbert / Ted</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="question1.php">Question 1</a></li>
                    <li class="nav-item active"><a class="nav-link" href="javascript:avoid(0);">Question 2 <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="question3.php">Question 3</a></li>
                    <li class="nav-item"><a class="nav-link" href="question4.php">Question 4</a></li>
                    <li class="nav-item"><a class="nav-link" href="question5.php">Question 5</a></li>
                </ul>
            </div>
        </nav>        
        
        <div class="container">
            <div class="alert alert-info">
                Question 2. Write a query in SQL and display results in PHP to find the player who scored the last goal for first team against third team. (Columns: Team Name, Player Name, Goal Time. Use your design first and third team is sorted alphabetically)
            </div>

            <!-- data retrieve part -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>TEAM NAME</th>
                        <th>PLAYER NAME</th>
                        <th>GOAL TIME</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>            
        </div>

        
        <!-- include jquery, and bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <?php
            require_once 'database.php';
            
            /* get first team id */
            $sql = 'SELECT
                        TEAM_ID
                    FROM
                        TEAM
                    ORDER BY 
                        TEAM_NAME ASC
                    LIMIT 1;';
            $stmt = $con->query($sql);
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            $team1 = $TEAM_ID;

            /* get third team id */
            $sql = 'SELECT
                        TEAM_ID
                    FROM
                        TEAM
                    ORDER BY
                        TEAM_NAME ASC
                    LIMIT 1 OFFSET 2;';
            $stmt = $con->query($sql);
            extract($stmt->fetch(PDO::FETCH_ASSOC));
            $team2 = $TEAM_ID;

            $sql = 'SELECT
                        T.TEAM_NAME, P.PLAYER_NAME, S.GOAL_TIME
                    FROM
                        MATCHES M 
                    INNER JOIN
                        SCORE S
                    ON
                        M.MATCH_ID = S.MATCH_ID
                    INNER JOIN
                        PLAYER P
                    ON
                        S.PLAYER_ID = P.PLAYER_ID
                    INNER JOIN
                        TEAM T
                    ON
                        P.TEAM_ID = T.TEAM_ID
                    WHERE
                        M.TEAM_ID_1 IN ('.$team1.') AND M.TEAM_ID_2 IN ('.$team2.') OR
                        M.TEAM_ID_1 IN ('.$team2.') AND M.TEAM_ID_2 IN ('.$team1.')
                    ORDER BY
                        M.MATCH_DATE DESC, S.GOAL_TIME DESC
                    LIMIT 1;';
            $stmt = $con->query($sql);
            $res[] = $stmt->fetch(PDO::FETCH_ASSOC);
            $con = null;
        ?>
        
        <script>
            /* we user javascript for data retrieve and search 
               so, we trasit php array object to javascript array object */
            var data = <?= json_encode($res); ?>;
//            console.log(data); /* if you want to check data, remove '//' in front of line and then you can see on developer mode in your browser */
            data.forEach(function(player){
//                console.log(player); /* if you want to check data, remove '//' in front of line and then you can see on developer mode in your browser */
                draw(player);
            })
            
            /* draw row in the table */
            function draw(o){
                var html = '<tr>';
                html += '     <td>' + o.TEAM_NAME + '</td>';
                html += '     <td>' + o.PLAYER_NAME + '</td>';
                html += '     <td>' + o.GOAL_TIME + '</td>';
                html += '   </tr>';
                $('tbody').append(html);
            }
        </script>
    </body>
</html>
