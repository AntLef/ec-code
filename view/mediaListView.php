<?php ob_start(); ?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link href="public/css/searchbar/searchbar.css" rel="stylesheet" />
<script src="public/js/searchbar/searchbar.js"></script>



<?php if ( $page == "favorite" ): ?>
    <h1 class="display-4">Mes Favoris</h1>
<?php endif; ?>




<div class="container">

    <div class="search-box input-group flex-nowrap" style="padding-top: 30px; padding-bottom: 30px">
        <input type="text" autocomplete="off" placeholder="Recherche un film, une série ..." />
        <div class="result"></div>
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

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
