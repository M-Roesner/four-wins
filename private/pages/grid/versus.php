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