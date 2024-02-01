<div class="grid_playground">
    <form action="index.php" method="get">
        <?php
            echo ($pf->checkTie()) ? "tie" : ""; // icon left ...
            if($pf->hasWon($oldPlayer) && $oldPlayer != 0){
        ?>
            <div class="playground_display_win">
                <a href="index.php?player=<?= $oldPlayer ?>&reset=true" class="a_win_icon">
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
            $latestCoinCoordinates = $pf->getLatestCoinCoordinates();
            $latestCoinRow = -1;
            $latestCoinCol = -1;
            if($latestCoinCoordinates != null){
                $latestCoinRow = $latestCoinCoordinates['row'];
                $latestCoinCol = $latestCoinCoordinates['col'];
            }
            
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
                        $lastCoint = ($latestCoinRow + 1 == $i && $latestCoinCol == $j) ? "lastCoint" : "";
                        $playerpath = match ($pf->getCoin($i - 1, $j)) {
                            "1" => "./public/img/tokenRed.png",
                            "2" => "./public/img/tokenBlue.png",
                            default => "./public/img/token.png",
                        };
                        echo "<td class='" . $lastCoint . "'>";
                            echo "<img src='" . $playerpath . "' alt='player token' class='tokens'>";
                        echo "</td>";
                    }
                    }
                echo "</tr>";
                }
            echo "</table>";
        ?>
    </form>
</div>