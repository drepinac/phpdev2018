<?php

include 'data.php';

//print_r($data);


function date_trans($dat)
{
    $temp= explode('-', $dat);
    return $temp[2].'.'.$temp[1].'.'.$temp[0];
}

function tablica($imenaNiz)
{
    echo '<table border = "2">
            <tr>
            <th> Ime </th>
            <th> Prezime </th>
            <th> Datum </th>
            <th> Plaćeno </th>
            </tr>';
    foreach ($imenaNiz as $key => $osoba) {
        echo '<td>'.$osoba['ime'].'</td>';
        echo '<td>'.$osoba['prezime'].'</td>';
        echo '<td>'.date_trans($osoba['datum']).'</td>';
        // echo '<td>'.date_format(date_create($osoba['datum']), 'd.m.Y').'</td>';
        echo '<td>'.'<select>';
        if ($osoba['placeno'] == 'Da') {
            echo '<option value="Da">Da</option>'
                .'<option value="Ne">Ne</option>';
        } else {
            echo '<option value="Ne">Ne</option>'
                .'<option value="Da">Da</option>';
        }
        echo '</select>';
        echo '</td>';
             
        echo '</tr>';
    }
    echo '</table>';
}

tablica($data);
