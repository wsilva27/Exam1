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
                    <li class="nav-item active"><a class="nav-link" href="javascript:avoid(0);">Question 1 <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="question2.php">Question 2</a></li>
                    <li class="nav-item"><a class="nav-link" href="question3.php">Question 3</a></li>
                    <li class="nav-item"><a class="nav-link" href="question4.php">Question 4</a></li>
                    <li class="nav-item"><a class="nav-link" href="question5.php">Question 5</a></li>
                </ul>
            </div>
        </nav>        
        
        <div class="container">
            <div class="alert alert-info">
                Question 1. Write a query in SQL and display results in PHP to find all Teams in alphabetical order with the total goals for the season.(Columns: Team Name and Total Goals)
            </div>

            <!-- data retrieve part -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>TEAM NAME</th>
                        <th>TOTAL GOALS</th>
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
            $sql = 'SELECT
	                   T.TEAM_ID, T.TEAM_NAME, COUNT(*) AS TOTAL_GOALS
                    FROM
                        TEAM T
                    LEFT JOIN (
                        SELECT
                            S.SCORE_ID, P.TEAM_ID
                        FROM
                            SCORE S
                        INNER JOIN
                            PLAYER P
                        ON
                            S.PLAYER_ID = P.PLAYER_ID
                    ) G
                    ON
                        T.TEAM_ID = G.TEAM_ID
                    GROUP BY
                        T.TEAM_ID, T.TEAM_NAME
                    ORDER BY
                        T.TEAM_NAME ASC;';
            $stmt = $con->query($sql);
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $res[] = $row;
                }
            }else{
                $res = null;
            }
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
                html += '     <td>' + o.TOTAL_GOALS + '</td>';
                html += '   </tr>';
                $('tbody').append(html);
            }
        </script>
    </body>
</html>
