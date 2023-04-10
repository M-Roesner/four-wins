<?php 
    include "./private/pages/head.php"; 
    require_once './private/classes/Playerground.php';
    include './private/classes/session.php';
?>
<body>
    <div class="grid_box">
        <div class="grid_site_generals grid_left <?= ($isReset) ? "grid_left_initial" : ""?> <?= ($activePlayer == 1) ? "grid_left_active" : ""?>"></div>
        <div class="grid_site_generals grid_right <?= ($isReset) ? "grid_right_initial" : ""?> <?= ($activePlayer == 2) ? "grid_right_active" : ""?>"></div>
        
        <div class="grid_versus">
            <div class="versus_generals player_vs">
                <img src="./public/img/VS.png" alt="vs" class="versus_icons icon_vs">
            </div>
            <div class="versus_generals player_red">
                <?php
                    if($activePlayer == 1)
                        echo "<img src='./public/img/poow.png' alt='poow' class='icon_poow'>";
                    ?>               
                <img src="./public/img/tokenRed.png" alt="player red" class="versus_icons">
            </div>
            <div class="versus_generals player_blue">
                <?php 
                if($activePlayer == 2) 
                    echo "<img src='./public/img/poow.png' alt='poow' class='icon_poow'>";
                ?>
                <img src="./public/img/tokenBlue.png" alt="player blue" class="versus_icons">
            </div>
        </div>
        
        <div class="grid_playground">
            <form action="index.php" method="get">
                <?php
                    if($pf->hasWon($oldPlayer) && $oldPlayer != 0){
                ?>
                    <div class="playground_display_win">
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
                                echo "<th>";
                                    echo "<input type='submit' name='btn_col' value='r " . $j + 1 . "' class='btn_imput'>";
                                echo "</th>";
                            }
                        } else{
                            for ($j = 0; $j < $cols; $j++) {
                                $playerpath = match ($pf->getCoin($i - 1, $j)) {
                                    "1" => "./public/img/tokenRed.png",
                                    "2" => "./public/img/tokenBlue.png",
                                    default => "./public/img/token.png",
                                };
                                echo "<td class='token_generals token_player0" . $pf->getCoin($i - 1, $j) . "'>";
                                    echo "<img src='" . $playerpath . "' alt='player' class='tokens'>";
                                echo "</td>";
                            }
                            }
                        echo "</tr>";
                        }
                    echo "</table>";
                ?>
                
            </form>
        </div>
        
        <div class="grid_reset_button">
            <form action="index.php" method="get">
                <input type="hidden" name="reset" value="true">
                <input class="btn_reset" type="submit" value="New Party!">
            </form>
        </div>

        <div class="grid_footer">
            <p>createy by</p> 
            <a href="https://github.com/S-Hepting" target="_blank"> S. Hepting </a>
            <p>and</p>
            <a href="https://github.com/M-Roesner" target="_blank"> M. Rösner </a>
            <p>, used</p>
            <a href="index.php" target="_blank" class="impressum"> sources</a>
            <p>!</p>              
        </div>
    </div>
    
</body>
</html>