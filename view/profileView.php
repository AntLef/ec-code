<?php ob_start(); ?>



<div class="container" style="padding: 10%" >


    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Modifier ton email</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Modifier ton mot de passe</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Supprimer ton compte</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
            <div class="container" style="margin-top: 20px" >

                <form method="post" action="index.php?action=profile&submit=modify_email" class="custom-form">

                    <div class="form-group">
                        <label for="email">Nouvelle adresse email</label>
                        <input type="email" name="email" value="" id="email" class="form-control" />
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="Valider" class="btn btn-block bg-red" />
                            </div>
                        </div>
                    </div>

                    <span class="error-msg">
                    <?= isset( $error_msg_1 ) ? $error_msg_1 : null; ?>
                    </span>
                    <span class="valid-msg">
                    <?= isset( $valid_msg_1 ) ? $valid_msg_1 : null; ?>
                    </span>
                </form>

            </div>
        </div>

        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="container" style="margin-top: 20px" >

                <form method="post" action="index.php?action=profile&submit=modify_password" class="custom-form">

                    <div class="form-group">
                        <label for="old_password">Ancien mot de passe</label>
                        <input type="password" name="old_password" id="old_password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="Valider" class="btn btn-block bg-red" />
                            </div>
                        </div>
                    </div>

                    <span class="error-msg">
                    <?= isset( $error_msg_2 ) ? $error_msg_2 : null; ?>
                    </span>
                    <span class="valid-msg">
                    <?= isset( $valid_msg_2 ) ? $valid_msg_2 : null; ?>
                    </span>
                </form>

            </div>
        </div>

        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
            <div class="container" style="margin-top: 20px" >

                <a href="index.php?action=profile&submit=delete" >
                    <button type="button" style="margin-bottom: 15px; margin-left: 15px;" class="btn btn-outline-danger" >Supprimer le compte</button>
                </a>
        
            </div>
        </div>

    </div>

</div>






<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
