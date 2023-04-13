<?php 
    include "./private/pages/head.php"; 
    require_once './private/classes/Playerground.php';
    include './private/classes/session.php';
?>
<body>
    <main class="grid_box">
        <?php
        include './private/pages/grid/sites.php';
        include './private/pages/grid/versus.php';
        include './private/pages/grid/playground.php';
        include './private/pages/grid/reset_btn.php';
        include './private/pages/grid/footer.php';
        ?>
    </main>
</body>
</html>