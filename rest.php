<?php
// rest.php

// Adatbázis kapcsolat létrehozása
$kapcsolat = mysqli_connect("localhost", "root", "", "osztalyozo");
mysqli_set_charset($kapcsolat, "utf8");

if (isset($_POST['osztaly'])) {
    $osztaly = $_POST['osztaly'];

    // SQL lekérdezés az osztály névsorához
    $sql = "SELECT Nev FROM naplo_forras WHERE Osztaly = '$osztaly'";
    $eredmeny = mysqli_query($kapcsolat, $sql);

    $nevsor = array();
    while ($row = mysqli_fetch_assoc($eredmeny)) {
        $nevsor[] = $row['Nev'];
    }

    // Visszatérés a névsorral JSON formátumban
    echo json_encode($nevsor);
}

// Adatbázis kapcsolat lezárása
mysqli_close($kapcsolat);
?>
