<?php 
    include "./private/pages/head.php"; 
    require_once './private/classes/Playerground.php';
    include './private/classes/session.php';
?>
<body>
    <div class="grid_box">
        <div class="grid_left">

        </div>
        <div class="grid_right">
            <?php // 'grid_right' direct after 'grid_left', because background-image Position ?>
        </div>

        <div class="grid_versus">
            <div class="player_red <?= ($activePlayer == 1) ? "active" : "" ?>">
                <img src="./public/img/red.png" alt="player red" class="vs_icon">
            </div>
            <div class="player_vs">
                <!-- <p>V.S.</p> -->
            </div>
            <div class="player_blue <?= ($activePlayer == 2) ? "active" : "" ?>">
                <img src="./public/img/blue.png" alt="player blue" class="vs_icon">
            </div>
        </div>
        
        <div class="grid_playground">
            <form action="index.php" method="get">
                <?php
                    if($pf->hasWon($oldPlayer) && $oldPlayer != 0){
                ?>
                    <div class="display_win">
                        <a href="index.php?player=<?= $oldPlayer ?>&reset=true">
                            <img src="<?= ($oldPlayer == 1) ? "./public/img/PlayerOneWins.png" : "./public/img/PlayerTwoWins.png" ?>" alt="Spieler gewinnt" class="win_icon">
                        </a>
                    </div>
                <?php
                    } else {
                ?>
                    <input type="hidden" name="player" value="<?= $activePlayer ?>">
                    <input type="hidden" name="startedPlayer" value="<?= $startedPlayer ?>">
                <?php
                    }
                    // Erstellt eine HTML-Tabelle mit der Klasse
                    $rows = $pf->getHeight();
                    $cols = $pf->getWidth();

                    echo "<table>";
                    for ($i = 0; $i < $rows + 1; $i++) {
                    echo "<tr>";
                    if ($i == 0) {
                        for ($j = 0; $j < $cols; $j++) {
                            echo "<th class=''>";
                            echo "<input type='submit' name='btn_col' value='Row " . $j + 1 . "' class='btn_imput'>";
                            echo "</th>";
                        }
                    } else{
                        for ($j = 0; $j < $cols; $j++) {
                            echo "<td class='token_generals token_player" . $pf->getCoin($i - 1, $j) . "'>";
                            echo "</td>";
                        }
                        }
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                
            </form>
        </div>

        <div class="grid_button">
            <form action="index.php" method="get">
                <input type="hidden" name="reset" value="true">
                <input class="reset" type="submit" value="New Party!">
            </form>
        </div>
    </div>
    
</body>
</html>