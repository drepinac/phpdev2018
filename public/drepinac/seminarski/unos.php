<?php
include_once './dbcon_o.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <title>Videoteka</title>
     <style>
         th {text-align: center;
             background-color: silver}
     </style>
    </head>
    <body>
        <div class="container well">
        <form style="border:1">
            <h2>Ažuriranje podataka o filmovima</h2>
        <div class="row">
            <div class="col-md-1">
                Naslov:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="naslov" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Žanr:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="zanr" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Godina:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="godina" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Trajanje:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="trajanje" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Slika:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="slika" value="" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                pokreni:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="pokreni" value="" /><br/>
            </div>
        </div>
      </form>
        </div>
        <div class="row">
            
            <div style="text-align: center"  class="col-md-12 align-self-center">
                <br>
                <table align="center" width="90%" border="1">
                    <thead>
                        <th>Slika</th><th>Naslov filma</th><th>Godina</th><th>Trajanje</th><th>Akcija</th>
                    </thead>
                      
                <tbody>
                <?php
                    $query ="select naslov, godina, trajanje, slika, id from filmovi order by naslov";
                    if ($stmt = $mysqli->prepare($query)) {
                        $upit = '%';
//                         $stmt->bind_param('s', $upit);  // u prepare mora ici varijabla
//                         $stmt->bind_param('s', 'H');  // u prepare mora ici varijabla
                         $stmt->execute();
                    $stmt->bind_result($naslov, $godina, $trajanje, $slika, $id);
                    while ($stmt->fetch()) {
                        echo "<tr>";
                        echo '<td width=70px, height=150px><img style="display:block;" src=slike/'.$slika.' height=100%></td><td>'.$naslov.'</td><td>'.$godina.'</td><td>'.$trajanje.'</td><td>'.$id.'</td>';
                    }
                    $stmt->close();  
                    }
                    $mysqli->close();
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
