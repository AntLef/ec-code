<?php ob_start(); ?>

<p>
    - modification du mot de passe<br>
    - modification de l'adresse mail<br>
    - suppression complete du compte
</p>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
