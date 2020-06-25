<?php ob_start(); ?>

<h1 class="display-4">Mon historique</h1>




<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
