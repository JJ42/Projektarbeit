  <?php
error_reporting(E_ALL);
session_start();
require 'database_connection.php';

/*
 * adminFunction.php Seite enthält alle Functionen und
 * Datenbankabfragen die ein Administrator auf seiner Seite
 * verwenden kann.
 *
 */

//Tabelle für Aktive Unternehmen erstellen
function UnternehmenAktiv()
{
    // Abfragen der aktiven Praktikumsunternehmen
    $sql = 'SELECT Name, URL, aktiv from praktunter where aktiv="1" order by Name';
    $result = mysqli_query($mysqli, $sql);
    $daten = mysqli_num_rows($result);
    $felder = mysqli_num_fields($result);
    
    echo '<table class="table table-striped">';
    echo '<tr>';
    for ($j = 0; $j <= $felder - 1; $j ++) {
        echo '<td>' . (mysqli_fetch_field_direct($result, $j)->name) . '</td>';
    }
    echo '<td>Deaktivieren</td>';
    echo '</tr>';
    
    while ($zeile = mysqli_fetch_array($result)) {
        echo '<tr>';
        for ($j = 0; $j < $felder - 1; $j ++) {
            echo "<td>" . $zeile[$j] . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
}

//Tabelle für deaktive Unternehmen erstellen
function UnternehmenDeaktiv()
{
    // Abfragen der aktiven Praktikumsunternehmen
    $sql = 'SELECT * from praktunter where aktiv="0" order by Name';
    $result = mysqli_query($mysqli, $sql);
    $daten = mysqli_num_rows($result);
    $felder = mysqli_num_fields($result);
    
    echo '<table class="table table-striped">';
    echo '<tr>';
    for ($j = 0; $j <= $felder - 1; $j ++) {
        echo '<td>' . (mysqli_fetch_field_direct($result, $j)->name) . '</td>';
    }
    echo '</tr>';
    
    while ($zeile = mysqli_fetch_array($result)) {
        echo '<tr>';
        for ($j = 0; $j < $felder - 1; $j ++) {
            echo "<td>" . $zeile[$j] . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
}


// Liste der angelegten Praktikas
function PraktikaListe()
{
    // Abfragen der aktiven Praktikumsunternehmen
    $sql = 'SELECT Id, Student_name, Student_matrnr, Company, Department, Town, Day, Month, Year, Angelegt, Kolloquium from praktikum order by angelegt DESC';
    $result = mysqli_query($mysqli, $sql);
    $daten = mysqli_num_rows($result);
    $felder = mysqli_num_fields($result);
    
    echo '<table class="table table-striped">';
    echo '<tr>';
    for ($j = 0; $j <= $felder - 1; $j ++) {
        echo '<td>' . (mysqli_fetch_field_direct($result, $j)->name) . '</td>';
    }
    echo '</tr>';
    
    while ($zeile = mysqli_fetch_array($result)) {
        echo '<tr>';
        for ($j = 0; $j < $felder - 1; $j ++) {
            echo "<td>" . $zeile[$j] . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
}

?> 
