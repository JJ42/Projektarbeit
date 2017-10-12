<?php
require 'db.php';

function EintragAufrufen ($Id) {
    $sql = "SELECT Day, Month, Year, EndDay, EndMonth, EndYear, Duration,
            Company, Department, Student_email, Student_phone, Description,
            Title, Town, Password FROM praktikum where Id='.$Id";
    echo 'SQL Query: ', $sql, '<br>', "\n";
    
    $result = mysqli_query($mysqli, $sql);
    echo 'mysqli_num_rows: |', mysqli_num_rows($result), '|<br>';
    
    $row = mysqli_fetch_array($result);
    return $row;
}


?>