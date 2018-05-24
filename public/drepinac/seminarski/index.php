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
    </head>
    <body>
        
        <div class="row">
            
            <div style="text-align: center"  class="col-md-12 align-self-center">
                <h1> Videoteka ALGEBRA </h1>
                <?php
                  for ($i = 65; $i <= 90; $i++) {
                  echo ' | <a href="index.php?slovo='.chr($i).'">'.chr($i).'</a>';
                  }
                  echo ' | <a href="unos.php"> Ažuriranje filmova</a><br/>';

                // put your code here
                ?>
                <br>
                <table align="center" width="90%">
                <tbody>
                <?php
                    if (isset($_GET['slovo'])) {
                        $upit = $_GET['slovo'].'%';
                    } else {$upit = '%';}
                    $query ="select naslov, godina, trajanje, slika from filmovi where naslov like ? order by naslov";
                    if ($stmt = $mysqli->prepare($query)) {
//                        $upit = $_GET['slovo'].'%';
                         $stmt->bind_param('s', $upit);  // u prepare mora ici varijabla
//                         $stmt->bind_param('s', 'H');  // u prepare mora ici varijabla
                         $stmt->execute();
                    $stmt->bind_result($naslov, $godina, $trajanje,$slika);
                    while ($stmt->fetch()) {
                        echo "<tr>";
                        echo '<td><img src=images/'.$slika.' width=10% height=10%><br>'.$naslov.'('.$godina.')<br>Trajanje: '.$trajanje.' min</td>';
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
