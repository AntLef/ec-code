<?php ob_start(); ?>

<div class="container-fluid" style="padding-bottom: 20px">

    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="<?= $url; ?>" width="300" height="150"></iframe>
    </div>

    <h1 class="display-4" style="margin-top:20px"><?= $medias[0]['title']; ?></h1>
    <p><?= $medias[0]['summary']; ?></p>

    <?php if ( $medias[0]['type'] == "movie" ): ?>
        <p><i>Sortie le <?= strtolower ( strftime( "%A %d %B %G", strtotime( $medias[0]['release_date'] ) ) ) ; ?></i></p>
    <?php endif ?>


    <?php if ( $medias[0]['type'] == "series" ): ?>
    
        <p><i>Sortie du premier épisode le <?= strtolower ( strftime( "%A %d %B %G", strtotime( $medias[0]['release_date'] ) ) ) ; ?></i></p>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <?php foreach ( $info_series as $info ): ?>

                <li class="nav-item">
                    <a class="nav-link <?php if ( $info["season_id"] == "1" ): print "active"; endif;  ?>" id="pills-<?= $info["season_id"] ?>-tab" data-toggle="pill" href="#pills-<?= $info["season_id"] ?>" role="tab" aria-controls="pills-<?= $info["season_id"] ?>" aria-selected="true"> Saison <?= $info["season_id"] ?> </a>
                </li>

            <?php endforeach ?>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <?php foreach ( $info_series as $info ): ?>

                <div class="tab-pane fade  <?php if ( $info["season_id"] == "1" ): print "show active"; endif;  ?>" id="pills-<?= $info["season_id"] ?>" role="tabpanel" aria-labelledby="pills-<?= $info["season_id"] ?>-tab">
                    <?php require 'episodeMediaView.php' ?>
                </div>

            <?php endforeach ?>
        </div>

    <?php endif ?>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>

<!-- ?start=60 -->
