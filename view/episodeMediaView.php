
<div class="card-columns" style="margin-bottom: 20px">
    <?php foreach( $series as $serie ): ?>
        <?php if ( $serie["season_id"] == $info["season_id"] ): ?>

            <div class="card">

                <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="<?= $serie['trailer_url']; ?>" width="300" height="150"></iframe></div>

                <div class="card-body">
                    <h5 class="card-title"><?= $serie["title"] ?> </h5><i><?= $serie['duration'] ?></i>
                    <p class="card-text"><?php print( Media::getTextResume( $serie["summary"] ) ) ?></p>
                </div>

                <a href="index.php?media=<?= $medias[0]['id']; ?>&url=<?= $serie['trailer_url']; ?>?autoplay=1" >
                    <button type="button" style="margin-bottom: 15px; margin-left: 15px;" class="btn btn-outline-success" >Regarder L'épisode <?= $serie["episode_id"] ?></button>
                </a>

            </div>

        <?php endif ?>
    <?php endforeach ?>
</div>
