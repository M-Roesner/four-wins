<?php
require_once ('./private/classes/Playerground.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['reset'])) {
    session_unset();
}

$pf = new Playground(7,6);
$activePlayer = rand(1,2);
$oldPlayer = 0; // Übergabe über GET-Methode
$column; // Übergabe über GET-Methode

if (isset($_GET['btn_col']) && isset($_GET['player']) ) {
    $column = $_GET['btn_col'];
    $column = substr($column,4,strlen($column)); // remove 'Reihe ' from button value
    $oldPlayer = $_GET['player'];

    $activePlayer = $pf->makeMove($column, $oldPlayer);
}
?>