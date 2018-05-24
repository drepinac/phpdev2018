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
         #forma {display: none;}
     </style>
    </head>
    <body>
        
<?php
//      Pokretanje unosa novog filma      
        if (isset($_POST['novi'])){
           $naslov='';
           $id_zanr='';
           $godina='';
           $trajanje='';
           $slika='';
?>
            <style type="text/css">#forma{
            display:block;
            }</style>
<?php           
}
//      upisivanje filmova u bazu nakon submita
        if (isset($_POST['unos'])) {
            $query="insert into filmovi (naslov, id_zanr, godina, trajanje, slika) "
                 . "values (?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param('siiis', $_POST['naslov'], $_POST['zanr'], $_POST['godina'], $_POST['trajanje'], $_FILES['datoteka']['name']);  // u prepare mora ici varijabla
                $stmt->execute();
                $stmt->close();  

                $uploaddir = 'd:\xampp\htdocs\phpdev2018\public\drepinac\seminarski\images\\';

                $uploadfile = basename($_FILES['datoteka']['name']);
                $file_array = explode(".", $uploadfile);
                $file_ext = end($file_array);
//                echo $file_ext.'</br>';
                $new_file_name = $uploaddir.$uploadfile;
//                echo $uploaddir.'</br>';
                echo $new_file_name.'</br>';
//                echo($_FILES['datoteka']['tmp_name']);
//                echo('</br>');
                if (file_exists($new_file_name)) {
                    echo 'Datoteka je već učitana';
                } else {
                if (move_uploaded_file($_FILES['datoteka']['tmp_name'], $new_file_name)) {
                }
                }
            }
            $_POST = array(); //očisti post array
?>
            <style type="text/css">#forma{
            display:none;
            }</style>
<?php            header('Location: unos.php');
        }

//      Pokretanje brisanja filma
        if (isset($_GET['brisanje'])) {
            $query ="delete from filmovi where id = ?";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param('i', $_GET['brisanje']);  // u prepare mora ici varijabla
                $stmt->execute();
                $stmt->close();  
            }
            $_POST = array(); //očisti post array
            header('Location: unos.php');
        }
        if (isset($_POST['izmjeni'])){

            $query ="update filmovi set naslov = ?, id_zanr = ?, godina = ?, trajanje = ?, slika = ? where id = ?";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param('siiis', $_POST['naslov'], $_POST['zanr'], $_POST['godina'], $_POST['trajanje'], $_FILES['datoteka']['name'], $_POST['id']);  // u prepare mora ici varijabla
                $stmt->execute();
                $stmt->close();  
            }
            $_POST = array(); //očisti post array
            header('Location: unos.php');
            
        }

 //     Dohvat podataka za popunjavanje forme nakon izbora opcije izmjeni na reportu
        if (isset($_GET['izmjena'])) {
            $query ="select naslov, id_zanr, godina, trajanje, slika, id from filmovi where id = ?";
            if ($stmt = $mysqli->prepare($query)) {
                $upit = '%';
                $stmt->bind_param('i', $_GET['izmjena']);  // u prepare mora ici varijabla
                $stmt->execute();
            $stmt->bind_result($naslov, $id_zanr, $godina, $trajanje, $slika, $id);
            while ($stmt->fetch()) {
            }
            $stmt->close();  
            }
//        $mysqli->close();
        } else 
        {
           $id='';
           $naslov='';
           $id_zanr='';
           $godina='';
           $trajanje='';
           $slika='';
        }
      ?>

        
        <div id="forma" class="container well">
        <form method="POST" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data" style="border:1">
            <h2>Ažuriranje podataka o filmovima</h2>
        <div class="row">
            <div class="col-md-1">
                Naslov:<br/>
            </div>
            <div class="col-md-1">
                <input type="hidden" name="id" value="<?=$id?>"
                <input type="text" name="naslov" value="<?=$naslov?>" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Žanr:<br/>
            </div>
            <div class="col-md-1">
                <select name="zanr">
<?php               $query ="select id, naziv from zanr";
                    if ($stmt = $mysqli->prepare($query)) {
                        $stmt->execute();
                        $stmt->bind_result($id, $naziv);
                        while ($stmt->fetch()) {
                            echo '<option value="'.$id.'">'.$naziv.'</option>';
                        }
                        $stmt->close();  
                        }
?>
                </select>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Godina:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="godina" value="<?=$godina?>" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Trajanje:<br/>
            </div>
            <div class="col-md-1">
                <input type="text" name="trajanje" value="<?=$trajanje?>" /><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                Slika:<br/>
            </div>
            <div class="col-md-1">
                <?=$slika?><br/>
                <input type="file" name="datoteka" value=""/><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3"><br>
                <?php
                if (isset($_POST['novi'])){
                  echo '<input type="submit" name="unos" value="Upis novog filma"/>';} else {
                  echo '<input type="submit" name="izmjeni" value="Spremi izmjene"/>';}
                ?>
            </div>
        </div>
      </form>
        </div>
        
<!-- dugme za unos novog filma -->
        <div class="row">
            <div class="container">
                <form method="POST" action="<?php $_PHP_SELF ?>">
                    <br>
                <input style="align-items: right" type="submit" name="novi" value="Novi film">
                <button type="button" onclick="location.href='index.php'">Naslovnica</button>
              </form>
            </div>
<!-- dugme za unos novog filma -->

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
                        echo '<tr>';
                        $poruka = "'Da li stvarno želite obrisati file?'";
                        echo '<td width=70px, height=150px><img style="display:block;" src=images/'.$slika.' height=100%></td>'
                             .'<td>'.$naslov.'</td><td>'.$godina.'</td><td>'.$trajanje.'</td>'
//                             .'<td>[<a href="unos.php?brisanje='.$id.'" onclick="return confirm('.$poruka.')">obriši</a>]'.' [<a href="unos.php?izmjena='.$id.'">izmjeni</a>]</td>';
                             .'<td>[<a href="unos.php?brisanje='.$id.'" onclick="return confirm('.$poruka.')">obriši</a>]'.' [<a href="unos.php?izmjena='.$id.'">izmjeni</a>]</td>';
                        echo '</tr>';
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
