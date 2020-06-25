<?php ob_start(); ?>



<?php foreach( $medias as $media ): ?>
    <a class="item" href="index.php?media=<?= $media['id']; ?>">
        <div class="video">
            <div>
                <iframe width="560" height="315" src="<?= $media['trailer_url']; ?>?start=60" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <p><?= $media['title']; ?></p>
        <p><i>Sortie le <?= strtolower ( strftime( "%A %d %B %G", strtotime($media['release_date'] ) ) ) ; ?></i></p>
    </a>
<?php endforeach; ?>



<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>

<!-- ?start=60 -->