<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--        <link rel="stylesheet" href="../common/css/bootstrap.min.css">-->
        <style>
            body {font-size: 0.8em;}
            .row {margin: 10px 0;}
        </style>
    </head>
    <body>
        <!-- inputbox for search -->
        <!-- try key in -->
        <div class="row">
            <div class="offset-md-8 col-4 text-right">
                <input type="text" class="form-control" placeholder="search" onkeyup="search_text();">
            </div>
        </div>

        <!-- data retrieve part -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>PLAYER ID</th>
                    <th>PLAYER NAME</th>
                    <th>PHONE NUMBER</th>
                    <th>PLAYER DOB</th>
                    <th>JERSEY NUMBER</th>
                    <th>PLAYER CAPTAIN</th>
                    <th>POSITION ID</th>
                    <th>POSITION NAME</th>
                    <th>TEAM ID</th>
                    <th>TEAM NAME</th>
                    <th>LEAGUE ID</th>
                    <th>LEAGUE NAME</th>
                    <th>SEASON ID</th>
                    <th>SEASON NAME</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <!-- include jquery, and bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- below part for ted's local -->
<!--
        <script src="../common/js/jquery-3.3.1.js"></script>
        <script src="../common/js/bootstrap.min.js"></script>
-->
        <?php
            /* database init */
            $host = "localhost:3306";
            $db_name = "SOCCER";
            $username = "root";
            $password = "";
            /* database connection */
            try{
                $con = new \PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
            }catch(PDOException $e){
                echo "Connection error: $e->getMessage()";
            }

            /* call stored procedure
               please create procedure GetPlayers() with in soccer.sql
            */
            $sql = 'CALL GetPlayers()';
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
                html += '     <td>' + o.PLAYER_ID + '</td>';
                html += '     <td>' + o.PLAYER_NAME + '</td>';
                html += '     <td>' + o.PHONE_NUMBER + '</td>';
                html += '     <td>' + o.PLAYER_DOB + '</td>';
                html += '     <td>' + o.JERSEY_NUMBER + '</td>';
                html += '     <td>' + (o.IS_PLAYER_CAPTAIN == null ? '' : 'CAPTAIN') + '</td>';
                html += '     <td>' + o.PLAYER_POSITION_ID + '</td>';
                html += '     <td>' + o.POSITION_NAME + '</td>';
                html += '     <td>' + o.TEAM_ID + '</td>';
                html += '     <td>' + o.TEAM_NAME + '</td>';
                html += '     <td>' + o.LEAGUE_ID + '</td>';
                html += '     <td>' + o.LEAGUE_NAME + '</td>';
                html += '     <td>' + o.SEASON_ID + '</td>';
                html += '     <td>' + o.SEASON_NAME + '</td>';
                html += '   </tr>';
                $('tbody').append(html);
            }
            /* function to clear all rows in table body */
            function clear(){
                $('tbody').html('');
            }

            /* text search just using javascript based on data variable */
            function search_text(){
                var s = $('input').val();
//                console.log(s); /* if you want to check data, remove '//' in front of line and then you can see on developer mode in your browser */
                /* clear all rows in table body before search */
                clear();

                /* find text in the data variable and if matched draw in the table body */
                data.forEach(function(o){
                    if(o.PLAYER_NAME.toLowerCase().indexOf(s) != -1 || o.PHONE_NUMBER.indexOf(s) != -1
                       || o.PLAYER_DOB.indexOf(s) != -1 || o.JERSEY_NUMBER.indexOf(s) != -1
                       || (o.IS_PLAYER_CAPTAIN != null && o.IS_PLAYER_CAPTAIN.toLowerCase().indexOf(s) != -1)
                       || o.POSITION_NAME.toLowerCase().indexOf(s) != -1 || o.TEAM_NAME.toLowerCase().indexOf(s) != -1
                       || o.LEAGUE_NAME.toLowerCase().indexOf(s) != -1 || o.SEASON_NAME.toLowerCase().indexOf(s) != -1){
                        draw(o);
                    }
                });
            };
        </script>
    </body>
</html>
