<?php ob_start(); ?>

<div class="container">


    <h1 class="display-4">Mon historique</h1>
    
    <a href="index.php?action=history&submit=alldelete">
        <button type="button" style="margin-top: 15px;" class="btn btn-outline-danger" >Supprimer tous l'historique</button>
    </a>

    <table class="table" style="margin-top: 40px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Date de début</th>
                <th scope="col">Durée</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $historys as $history ): ?>
                <tr>
                    <th scope="row"><?= $history['id']; ?></th>
                    <td><?php Media::getMediasById( $history['id_media'] ); ?></td>
                    <td><?= $history['start_date']; ?></td>
                    <td><?= $history['watch_duration']; ?></td>

                    <td>
                        <a href="index.php?action=history&submit=delete&id=<?= $history['id']; ?>" >
                            <button type="button" style="margin-bottom: 15px; margin-left: 15px;" class="btn btn-outline-danger" >Supprimer le compte</button>
                        </a>
                    </td>

                </tr>    
            <?php endforeach; ?>
        
        </tbody>
    </table>


</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
