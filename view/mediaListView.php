<?php ob_start(); ?>

<?php if ( $page == "favorite" ): ?>
    <h1 class="display-4">Mes Favoris</h1>
<?php endif; ?>


<div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>


<div class="media-list">

    <?php if ( $page == "favorite" ): ?>

        <?php foreach( $medias as $media ): ?>
            <?php if ( Media::textFavorite( $media['id'], $_SESSION['user_id'], 2 ) == 2 ): ?>

                <?php if ( $media['type'] == "series" ): ?>
                    <div class="item" style="background-color: #363c63">
                <?php else: ?>
                    <div class="item">
                <?php endif; ?>

                    <a href="index.php?media=<?= $media['id']; ?>">
                        <div class="video">
                            <div>
                                <iframe allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>" ></iframe>
                            </div>
                        </div>
                        <div class="title"><?= $media['title']; ?></div>
                        <div class="title"><i>Sortie le <?= strtolower ( strftime( "%A %d %B %G", strtotime($media['release_date'] ) ) ) ; ?></i></div>
                    </a>

                    <a href="index.php?like=<?= $media['id'] ?>" style="padding: 15px">
                    <?php $positive = Media::textFavorite( $media['id'], $_SESSION['user_id'], 2 ); if ( $positive == 1 ): ?>
                        <button type="button" class="btn btn-outline-success">
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-danger">
                    <?php endif; ?>

                            <?php Media::textFavorite( $media['id'], $_SESSION['user_id'], 1 ); ?>
                        </button>
                    </a>
                    
                </div>

            <?php endif; ?>
        <?php endforeach; ?>

    <?php else: ?>
        
        <?php foreach( $medias as $media ): ?>

            <?php if ( $media['type'] == "series" ): ?>
                <div class="item" style="background-color: #363c63">
            <?php else: ?>
                <div class="item">
            <?php endif; ?>

                <a href="index.php?media=<?= $media['id']; ?>">
                    <div class="video">
                        <div>
                            <iframe allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>" ></iframe>
                        </div>
                    </div>
                    <div class="title"><?= $media['title']; ?></div>
                    <div class="title"><i>Sortie le <?= strtolower ( strftime( "%A %d %B %G", strtotime($media['release_date'] ) ) ) ; ?></i></div>
                </a>

                <a href="index.php?like=<?= $media['id'] ?>" style="padding: 15px">
                <?php $positive = Media::textFavorite( $media['id'], $_SESSION['user_id'], 2 ); if ( $positive == 1 ): ?>
                    <button type="button" class="btn btn-outline-success">
                <?php else: ?>
                    <button type="button" class="btn btn-outline-danger">
                <?php endif; ?>
                        <?php Media::textFavorite( $media['id'], $_SESSION['user_id'], 1 ); ?>
                    </button>
                </a>
                
            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
