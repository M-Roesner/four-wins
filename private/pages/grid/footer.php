<div class="grid_footer">
    <?php
        $randCreatorFirst = rand(0,1);
        $sHepting = "<a href='https://github.com/S-Hepting' target='_blank'> S. Hepting </a>";
        $mRoesner = "<a href='https://markus-roesner.dev' target='_blank'> M. Rösner </a>";
    ?>
    <p>createy by</p>
    <?= ($randCreatorFirst) ? $sHepting : $mRoesner ?>
    <p>and</p>
    <?= ($randCreatorFirst) ? $mRoesner : $sHepting?>
    <p>, used</p>
    <a href="" target="_blank" class="impressum"> sources</a>
    <p>!</p>
</div>