<?php
require_once ('./private/classes/Playerground.php');

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isReset = true;
if(isset($_GET['reset'])) {
    session_unset();
} else {
    $isReset = false;
}


$pf = new Playground(7,6);
$startedPlayer = 0; // player who begun
$activePlayer = 0;
$oldPlayer = 0; // Übergabe über GET-Methode
$column; // Übergabe über GET-Methode


// rolls who begins the match, else sets params and makeMove
if (!isset($_GET['startedPlayer']) ) {
    $startedPlayer = rand(1,2);
    $activePlayer = $startedPlayer;
} else {
    $startedPlayer = $_GET['startedPlayer'];
    if (isset($_GET['btn_col']) && isset($_GET['player'])) {
        $column = $_GET['btn_col'];
        $column = substr($column,2,strlen($column)) - 1; // remove 'Reihe ' from button value
        $oldPlayer = $_GET['player'];
    
        $activePlayer = $pf->makeMove($column, $oldPlayer, $startedPlayer);
    }
}
?>